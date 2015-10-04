<?php
/**
 * Created by PhpStorm.
 * User: vearutop
 * Date: 04.10.2015
 * Time: 12:18
 */

namespace TravelBlog\Entity;


use Yaoi\Database\Definition\Table;
use Yaoi\Database\Entity;

class UserPasswordIdentity extends Entity
{
    public $login;
    public $password;

    static function setUpColumns($columns)
    {
        // TODO: Implement setUpColumns() method.
    }

    static function setUpTable(\Yaoi\Database\Definition\Table $table, $columns)
    {
        // TODO: Implement setUpTable() method.
    }

}