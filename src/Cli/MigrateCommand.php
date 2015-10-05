<?php

namespace TravelBlog\Cli;

use TravelBlog\Entity\Session;
use TravelBlog\Identity;
use TravelBlog\IdentityProvider;
use TravelBlog\User;
use TravelBlog\UserIdentity;
use Yaoi\Database\Definition\Table;
use Yaoi\Log;
use Yaoi\Migration\Manager;

class MigrateCommand extends Command
{
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
        /** @var Table[] $tables */
        $tables = array(
            Identity::table(),
            IdentityProvider::table(),
            Session::table(),
            User::table(),
            UserIdentity::table(),

        );

        $log = new Log('colored-stdout');

        $adder = new Manager();
        $adder->setLog($log);
        foreach ($tables as $table) {
            $adder->add($table->migration());
        }
    }

    public function getName()
    {
        return 'migrate';
    }

}