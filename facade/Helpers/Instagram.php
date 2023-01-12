<?php
namespace Src\Helpers;
class Instagram implements Social
{
    public static function share($url,$title)
    {
        echo "$url - $title by Instagram".PHP_EOL;
    }
}