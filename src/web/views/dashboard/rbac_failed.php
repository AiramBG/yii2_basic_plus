<?php

/* @var $this yii\web\View */

use app\src\web\widgets\Icon;
use yii\helpers\Html;


$this->title = Yii::l('access_denied');
?>
<div class="site-dashboard">
    <h1><?= Html::encode($this->title) ?></h1>

    <p><?= Yii::l('add_role_example') ?></p>
    <p><?= Html::a(Icon::i('la', 'magic').' Magic!', ['dashboard/rbac_add'], ['class' => 'btn btn-success']) ?></p>

</div>
