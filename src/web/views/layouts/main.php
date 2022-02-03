<?php

/* @var $this \yii\web\View */
/* @var $content string */

use app\src\web\assets\AppAsset;
use app\src\web\widgets\Alert;
use app\src\web\widgets\LanguageDropdown;
use yii\bootstrap4\Breadcrumbs;
use yii\bootstrap4\Html;
use yii\bootstrap4\Nav;
use yii\bootstrap4\NavBar;

AppAsset::register($this);
$this->beginPage()
?>
<!DOCTYPE html>
<html lang="<?= Yii::$app->language ?>" class="h-100">
<head>
    <meta charset="<?= Yii::$app->charset ?>">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <?php $this->registerCsrfMetaTags() ?>
    <title><?= Html::encode($this->title) ?></title>
    <?php $this->head() ?>
</head>
<body class="d-flex flex-column h-100">
<?php $this->beginBody() ?>

<header>
    <?php
    NavBar::begin([
        'brandLabel' => Yii::$app->name,
        'brandUrl' => Yii::$app->homeUrl,
        'options' => [
            'class' => 'navbar navbar-expand-md navbar-dark bg-dark fixed-top',
        ],
    ]);

    echo Nav::widget([
        'options' => ['class' => 'navbar-nav ml-auto mr-2'],
        'items' => [
            ['label' => Yii::l('home'), 'url' => ['landing/index']],
            ['label' => Yii::l('about'), 'url' => ['landing/about']],
            ['label' => Yii::l('contact'), 'url' => ['landing/contact']],
        ],
    ]);

    echo LanguageDropdown::widget([
        'options' =>[
            'container' => ['class' => 'mr-2'],
            'button' => ['id' => 'languageSelector', 'class' => 'btn btn-sm btn-secondary']
        ]
    ]);


    if (Yii::$app->user->isGuest) {
        echo Html::a(Yii::l('login'), ['accounts/login'], ['class' => 'btn btn-primary btn-sm']);
    } else {
        echo Html::beginForm(['accounts/logout'], 'post', ['class' => 'form-inline'])
            . Html::submitButton(
                Yii::l('logout').' (' . Yii::$app->user->identity->name . ')',
                ['class' => 'btn btn-link logout']
            )
            . Html::endForm();
    }

    NavBar::end();
    ?>
</header>

<main role="main" class="flex-shrink-0">
    <div class="container">
        <?= Breadcrumbs::widget([
            'links' => isset($this->params['breadcrumbs']) ? $this->params['breadcrumbs'] : [],
        ]) ?>
        <?= Alert::widget() ?>
        <?= $content ?>
    </div>
</main>

<footer class="footer mt-auto py-3 text-muted">
    <div class="container">
        <p class="float-left">&copy; <?= Yii::$app->params['companyName'] ?> <?= date('Y') ?></p>
        <p class="float-right">
            <?= Html::a(Yii::l('privacy_policy'), ['landing/privacy']) ?> |
            <?= Html::a(Yii::l('terms_of_use'), ['landing/terms']) ?>
        </p>
    </div>
</footer>

<?php $this->endBody() ?>
</body>
</html>
<?php $this->endPage() ?>
