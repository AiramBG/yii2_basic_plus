<?php

/* @var $this \yii\web\View */
/* @var $content string */

use app\src\common\components\users\entities\User;
use app\src\web\assets\AppAsset;
use app\src\web\widgets\Alert;
use app\src\web\widgets\Dropdown;
use app\src\web\widgets\Icon;
use app\src\web\widgets\LanguageDropdown;
use yii\bootstrap4\Breadcrumbs;
use yii\bootstrap4\Html;
use yii\bootstrap4\Nav;
use yii\bootstrap4\NavBar;
use yii\helpers\Url;

AppAsset::register($this);
$this->beginPage()
?>
<!DOCTYPE html>
<html lang="<?= Yii::$app->language ?>">
<head>
    <meta charset="<?= Yii::$app->charset ?>">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <?php $this->registerCsrfMetaTags() ?>
    <title><?= Html::encode($this->title) ?></title>
    <?php $this->head() ?>
</head>
<body>
<?php
$this->beginBody();

//TODO it should be filled by the controller
$notifications = [
    ['icon' => 'exclamation-triangle', 'title' => 'Who you gonna call?', 'body' => "There's something strange in your neighborhood.", 'datetime' => new DateTime(), 'url' => '#']
];
$messages = [
    ['image' => 'https://www.w3schools.com/w3images/avatar2.png', 'title' => 'Person 1', 'body' => 'This is a long test message. Messages should be displayed truncated so as not to exceed layout space.', 'datetime' => new DateTime(), 'url' => '#'],
    ['image' => 'https://www.w3schools.com/howto/img_avatar2.png', 'title' => 'Person 2', 'body' => 'Happy New Year!', 'datetime' => new DateTime('2022-01-01 00:00:00'), 'url' => '#'],
    ['image' => 'https://www.w3schools.com/howto/img_avatar.png', 'title' => 'Person 3', 'body' => 'Merry Christmas! Have you been good this year?', 'datetime' => new Datetime('2021-12-24 17:32:45'), 'url' => '#'],
];
//TODO end



$navItems = [];

//Notifications
$navItems[] = Dropdown::activityList('bell', $notifications);

//Messages
$items = Dropdown::activityList('envelope', $messages);
$items['items'][] = Html::tag('div', '', ['class' => 'dropdown-divider']);
$items['items'][] = ['label' => Yii::l('see_all_messages'), 'url' => '#'];
$navItems[] = $items;

//Language selector as nav item
$navItems[] = LanguageDropdown::item([
    'options' => ['class' => 'vertical-align'],
    'dropdownOptions' => ['class' => 'dropdown-menu-right remove-caret'], //sub-items div content
]);


//Account item
$avatar = User::DEFAULT_AVATAR;
$navItems[] = [
    'label' => '<img src='.$avatar.' width="32" height="32" class="rounded-circle">',
    'items' => [
        ['label' => Yii::l('settings'), 'url' => '#'],
        ['label' => Yii::l('logout'), 'url' => '#']
    ],
    'dropdownOptions' => ['class' => 'dropdown-menu-right'], //div container
    'options' => ['class' => 'vertical-align'], //tag li
];



NavBar::begin([
    'brandLabel' => Yii::$app->name,
    'brandUrl' => Url::to(['dashboard/index']),
    'brandOptions' => ['class' => 'navbar-brand px-3'],
    'renderInnerContainer' => false,
    'options' => ['class' => 'navbar navbar-dark sticky-top bg-dark flex-md-nowrap p-0 shadow navbar-expand-sm'],
]);

echo Nav::widget([
    'options' => ['class' => 'navbar-nav ml-auto mr-2'],
    'encodeLabels' => false,
    'items' => $navItems,
]);

NavBar::end();


?>
<div class="container-fluid">
    <div class="row">
        <nav id="sidebarMenu" class="col-md-3 col-lg-2 d-md-block bg-light sidebar collapse">
            <div class="sidebar-sticky pt-3">

                <!-- SIDE MENU -->

                <ul class="nav flex-column">
                    <li class="nav-item">
                        <a class="nav-link active" href="#"><?= Icon::i('la', 'file-alt') ?> Option 1</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="#"><?= Icon::i('la', 'file-alt') ?> Option 2</a>
                    </li>

                </ul>


                <h6 class="sidebar-heading d-flex justify-content-between align-items-center px-3 mt-4 mb-1 text-muted">
                    <span><?= Icon::i('la', 'folder') ?> Subcategory</span>
                    <a class="d-flex align-items-center text-muted" href="#" aria-label="Add a new option">
                        <i class="la la-plus-circle pull-right la-size-lg"></i>
                    </a>
                </h6>

                <ul class="nav flex-column">
                    <li class="nav-item">
                        <a class="nav-link" href="#"><?= Icon::i('la', 'file-alt') ?> Option 3</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="#"><?= Icon::i('la', 'file-alt') ?> Option 4</a>
                    </li>
                </ul>
            </div>
        </nav>

        <main role="main" class="col-md-9 ml-sm-auto col-lg-10 px-md-4"><div class="chartjs-size-monitor"><div class="chartjs-size-monitor-expand"><div class=""></div></div><div class="chartjs-size-monitor-shrink"><div class=""></div></div></div>
            <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3">
                <?= $content ?>
            </div>
        </main>
    </div>
</div>



<script src="https://cdn.jsdelivr.net/npm/feather-icons@4.28.0/dist/feather.min.js"></script>

<?php $this->endBody() ?>
</body>
</html>
<?php $this->endPage() ?>
