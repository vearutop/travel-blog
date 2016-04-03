<?php

namespace TravelBlog\Ui\AlbumCommand;


use TravelBlog\Auth\AuthService;
use TravelBlog\Entity\Album;
use TravelBlog\Router;
use Yaoi\Command\Command;
use Yaoi\Command\Option;
use Yaoi\Command\Definition;

class Create extends Command
{
    public $title;

    static function setUpDefinition(Definition $definition, $options)
    {
        $options->title = Option::create()->setType()->setIsRequired();
    }

    public function performAction()
    {
        $user = AuthService::getInstance()->getUser();

        $album = new Album();
        $album->userId = $user->id;
        $album->title = $this->title;
        $album->created = time();
        $album->updated = $album->created;
        $album->imagesCount = 0;
        $album->save();

        Router::redirect($this->io->makeAnchor(Catalog::createState()));
    }

}