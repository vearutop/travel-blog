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
    public $urlName;

    static function setUpColumns($columns)
    {
        $columns->id = Column::AUTO_ID;
        $columns->firstName = Column::STRING;
        $columns->lastName = Column::STRING;
        $columns->urlName = Column::STRING;
        $columns->avatar = Column::STRING;
    }

    static function setUpTable(\Yaoi\Database\Definition\Table $table, $columns)
    {
        // TODO: Implement setUpTable() method.
    }

}