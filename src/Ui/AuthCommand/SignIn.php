<?php

namespace TravelBlog\Ui\AuthCommand;

use TravelBlog\Auth\AuthService;
use TravelBlog\Identity\Password;
use TravelBlog\Router;
use TravelBlog\Ui\AlbumCommand\AlbumCommand;
use Yaoi\Command;
use Yaoi\Command\Definition;

class SignIn extends Command
{
    public $login;
    public $password;

    static function setUpDefinition(Definition $definition, $options)
    {
        $options->login = Command\Option::create()
            ->setDescription('Login')
            ->setType()
            ->setIsRequired();

        $options->password = Command\Option::create()
            ->setDescription('Password')
            ->setType()
            ->setIsRequired();

    }

    public function performAction()
    {
        $identity = Password::findIdentity($this->login, $this->password);
        AuthService::getInstance()->signIn($identity);

        Router::redirect($this->io->makeAnchor(AlbumCommand::createState()));

        $this->response->success('btch');
    }

}