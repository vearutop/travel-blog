<?php
namespace TravelBlog\Ui;

use TravelBlog\View\Layout;
use Yaoi\BaseClass;

class IndexController extends BaseClass
{
    public static function IndexAction() {
        Layout::create()->setHeading('hello!')->render();
    }

    public static function NotFoundAction() {
        Layout::create()->setHeading('Page not found')->setContentBlock(':(')->render();
    }

}