<?php
/**
 * @link http://www.yiiframework.com/
 * @copyright Copyright (c) 2008 Yii Software LLC
 * @license http://www.yiiframework.com/license/
 */

namespace app\src\console\commands;

use Yii;
use app\src\common\components\users\entities\User;
use yii\console\Controller;
use yii\console\ExitCode;


class DeleteUserController extends Controller
{
    public function actionIndex($email)
    {
        $user = User::findOne(['email' => $email]);
        if ($user instanceof User) {
            echo 'User found: '.$user->name;
            if ($user->delete()) {
                echo ' => deleted.'.PHP_EOL;
            }
        } else {
            echo "User with email '{$email}' not found.".PHP_EOL;
        }
        return ExitCode::OK;
    }
}
