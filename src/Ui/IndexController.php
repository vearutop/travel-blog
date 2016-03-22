<?php
namespace TravelBlog\Ui;

use TravelBlog\View\Auth\LoginForm;
use TravelBlog\View\Layout;
use Yaoi\BaseClass;

class IndexController extends BaseClass
{
    public static function ActionIndex() {
        $layout = Layout::create()->setHeading('hello!');
        $layout->pushContent(LoginForm::create());

        $layout->render();
    }

    public static function NotFoundAction() {
        Layout::create()->setHeading('Page not found')->pushContent(':(')->render();
    }

}