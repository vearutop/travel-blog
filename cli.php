#!/bin/env php
<?php
namespace TravelBlog;

use TravelBlog\Cli\Router;

require_once __DIR__ . '/vendor/autoload.php';
require_once __DIR__ . '/env/conf.php';

Router::create()->route(Request::createAuto());
