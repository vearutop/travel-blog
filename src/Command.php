<?php

namespace TravelBlog;

use TravelBlog\Command\Option;
use Yaoi\String\Utils;

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
                if ($option->isArgument) {
                    $this->arguments []= $option;
                    continue;
                }

                if ($option->shortName) {
                    $this->optionsByShortName[$option->shortName] = $option;
                }

                if (empty($option->name)) {
                    $option->name = Utils::fromCamelCase($name, '-');
                }

                $this->optionsByName[$option->name] = $option;
            }
        }
        return $this->options;
    }


    protected $optionsByShortName = array();
    protected $optionsByName = array();
    protected $arguments = array();
}