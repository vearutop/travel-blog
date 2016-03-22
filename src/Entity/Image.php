<?php

namespace TravelBlog\Entity;

use Yaoi\Database\Definition\Column;
use Yaoi\Database\Entity;
use Yaoi\Undefined;

class Image extends Entity
{
    public $id;
    public $albumId;
    public $height;
    public $width;
    public $path;
    public $url;
    public $hash;

    static function setUpColumns($columns)
    {
        $columns->id = Column::AUTO_ID;
        $columns->albumId = Column::cast(Album::columns()->id)->copy()->setFlag(Column::NOT_NULL, false);
        $columns->height = Column::INTEGER + Column::SIZE_2B + Column::NOT_NULL;
        $columns->width = Column::INTEGER + Column::SIZE_2B + Column::NOT_NULL;
        $columns->path = Column::STRING + Column::NOT_NULL;
        $columns->url = Column::STRING + Column::NOT_NULL;
        $columns->hash = Column::create(Column::STRING)->setStringLength(32, true)->setUnique();
    }

    static function setUpTable(\Yaoi\Database\Definition\Table $table, $columns)
    {
    }

    public function save()
    {
        if ($this->hash instanceof Undefined) {
            $this->hash = md5_file($this->path);
        }
        parent::save(); // TODO: Change the autogenerated stub
    }

}