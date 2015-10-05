<?php

namespace TravelBlog\Cli;

abstract class Command
{
    /**
     * @param static|\stdClass $options
     * @return void
     */
    abstract public function describeSwitches($options);
    abstract public function describeCommand();
    abstract public function execute();
    abstract public function getName();

}