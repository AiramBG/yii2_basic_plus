<?php
/* @var $this yii\web\View */

use app\src\web\widgets\Icon;
use yii\console\widgets\Table;
use yii\helpers\Html;

$this->title = Yii::$app->name;
$auth = Yii::$app->authManager;


?>
<div class="site-dashboard">
    <h1><?= Yii::l('welcome_username', ['name' => Yii::$app->user->identity->name]) ?></h1>
    <p><?= Yii::l('dashboard_example') ?></p>

    <p><?= Yii::l('example_page') ?></p>
    <code><?= __FILE__ ?></code>


    <h2 class="pt-4 pb-2"><?= Yii::l('rbac_test') ?></h2>


    <div class="row">
        <div class="col-md-6">
            <h3>Test</h3>
            <p><?= Yii::l('link_restricted') ?></p>
            <p><?= Html::a(Icon::i('la', 'shield-alt').' '.Yii::l('test_access'), ['dashboard/rbac_test'], ['class' => 'btn btn-primary']) ?></p>

        </div>
        <div class="col-md-3">
            <h3><?= Yii::l('your_roles') ?></h3>
            <table class="table">
                <?php foreach ($auth->getRolesByUser(Yii::$app->user->getId()) as $role) {
                    echo "<tr><td>{$role->name}</td><td>{$role->description}</td></tr>";
                } ?>
            </table>
        </div>
        <div class="col-md-3">
            <h3><?= Yii::l('your_permissions') ?></h3>
            <table class="table">
                <?php foreach ($auth->getPermissionsByUser(Yii::$app->user->getId()) as $permission) {
                    echo "<tr><td>{$permission->name}</td><td>{$permission->description}</td></tr>";
                } ?>
            </table>
        </div>
    </div>




</div>
