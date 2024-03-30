<?php
declare(strict_types=1);

use WFM\Router;

if (PHP_MAJOR_VERSION < 8) {
    die("PHP version >= 8.1 is required to run this app");
}

require_once dirname(__DIR__) . '/config/init.php';
require_once CONFIG . '/routes.php';
require_once HELPERS . '/functions.php';


new \WFM\App();

//throw new Exception('Some erorr occured!', 501);

//dd(Router::getRoutes());

//print(phpinfo());