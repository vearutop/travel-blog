<?php

namespace TravelBlog\Entity;

use Yaoi\Database\Definition\Column;
use Yaoi\Database\Definition\Table;
use Yaoi\Database\Entity;

class IdentityProvider extends Entity
{
    public $id;
    public $title;
    public $class;

    static function setUpColumns($columns)
    {
        $columns->id = Column::AUTO_ID;
        $columns->title = Column::STRING;
        $columns->class = Column::STRING;
    }

    static function setUpTable(\Yaoi\Database\Definition\Table $table, $columns)
    {
    }

}