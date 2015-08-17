<?php

namespace TravelBlog\Cli;

use Yaoi\Migration\Manager;

class MigrateCommand extends Command
{
    public $action;

    /**
     * @param static|\stdClass $options
     * @return void
     */
    public function describeSwitches($options)
    {
        $options->action = Argument::create();

        $options->force = 'Force migrations';
    }

    public function describeCommand()
    {
        return 'Migrate environment to comply application code';
    }

    public function execute() {
        Manager::getInstance()->run();
    }

}