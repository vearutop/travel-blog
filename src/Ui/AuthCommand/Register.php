<?php

namespace TravelBlog\Ui\AuthCommand;

use TravelBlog\View\Auth\RegisterForm;
use Yaoi\Command;
use Yaoi\Command\Definition;

class Register extends Command
{
    static function setUpDefinition(Definition $definition, $options)
    {
        // TODO: Implement setUpDefinition() method.
    }

    public function performAction()
    {
        $this->response->addContent(
            RegisterForm::create()->setSubmitUrl($this->io->makeAnchor(RegisterReceive::createState()))
        );
    }

}