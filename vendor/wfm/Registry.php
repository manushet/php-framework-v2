<?php
declare(strict_types=1);

namespace WFM;

class Registry
{
    use SingletonTrait;

    protected static array $properties = [];

    /**
     * @param string $name
     * @param mixed $value
     * @return void
     */
    public function setProperty(string $name, mixed $value): void
    {
        self::$properties[$name] = $value;
    }

    /**
     * @param string $name
     * @return mixed|null
     */
    public function getProperty(string $name): mixed
    {
        return self::$properties[$name] ?? null;
    }

    /**
     * @return array
     */
    public function getProperties(): array
    {
        return self::$properties;
    }
}