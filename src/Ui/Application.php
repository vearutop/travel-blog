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
use Yaoi\Oauth2\Vk\VkAuth;

class Application extends ActionCommand
{
    static function setUpDefinition(Definition $definition, $options)
    {
        $definition->title = 'Traveler\'s blog';

        $options->action = Command\Option::create(
            Command\EnumActions::create()
                ->addToEnum(Index::definition(), '')
                ->addToEnum(AlbumCommand::definition(), 'album')
                ->addToEnum(Auth::definition())
        )
            ->setIsUnnamed()
            ->setDescription('Application action');
    }

    public function performAction()
    {
        if ($user = AuthService::getInstance()->getUser()) {
            $this->response->addContent('Hello, ' . $user->urlName . ' ');
            $this->response->addContent(new Anchor('Sign out', $this->io->makeAnchor(SignOut::createState())));
        }
        //else {
        $this->response->addContent(new Anchor('vk auth', $this->io->makeAnchor(VkAuth::createState())));
        //}
        if (null === $this->action) {
            $this->response->error("Page not found");
            return;
        }

        parent::performAction();
    }
}