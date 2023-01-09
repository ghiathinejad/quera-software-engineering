<?php

namespace System\Database\ORM;

use  System\Database\Traits\HasCRUD;
use  System\Database\Traits\HasMethodCaller;
use  System\Database\Traits\HasQueryBuilder;


abstract class Model
{
    use HasCRUD, HasMethodCaller, HasQueryBuilder;

    protected $table; // table name

    protected $primaryKey = 'id';
}

