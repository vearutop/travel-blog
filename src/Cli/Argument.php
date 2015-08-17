<?php
/**
 * Created by PhpStorm.
 * User: vearutop
 * Date: 18.08.2015
 * Time: 3:03
 */

namespace TravelBlog\Cli;

use Yaoi\BaseClass;

class Argument extends BaseClass
{
    const TYPE_BOOL = 'bool';
    const TYPE_VALUE = 'value';
    const TYPE_ENUM = 'enum';
    const TYPE_PROMPT = 'prompt';

    public $values = array();

    public function setEnum(array $values) {

    }

    public $required;
    public $description;
    public $type;
}