<?php

namespace TravelBlog\Identity\OAuth2;


use TravelBlog\Identity\OAuth2\Client\Driver\Vk;
use TravelBlog\Request;
use Yaoi\Service;

class Client extends Service
{


    protected static function getSettingsClassName()
    {
        return Settings::className();
    }


    public function getAuthUri() {
        /** @var Vk $driver */
        $driver = $this->getDriver();
        $uri = $driver->getAuthUri();
        return $uri;
    }

    public function getAccessToken(Request $request) {
        /** @var Vk $driver */
        $driver = $this->getDriver();
        $token = $driver->getAccessToken($request);
        return $token;
    }

    public function getUserInfo() {

    }


}