<?php

namespace TravelBlog\Entity;

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
    public $gender;

    const GENDER_FEMALE = 1;
    const GENDER_MALE = 2;


    static function setUpColumns($columns)
    {
        $columns->id = Column::AUTO_ID;
        $columns->firstName = Column::STRING;
        $columns->lastName = Column::STRING;
        $columns->urlName = Column::STRING;
        $columns->avatar = Column::STRING;
        $columns->gender = Column::INTEGER + Column::NOT_NULL;
    }

    static function setUpTable(\Yaoi\Database\Definition\Table $table, $columns)
    {
        // TODO: Implement setUpTable() method.
    }

}