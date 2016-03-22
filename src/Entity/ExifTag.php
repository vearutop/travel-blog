<?php

namespace TravelBlog\Entity;


use Yaoi\Database\Definition\Column;
use Yaoi\Database\Definition\Table;
use Yaoi\Database\Entity;

class ExifTag extends Entity
{
    public $id;
    public $text;
    public $skip;

    static function setUpColumns($columns)
    {
        $columns->id = Column::AUTO_ID;
        $columns->text = Column::STRING + Column::NOT_NULL;
        $columns->skip = Column::INTEGER;
    }

    static function setUpTable(\Yaoi\Database\Definition\Table $table, $columns)
    {
    }


}