<?php

$params = require __DIR__ . '/params.php';
$db = require __DIR__ . '/db.php';
$mailer = require __DIR__ . '/mailer.php';

$config = [
    'id' => 'webapp',
    'defaultRoute' => 'landing',
    'basePath' => dirname(__DIR__),
    'bootstrap' => ['log'],
    'controllerNamespace' => 'app\src\web\controllers',
    'viewPath' => '@views',
    'aliases' => [
        '@bower' => '@vendor/bower-asset',
        '@npm'   => '@vendor/npm-asset',
    ],
    'components' => [
        'db' => $db,
        'mailer' => $mailer,
        'request' => [
            'cookieValidationKey' => 'LEE9KOsx6rKHmWaprCAf7JsG8P2oWJe9',
        ],
        'cache' => [
            'class' => \yii\caching\FileCache::class,
        ],
        'user' => [
            'class' => \app\src\common\components\users\managers\UserManager::class,
            'identityClass' => \app\src\common\components\users\entities\User::class,
            'enableAutoLogin' => true,
            'autoRenewCookie' => true,
            'loginUrl' => ['accounts/login'],
        ],
        'authManager' => [ //roles and permissions
            'class' => 'yii\rbac\DbManager',
        ],
        'errorHandler' => [
            'errorAction' => 'landing/error',
        ],
        'log' => [
            'traceLevel' => YII_DEBUG ? 3 : 0,
            'targets' => [
                [
                    'class' => 'yii\log\FileTarget',
                    'levels' => ['error', 'warning'],
                ],
            ],
        ],
        'i18n' => [
            'translations' => [
                'locales' => [
                    'class' => \app\src\common\components\i18n\managers\TranslationManager::class,
                ],
                'routes' => [
                    'class' => \app\src\common\components\i18n\managers\TranslationManager::class,
                ],
            ],
        ],
        'urlManager' => [
            'class' => \app\src\common\components\i18n\managers\UrlManager::class,
            'enablePrettyUrl' => true,
            'showScriptName' => false,
            'hideActionIndex' => true,
            'enableLocaleUrls' => true,
            'translateUrl' => true,
            'enableDefaultLanguageUrlCode' => true,
            'enableLanguageDetection' => true,
            'enableLanguagePersistence' => false,
            'languageParam' => 'language',

            'rules' => [
                '/' => 'landing/index',
                '/about' => 'landing/about',
                '/contact' => 'landing/contact',
                '/privacy' => 'landing/privacy',
                '/terms' => 'landing/terms',
                '/login' => 'accounts/login',
                '/signup' => 'accounts/signup',
            ],
        ],
    ],
    'params' => $params,
    'language' => 'es', //default for web content translation
    'sourceLanguage' => false //To-Fix: the translation not working with the language setted in sourceLanguage
];

if (YII_ENV_DEV) {
    // configuration adjustments for 'dev' environment
    $config['bootstrap'][] = 'debug';
    $config['modules']['debug'] = [
        'class' => \yii\debug\Module::class,
        // uncomment the following to add your IP if you are not connecting from localhost.
        'allowedIPs' => ['192.168.1.*', '::1'],
    ];

    $config['bootstrap'][] = 'gii';
    $config['modules']['gii'] = [
        'class' => \yii\gii\Module::class,
        // uncomment the following to add your IP if you are not connecting from localhost.
        //'allowedIPs' => ['127.0.0.1', '::1'],
    ];
}

return $config;
