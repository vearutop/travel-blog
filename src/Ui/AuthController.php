<?php

namespace TravelBlog\Ui;

use TravelBlog\Auth\AuthService;
use TravelBlog\Controller;
use TravelBlog\Entity\Identity;
use TravelBlog\Entity\User;
use TravelBlog\Entity\UserIdentity;
use TravelBlog\Identity\Password;
use TravelBlog\Router;
use TravelBlog\View\Auth\RegisterForm;
use TravelBlog\View\Layout;
use Yaoi\Date\TimeMachine;

class AuthController extends Controller
{

    public function actionSignIn() {
        //var_dump($this->request);
        $identity = Password::findIdentityByRequest($this->request);
        AuthService::getInstance()->signIn($identity);

        Router::redirect('/albums');
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


    public function actionRegister() {
        Layout::create()->pushContent(RegisterForm::create())->render();
    }

    public function actionRegisterReceive() {
        $login = $this->request->post('login');
        $password = $this->request->post('password');
        $repeatPassword = $this->request->post('repeat_password');
        $email = $this->request->post('email');

        if (empty($login)) {
            throw new \Exception('Please provide login');
        }

        if (empty($password)) {
            throw  new \Exception('Please provide password');
        }

        if ($password !== $repeatPassword) {
            throw new \Exception('Repeat password does not match ');
        }

        $identity = new Identity();
        $identity->providerUserId = $login;
        $identity->providerId = Password::getProvider()->id;
        $identity->meta = Password::getPasswordHash($login, $password);
        if ($identity->findSaved()) {
            throw new \Exception('Login is already registered');
        }
        $identity->save();

        $user = new User();
        $user->urlName = $login;
        $user->save();

        $userIdentity = new UserIdentity();
        $userIdentity->userId = $user->id;
        $userIdentity->identityId = $identity->id;
        $userIdentity->addedAt = TimeMachine::getInstance()->now();
        $userIdentity->save();

        AuthService::getInstance()->signIn($identity);
        Router::redirect('/albums');
    }
}