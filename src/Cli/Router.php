<?php

namespace TravelBlog\Cli;

use TravelBlog\Command;
use TravelBlog\Request;

class Router extends \TravelBlog\Router
{
    /** @var  Command[] */
    protected $commands;

    public function route() {
        $this->commands = array(
            new MigrateCommand(),
            new SetupCommand(),
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
        foreach ($this->commands as $command) {

        }
    }

}