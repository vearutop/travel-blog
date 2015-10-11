<?php
/**
 * Created by PhpStorm.
 * User: vearutop
 * Date: 18.08.2015
 * Time: 3:03
 */

namespace TravelBlog\Command;

use Yaoi\BaseClass;

class Option extends BaseClass
{
    const TYPE_BOOL = 'bool';
    const TYPE_VALUE = 'value';
    const TYPE_ENUM = 'enum';
    const TYPE_PROMPT = 'prompt';

    public $values = array();

    public $isArgument;
    public $isVariableLength;
    public function setIsArgument($isArgument = true, $isVariableLength = false) {
        $this->isArgument = $isArgument;
        $this->isVariableLength = $isVariableLength;
        return $this;
    }

    public $name;
    public function setName($name) {
        $this->name = $name;
        return $this;
    }

    public $shortName;
    public function setShortName($shortName) {
        $this->shortName = $shortName;
        return $this;
    }

    public function setEnum($values) {
        $this->type = self::TYPE_ENUM;
        $this->values = is_array($values) ? $values : func_get_args();
        return $this;
    }

    public function setType($type = self::TYPE_VALUE) {
        $this->type = $type;
        return $this;
    }

    public function setDescription($description) {
        $this->description = $description;
        return $this;
    }

    public $required;
    public function setRequired($required = true) {
        $this->required = $required;
        return $this;
    }

    public $description;
    public $type = self::TYPE_BOOL;
}