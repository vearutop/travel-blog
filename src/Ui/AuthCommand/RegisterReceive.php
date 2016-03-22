<?php

namespace TravelBlog\Ui\AuthCommand;


use TravelBlog\Auth\AuthService;
use TravelBlog\Entity\Identity;
use TravelBlog\Entity\User;
use TravelBlog\Entity\UserIdentity;
use TravelBlog\Identity\Password;
use TravelBlog\Router;
use Yaoi\Command;
use Yaoi\Command\Definition;
use Yaoi\Date\TimeMachine;

class RegisterReceive extends Command
{
    public $login;
    public $password;
    public $repeatPassword;
    public $email;

    /**
     * @param Definition $definition
     * @param \stdClass|static $options
     */
    static function setUpDefinition(Definition $definition, $options)
    {
        $options->login = Command\Option::create();
    }

    public function performAction()
    {
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