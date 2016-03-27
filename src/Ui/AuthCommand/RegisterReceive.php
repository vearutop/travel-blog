<?php

namespace TravelBlog\Ui\AuthCommand;


use TravelBlog\Auth\AuthService;
use TravelBlog\Entity\Identity;
use TravelBlog\Entity\User;
use TravelBlog\Entity\UserIdentity;
use TravelBlog\Identity\Password;
use TravelBlog\Router;
use TravelBlog\Ui\AlbumCommand\Catalog;
use Yaoi\Command;
use Yaoi\Command\Definition;
use Yaoi\Date\TimeMachine;
use Yaoi\Twbs\Io\Content\Form;

class RegisterReceive extends Command
{
    public $login;
    public $password;
    public $repeatPassword;
    public $email;

    /**
     * @param Definition $definition
     * @param \stdClass|static $options
     */
    static function setUpDefinition(Definition $definition, $options)
    {
        $options->login = Command\Option::create()->setType()->setIsRequired();
        $options->password = Command\Option::create()->setType()->setIsRequired();
        $options->repeatPassword = Command\Option::create()->setType()->setIsRequired();
        $options->email = Command\Option::create()->setType();
    }

    public function performAction()
    {
        var_dump($this->login);

        $this->response->addContent(new Form(RegisterReceive::createState($this->io), $this->io));

        $identity = new Identity();
        $identity->providerUserId = $this->login;
        $identity->providerId = Password::getProvider()->id;
        $identity->meta = Password::getPasswordHash($this->login, $this->password);
        if ($identity->findSaved()) {
            throw new \Exception('Login is already registered');
        }
        $identity->save();

        $user = new User();
        $user->urlName = $this->login;
        $user->save();

        $userIdentity = new UserIdentity();
        $userIdentity->userId = $user->id;
        $userIdentity->identityId = $identity->id;
        $userIdentity->addedAt = TimeMachine::getInstance()->now();
        $userIdentity->save();

        AuthService::getInstance()->signIn($identity);
        Router::redirect($this->io->makeAnchor(Catalog::createState()));
    }


}