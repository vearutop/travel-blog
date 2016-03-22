<?php

namespace TravelBlog\Identity;

use TravelBlog\Entity\Identity;
use TravelBlog\Entity\IdentityProvider;
use Yaoi\Io\Request;

class Password implements IdentityContract
{
    private static $provider;

    public static function getProvider()
    {
        if (null === self::$provider) {
            self::$provider = new IdentityProvider();
            self::$provider->class = get_called_class();
            self::$provider->title = 'Password based identity';
            self::$provider->findOrSave();
        }
        return self::$provider;
    }


    private static $salt = 'NaCl';

    public static function setSalt($salt)
    {
        self::$salt = $salt;
    }

    public static function getPasswordHash($login, $password)
    {
        return md5(self::$salt . $login . $password);
    }

    public static function findIdentity(Request $request) {
        $login = $request->post('login');
        $password = $request->post('password');

        $cols = Identity::columns();

        /** @var Identity $identity */
        $identity = Identity::statement()
            ->where('? = ?', $cols->providerId, self::getProvider()->id)
            ->where('? = ?', $cols->providerUserId, $login)
            ->query()
            ->fetchRow();

        if (!$identity) {
            throw new \Exception('Identity not found');
        }

        if ($identity->meta !== self::getPasswordHash($login, $password)) {
            throw  new \Exception('Wrong password');
        }

        return $identity;
    }

}