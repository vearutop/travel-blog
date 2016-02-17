<?php

namespace TravelBlogTests\PHPUnit\Auth;


use TravelBlog\Request;
use TravelBlog\Router;
use Yaoi\Test\PHPUnit\TestCase;

class VkTest extends TestCase
{
    public function testRequest() {
        $request = new Request();
        $request->isCli = false;
        $request->server = new Request\Server();
        $request->server->REQUEST_URI = '/auth/vk';
        Router::create($request)->route();
    }

}