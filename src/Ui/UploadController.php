<?php

namespace TravelBlog\Ui;


use TravelBlog\Controller;
use TravelBlog\FileStorage;
use TravelBlog\View\Layout;
use TravelBlog\View\Upload\Form;

class UploadController extends Controller
{
    public function indexAction()
    {
        $layout = Layout::create();
        $layout->pushContent(new Form('/upload/receive'));
        $layout->render();
    }


}