<?php

namespace TravelBlog;

use TravelBlog\Ui\Application;
use Yaoi\Io\Request;
use Yaoi\Twbs\Runner;

require_once __DIR__ . '/../vendor/autoload.php';
require_once __DIR__ . '/../env/conf.php';

ob_start();
//Router::create(Request::createAuto())->route();
Runner::create()->run(Application::definition());
ob_flush();