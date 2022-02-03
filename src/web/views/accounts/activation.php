<?php

/* @var $this yii\web\View */
/* @var $success boolean */

use yii\bootstrap4\Html;
use yii\bootstrap4\ActiveForm;

$this->title = Yii::l('account_activation');
$this->params['breadcrumbs'][] = Yii::l('signup');
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="site-activation">
    <h1><?= $this->title ?></h1>

    <?php if ($success): ?>
        <p><?= Yii::l('account_activation_success') ?> <?= Yii::l('you_can_login_now') ?></p>
    <?php else: ?>
        <p><?= Yii::l('account_activation_fail') ?></p>
        <p><?= Html::a(Yii::l('need_validation_email'), ['accounts/recovery']) ?></p>
    <?php endif; ?>
</div>
