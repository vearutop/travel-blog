<?php

namespace TravelBlog;

use TravelBlog\Ui\AlbumController;
use TravelBlog\Ui\IndexController;
use TravelBlog\Ui\AuthController;
use TravelBlog\Ui\UploadController;
use Yaoi\BaseClass;
use Yaoi\Io\Request;
use Yaoi\String\StringValue;

class Router extends BaseClass
{
    public function __construct(Request $request) {
        $this->request = $request;
    }

    /** @var Request  */
    protected $request;
    protected $baseUrl;

    public function route() {
        $path = new StringValue($this->request->path());

        switch (true) {
            case $path->starts('/?') || '/' === $path->value:
                IndexController::ActionIndex();
                break;

            case $path->value === '/albums':
                AlbumController::create($this->request)->actionIndex();
                break;
            case $path->starts('/albums/details'):
                AlbumController::create($this->request)->actionDetails();
                break;
            case $path->starts('/albums/create'):
                AlbumController::create($this->request)->actionCreate();
                break;
            case $path->starts('/albums/upload/receive'):
                AlbumController::create($this->request)->actionUploadReceive();
                break;


            case $path->starts('/auth/vk'):
                AuthController::create($this->request)->oauthEndPoint();
                break;
            case $path->value === '/auth/register':
                AuthController::create($this->request)->actionRegister();
                break;
            case $path->value === '/auth/sign-in':
                AuthController::create($this->request)->actionSignIn();
                break;
            case $path->value === '/auth/register/receive':
                AuthController::create($this->request)->actionRegisterReceive();
                break;


            case $path->value === '/upload':
                UploadController::create($this->request)->indexAction();
                break;
            case $path->starts('/upload/receive'):
                UploadController::create($this->request)->receiveAction();
                break;

            default:
                IndexController::NotFoundAction();
                break;
        }

    }

    public static function redirect($url, $permanent = false, $stop = true) {
        if ($permanent) {
            header('HTTP/1.1 301 Moved Permanently');
        }
        header('Location: ' . $url);
        if ($stop) {
            exit(); // todo proper stop
        }
    }

}