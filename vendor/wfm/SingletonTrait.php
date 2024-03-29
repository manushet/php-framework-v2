<?php
declare(strict_types=1);

namespace WFM;

trait SingletonTrait
{
    private static ?self $instance = null;

    private function __construct() 
    {

    }

    public static function getInstance(): ?static
    {
        return static::$instance ?? static::$instance = new static();
    }
}