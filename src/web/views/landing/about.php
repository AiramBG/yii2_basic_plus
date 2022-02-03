<?php

/* @var $this yii\web\View */

use yii\helpers\Html;


$this->title = Yii::l('about');
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="site-about">
    <h1><?= Html::encode($this->title) ?></h1>

    <p><?= Yii::l('example_page') ?></p>

    <code><?= __FILE__ ?></code>
</div>
