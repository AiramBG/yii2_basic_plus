<?php

return [
    'class' => 'yii\swiftmailer\Mailer',
    'viewPath' => '@common/components/mail',
    // send all mails to a file by default. You have to set
    // 'useFileTransport' to false and configure a transport
    // for the mailer to send real emails.
    'useFileTransport' => false,
    'transport' => [
        'class' => 'Swift_SmtpTransport',
        'host' => '',
        'username' => '',
        'password' => '',
        'port' => '587',
        'encryption' => 'tls',
    ],
];




