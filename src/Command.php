<?php

namespace TravelBlog;

use TravelBlog\Command\Option;

abstract class Command
{
    /**
     * @param static|\stdClass $options
     * @return void
     */
    abstract public function setUpOptions($options);
    abstract public function describeCommand();
    abstract public function getName();
    abstract public function execute();


    /** @var  static|\stdClass */
    protected $options;
    public function options() {
        if (null === $this->options) {
            $this->options = new \stdClass();
            $this->setUpOptions($this->options);
            /**
             * @var string $name
             * @var Option $option
             */
            foreach ((array)$this->options as $name => $option) {
                $option->name = $name;
                if ($option->shortName) {
                    $this->optionsByShortName[$option->shortName] = $option;
                }
                if ($option->name) {
                    $this->optionsByName[$option->name] = $option;
                }
            }
        }
        return $this->options;
    }


    protected $optionsByShortName = array();
    protected $optionsByName = array();
    protected $arguments = array();
}