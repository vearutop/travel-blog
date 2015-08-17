<?php

namespace TravelBlog;

use Yaoi\Database\Definition\Column;
use Yaoi\Database\Definition\Table;
use Yaoi\Database\Entity;

class User extends Entity
{
    public $id;
    public $firstName;
    public $lastName;
    public $avatar;

    static function setUpColumns($columns)
    {
        $columns->id = Column::AUTO_ID;
        $columns->firstName = Column::STRING;
        $columns->lastName = Column::STRING;
        $columns->avatar = Column::STRING;
    }

    static function setUpTable(Table $table)
    {
    }
}