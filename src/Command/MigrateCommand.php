<?php

namespace TravelBlog\Command;

use Yaoi\Command\Definition;
use Yaoi\Command\Option;
use Yaoi\Database;
use Yaoi\Log;
use Yaoi\Schema\Primitives\EnumStructure;

class MigrateCommand extends \Yaoi\Command\Command
{
    public $dryRun;
    public $verbose;
    public $continueAfterFail;
    public $wipe;

    static function setUpDefinition(Definition $definition, $options)
    {
        $options->dryRun = Option::create()->setDescription('Read-only mode to check current status');
        $options->continueAfterFail = Option::create()->setDescription('Do not stop migrations after failure');
        $options->verbose = Option::create(EnumStructure::create()->setEnum(0, 1, 2))->setDescription('More output');
        $options->wipe = Option::create()->setDescription('Drop and create tables');

        $definition->description = 'Migrate environment to comply application code';
    }

    public function performAction()
    {
        $database = Database::getInstance();
        $settings = $database->getSettings();

        $tables = $settings->getTables();
        $log = new Log('colored-stdout');

        if ($this->wipe) {
            foreach ($tables as $table) {
                $table
                    ->migration()
                    ->setDryRun($this->dryRun)
                    ->setLog($log)
                    ->rollback();
            }
        }

        foreach ($tables as $table) {
            $table
                ->migration()
                ->setDryRun($this->dryRun)
                ->setLog($log)
                ->apply();
        }

    }
}