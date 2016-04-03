<?php

namespace TravelBlog\Ui\AuthCommand;


use TravelBlog\Auth\AuthService;
use TravelBlog\Router;
use TravelBlog\Ui\Index;
use Yaoi\Command\Command;
use Yaoi\Command\Definition;

class SignOut extends Command
{
    static function setUpDefinition(Definition $definition, $options)
    {
        // TODO: Implement setUpDefinition() method.
    }

    public function performAction()
    {
        AuthService::getInstance()->signOut();
        Router::redirect($this->io->makeAnchor(Index::createState()));
    }


}