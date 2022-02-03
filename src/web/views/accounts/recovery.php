<?php

/* @var $this yii\web\View */
/* @var $form yii\bootstrap4\ActiveForm */
/* @var $model \app\src\web\forms\AccountRecoveryForm */

use yii\bootstrap4\Html;
use yii\bootstrap4\ActiveForm;

$this->title = Yii::l('account_recovery');
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="center">
    <h1><?= Html::encode($this->title) ?></h1>

    <p><?= Yii::l('account_recovery_msg') ?></p>

    <div class="row">
        <div class="col-lg-5">
            <?php $form = ActiveForm::begin(['id' => 'account-recovery-form']); ?>

            <?= $form->field($model, 'email')->textInput(['autofocus' => true]) ?>

            <div class="form-group">
                <?= Html::submitButton('Send', ['class' => 'btn btn-primary']) ?>
            </div>

            <?php ActiveForm::end(); ?>
        </div>
    </div>
</div>