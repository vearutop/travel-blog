<?php

namespace TravelBlog\Cli;


use TravelBlog\Command\Exception;
use TravelBlog\Command\Option;
use TravelBlog\Request;
use TravelBlog\StringVar;

abstract class Command extends \TravelBlog\Command
{
    const OPTION_NAME = '--';
    const OPTION_SHORT = '-';

    protected $autoFlagName = true;
    protected $autoShortName = false;

    public function setup(Request $request) {
        $tokens = $request->server()->argv;
        $argc = count($tokens);
        for ($index = 0; $index < $argc; ++$index) {
            $token = new StringVar($tokens[$index]);
            $option = null;


            if ($optionName = $token->afterStarts(self::OPTION_NAME)) {
                if (!isset($this->optionsByName[$optionName])) {
                    throw new Exception('Unknown option "' . self::OPTION_NAME . $optionName . '"', Exception::UNKNOWN_OPTION);
                }
                $option = $this->optionsByName[$optionName];
            }
            elseif ($optionName = $token->afterStarts(self::OPTION_SHORT)) {
                if (!isset($this->optionsByName[$optionName])) {
                    throw new Exception('Unknown option "' . self::OPTION_NAME . $optionName . '"', Exception::UNKNOWN_OPTION);
                }
                $option = $this->optionsByShortName[$optionName];
            }

            if (null === $option) {


            }

        }
    }

    public function help() {
        echo "Usage:" . PHP_EOL;
        foreach ($this->arguments as $argument) {

        }
        /** @var Option $option */
        foreach ((array)$this->options as $option) {
            echo "  " . self::OPTION_NAME . $option->flagName . ' ' . $option->description . PHP_EOL;
        }
    }

}