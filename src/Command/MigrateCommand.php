<?php

namespace TravelBlog\Command;

use TravelBlog\Entity\Album;
use TravelBlog\Entity\ExifTag;
use TravelBlog\Entity\Identity;
use TravelBlog\Entity\IdentityProvider;
use TravelBlog\Entity\Image;
use TravelBlog\Entity\ImageExif;
use TravelBlog\Entity\Session;
use TravelBlog\Entity\User;
use TravelBlog\Entity\UserIdentity;
use Yaoi\Command\Definition;
use Yaoi\Command\Option;
use Yaoi\Database\Definition\Table;
use Yaoi\Log;
use Yaoi\Migration\Manager;

class MigrateCommand extends \Yaoi\Command
{
    public $dryRun;
    public $verbose;
    public $continueAfterFail;
    public $wipe;

    static function setUpDefinition(Definition $definition, $options)
    {
        $options->dryRun = Option::create()->setDescription('Read-only mode to check current status');
        $options->continueAfterFail = Option::create()->setDescription('Do not stop migrations after failure');
        $options->verbose = Option::create()->setDescription('More output')->setEnum(0, 1, 2);
        $options->wipe = Option::create()->setDescription('Drop and create tables');

        $definition->description = 'Migrate environment to comply application code';
    }

    public function performAction()
    {
        /** @var Table[] $tables */
        $tables = array(
            Identity::table(),
            IdentityProvider::table(),
            Session::table(),
            User::table(),
            UserIdentity::table(),

            Album::table(),
            ExifTag::table(),
            Image::table(),
            ImageExif::table(),
        );

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