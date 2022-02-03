<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $name string */
/* @var $verifyLink string */

?>
<div class="verify-email">
    <p><?= Yii::l('welcome_username', ['name' => $name]) ?></p>

    <p><?= Yii::l('account_creation_email_body') ?></p>

    <p><?= Html::a(Html::encode($verifyLink), $verifyLink) ?></p>
</div>
