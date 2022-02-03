<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $name string */
/* @var $resetLink string */
?>
<div class="center">
    <p><?= Yii::l('hi_username', ['name' => $name]) ?></p>
    <p><?= Yii::l('password_reset_warning_msg') ?></p>
    <p><?= Yii::l('password_reset_link') ?></p>

    <p><?= Html::a(Html::encode($resetLink), $resetLink) ?></p>
</div>
