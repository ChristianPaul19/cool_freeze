<?php

define('APP_NAME', 'Cool Freeze');

$host = $_SERVER['HTTP_HOST'] ?? '';
$host = preg_replace('/:\d+$/', '', strtolower($host));
$isLocalHost = $host === 'localhost'
	|| $host === '127.0.0.1'
	|| preg_match('/^(10|192\.168|172\.(1[6-9]|2\d|3[0-1]))\./', $host);

define('APP_ENV', $isLocalHost ? 'local' : 'production');

// Detect the folder the project is running from (works for /coolfreeze/, /cool_freeze/, or / on Hostinger)
$scriptDir = rtrim(str_replace('\\', '/', dirname($_SERVER['SCRIPT_NAME'])), '/');
define('BASE_URL', $scriptDir . '/');

define('MAINTENANCE_MODE', false);

date_default_timezone_set('Asia/Manila');