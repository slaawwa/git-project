<?php

// comment out the following two lines when deployed to production
// $dev = false;
$site = require(__DIR__ . '/../config/server.php');

defined('YII_DEBUG') or define('YII_DEBUG', $site['debug']);
defined('YII_ENV') or define('YII_ENV', $site['YII_ENV']);

require(__DIR__ . '/../vendor/autoload.php');
require(__DIR__ . '/../vendor/yiisoft/yii2/Yii.php');

$config = require(__DIR__ . '/../config/web.php');

(new yii\web\Application($config))->run();
