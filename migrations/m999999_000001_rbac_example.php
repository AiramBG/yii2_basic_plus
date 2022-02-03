<?php

use yii\db\Migration;

/**
 * This migration allows:
 *  - fill database with example roles and permissions
 *  - assign
 */
class m999999_000001_rbac_example extends Migration
{
    public function safeUp()
    {
        $auth = Yii::$app->authManager;

        //Permission creation example
        $permission = $auth->createPermission('ExampleAccess');
        $permission->description = 'Allow access to the dashboard restricted page';
        $auth->add($permission);

        //Role creation example
        $role = $auth->createRole('Admin');
        $auth->add($role);

        $role2 = $auth->createRole('ExampleRole');
        $auth->add($role2);

        //Assing permissions to roles
        $auth->addChild($role, $permission);
        $auth->addChild($role2, $permission);

        //Assign role to user
        $userId = 1; //Admin
        $auth->assign($role, $userId);

    }

    public function safeDown()
    {
        $auth = Yii::$app->authManager;

        $userId = 1;
        $permission = $auth->getPermission('ExampleAccess');
        $role = $auth->getRole('Admin');

        //Revoke a role assigned to a user
        $auth->revoke($role, $userId);

        //Remove a permission assigned to a role
        $auth->removeChild($role, $permission);

        //Delete a role completely
        $auth->remove($role);

        //Delete a permission completely
        $auth->remove($permission);

    }
}
