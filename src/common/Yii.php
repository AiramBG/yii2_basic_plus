<?php

use app\src\common\components\i18n\managers\TranslationManager;

$yii2 = __DIR__ . '/../../vendor/yiisoft/yii2';
require $yii2 . '/BaseYii.php';


/**
 * Yii is a helper class serving common framework functionalities.
 */
class Yii extends \yii\BaseYii
{
    /**
     * Routes translation
     * @param $key
     * @param array $params
     * @param null $language
     * @return string
     */
    public static function r($key, $params = [], $language = null)
    {
        return self::t('routes', $key, $params, $language);
    }

    /**
     * Locale messages translation
     * @param $key
     * @param array $params
     * @param null $language
     * @return string
     */
    public static function l($key, $params = [], $language = null)
    {
        return self::t('locales', $key, $params, $language);
    }

    /**
     * Returns a list of supported languages
     * @return array
     */
    public static function getLanguages()
    {
        return (new TranslationManager())->getLanguages();
    }
}

spl_autoload_register(['Yii', 'autoload'], true, true);
Yii::$classMap = require $yii2 . '/classes.php';
Yii::$container = new yii\di\Container();