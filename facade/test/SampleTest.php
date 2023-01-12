<?php

namespace Src\test;

use PHPUnit\Framework\TestCase;
use Src\Facades\Facade;
use Src\Facades\SocialFacade as SF;
use Src\Helpers\Instagram;
use Src\Helpers\SocialFacade;
use Src\Helpers\Twitter;
use ReflectionClass;

class SampleTest extends TestCase
{
    public static function setUpBeforeClass(): void
    {
        require_once __DIR__ . '/../vendor/autoload.php';
    }

    public function testSocialFacadeHasGetFacadeAccessor()
    {
        $socialFacade = new ReflectionClass(SF::class);
        self::assertTrue($socialFacade->hasMethod('getFacadeAccessor'));
    }

    public function testFacadeCallStatic()
    {
        $socialFacade = new ReflectionClass(Facade::class);
        self::assertTrue($socialFacade->hasMethod('__callStatic'));
    }

    public function testFacadeHelper()
    {
        $twitter = new Twitter();
        $instagram = new Instagram();

        new SocialFacade($twitter, $instagram);

        $this->assertTrue(True);
    }

}