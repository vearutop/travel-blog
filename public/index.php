<?php

namespace TravelBlog;

use Yaoi\Io\Request;

require_once __DIR__ . '/../vendor/autoload.php';
require_once __DIR__ . '/../env/conf.php';

ob_start();
Router::create(Request::createAuto())->route();
ob_flush();