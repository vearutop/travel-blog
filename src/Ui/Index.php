<?php

namespace TravelBlog\Ui;


use TravelBlog\Auth\AuthService;
use TravelBlog\Entity\UserIdentity;
use TravelBlog\Router;
use TravelBlog\Ui\AlbumCommand\AlbumCommand;
use TravelBlog\View\Auth\LoginForm;
use Yaoi\Command\Command;
use Yaoi\Command\Definition;
use Yaoi\Io\Content\Heading;

class Index extends Command
{
    static function setUpDefinition(Definition $definition, $options)
    {

    }

    public function performAction()
    {
        if ($user = AuthService::getInstance()->getUser()) {
            Router::redirect($this->io->makeAnchor(AlbumCommand::createState()));
        }

        $this->response->addContent(new Heading('Welcome aboard!'));
        $this->response->addContent(LoginForm::create());

    }


}