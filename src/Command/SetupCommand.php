<?php

namespace TravelBlog\Command;


use Yaoi\Command\Definition;
use Yaoi\Command\Option;

class SetupCommand extends \Yaoi\Command
{
    public $databaseDsn;
    public $cacheDsn;

    public $vkAppId;
    public $vkAppKey;

    public $googleAppId;
    public $googleAppKey;

    static function setUpDefinition(Definition $definition, $options)
    {
        $definition->description = 'Setup application';

        $options->databaseDsn = Option::create()
            ->setDescription('Database connection string (example mysqli://user:password@localhost/db_name)');

        $options->cacheDsn = Option::create()
            ->setDescription('Cache storage connection string (example memcached://localhost:11211)');

        $options->vkAppId = Option::create()
            ->setDescription('Vk.com API application id');

        $options->vkAppKey = Option::create()
            ->setDescription('Vk.com API application secret key');

        $options->googleAppId = Option::create()
            ->setDescription('Google API application id');

        $options->googleAppKey = Option::create()
            ->setDescription('Google API application secret key');

    }

    public function performAction()
    {
    }
}