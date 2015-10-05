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
    public $dryRun;
    public $verbose;
    public $continueAfterFail;

    /**
     * @param static|\stdClass $options
     * @return void
     */
    public function describeSwitches($options)
    {
        $options->dryRun = Option::create()->setDescription('Read-only mode to check current status');
        $options->continueAfterFail = Option::create()->setDescription('Do not stop migrations after failure');
        $options->verbose = Option::create()->setDescription('More output')->setEnum(0, 1, 2);
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