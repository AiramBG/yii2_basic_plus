<?php

namespace app\src\common\components\i18n\managers;

use yii\base\InvalidConfigException;
use yii\caching\CacheInterface;
use yii\db\Connection;
use yii\db\Query;
use yii\di\Instance;
use yii\helpers\ArrayHelper;
use yii\i18n\MessageSource;

/**
 * This class compiles to an associative array all translation messages from the application language.
 * First, TranslationManager tries to get all messages from matching language (for example: es_ES)
 * Second, TranslationManager extract the main language ("es") and merge all previous messages with the new langCode.
 * It results in a complete traduction sheet for your application.
 */
class TranslationManager extends MessageSource
{
    /**
     * @var Connection|array|string the DB connection object or the application component ID of the DB connection.
     *
     * After the DbMessageSource object is created, if you want to change this property, you should only assign
     * it with a DB connection object.
     *
     * Starting from version 2.0.2, this can also be a configuration array for creating the object.
     */
    public $db = 'db';

    /**
     * @var CacheInterface|array|string the cache object or the application component ID of the cache object.
     * The messages data will be cached using this cache object.
     * Note, that to enable caching you have to set [[enableCaching]] to `true`, otherwise setting this property has no effect.
     *
     * After the DbMessageSource object is created, if you want to change this property, you should only assign
     * it with a cache object.
     *
     * Starting from version 2.0.2, this can also be a configuration array for creating the object.
     * @see cachingDuration
     * @see enableCaching
     */
    public $cache = 'cache';

    /**
     * @var int the time in seconds that the messages can remain valid in cache.
     * Use 0 to indicate that the cached data will never expire.
     * @see enableCaching
     */
    public $cachingDuration = 60; //86400 = 1 day

    /**
     * @var bool whether to enable caching translated messages
     */
    public $enableCaching = false;

    /**
     * Initializes the DbMessageSource component.
     * This method will initialize the [[db]] property to make sure it refers to a valid DB connection.
     * Configured [[cache]] component would also be initialized.
     * @throws InvalidConfigException if [[db]] is invalid or [[cache]] is invalid.
     */

    public function init()
    {
        parent::init();
        $this->db = Instance::ensure($this->db, Connection::class);
        if ($this->enableCaching) {
            $this->cache = Instance::ensure($this->cache, 'yii\caching\CacheInterface');
        }
    }

    /**
     * Loads the message translation for the specified language and category.
     * If translation for specific locale code such as `en-US` isn't found it
     * tries more generic `en`.
     *
     * @param string $category the message category (sheet or routes)
     * @param string $language the target language
     * @return array the loaded messages. The keys are original messages, and the values
     * are translated messages.
     */
    protected function loadMessages($category, $language)
    {
        $category = strtolower($category);

        if ($this->enableCaching) {
            $key = [
                __CLASS__,
                $category,
                $language,
            ];
            $messages = $this->cache->get($key);
            if ($messages === false) {
                $messages = $this->loadMessagesFromDb($category, $language);
                $this->cache->set($key, $messages, $this->cachingDuration);
            }

            return $messages;
        }

        return $this->loadMessagesFromDb($category, $language);
    }

    /**
     * Loads the translation sheets from database.
     * @param string $category the message category (sheet or routes).
     * @param string $language the target language.
     * @return array the messages loaded from database.
     */
    protected function loadMessagesFromDb($category, $language)
    {
        $mainQuery = $this->localeLoader($category, $language);
        $fallbackLanguage = substr($language, 0, 2);
        if ($fallbackLanguage !== $language) {
            $mainQuery->union($this->localeLoader($category, $fallbackLanguage), true);
        }
        $langSheet = $mainQuery->createCommand($this->db)->queryAll();
        $langSheet = ArrayHelper::map($langSheet, 'key', 'translation');

        if ($category == 'routes') {
            foreach ($langSheet as $route => $translation) {
                if ($route == $translation) continue;
                $langSheet[$translation] = $route;
            }
        }

        return $langSheet;
    }

    /**
     * The method builds the [[Query]] object for the language messages search.
     * Normally is called from [[loadMessagesFromDb]].
     *
     * @param string $category the message category
     * @param string $language the requested language
     * @param bool $reverse loads keys as translations, and translations as keys
     * @return Query
     * @see loadMessagesFromDb
     * @since 2.0.7
     */
    protected function localeLoader($category, $language, $reverse = false)
    {
        return (new Query())
            ->select(['key', 'langcode' , 'translation'])
            ->from('{{%i18n_'.$category.'}}')
            ->where(['langcode' => $language]);
    }

    /**
     * @return array [['langcode' => 'en', 'localname' => 'English'], ... ]
     * @throws \yii\db\Exception
     */
    public function getLanguages()
    {
        $languages = [];
        $results = (new Query())
            ->select(['langcode', 'localname'])
            ->from('{{%i18n_languages}}')
            ->createCommand($this->db)
            ->queryAll();

        foreach ($results as $result) {
            $languages[$result['langcode']] = $result['localname'];
        }

        return $languages;
    }

    /**
     * @return string[] ['en', 'es', ... ]
     */
    public function getLangCodes()
    {
        try {
            return array_keys($this->getLanguages());
        } catch(\Throwable $t) {
            return [];
        }
    }
}