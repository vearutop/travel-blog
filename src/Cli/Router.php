<?php

namespace TravelBlog\Cli;

use TravelBlog\Request;

class Router extends \TravelBlog\Router
{

    public function route(Request $request) {
        print_r(implode(";\npublic $", array_keys($_SERVER)));
    }

}