<?php

namespace TravelBlog\Command;

use Yaoi\Command\Command;

abstract class ActionCommand extends Command
{
    /** @var Command */
    public $action;

    public function performAction()
    {
        $this->action->performAction();
    }
}