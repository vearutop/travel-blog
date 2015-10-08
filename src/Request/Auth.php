<?php

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