<?php

namespace TravelBlog\Ui\AlbumCommand;


use TravelBlog\Entity\Album;
use TravelBlog\Entity\Image;
use TravelBlog\View\Upload\Form;
use Yaoi\Command;
use Yaoi\Command\Definition;
use Yaoi\Io\Content\Rows;
use Yaoi\Rows\Processor;

class Details extends Command
{
    public $albumId;

    static function setUpDefinition(Definition $definition, $options)
    {
        $options->albumId = Command\Option::create()
            ->setIsRequired()
            ->setType();
    }

    public function performAction()
    {
        $album = Album::findByPrimaryKey($this->albumId);

        if (!$album) {
            throw new \Exception('Album not found');
        }

        $images = Image::statement()
            ->where('? = ?', Image::columns()->albumId, $this->albumId)
            ->query()
            ->fetchAll();

        if ($images) {
            $this->response->addContent(new Rows(Processor::create($images)
                ->map(function (Image $image) {
                    $row = array();
                    $row['Path'] = $image->path;
                    $row['Url'] = $image->url;
                    return $row;
                })));
        }

        $uploadHandler = Upload::createState();
        $uploadHandler->albumId = $this->albumId;
        $uploadUrl = (string)$this->io->makeAnchor($uploadHandler);
        $this->response->addContent(new Form($uploadUrl));
    }


}