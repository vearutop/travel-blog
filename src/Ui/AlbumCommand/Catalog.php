<?php

namespace TravelBlog\Ui\AlbumCommand;


use TravelBlog\Auth\AuthService;
use TravelBlog\Entity\Album;
use TravelBlog\Entity\User;
use TravelBlog\View\Album\CreateForm;
use Yaoi\Command;
use Yaoi\Command\Definition;
use Yaoi\Io\Content\Anchor;
use Yaoi\Io\Content\Rows;
use Yaoi\Rows\Processor;
use Yaoi\Twbs\Io\Content\Form;

class Catalog extends Command
{
    static function setUpDefinition(Definition $definition, $options)
    {
    }

    public function performAction()
    {
        if (!$user = AuthService::getInstance()->getUser()) {
            throw new \Exception('Authenticated user required');
        }

        $this->response->success('CATALOGE!');
        /** @var Album[] $albums */
        $albums = Album::statement()
            ->where('? = ?', Album::columns()->userId, $user->id)
            ->query()
            ->fetchAll();

        $this->response->addContent(new Form(Create::createState(), $this->io));
        $details = Details::createState();

        if ($albums) {
            $this->response->addContent(new Rows(Processor::create($albums)
                ->map(function (Album $album) use ($details) {
                    $row = array();
                    $details->albumId = $album->id;
                    $row['Title'] = new Anchor($album->title, $this->io->makeAnchor($details));
                    $row['Created'] = date('Y-m-d H:i:s', $album->created);
                    return $row;
                })));
        }

    }
}