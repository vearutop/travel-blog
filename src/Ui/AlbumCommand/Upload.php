<?php

namespace TravelBlog\Ui\AlbumCommand;


use TravelBlog\Auth\AuthService;
use TravelBlog\Entity\Album;
use TravelBlog\Entity\Image;
use TravelBlog\FileStorage;
use TravelBlog\Ui\UploadController;
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
        $id = $this->albumId;
        $album = Album::findByPrimaryKey($id);

        if (!$album) {
            throw new \Exception('Album not found');
        }
        $user = AuthService::getInstance()->getUser();

        $fileStorage = FileStorage::getInstance();
        $fileStorage->receiveAction($user->urlName . '/' . $album->title);

        foreach (FileStorage::getInstance()->savedFiles as $filePath => $fileUrl) {
            $image = new Image();
            $image->albumId = $album->id;
            $image->path = $filePath;
            $image->url = $fileUrl;
            $image->save();
            $album->imagesCount++;
        }
        $album->save();
    }
}