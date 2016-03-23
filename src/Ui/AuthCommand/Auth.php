<?php

namespace TravelBlog\Ui\AuthCommand;


use TravelBlog\Command\ActionCommand;
use Yaoi\Command;
use Yaoi\Command\Definition;

class Auth extends ActionCommand
{

    static function setUpDefinition(Definition $definition, $options)
    {
        $options->action = Command\Option::create()
            ->setIsUnnamed()
            ->setIsRequired()
            ->addToEnum(SignIn::definition())
            ->addToEnum(SignOut::definition())
            ->addToEnum(Register::definition())
            ->addToEnum(RegisterReceive::definition())
        ;
    }

}