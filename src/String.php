<?php

namespace TravelBlog;

use Yaoi\BaseClass;

class String extends BaseClass
{
    public $value = '';
    public function __construct($string) {
        $this->value = (string)$string;
    }

    public function starts($substring, $ignoreCase = false) {
        $strLen = strlen($substring);
        if ($ignoreCase) {
            return strtolower(substr($this->value, 0, $strLen)) === strtolower($substring);
        }
        else {
            return substr($this->value, 0, $strLen) === $substring;
        }
    }

    public function ends($substring, $ignoreCase = false) {
        $strLen = strlen($substring);
        if ($ignoreCase) {
            return strtolower(substr($this->value, -$strLen)) === strtolower($substring);
        }
        else {
            return substr($this->value, -$strLen) === $substring;
        }
    }

    public function __toString() {
        return $this->value;
    }

}