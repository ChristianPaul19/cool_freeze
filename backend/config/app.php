<?php

define('APP_NAME', 'CoolFreeze');

$host = $_SERVER['HTTP_HOST'] ?? '';
$host = preg_replace('/:\d+$/', '', strtolower($host));
$isLocalHost = $host === 'localhost'
	|| $host === '127.0.0.1'
	|| preg_match('/^(10|192\.168|172\.(1[6-9]|2\d|3[0-1]))\./', $host);

define('APP_ENV', $isLocalHost ? 'local' : 'production');

define('BASE_URL', APP_ENV === 'local' ? '/coolfreeze/' : '/');

define('MAINTENANCE_MODE', false);

date_default_timezone_set('Asia/Manila');

