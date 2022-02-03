<?php
require __DIR__ . '/../../../config/constants.php';
require __DIR__ . '/../../../vendor/autoload.php';
require __DIR__ . '/../../common/Yii.php';
require __DIR__ . '/../../../config/bootstrap.php';

$config = require __DIR__ . '/../../../config/web.php';

$app = (new yii\web\Application($config))->run();
