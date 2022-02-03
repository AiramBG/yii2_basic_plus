<?php

/* @var $this yii\web\View */

use app\src\web\widgets\Icon;
use yii\helpers\Html;


$this->title = Yii::l('access_granted');
?>
<div class="site-dashboard">
    <h1><?= Html::encode($this->title) ?></h1>

    <p><?= Yii::l('remove_role_example') ?></p>
    <p><?= Html::a(Icon::i('la','recycle').' Reset', ['dashboard/rbac_reset'], ['class' => 'btn btn-danger']) ?></p>

</div>
