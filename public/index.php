<?php
declare(strict_types=1);

if (PHP_MAJOR_VERSION < 8) {
    die("PHP version >= 8.1 is required to run this app");
}

require_once dirname(__DIR__) . '/config/init.php';

print(phpinfo());