<?php

namespace TravelBlog\Ui\AuthCommand;


use TravelBlog\Command\ActionCommand;
use Yaoi\Command\Option;
use Yaoi\Command\Definition;
use Yaoi\Oauth2\Vk\VkAuth;

class Auth extends ActionCommand
{

    static function setUpDefinition(Definition $definition, $options)
    {
        $options->action = Option::create()
            ->setIsUnnamed()
            ->setIsRequired()
            ->addToEnum(SignIn::definition())
            ->addToEnum(SignOut::definition())
            ->addToEnum(Register::definition())
            ->addToEnum(RegisterReceive::definition())
            ->addToEnum(VkAuth::definition(), 'vk')
        ;
    }

}