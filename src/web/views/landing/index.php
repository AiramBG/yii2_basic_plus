<?php
/* @var $this yii\web\View */

use yii\helpers\Html;

$this->title = Yii::$app->name;

$langLabel = Yii::l('language');
$langCode = Yii::$app->language;

$congrats = Yii::l('congratulations');
$yiiCreatedSuccessfully = Yii::l('yii_created_successfully', ['version' => Yii::getVersion()]);
$guideButton = Yii::l('yii_guide_button');

?>
<div class="site-index">

    <div class="jumbotron text-center bg-transparent">
        <h1 class="display-4"><?= $congrats ?></h1>

        <p class="lead"><?= $yiiCreatedSuccessfully ?></p>

        <p><a class="btn btn-lg btn-success" href="https://www.yiiframework.com/doc/guide/2.0"><?= $guideButton ?></a></p>
    </div>

    <div class="body-content">

        <div class="row">
            <div class="col-lg-4">
                <h2>Request params</h2>

                <table class="table">
                    <tr><td><?= $langLabel ?></td><td><?= $langCode ?></td></tr>
                    <?php foreach ($_GET as $key => $value) echo "<tr><td>{$key}</td><td>{$value}</td></tr>" ?>
                </table>

            </div>
            <div class="col-lg-4">
                <h2>Heading</h2>

                <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et
                    dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip
                    ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu
                    fugiat nulla pariatur.</p>

                <p><?php
                    echo (Yii::$app->user->isGuest)
                        ? Html::a(Yii::l('signup'), ['accounts/signup'], ['class' => 'btn btn-primary'])
                        : Html::a(Yii::l('private_area'), ['dashboard/index'], ['class' => 'btn btn-primary'])
                    ?></p>
            </div>
            <div class="col-lg-4">
                <h2>Heading</h2>

                <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et
                    dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip
                    ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu
                    fugiat nulla pariatur.</p>

                <p><a class="btn btn-outline-secondary" href="http://www.yiiframework.com/extensions/">Yii Extensions &raquo;</a></p>
            </div>
        </div>

    </div>
</div>
