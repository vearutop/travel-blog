<?php

namespace TravelBlog\Ui\AlbumCommand;


use TravelBlog\Auth\AuthService;
use TravelBlog\Command\ActionCommand;
use Yaoi\Command\EnumActions;
use Yaoi\Command\Option;
use Yaoi\Command\Definition;

class AlbumCommand extends ActionCommand
{
    static function setUpDefinition(Definition $definition, $options)
    {
        $options->action = Option::create(EnumActions::create()
            ->addToEnum(Catalog::definition(), '')
            ->addToEnum(Create::definition())
            ->addToEnum(Details::definition())
            ->addToEnum(Upload::definition())
        )
            ->setIsUnnamed()
            ->setIsRequired();
    }

    public function performAction()
    {
        if (!$user = AuthService::getInstance()->getUser()) {
            throw new \Exception('Authenticated user required');
        }

        parent::performAction();
    }
}