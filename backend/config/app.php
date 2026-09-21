<?php

define('APP_NAME', 'CoolFreeze');

$host = $_SERVER['HTTP_HOST'] ?? '';
define('APP_ENV', preg_match('/^(localhost|127\.0\.0\.1)(:\d+)?$/', $host) ? 'local' : 'production');

define('BASE_URL', APP_ENV === 'local' ? '/coolfreeze/' : '/');

define('MAINTENANCE_MODE', false);

date_default_timezone_set('Asia/Manila');

