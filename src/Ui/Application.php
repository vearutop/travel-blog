<?php

namespace TravelBlog\Ui;

use TravelBlog\Auth\AuthService;
use TravelBlog\Command\ActionCommand;
use TravelBlog\Ui\AlbumCommand\AlbumCommand;
use TravelBlog\Ui\AuthCommand\Auth;
use TravelBlog\Ui\AuthCommand\SignOut;
use Yaoi\Command;
use Yaoi\Command\Definition;
use Yaoi\Io\Content\Anchor;

class Application extends ActionCommand
{
    static function setUpDefinition(Definition $definition, $options)
    {
        $options->action = Command\Option::create()
            ->setIsUnnamed()
            ->addToEnum(Index::definition(), '')
            ->addToEnum(AlbumCommand::definition(), 'album')
            ->addToEnum(Auth::definition())
            ->setDescription('Application action');
    }

    public function performAction()
    {
        if ($user = AuthService::getInstance()->getUser()) {
            $this->response->addContent('Hello, ' . $user->urlName . ' ');
            $this->response->addContent(new Anchor('Sign out', $this->io->makeAnchor(SignOut::createState())));
        }
        if (null === $this->action) {
            $this->response->error("Page not found");
            return;
        }

        parent::performAction();
    }
}