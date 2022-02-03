<?php

namespace app\src\web\forms;

use app\src\common\components\tokens\managers\TokenManager;
use app\src\common\components\users\entities\User;
use Yii;
use yii\base\Model;

class PasswordResetForm extends Model
{
    /** @var string */
    public $password;
    /** @var string */
    public $password_repeat;

    /** @var string */
    public $token;


    /**
     * @return array customized attribute labels
     */
    public function attributeLabels()
    {
        return [
            'password' => Yii::l('password'),
            'password_repeat' => Yii::l('password_repeat'),
        ];
    }


    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            ['password', 'required'],
            ['password', 'string', 'min' => User::PWD_MIN_LENGTH],
            ['password', 'string', 'max' => User::PWD_MAX_LENGTH],
            ['password_repeat', 'required'],
            ['password_repeat', 'compare', 'compareAttribute'=>'password', 'message' => Yii::l('password_dont_match')],
        ];
    }


    /**
     * Resets the password and send an alert email
     *
     * @return bool whether the email was sent
     */
    public function reset()
    {
        $user = User::findByPasswordResetToken($this->token);

        if ($user === null || $user->status != User::STATUS_ACTIVE) {
            return false;
        }

        $user->setPassword($this->password);
        $success = false;
        if ($user->save()) {
            (new TokenManager())->removeAllAccessTokens($user->getId());

            //Maybe you should to send an email for security reasons
            $success = true;
        }

        return $success;
    }
}
