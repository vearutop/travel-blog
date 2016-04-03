<?php

namespace TravelBlog\Ui\AuthCommand;

use TravelBlog\Auth\AuthService;
use TravelBlog\Identity\Password;
use TravelBlog\Router;
use TravelBlog\Ui\AlbumCommand\AlbumCommand;
use Yaoi\Command\Command;
use Yaoi\Command\Definition;
use Yaoi\Command\Option;

class SignIn extends Command
{
    public $login;
    public $password;

    static function setUpDefinition(Definition $definition, $options)
    {
        $options->login = Option::create()
            ->setDescription('Login')
            ->setType()
            ->setIsRequired();

        $options->password = Option::create()
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