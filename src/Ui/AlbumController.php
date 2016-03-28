<?php

namespace TravelBlog\Ui;


use TravelBlog\Auth\AuthService;
use TravelBlog\Controller;
use TravelBlog\Entity\Album;
use TravelBlog\Entity\Image;
use TravelBlog\Entity\User;
use TravelBlog\FileStorage\FileStorage;
use TravelBlog\Router;
use TravelBlog\View\Album\CreateForm;
use TravelBlog\View\Layout;
use TravelBlog\View\Upload\Form;
use Yaoi\Io\Request;

class AlbumController extends Controller
{
    /** @var User */
    private $user;

    public function __construct(Request $request)
    {
        parent::__construct($request);
        if (!$this->user = AuthService::getInstance()->getUser()) {
            throw new \Exception('Authenticated user required');
        }
    }

    public function actionIndex() {
        /** @var Album[] $albums */
        $albums = Album::statement()
            ->where('? = ?', Album::columns()->userId, $this->user->id)
            ->query()
            ->fetchAll();

        $layout = new Layout();

        $layout->pushContent(new CreateForm);

        foreach ($albums as $album) {
            $layout->pushContent('<p><a href="/albums/details?id='.$album->id.'">'
                .$album->title
                .'</a></p>');
        }

        $layout->render();

    }

    public function actionCreate() {
        $title = $this->request->post('title');

        if (!$title) {
            throw new \Exception('Empty title');
        }

        $album = new Album();
        $album->userId = $this->user->id;
        $album->title = $title;
        $album->save();

        Router::redirect('/albums');
    }

    public function actionDetails() {
        $id = $this->request->get('id');

        if (!$id) {
            throw new \Exception('Empty id');
        }

        $album = Album::findByPrimaryKey($id);

        if (!$album) {
            throw new \Exception('Album not found');
        }

        $layout = new Layout();
        $layout->pushContent(new Form('/albums/upload/receive/?id=' . $id));


        $layout->render();
    }


    public function actionUploadReceive()
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