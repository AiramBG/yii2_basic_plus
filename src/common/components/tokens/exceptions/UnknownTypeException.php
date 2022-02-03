<?php

namespace app\src\common\components\tokens\exceptions;

class UnknownTypeException extends \Exception {
    protected $message = 'Unknown token type';
}