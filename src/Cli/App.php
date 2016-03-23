<?php

namespace TravelBlog\Cli;


use TravelBlog\Command\MigrateCommand;
use TravelBlog\Command\SetupCommand;
use Yaoi\Command\Application;
use Yaoi\Command\Definition;

class App extends Application
{
    public $setup;
    public $migrate;

    static function setUpCommands(Definition $definition, $commandDefinitions)
    {

        $commandDefinitions->migrate = MigrateCommand::definition();
        $commandDefinitions->setup = SetupCommand::definition();

        $definition->name = 'photorep';
    }

}