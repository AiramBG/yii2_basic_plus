<?php

namespace app\src\web\forms;

use app\src\common\components\tokens\entities\Token;
use Throwable;
use Yii;
use yii\base\Model;
use app\src\common\components\users\entities\User;
use yii\helpers\Html;
use yii\helpers\Url;

/**
 * Signup form
 */
class SignupForm extends Model
{
    public $name;
    public $email;
    public $password;

    /**
     * @return array customized attribute labels
     */
    public function attributeLabels()
    {
        return [
            'name' => Yii::l('name'),
            'email' => Yii::l('email'),
            'password' => Yii::l('password'),
        ];
    }


    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            ['name', 'trim'],
            ['name', 'required'],
            ['name', 'string', 'min' => User::NAME_MIN_LENGTH, 'max' => User::NAME_MAX_LENGTH],

            ['email', 'trim'],
            ['email', 'required'],
            ['email', 'email'],
            ['email', 'string', 'max' => 255],
            ['email', 'unique', 'targetClass' => User::class, 'message' => Yii::l('account_creation_err_email_exists')],

            ['password', 'required'],
            ['password', 'string', 'min' => User::PWD_MIN_LENGTH, 'max' => User::PWD_MAX_LENGTH],
        ];
    }

    /**
     * Signs user up.
     *
     * @return bool whether the creating new account was successful and email was sent
     */
    public function signup()
    {
        if (!$this->validate()) {
            return null;
        }

        try {
            $user = new User();
            $user->name = $this->name;
            $user->email = $this->email;
            $user->setPassword($this->password);
            $user->save();
        } catch(Throwable $t) {
            Yii::error($t->getMessage(), __METHOD__);
            return null;
        }

        return $user->sendEmailValidationToken();
    }
}
