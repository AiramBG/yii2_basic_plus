<?php

namespace app\src\common\components\users\events;

use yii\base\Event;
use yii\web\IdentityInterface;

class LogoutEvent extends Event
{
    /**
     * @var IdentityInterface the identity object associated with this event
     */
    public $identity;

    /**
     * @var string the token code used to authentication.
     */
    public $tokenCode;

}