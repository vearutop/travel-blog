<?php

namespace TravelBlog\Ui\AuthCommand;


use TravelBlog\Auth\AuthService;
use TravelBlog\Entity\Identity;
use TravelBlog\Entity\User;
use TravelBlog\Entity\UserIdentity;
use TravelBlog\Identity\Password;
use TravelBlog\Router;
use TravelBlog\Ui\AlbumCommand\Catalog;
use Yaoi\Command\Command;
use Yaoi\Command\Option;
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
        $options->login = Option::create()->setType()->setIsRequired();
        $options->password = Option::create()->setType()->setIsRequired();
        $options->repeatPassword = Option::create()->setType()->setIsRequired();
        $options->email = Option::create()->setType();
    }

    public function performAction()
    {
        try {
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
        catch (\Exception $exception) {
            $this->response->error($exception->getMessage());
            $this->response->addContent(new Form(RegisterReceive::createState($this->io), $this->io));
        }
    }


}