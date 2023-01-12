<?php
namespace Src\Facades;
Class Facade{
    public static function __callStatic($method, $args)
    {
        return (new static)->$method(...$args);
    }

}