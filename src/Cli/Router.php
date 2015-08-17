<?php

namespace TravelBlog\Cli;

use TravelBlog\Request;

class Router extends \TravelBlog\Router
{
    protected $commands;

    public function route() {
        $this->commands = array(
            'migrate' => new MigrateCommand(),
            'setup' => new SetupCommand(),
        );

        $commandName = $this->request->path();
        if ('help' === $commandName || !isset($this->commands[$commandName])) {
            $this->help();
        }

    }

    public function help($command = null) {
?>
Usage:
<?php
    }

}