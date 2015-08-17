<?php
	$my_cnf = [
		// 'server' => 'loc.vk-face.com',
		'YII_ENV' => $_SERVER['SERVER_NAME'] == 'loc.vk-face.com'? 'dev': 'prod',
	];

	$my_cnf['debug'] = $my_cnf['YII_ENV'] == 'dev'? true: false;

	if (!isset($my_cnf['server'])) {
		$my_cnf['server'] = $_SERVER['SERVER_NAME'];
	}

	switch ($my_cnf['server']) {
		case 'i.vk-face.com':
		case 'yii2.vk-face.com':
		case 'vk-face.com':
			$my_cnf['host'] = 'mysql.hostinger.com.ua';
			$my_cnf['dbname'] = 'u984997905_yiivk';
			$my_cnf['username'] = 'u984997905_root';
			$my_cnf['password'] = '--password--';
		break;
		default:
			$my_cnf['host'] = 'localhost';
			$my_cnf['dbname'] = 'yii2vk_face';
			$my_cnf['username'] = 'root';
			$my_cnf['password'] = 'qwerty92';
		break;
	}

	return $my_cnf;