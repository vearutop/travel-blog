<?php

namespace TravelBlog\Entity;

use TravelBlog\Identity;
use Yaoi\Database\Definition\Column;
use Yaoi\Database\Entity;

class Session extends Entity
{
    public $identityId;
    public $sessionId;
    public $createdAt;

    static function setUpColumns($columns)
    {
        $columns->identityId = Identity::columns()->id;
        $columns->sessionId = Column::create(Column::STRING + Column::NOT_NULL)->setStringLength(32, true)->setUnique();
        $columns->createdAt = Column::INTEGER;
    }

    static function setUpTable(\Yaoi\Database\Definition\Table $table, $columns)
    {
        $table->setPrimaryKey($columns->identityId);
    }
}