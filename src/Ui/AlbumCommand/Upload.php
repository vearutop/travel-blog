<?php

namespace TravelBlog\Ui\AlbumCommand;


use TravelBlog\Auth\AuthService;
use TravelBlog\Entity\Album;
use TravelBlog\Entity\Image;
use TravelBlog\FileStorage\FileStorage;
use Yaoi\Command\Command;
use Yaoi\Command\Definition;
use Yaoi\Command\Option;

class Upload extends Command
{
    public $albumId;

    static function setUpDefinition(Definition $definition, $options)
    {
        $options->albumId = Option::create()
            ->setIsRequired()
            ->setType();
    }

    public function performAction()
    {
        ob_end_clean();
        $id = $this->albumId;
        header("Expires: Mon, 26 Jul 1997 05:00:00 GMT");
        header("Last-Modified: " . gmdate("D, d M Y H:i:s") . " GMT");
        header("Content-Type: application/json");
        header("Cache-Control: no-store, no-cache, must-revalidate");
        header("Cache-Control: post-check=0, pre-check=0", false);
        header("Pragma: no-cache");

        try {
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
            echo '{"jsonrpc" : "2.0", "result" : null, "id" : "id"}';
        } catch (\Exception $exception) {
            $result = array(
                'jsonrpc' => '2.0',
                'error' => array(
                    'code' => $exception->getCode(),
                    'message' => $exception->getMessage()
                ),
                'id' => 'id'
            );
            echo json_encode($result);
        }
        exit();
    }
}