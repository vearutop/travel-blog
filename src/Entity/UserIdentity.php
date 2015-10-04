<?php

namespace TravelBlog;


use Yaoi\Database\Definition\Column;
use Yaoi\Database\Definition\Table;
use Yaoi\Database\Entity;
use Yaoi\Date\TimeMachine;

class UserIdentity extends Entity
{
    public $userId;
    public $identityId;
    public $addedAt;

    static function setUpColumns($columns)
    {
        $columns->userId = User::columns()->id;
        $columns->identityId = Identity::columns()->id;
        $columns->addedAt = Column::INTEGER + Column::UNSIGNED;
    }

    static function setUpTable(\Yaoi\Database\Definition\Table $table, $columns)
    {
        $table->setPrimaryKey($columns->userId, $columns->identityId);
    }

    public function save() {
        if (empty($this->addedAt)) {
            $this->addedAt = TimeMachine::getInstance()->now();
        }
        return parent::save();
    }

}