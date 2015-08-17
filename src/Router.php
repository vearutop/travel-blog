<?php

namespace TravelBlog;

use TravelBlog\Ui\IndexController;
use Yaoi\BaseClass;

class Router extends BaseClass
{
    public function __construct(Request $request) {
        $this->request = $request;
    }

    /** @var Request  */
    protected $request;
    protected $baseUrl;

    public function route() {
        $path = new String($this->request->path());

        switch (true) {
            case $path->starts('/?') || '/' === $path->value:
                IndexController::IndexAction();
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