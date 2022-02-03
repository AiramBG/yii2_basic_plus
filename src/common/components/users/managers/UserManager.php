<?php

namespace app\src\common\components\users\managers;

use app\src\common\components\users\events\LogoutEvent;
use Yii;

class UserManager extends \yii\web\User
{

    /**
     * @inheritDoc
     */
    public function logout($destroySession = true)
    {
        $authkey = Yii::$app->getSession()->get($this->authKeyParam);
        $this->beforeLogoutEvent($authkey);

        if ($this->identity->removeAuthKey($authkey)) {
            $id = $this->identity->getId();
            $ip = Yii::$app->getRequest()->getUserIP();
            $this->switchIdentity(null);
            Yii::info("User '$id' logged out from $ip.", __METHOD__);
            if ($destroySession && $this->enableSession) {
                Yii::$app->getSession()->destroy();
            }
            $this->afterLogoutEvent($authkey);
        }
        return $this->getIsGuest();
    }

    /**
     * @param string $tokenCode Auth token code used in session or cookie
     */
    protected function beforeLogoutEvent($tokenCode)
    {
        $this->trigger(self::EVENT_BEFORE_LOGOUT, new LogoutEvent([
            'identity' => $this->identity,
            'tokenCode' => $tokenCode
        ]));
    }


    /**
     * @param string $tokenCode Auth token code used in session or cookie
     */
    protected function afterLogoutEvent($tokenCode)
    {
        $event = new LogoutEvent([
            'identity' => $this->identity,
            'tokenCode' => $tokenCode
        ]);

        $this->trigger(self::EVENT_AFTER_LOGOUT, $event);
    }
}