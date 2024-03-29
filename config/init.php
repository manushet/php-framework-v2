<?php 
define('DEBUG', true);
define('ROOT', dirname(__DIR__));
define('WWW', ROOT . '/public');
define('APP', ROOT . '/app');
define('CORE', ROOT . '/vendor/wfm');
define('HELPERS', ROOT . '/vendor/wfm/helpers');
define('CACHE', ROOT . '/tmp/cache');
define('LOGS', ROOT . '/tmp/logs');
define('CONFIG', ROOT . '/config');
define('LAYOUT', 'ishop');
define('APP_URL', 'http://localhost:8000/');
define('ADMIN_URL', 'http://localhost:8000/admin');
define('NO_IMAGE', 'uploads/assets/images/no_image.jpg');

require_once ROOT . '/vendor/autoload.php';