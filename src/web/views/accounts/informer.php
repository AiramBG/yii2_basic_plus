<?php
/**
 * This template is used to report simple information to a user.
 * For example, after submitting a form that only needs a short answer.
 */

/* @var $this yii\web\View */
/* @var string $title */
/* @var string $h1 */
/* @var string $message */

$this->title = $title;
$this->params['breadcrumbs'][] = $this->title;
?>

<div class="center">
    <h1><?= $h1 ?></h1>
    <p><?= $message ?></p>
</div>