<?php

/* @var $this yii\web\View */
/* @var $form yii\bootstrap4\ActiveForm */
/* @var $model LoginForm */

use app\src\web\forms\LoginForm;
use yii\bootstrap4\ActiveForm;
use yii\bootstrap4\Html;

$this->title = Yii::l('login');
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="site-login">
    <h1><?= Html::encode($this->title) ?></h1>

    <p><?= Yii::l('login_msg') ?></p>

    <div class="row">
        <div class="col-lg-5">
            <?php $form = ActiveForm::begin(['id' => 'login-form']); ?>

                <?= $form->field($model, 'email')->textInput(['autofocus' => true, 'autocomplete' => false]) ?>

                <?= $form->field($model, 'password')->passwordInput() ?>

                <?= $form->field($model, 'rememberMe')->checkbox([
                    'template' => "<div class=\"col-lg-6 custom-control custom-checkbox\">{input} {label}</div>\n<div class=\"col-lg-6\">{error}</div>",
                ]) ?>


                <div class="form-group">
                    <div class="offset-lg-1 col-lg-11">
                        <?= Html::submitButton(Yii::l('login'), ['class' => 'btn btn-primary', 'name' => 'login-button']) ?>
                    </div>
                </div>

            <?php ActiveForm::end(); ?>
        </div>
    </div>

    <div class="row">
        <div class="col-lg-5">
            <p><?= Html::a(Yii::l('need_an_account'), ['accounts/signup']) ?></p>
            <p><?= Html::a(Yii::l('need_validation_email'), ['accounts/recovery']) ?></p>
            <p><?= Html::a(Yii::l('forgot_password'), ['accounts/recovery']) ?></p>
        </div>
    </div>
</div>
