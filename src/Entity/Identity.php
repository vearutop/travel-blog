<?php
namespace TravelBlog\Entity;

use Yaoi\Database\Definition\Column;
use Yaoi\Database\Definition\Index;
use Yaoi\Database\Entity;

class Identity extends Entity
{
    public $id;
    public $providerUserId;
    public $providerId;
    public $meta;

    static function setUpColumns($columns)
    {
        $columns->id = Column::AUTO_ID;
        $columns->providerId = IdentityProvider::columns()->id;
        $columns->providerUserId = Column::STRING + Column::NOT_NULL;
        $columns->meta = Column::STRING;
    }

    static function setUpTable(\Yaoi\Database\Definition\Table $table, $columns)
    {
        $table->addIndex(Index::TYPE_UNIQUE, $columns->providerUserId, $columns->providerId);
    }

}