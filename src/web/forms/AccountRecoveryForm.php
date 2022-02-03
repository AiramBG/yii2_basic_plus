<?php

namespace app\src\web\forms;

use app\src\common\components\users\entities\User;
use Yii;
use yii\base\Model;

class AccountRecoveryForm extends Model
{
    /** @var string */
    public $email;

    /**
     * @return array customized attribute labels
     */
    public function attributeLabels()
    {
        return [
            'email' => Yii::l('email'),
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            ['email', 'trim'],
            ['email', 'required'],
            ['email', 'email'],
        ];
    }

    /**
     * Sends confirmation email to user
     *
     * @return bool whether the email was sent
     */
    public function sendEmail()
    {
        $user = User::findOne(['email' => $this->email]);
        if (is_null($user) || $user->status == User::STATUS_DELETED) {
            return false;
        }

        return ($user->status == User::STATUS_INACTIVE)
            ? $user->sendEmailValidationToken()
            : $user->sendPasswordResetToken();
    }
}
