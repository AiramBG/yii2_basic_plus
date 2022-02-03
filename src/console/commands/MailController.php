<?php
/**
 * @link http://www.yiiframework.com/
 * @copyright Copyright (c) 2008 Yii Software LLC
 * @license http://www.yiiframework.com/license/
 */

namespace app\src\console\commands;

use Yii;
use yii\console\Controller;
use yii\console\ExitCode;

/**
 * This command tests the mail configuration
 */
class MailController extends Controller
{
    /**
     * @param string $to receiver email.
     * @param string $message the message to be echoed.
     * @return int Exit code
     */
    public function actionIndex($to, $message = 'Hello world')
    {
        $sended = Yii::$app->mailer->compose()
            ->setFrom(Yii::$app->params['senderEmail'])
            ->setTo($to)
            ->setSubject($message)
            ->setTextBody($message)
            ->send();

        echo ($sended ? 'Success!' : 'Error :(').PHP_EOL;
        return $sended ? ExitCode::OK : ExitCode::UNSPECIFIED_ERROR;
    }
}
