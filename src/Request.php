<?php
/**
 * Created by PhpStorm.
 * User: vearutop
 * Date: 17.08.2015
 * Time: 20:59
 */

namespace TravelBlog;

use TravelBlog\Request\Server;
use Yaoi\BaseClass;

class Request extends BaseClass
{
    public $baseUrl;
    public $path;
    protected $get;
    public $post;
    public $request;
    public $cookie;

    /** @var  Server  */
    public $server;
    public $scheme;
    protected $argv;


    const GET = 'get';
    const POST = 'post';
    const REQUEST = 'request';
    const ARGV = 'argv';
    const COOKIE = 'cookie';
    const SERVER = 'server';

    public function get($param, $default = null) {
        return $this->param(self::GET, $param, $default);
    }

    public function post($param, $default = null) {
        return $this->param(self::POST, $param, $default);
    }

    public function argv($param, $default = null) {
        return $this->param(self::ARGV, $param, $default);
    }

    /**
     * @return Server
     */
    public function server() {
        return $this->server;
    }

    public function cookie($param, $default) {
        return $this->param(self::COOKIE, $param, $default);
    }

    public function request($param, $default = null) {
        return $this->param(self::REQUEST, $param, $default);
    }

    protected function param($type, $param, $default) {
        $data = $this->$type;
        return isset($data[$param])
            ? $data[$param]
            : $default;
    }

    public function hostname() {
        if ($this->isCli()) {
            return $this->argv(2);
        }
        else {
            return $this->server->HTTP_HOST;
        }
    }

    public function path() {
        if ($this->isCli()) {
            return $this->argv(1);
        }
        else {
            return $this->server->REQUEST_URI;
        }
    }

    public function isCli() {
        return PHP_SAPI === 'cli';
    }



    public static function createAuto() {
        $request = new static();
        $request->baseUrl = '/';
        $request->get = $_GET;
        $request->post = $_POST;
        $request->request = $_REQUEST;
        $request->cookie = $_COOKIE;
        $request->server = Server::fromArray($_SERVER);
        if ($request->isCli()) {
            $request->argv = $_SERVER['argv'];
        }
        return $request;
    }
}