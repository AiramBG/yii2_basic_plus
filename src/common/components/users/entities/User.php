<?php

namespace app\src\common\components\users\entities;

use app\src\common\components\tokens\entities\Token;
use app\src\common\components\tokens\exceptions\UnknownBehaviorException;
use app\src\common\components\tokens\exceptions\UnknownTypeException;
use app\src\common\components\tokens\managers\TokenManager;
use Throwable;
use Yii;
use yii\db\ActiveRecord;
use yii\helpers\Html;
use yii\helpers\Url;
use yii\web\IdentityInterface;

class User extends ActiveRecord implements IdentityInterface
{
    const NAME_MIN_LENGTH = 3;
    const NAME_MAX_LENGTH = 50;
    const PWD_MIN_LENGTH = 3;
    const PWD_MAX_LENGTH = 100;
    const SESSION_EXPIRATION_DAYS = 30;
    const EMAIL_VALIDATION_EXPIRATION_DAYS = 3;
    const LOGIN_FIELD = 'email';
    const DEFAULT_AVATAR = 'https://secure.gravatar.com/avatar/3c3fe674164a4dba4b7ba5cfcab02d4b?s=512&d=mm&r=g';

    const STATUS_DELETED = 0;
    const STATUS_INACTIVE = 1; //Accounts pending to redeem the confirmation token
    const STATUS_SUSPENDED = 2; //Accounts temporarily disabled due to inappropriate behavior or rule-breaking.
    const STATUS_ACTIVE = 10;

    private $_authToken;

    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return '{{%users}}';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            ['status', 'default', 'value' => self::STATUS_INACTIVE],
            ['status', 'in', 'range' => [self::STATUS_ACTIVE, self::STATUS_INACTIVE, self::STATUS_DELETED]],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public static function findIdentity($id)
    {
        return static::findOne(['id' => $id]);
    }


    /**
     * {@inheritdoc}
     */
    public static function findIdentityByAccessToken($token, $type = null)
    {
        return self::findByToken($token, TokenManager::TYPE_ACCESS_TOKEN);
    }


    /**
     * Finds user by a field setted in self::LOGIN_FIELD
     *
     * @param string $email
     * @return static|null
     */
    public static function findByLoginField($value)
    {
        return static::findOne([self::LOGIN_FIELD => $value, 'status' => self::STATUS_ACTIVE]);
    }

    /**
     * Finds user by validation email token
     *
     * @param string $token
     * @return static|null
     */
    public static function findByValidationTokenCode($token) {
        return self::findByToken($token, TokenManager::TYPE_EMAIL_VALIDATION);
    }

    /**
     * Finds user by password reset token
     *
     * @param string $token password reset token
     * @return static|null
     */
    public static function findByPasswordResetToken($token)
    {
        return self::findByToken($token, TokenManager::TYPE_PWD_RESET);
    }

    /**
     * Generic workflow for validation with tokens
     * @param $tokenCode
     * @param $tokenType
     * @return IdentityInterface|null
     */
    private static function findByToken($tokenCode, $tokenType)
    {
        try {
            $token = (new TokenManager())->redeem($tokenCode, $tokenType);
            return $token ? self::findIdentity($token->user_id) : null;
        } catch(Throwable $t) {
            Yii::debug($t->getMessage(), __METHOD__);
            return null;
        }
    }

    /**
     * {@inheritdoc}
     */
    public function getId()
    {
        return $this->getPrimaryKey();
    }

    /**
     * {@inheritdoc}
     */
    public function getAuthKey()
    {
        try {
            if (is_null($this->_authToken)) {
                $this->_authToken = $this->generateAccessToken();
                Yii::info("Token created for user id {$this->getId()} with code: {$this->_authToken->code}");
            }
            return $this->_authToken->code;
        } catch(\Throwable $t) {
            Yii::debug($t->getMessage(), __METHOD__);
            return null;
        }
    }

    /**
     * {@inheritdoc}
     */
    public function validateAuthKey($authKey)
    {
        $token = (new TokenManager())->redeem($authKey, TokenManager::TYPE_ACCESS_TOKEN);
        return !is_null($token);
    }

    /**
     * @param string $authKey
     * @return bool
     */
    public function removeAuthKey($authKey)
    {
        return (new TokenManager())->removeToken($this->getId(), TokenManager::TYPE_ACCESS_TOKEN, $authKey) > 0;
    }

    /**
     * Validates password
     *
     * @param string $password password to validate
     * @return bool if password provided is valid for current user
     */
    public function validatePassword($password)
    {
        return Yii::$app->security->validatePassword($password, $this->password);
    }

    /**
     * Generates password hash from password and sets it to the model
     *
     * @param string $password
     */
    public function setPassword($password)
    {
        $this->password = Yii::$app->security->generatePasswordHash($password);
    }

    /**
     * Generates a secure random passsword
     *
     * @return string
     * @throws \yii\base\Exception
     */
    public function setNewPassword()
    {
        $pwd = Yii::$app->security->generateRandomString(max(User::PWD_MIN_LENGTH, 6));
        $this->setPassword($pwd);
        return $pwd;
    }

    /**
     * Generates "remember me" authentication key
     */
    public function generateAccessToken()
    {
        return (new TokenManager())->create(
            $this->id,
            TokenManager::TYPE_ACCESS_TOKEN,
            TokenManager::BEHAVIOR_ADD,
            86400 * self::SESSION_EXPIRATION_DAYS
        );
    }

    /**
     * Generates new token for email validation
     * @return Token
     * @throws Throwable
     * @throws UnknownBehaviorException
     * @throws UnknownTypeException
     * @throws \yii\db\StaleObjectException
     */
    public function generateEmailValidationToken()
    {
        return (new TokenManager())->create(
            $this->id,
            TokenManager::TYPE_EMAIL_VALIDATION,
            TokenManager::BEHAVIOR_REPLACE,
            86400* self::EMAIL_VALIDATION_EXPIRATION_DAYS,
            1
        );
    }

    /**
     * Sends confirmation email to user
     * @return bool whether the email was sent
     */
    public function sendEmailValidationToken()
    {
        try {
            $token = $this->generateEmailValidationToken();
            return Yii::$app
                ->mailer
                ->compose(
                    ['html' => 'emailValidation-html', 'text' => 'emailValidation-text'],
                    [
                        'verifyLink' => Url::to(['accounts/activation', 'v' => $token->code], true),
                        'name' => Html::encode($this->name),
                    ]
                )
                ->setFrom([Yii::$app->params['senderEmail'] => Yii::$app->params['senderName']])
                ->setTo($this->email)
                ->setSubject(Yii::l('account_creation_email_subject', ['appname' => Yii::$app->name]))
                ->send();
        }
        catch(Throwable $t) {
            Yii::error($t->getMessage(), __METHOD__);
            return false;
        }
    }

    /**
     * Generates new token for account recovery
     * @return Token
     * @throws Throwable
     * @throws UnknownBehaviorException
     * @throws UnknownTypeException
     * @throws \yii\db\StaleObjectException
     */
    public function generatePasswordResetToken()
    {
        return (new TokenManager())->create(
            $this->id,
            TokenManager::TYPE_PWD_RESET,
            TokenManager::BEHAVIOR_REPLACE,
            86400 * self::EMAIL_VALIDATION_EXPIRATION_DAYS,
            1
        );
    }

    /**
     * Sends a password recovery code by email.
     * @return bool whether the email was sent
     */
    public function sendPasswordResetToken()
    {
        try {
            $token = $this->generatePasswordResetToken();
            return Yii::$app
                ->mailer
                ->compose(
                    ['html' => 'passwordReset-html', 'text' => 'passwordReset-text'],
                    [
                        'resetLink' => Url::to(['accounts/password-reset', 't' => $token->code], true),
                        'name' => Html::encode($this->name),
                    ]
                )
                ->setFrom([Yii::$app->params['senderEmail'] => Yii::$app->params['senderName']])
                ->setTo($this->email)
                ->setSubject(Yii::l('password_reset'))
                ->send();
        }
        catch(Throwable $t) {
            Yii::error($t->getMessage(), __METHOD__);
            return false;
        }
    }
}
