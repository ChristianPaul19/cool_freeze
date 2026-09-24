<?php

define('APP_NAME', 'Cool Freeze');

$host = $_SERVER['HTTP_HOST'] ?? '';
$host = preg_replace('/:\d+$/', '', strtolower($host));
$isLocalHost = $host === 'localhost'
	|| $host === '127.0.0.1'
	|| preg_match('/^(10|192\.168|172\.(1[6-9]|2\d|3[0-1]))\./', $host);

define('APP_ENV', $isLocalHost ? 'local' : 'production');

// Detect the project's URL folder (/cool_freeze/, /coolfreeze/, or / on Hostinger),
// no matter which script is running (index.php, backend/api/register.php, ...).
// ROOT_PATH is defined in bootstrap.php before this file is loaded.
$scriptFile = str_replace('\\', '/', realpath($_SERVER['SCRIPT_FILENAME']));
$rootPath   = str_replace('\\', '/', realpath(ROOT_PATH));
$scriptName = str_replace('\\', '/', $_SERVER['SCRIPT_NAME']);

$relative = substr($scriptFile, strlen($rootPath));                     // e.g. /backend/api/register.php
$base     = substr($scriptName, 0, strlen($scriptName) - strlen($relative)); // e.g. /cool_freeze

define('BASE_URL', rtrim($base, '/') . '/');

define('MAINTENANCE_MODE', false);

date_default_timezone_set('Asia/Manila');