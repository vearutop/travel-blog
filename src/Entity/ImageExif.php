<?php

namespace TravelBlog\Entity;


use Yaoi\Database\Definition\Column;
use Yaoi\Database\Definition\Table;
use Yaoi\Database\Entity;

class ImageExif extends Entity
{
    public $imageId;
    public $exifTagId;
    public $exifValue;

    static function setUpColumns($columns)
    {
        $columns->imageId = Image::columns()->id;
        $columns->exifTagId = ExifTag::columns()->id;
        $columns->exifValue = Column::STRING;
    }

    static function setUpTable(\Yaoi\Database\Definition\Table $table, $columns)
    {
        $table->setPrimaryKey($columns->imageId, $columns->exifTagId);
    }


}