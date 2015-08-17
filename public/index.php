<?php

namespace TravelBlog;

require_once __DIR__ . '/../vendor/autoload.php';
require_once __DIR__ . '/../env/conf.php';

Router::create(Request::createAuto())->route();