<?php
declare(strict_types=1);

namespace App;

use WFM\Registry;

class App
{
    public static $app;

    public function __construct()
    {
        self::$app = Registry::getInstance();
        $this->importParams();
    }

    protected function importParams(): void
    {
        $params = require_once CONFIG . '/params.php';
        
        if (!empty($params)) {
            foreach($params as $key => $value) {
                self::$app->setProperty($key, $value);
            }
        }
    } 
}