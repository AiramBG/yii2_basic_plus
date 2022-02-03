<?php

/* @var $this yii\web\View */

use yii\helpers\Html;


$this->title = Yii::l('terms_of_use');
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="site-about">
    <h1><?= Html::encode($this->title) ?></h1>

    <p><?= Yii::l('example_page') ?></p>

    <p><code><?= __FILE__ ?></code></p>

    <p><?= Yii::l('terms_def') ?></p>
</div>
