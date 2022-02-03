<?php

namespace app\src\web\widgets;

use Yii;
use yii\helpers\ArrayHelper;
use yii\helpers\Html;

class Icon
{
    /**
     * Size values (font-awesome and line-awesome compatible)
     */
    const SIZE_LARGE = 'lg';
    const SIZE_LG = 'lg';
    const SIZE_SMALL = 'sm';
    const SIZE_SM = 'sm';
    const SIZE_EXTRA_SMALL = 'xs';
    const SIZE_XS = 'xs';
    const SIZE_2X = '2x';
    const SIZE_3X = '3x';
    const SIZE_4X = '4x';
    const SIZE_5X = '5x';
    const SIZE_6X = '6x';
    const SIZE_7X = '7x';
    const SIZE_8X = '8x';
    const SIZE_9X = '9x';
    const SIZE_10X = '10x';


    /** @var string Iconset shortname */
    private $prefix;

    /** @var string */
    private $badgeText = '';

    /** @var bool */
    private $hasDot = false;

    /** @var array */
    private $iconOptions = [];

    /** @var array Badge/Dot options */
    private $activityOptions = [];

    /** @var string */
    private $screenReaderText = '';

    /** @var array */
    private $screenReaderOptions = [];

    /** @var bool */
    private $hasStack;

    /** @var array stack container options */
    private $stackOptions = [];

    /**
     *
     * @param $iconsetPrefix
     * @param $iconName
     * @param $options
     * @return Icon
     */
    public static function i($iconsetPrefix, $iconName, $options = [])
    {
        return new self($iconsetPrefix, $iconName, $options);
    }

    /**
     * @param string $prefix
     * @param string $name
     * @param array $options
     */
    public function __construct($prefix, $name = '', $options = [])
    {
        $this->prefix = $prefix;
        Html::addCssClass($options, $prefix);

        if (!empty($name)) {
            Html::addCssClass($options, $prefix . '-' . $name);
        }

        $this->iconOptions = $options;
    }

    /**
     * Show an unread activity badge over the icon
     * @param string $text
     * @param array $options
     * @return Icon
     */
    public function badge($text = '', $options = []) {
        $this->badgeText = $text;
        $this->hasDot = false;
        if (!empty($text)) {
            Html::addCssClass($options, 'position-absolute badge rounded-pill bg-danger');
        }
        $this->activityOptions = $options;
        $this->stack();
        return empty($this->screenReaderText) && !empty($text) && is_numeric($text)
            ? $this->srOnly(Yii::l('unread_notifications'))
            : $this;
    }

    /**
     * Show an unread activity dot over the icon
     * @param bool $show
     * @param array $options
     * @return Icon
     */
    public function dot($show = false, $options = [])
    {
        $this->hasDot = $show;
        $this->badgeText = '';
        if ($show) {
            Html::addCssClass($options, 'position-absolute top-0 start-100 translate-middle p-2 bg-danger border border-light rounded-circle');
        }
        $this->activityOptions = $options;
        $this->stack();
        $this->srOnly(Yii::l('unread_notifications'));
        return $this;
    }


    public function stack($options = [])
    {
        $this->hasStack = true;
        Html::addCssClass($options, $this->prefix . '-stack');
        $this->stackOptions = $options;
        return $this;
    }

    /**
     * Adds a hidden message for accessibility purposes.
     * @param string $text
     * @param array $options
     * @return Icon
     */
    public function srOnly($text = '', $options = []) {
        $this->screenReaderText = $text;
        Html::addCssClass($options, 'sr-only');
        $this->screenReaderOptions = $options;
        return $this;
    }

    /**
     * @return Icon
     */
    public function spin()
    {
        Html::addCssClass($this->iconOptions, $this->prefix . '-spin');
        return $this;
    }

    /**
     * @return Icon
     */
    public function inverse()
    {
        Html::addCssClass($this->iconOptions, $this->prefix . '-inverse');
        return $this;
    }

    /**
     * @return Icon
     */
    public function fixedWidth()
    {
        Html::addCssClass($this->iconOptions, $this->prefix . '-fw');
        return $this;
    }

    /**
     * @return Icon
     */
    public function border()
    {
        Html::addCssClass($this->iconOptions, $this->prefix . '-border');
        return $this;
    }

    /**
     * @return Icon
     */
    public function pullLeft()
    {
        Html::addCssClass($this->iconOptions, $this->prefix . '-pull-left');
        return $this;
    }

    /**
     * @return Icon
     */
    public function pullRight()
    {
        Html::addCssClass($this->iconOptions, $this->prefix . '-pull-right');
        return $this;
    }

    /**
     * @param string $value
     * @return $this
     */
    public function size($value)
    {
        $values = [
            self::SIZE_LARGE,
            self::SIZE_LG,
            self::SIZE_SMALL,
            self::SIZE_SM,
            self::SIZE_EXTRA_SMALL,
            self::SIZE_XS,
            self::SIZE_2X,
            self::SIZE_3X,
            self::SIZE_4X,
            self::SIZE_5X,
            self::SIZE_6X,
            self::SIZE_7X,
            self::SIZE_8X,
            self::SIZE_9X,
            self::SIZE_10X
        ];
        if (in_array($value, $values)) {
            Html::addCssClass($this->iconOptions, $this->prefix . '-' . $value);
        }

        return $this;
    }

    /**
     * @return string
     */
    public function __toString()
    {
        $render = [];

        $options = $this->iconOptions;
        $tag = ArrayHelper::remove($options, 'tag', 'i');
        $render[] = Html::tag($tag, null, $options);

        if ($this->hasDot || !empty($this->badgeText)) {
            $options = $this->activityOptions;
            $tag = ArrayHelper::remove($options, 'tag', 'span');
            $text = !empty($this->badgeText) ? $this->badgeText : null;
            if (!empty($this->screenReaderText)) {
                $srOnly = Html::tag('span', $this->screenReaderText, $this->screenReaderOptions);
                if (!empty($text)) {
                    $text .= $srOnly;
                    $this->screenReaderText = null;
                }
            }
            $render[] = Html::tag($tag, $text, $options);
        }

        if (!empty($this->screenReaderText)) {
            $srOnly = Html::tag('span', $this->screenReaderText, $this->screenReaderOptions);
            $render[] = Html::tag($tag, $srOnly, $options);
        }

        $html = implode(PHP_EOL, $render);
        if ($this->hasStack) {
            $html = Html::tag('span', $html, $this->stackOptions);
        }

        return $html;
    }
}
