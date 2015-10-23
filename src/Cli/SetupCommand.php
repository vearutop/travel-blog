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
    public $databaseDsn;
    public $cacheDsn;

    public $vkAppId;
    public $vkAppKey;

    public $googleAppId;
    public $googleAppKey;

    public function setUpOptions($options)
    {
        $options->databaseDsn = Option::create()
            ->setDescription('Database connection string (example mysqli://user:password@localhost/db_name)');

        $options->cacheDsn = Option::create()
            ->setDescription('Cache storage connection string (example memcached://localhost:11211)');

        $options->vkAppId = Option::create()
            ->setDescription('Vk.com API application id');

        $options->vkAppKey = Option::create()
            ->setType(Option::TYPE_PROMPT)
            ->setDescription('Vk.com API application secret key');

        $options->googleAppId = Option::create()
            ->setDescription('Google API application id');

        $options->googleAppKey = Option::create()
            ->setType(Option::TYPE_PROMPT)
            ->setDescription('Google API application secret key');
    }

    public function describeCommand()
    {
        return 'Setup application';
    }

    public function getName()
    {
        return 'setup';
    }

    public function execute()
    {
        file_put_contents(__DIR__ . '/../', '');
    }

}