<?php

namespace TravelBlog\Ui;

use TravelBlog\Controller;
use TravelBlog\Identity;

class LoginController extends Controller
{
    protected function createSession(Identity $identity) {

    }

    public function startSession() {

    }

    public function actionLogin() {


    }


    public function oauthEndPoint() {
        echo '<a href="' . Identity\OAuth2\Client::getInstance('vk')->getAuthUri() . '">vk</a> ';
        echo '<a href="' . Identity\OAuth2\Client::getInstance('google')->getAuthUri() . '">vk</a> ';


        //print_r(Identity\OAuth2\Client::getInstance('vk')->getAuthUri());

        return;
        $redirectUrl = 'http://photorep.ru/auth/vk';
        //$redirectUrl .= '/back/' . base64_encode($_SERVER['REQUEST_URI']);
        $oauth = new Identity\OAuth2\Vk\Client(5093545, $redirectUrl);
        $oauth->addPermission(Identity\OAuth2\Vk\Client::PERMISSION_NOTIFY);
        $oauth->setAppSecret('XWF3qMZX1KzKwI9kgAc9');
    }
}