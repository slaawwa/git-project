<?php

	$site = require(__DIR__ . '/server.php');

return [
    'class' => 'yii\db\Connection',
    'dsn' => 'mysql:host='.$site['host'].';dbname='.$site['dbname'],
    'username' => $site['username'],
    'password' => $site['password'],
    'charset' => 'utf8',
];
