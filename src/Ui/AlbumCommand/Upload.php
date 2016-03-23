<?php

namespace TravelBlog\Ui\AlbumCommand;


use Yaoi\Command;
use Yaoi\Command\Definition;

class Upload extends Command
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
        $id = $this->request->get('id');

        if (!$id) {
            throw new \Exception('Empty id');
        }
        $album = Album::findByPrimaryKey($id);

        if (!$album) {
            throw new \Exception('Album not found');
        }

        $upload = new UploadController($this->request);
        $upload->receiveAction($this->user->urlName . '/' . $album->title);

        foreach (FileStorage::getInstance()->savedFiles as $filePath => $fileUrl) {
            $image = new Image();
            $image->albumId = $album->id;
            $image->path = $filePath;
            $image->url = $fileUrl;
            $image->save();
        }
    }
}