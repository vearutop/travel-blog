<?php

namespace TravelBlog\Ui\AuthCommand;

use TravelBlog\View\Auth\RegisterForm;
use Yaoi\Command;
use Yaoi\Command\Definition;
use Yaoi\Twbs\Io\Content\Form;

class Register extends Command
{
    static function setUpDefinition(Definition $definition, $options)
    {
        // TODO: Implement setUpDefinition() method.
    }

    public function performAction()
    {
        $this->response->addContent(new Form(RegisterReceive::definition(), $this->io));
    }

}