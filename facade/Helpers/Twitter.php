<?php
namespace Src\Helpers;
class Twitter implements Social
{
    public static function share($url,$title)
    {
        echo "$url - $title by Twitter".PHP_EOL;
    }
}