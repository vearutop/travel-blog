<?php

namespace TravelBlog\Identity\OAuth2;

class Settings extends \Yaoi\Service\Settings
{
    const DISPLAY_PAGE = 'page';
    const DISPLAY_POPUP = 'popup';
    const DISPLAY_MOBILE = 'mobile';
    public $appId;
    public $appUrl;
    public $secret;
    public $redirectUrl;
    public $display = self::DISPLAY_PAGE;
    public $httpClient;
}