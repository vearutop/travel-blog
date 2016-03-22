<?php

namespace TravelBlog\Auth;


use TravelBlog\Entity\Identity;
use TravelBlog\Entity\Session;
use TravelBlog\Entity\User;
use TravelBlog\Entity\UserIdentity;
use Yaoi\Date\TimeMachine;
use Yaoi\Service;

class Auth extends Service
{
    private $identityId;
    private $users;

    public function signIn(Identity $identity) {
        $session = new Session();
        $session->identityId = $identity->id;

        if (isset($_COOKIE[$this->settings->sessionName])) {
            Session::statement()->delete()->where(
                '? = ?',
                Session::columns()->token,
                $_COOKIE[$this->settings->sessionName]
            )->query();
        }


        do {
            $token = $this->createSessionId();
        }
        while (Session::findByToken($token));

        setcookie($this->settings->sessionName, $token, time() + $this->settings->expireTime, '/', null, null, true);

        $session->identityId = $identity->id;
        $session->token = $token;
        $session->createdAt = TimeMachine::getInstance()->now();

        $session->save();
    }

    private function initSession($token = null) {
        if ($this->identityId !== null) {
            return $this;
        }

        if (null === $token) {
            if (!isset($_COOKIE[$this->settings->sessionName])) {
                $this->identityId = false;
                return $this;
            }
            $token = $_COOKIE[$this->settings->sessionName];
        }
        $session = Session::findByToken($token);
        if (!$session) {
            throw new \Exception('Session not found');
        }
        $this->identityId = $session->identityId;
        return $this;
    }

    /**
     * @return User[]
     * @throws \Exception
     */
    public function getUsers() {
        if (null !== $this->users) {
            return $this->users;
        }

        $this->initSession();
        $this->users = array();
        if (!$this->identityId) {
            return $this->users;
        }

        $this->users = User::statement()->innerJoin('? ON ? = ? AND ? = ?',
            UserIdentity::table(),
            UserIdentity::columns()->userId, User::columns()->id,
            UserIdentity::columns()->identityId, $this->identityId)->query()->fetchAll();

        return $this->users;
    }

    /**
     * @return null|User
     */
    public function getUser() {
        $users = $this->getUsers();
        if ($users) {
            return $users[0];
        }
        else {
            return null;
        }
    }



    public function createSessionId() {
        return md5(rand());
    }


    /** @var Settings */
    protected $settings;
    protected static function getSettingsClassName()
    {
        return Settings::className();
    }


}