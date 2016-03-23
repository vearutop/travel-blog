<?php

namespace TravelBlog\Auth;


class Settings extends \Yaoi\Service\Settings
{
    public $sessionName = 'session_token';
    public $expireTime = 2592000;
}