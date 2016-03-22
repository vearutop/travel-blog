<?php

namespace TravelBlog\Entity;

use Yaoi\Database\Definition\Column;
use Yaoi\Database\Entity;

class Session extends Entity
{
    public $identityId;
    public $token;
    public $createdAt;
    public $updatedAt;
    public $info;

    static function setUpColumns($columns)
    {
        $columns->identityId = Identity::columns()->id;
        $columns->token = Column::create(Column::STRING + Column::NOT_NULL)->setStringLength(32, true)->setUnique();
        $columns->createdAt = Column::INTEGER;
    }

    static function setUpTable(\Yaoi\Database\Definition\Table $table, $columns)
    {
        $table->setPrimaryKey($columns->identityId, $columns->token);
    }

    /**
     * @param $token
     * @return static
     */
    static function findByToken($token) {
        $session = Session::statement()->where('? = ?', Session::columns()->token, $token)->query()->fetchRow();
        return $session;
    }
}