<?php

/* @var $this yii\web\View */

use yii\helpers\Html;


$this->title = Yii::l('privacy_policy');
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="site-about">
    <h1><?= Html::encode($this->title) ?></h1>

    <p><?= Yii::l('example_page') ?></p>

    <code><?= __FILE__ ?></code><br><br>

    <p><?= Yii::l('privacy_def1') ?></p>
    <p><?= Yii::l('privacy_def2') ?></p>

</div>
