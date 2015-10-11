<?php
/**
 * Created by PhpStorm.
 * User: vearutop
 * Date: 18.08.2015
 * Time: 3:20
 */

namespace TravelBlog\Cli;


use TravelBlog\Command;
use TravelBlog\Command\Option;

class SetupCommand extends Command
{
    public $databaseType;
    public $databaseUser;
    public $databaseHost;
    public $databasePassword;
    public $databaseName;

    public $cacheType;
    public $cacheHost;
    public $cachePort;
    public $cachePath;

    public $vkAppId;
    public $vkAppKey;

    public $googleAppId;
    public $googleAppKey;

    public function setUpOptions($options, &$arguments)
    {
        $options->databaseType = Option::create()
            ->setEnum('mysql', 'pgsql', 'sqlite');

        $options->databaseUser = Option::create()
            ->setDescription('Database user name (skip for sqlite)');

        $options->databaseHost = Option::create();

        $options->databasePassword = Option::create()
            ->setType(Option::TYPE_PROMPT);

        $options->cacheType = Option::create()
            ->setEnum('memcached', 'file', 'void');

        $options->cacheHost = Option::create();
        $options->cachePort = Option::create();
        $options->cachePath = Option::create();

        $options->vkAppId = Option::create()
            ->setDescription('');


        // TODO: Implement initOptions() method.
    }

    public function describeCommand()
    {
        // TODO: Implement describeCommand() method.
    }

    public function getName()
    {
        // TODO: Implement getName() method.
    }

    public function execute()
    {
        // TODO: Implement execute() method.
    }

}