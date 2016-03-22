<?php

namespace TravelBlog\Entity;


use Yaoi\Database\Definition\Column;
use Yaoi\Database\Entity;

class Album extends Entity
{
    public $id;
    public $userId;
    public $title;
    public $created;

    static function setUpColumns($columns)
    {
        $columns->id = Column::AUTO_ID;
        $columns->userId = User::columns()->id;
        $columns->created = Column::INTEGER;
        $columns->title = Column::STRING;
    }

    static function setUpTable(\Yaoi\Database\Definition\Table $table, $columns)
    {
    }


}