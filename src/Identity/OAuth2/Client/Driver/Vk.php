<?php

namespace TravelBlog\Identity\OAuth2\Client\Driver;

use TravelBlog\Identity\OAuth2\Settings;
use Yaoi\BaseClass;

class Vk extends BaseClass
{
    private $settings;
    public function __construct(Settings $settings)
    {
        $this->settings = $settings;
        $this->appId = $settings->appId;
        $this->redirectUri = $settings->redirectUrl;
        $this->appSecret = $settings->secret;
        $this->display = $settings->display;
    }

    private $appId;

    private $permissions = array(
        self::PERMISSION_NOTIFY,
        //self::PERMISSION_OFFLINE => self::PERMISSION_OFFLINE,
        //self::PERMISSION_MESSAGES => self::PERMISSION_MESSAGES,
    );
    public function addPermission($permission) {
        $this->permissions[$permission] = $permission;
        return $this;
    }

    public function removePermission($permission) {
        if (isset($this->permissions[$permission])) {
            unset($this->permissions[$permission]);
        }
        return $this;
    }

    const PERMISSION_NOTIFY = 'notify';
    const PERMISSION_MESSAGES = 'messages';
    const PERMISSION_OFFLINE = 'offline';

    private $redirectUri;

    private $revoke;
    public function setRevoke($revoke) {
        $this->revoke = $revoke;
        return $this;
    }



    const API_VERSION = '5.37';

    public function getAuthUri() {
        $redirectUri = $this->redirectUri;

        $url = 'https://oauth.vk.com/authorize'
            . '?client_id=' . $this->appId
            . '&scope=' . implode(',', $this->permissions)
            . '&redirect_uri=' . urlencode($redirectUri)
            . '&display=' . $this->display
            . '&v=' . self::API_VERSION
            . '&response_type=code';

        if ($this->revoke) {
            $url .= '&revoke=1';
        }

        return $url;
    }


    private $code;
    public function setCode($code) {
        $this->code = $code;
        return $this;
    }


    private $token;
    /**
     * @param $code
     * @return Token
     */
    public function getAccessToken($code = null, $back = null) {
        if (null !== $code) {
            $this->code = $code;
        }

        $redirectUri = $this->redirectUri;
        if ($back) {
            $redirectUri .= '/back/' . base64_encode($back);
        }

        if (null === $this->token) {
            var_dump('code:', $this->code);
            $url = 'https://oauth.vk.com/access_token'
                . '?client_id=' . $this->appId
                . '&client_secret=' . $this->appSecret
                . '&v=' . self::API_VERSION
                . '&code=' . $this->code
                . '&redirect_uri=' . $redirectUri;
            //. '&redirect_uri=' . $this->redirectUri;
            $raw = \Yaoi\Http\Client::getInstance('vk')->fetch($url);
            var_dump('raw:', $url, $raw);
            $this->token = json_decode($raw);
        }
        var_dump('token:', $this->token);

        return $this->token;
    }

    private $secureToken;
    private function getSecureAccessToken() {
        if (null === $this->secureToken) {
            $url = 'https://oauth.vk.com/access_token'
                . '?client_id=' . $this->appId
                . '&client_secret=' . $this->appSecret
                . '&v=' . self::API_VERSION
                . '&grant_type=client_credentials';
            $this->secureToken = json_decode(file_get_contents($url))->access_token;
        }

        return $this->secureToken;
    }


    public function query($method, $params, $token) {
        $params['access_token'] = $token;
        $url = "https://api.vk.com/method/$method?" . http_build_query($params);
        var_dump($url);
        $result = file_get_contents($url);
        var_dump($result);
        return json_decode($result);
    }


    /**
     * @param null $userId
     * @param bool $detailed
     * @return UserInfo
     */
    public function getUserInfo($userId = null, $detailed = false) {
        if (null === $userId) {
            $userId = $this->getAccessToken()->user_id;
        }
        var_dump('vkuid', $userId);

        if ($detailed) {
            $fields = 'sex,bdate,city,country,photo_50,photo_100,photo_200_orig,photo_200,photo_400_orig, photo_max, photo_max_orig, online, online_mobile,lists,domain,has_mobile,contacts,connections,site,education,universities,schools,can_post,can_see_all_posts,can_see_audio,can_write_private_message,status,last_seen,common_count,relation,relatives,counters';
        }
        else {
            $fields = 'sex,bdate,city,country,photo_50,photo_max_orig,domain';
        }

        $result = $this->query('users.get',
            array(
                'user_ids'=> $userId,
                'fields' => $fields,
                'v' => self::API_VERSION,
            ),
            $this->getAccessToken()->access_token
        );
        var_dump($result);
        $result = $result->response[0];
        if (!$result) {
            throw new \Exception('Empty result');
        }

        if ($result->bdate) {
            $result->bdate = implode('-', array_reverse(explode('.', $result->bdate)));
        }
        $result->city = $result->city->title;
        $result->country = $result->country->title;
        return $result;
    }

}
