<?php

namespace app\src\web\widgets;

use app\src\common\components\users\entities\User;
use Yii;
use yii\bootstrap4\Html;

class Dropdown extends \yii\bootstrap4\Dropdown
{
    /**
     * It Builds a dropdown list of messages
     * @param string $navIcon
     * @param array $activities [icon|image='', title='', body='', datetime=Datetime, url=''], //TODO Activity model
     * @param int $maxActivities
     * @param int $bodyTruncate
     * @return array
     */
    public static function activityList($navIcon, $activities = [], $maxActivities = 0, $bodyTruncate = 50)
    {
        $activityItem = [
            'label' => Icon::i('la', $navIcon)->size(Icon::SIZE_2X)->badge(count($activities)),
            'dropdownOptions' => ['class' => 'dropdown-menu-right'], //div container
            'options' => ['class' => 'vertical-align'], //tag li
            'linkOptions' => ['class' => 'remove-caret'], //tag a
            'items' => [],
        ];
        foreach ($activities as $i => $act) {
            if ($maxActivities > 0 && $i >= $maxActivities) break;

            $title = isset($act['title']) ? $act['title'] : '';
            $image = '';

            //Image or Icon
            if (isset($act['image'])) {
                $image = $act['image'] ?: User::DEFAULT_AVATAR;
                $image = '<img src="'.$image.'" class="mr-3 rounded-circle" width="32" height="32">';
            } elseif (isset($act['icon'])) {
                $image = Icon::i('la', $act['icon'] ?: $navIcon, ['class' => 'mr-3'])->size(Icon::SIZE_3X);
            }

            $body = isset($act['body']) ? \yii\helpers\StringHelper::truncate($act['body'], $bodyTruncate) : '';
            $relativeDate = isset($act['datetime']) ? Yii::$app->formatter->format($act['datetime'], 'relativeTime') : '';

            $templateHolder = '
        <div class="media">
           '.$image.'
           <div class="media-body">
              <div class="d-flex w-100 justify-content-between">
                 <h6 class="mt-0">'.$title.'</h6>
                 <small>'.$relativeDate.'</small>
              </div>
              <span>'.$body.'</span>
           </div>
        </div>';

            $activityItem['items'][] = ['label' => $templateHolder, 'url' => $act['url']];
            if ($i < count($activities)-1) {
                $activityItem['items'][] = Html::tag('div', '', ['class' => 'dropdown-divider']);
            }
        }

        return $activityItem;
    }

}