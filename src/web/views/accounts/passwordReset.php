<?php

/* @var $this yii\web\View */
/* @var $form yii\bootstrap4\ActiveForm */
/* @var $model \app\src\web\forms\PasswordResetForm */

use app\src\common\components\users\entities\User;
use yii\bootstrap4\Html;
use yii\bootstrap4\ActiveForm;

$this->title = Yii::l('password_reset');
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="site-reset-password">
    <h1><?= Html::encode($this->title) ?></h1>

    <p><?= Yii::l('password_reset_choose') ?></p>

    <div class="row">
        <div class="col-lg-5">
            <?php $form = ActiveForm::begin(['id' => 'password-reset-form']); ?>

            <?= $form->field($model, 'password')->passwordInput(['autofocus' => true]) ?>
            <?= $form->field($model, 'password_repeat')->passwordInput() ?>
            <?= $form->field($model, 'token')->label(false)->hiddenInput(['value'=> $model->token]) ?>

            <div class="form-group">
                <?= Html::submitButton('Save', ['class' => 'btn btn-primary']) ?>
            </div>

            <?php ActiveForm::end(); ?>
        </div>

    </div>
    <div class="callout callout-primary">
        <?= Yii::l('password_requirements', ['min' => User::PWD_MIN_LENGTH]) ?>
    </div>
</div>