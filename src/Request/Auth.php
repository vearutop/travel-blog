<?php
/**
 * Created by PhpStorm.
 * User: vearutop
 * Date: 17.08.2015
 * Time: 21:29
 */

namespace TravelBlog\Request;

use TravelBlog\Request;

class Auth extends Request
{
    public $username;
    public $password;
    public $csrfToken;

    public static function setUpFields() {

    }
}