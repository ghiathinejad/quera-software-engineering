<?php

namespace System\Config;

class Config
{
    public static function get(string $key): mixed
    {
        $config = require(__DIR__ . '/../../app/config.php');
        return $config[$key] ?? null;
    }
}