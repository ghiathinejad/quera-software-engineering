<?php
namespace Src;

use DI\Container;
class App{

    public static Container $container;
    public function __construct()
    {


    }

    public static function bind(string $key,string $class_name, ?string $class_alias = null, ?string $alias=null)
    {
        self::$container = new Container();
        self::$container->set($key,$class_name);
        if(!is_null($alias))
            class_alias($class_alias,$alias);
    }
}
