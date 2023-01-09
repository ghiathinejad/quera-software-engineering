<?php

namespace System\Database\Traits;


trait HasMethodCaller
{
    private $allMethods = ['create', 'update', 'delete', 'find', 'all', 'save', 'where', 'whereOr', 'whereIn', 'whereNull', 'whereNotNull', 'limit', 'orderBy', 'get', 'paginate'];
    private $allowedMethods = ['create', 'update', 'delete', 'find', 'all', 'save', 'where', 'whereOr', 'whereIn', 'whereNull', 'whereNotNull', 'limit', 'orderBy', 'get', 'paginate'];


    public function __call($method, $args)
    {
        return $this->methodCaller($this, $method, $args);
    }

    public static function __callStatic($method, $args)
    {
        return (new static)->$method(...$args);
    }


    private function methodCaller($object, $method, $args)
    {
        return call_user_func_array(array($object, $method.'Method'), $args);
    }



    protected function setAllowedMethods($array)
    {
        $this->allowedMethods = $array;
    }
}