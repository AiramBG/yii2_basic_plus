<?php

namespace app\src\web\forms;

use Yii;
use yii\base\Model;

/**
 * ContactForm is the model behind the contact form.
 */
class ContactForm extends Model
{
    public $name;
    public $email;
    public $subject;
    public $body;
    public $verifyCode;

    /**
     * @return array customized attribute labels
     */
    public function attributeLabels()
    {
        return [
            'name' => Yii::l('name'),
            'email' => Yii::l('email'),
            'subject' => Yii::l('subject'),
            'body' => Yii::l('message'),
            'verifyCode' => 'Verification Code',
        ];
    }


    /**
     * @return array the validation rules.
     */
    public function rules()
    {
        return [
            // name, email, subject and body are required
            [['name', 'email', 'subject', 'body'], 'required'],
            [['name'], 'string', 'max' => 100],
            [['email'], 'email'],
            [['email'], 'string', 'max' => 254],
            [['body'], 'string', 'max' => 1000],
            [['verifyCode'], 'captcha', 'captchaAction' => 'landing/captcha'],
        ];
    }


    /**
     * Sends an email to the specified email address using the information collected by this model.
     * @param string $email the target email address
     * @return bool whether the model passes validation
     */
    public function contact($email)
    {
        if ($this->validate()) {
            Yii::$app->mailer->compose()
                ->setTo($email)
                ->setFrom([Yii::$app->params['senderEmail'] => Yii::$app->params['senderName']])
                ->setReplyTo([$this->email => $this->name])
                ->setSubject($this->subject)
                ->setTextBody($this->body)
                ->send();

            return true;
        }
        return false;
    }
}
