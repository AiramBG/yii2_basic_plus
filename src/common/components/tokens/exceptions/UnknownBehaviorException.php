<?php

namespace app\src\common\components\tokens\exceptions;

class UnknownBehaviorException extends \Exception {
    protected $message = 'Unknown token behavior';
}