<?php
namespace Src\Helpers;
class SocialFacade
{
    private $twitter;
    private $instagram;
    public function __construct(Social $twitter, Social $instagram){
        $this->twitter = $twitter;
        $this->instagram = $instagram;
    }


}
