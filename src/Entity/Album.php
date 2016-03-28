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
    public $imagesCount;
    public $updated;

    static function setUpColumns($columns)
    {
        $columns->id = Column::AUTO_ID;
        $columns->userId = User::columns()->id;
        $columns->created = Column::INTEGER + Column::NOT_NULL;
        $columns->title = Column::STRING + Column::NOT_NULL;
        $columns->imagesCount = Column::INTEGER + Column::NOT_NULL;
        $columns->updated = Column::INTEGER + Column::NOT_NULL;
    }

    static function setUpTable(\Yaoi\Database\Definition\Table $table, $columns)
    {
    }


}