<?php

namespace app\src\web\widgets;

use Yii;
use yii\bootstrap4\Html;
use yii\helpers\ArrayHelper;

/**
 * WIDGET OPTIONS
 * LanguageDropdown sets dropdown options like Dropdown widget by default.
 * If you want options for the button you will need to nest the options matching with the format below:
 *
 * $options = [
 *  'container' => [...] //div container with default 'dropdown' class
 *  'button' => [...] //button options with default 'btn' and 'dropdown-toggle' classes
 *  'dropdown' => [...] //dropdown options with default 'dropdown-item' class
 * ];
 *
 * You can avoid one or more of them:
 *
 * $options = [
 *  'button' => [...]
 * ];
 *
 * $options = [
 *  'dropdown' => [...]
 * ];
 *
 * The example above has the same result that:
 * $options => [...] //dropdown by default
 */
class LanguageDropdown extends Dropdown
{
    private static $_labels;

    private $_isError;

    public function init()
    {
        $this->_isError = Yii::$app->controller->route === Yii::$app->errorHandler->errorAction;
        $this->items = $this->getItemsLanguages();
        parent::init();
    }

    /**
     * Get the items as selectable options of languages.
     * @return array
     */
    private static function getItemsLanguages()
    {
        $route = Yii::$app->controller->route;
        $appLanguage = Yii::$app->language;
        $params = $_GET;

        array_unshift($params, '/' . $route);
        $items = [];

        foreach (Yii::$app->urlManager->languages as $language) {
            $isWildcard = substr($language, -2) === '-*';
            if (
                $language === $appLanguage ||
                // Also check for wildcard language
                $isWildcard && substr($appLanguage, 0, 2) === substr($language, 0, 2)
            ) {
                continue;   // Exclude the current language
            }
            if ($isWildcard) {
                $language = substr($language, 0, 2);
            }
            $params['language'] = $language;
            $items[] = [
                'label' => self::label($language),
                'url' => $params,
            ];
        }
        return $items;
    }

    public function run()
    {
        // Only show this widget if we're not on the error page
        if ($this->_isError) {
            return '';
        } else {
            return parent::run();
        }
    }

    public static function label($code)
    {
        if (self::$_labels === null) {
            self::$_labels = Yii::getLanguages();
        }

        return isset(self::$_labels[$code]) ? self::$_labels[$code] : null;
    }


    protected function renderItems($items, $options = [])
    {
        $containerOptions = isset($options['container']) ? $options['container'] : [];
        $buttonOptions = isset($options['button']) ? $options['button'] : [];
        $dropdownOptions = isset($options['dropdown']) ? $options['dropdown'] : [];
        if (empty($containerOptions) && empty($buttonOptions) && !empty($options)) {
            $dropdownOptions = $options;
        }

        Html::addCssClass($containerOptions, ['widget' => 'dropdown']);
        Html::addCssClass($buttonOptions, ['widget' => 'dropdown-toggle']);
        Html::addCssClass($dropdownOptions, ['widget' => 'dropdown-menu']);
        $buttonOptions = ArrayHelper::merge(
            $buttonOptions,
            ['data-toggle' => 'dropdown','aria-haspopup' => 'true', 'aria-expanded' => 'false']
        );

        $lines = [];
        $lines[] = Html::button(self::label(Yii::$app->language), $buttonOptions);
        $lines[] = parent::renderItems($items, $dropdownOptions);
        return Html::tag('div', implode("\n", $lines), $containerOptions);
    }

    /**
     * Build a Nav item array.
     * @param array $config name-value pairs that will be used to initialize the object properties
     * @return array the item result of the widget.
     * @throws \Exception
     */
    public static function item($config = [])
    {
        $config['label'] = self::label(Yii::$app->language);
        $config['items'] = self::getItemsLanguages();
        return $config;
    }
}