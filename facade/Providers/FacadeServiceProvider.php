<?php
namespace Src\Providers;
use Src\App;
use Src\Facades\SocialFacade;

class FacadeServiceProvider{
    public function register(){
        $app = new App();
        $app->bind('social',SocialFacade::class);
    }
}