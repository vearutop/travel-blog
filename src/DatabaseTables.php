<?php

namespace TravelBlog;

use TravelBlog\Entity\Album;
use TravelBlog\Entity\ExifTag;
use TravelBlog\Entity\Identity;
use TravelBlog\Entity\IdentityProvider;
use TravelBlog\Entity\Image;
use TravelBlog\Entity\ImageExif;
use TravelBlog\Entity\Session;
use TravelBlog\Entity\User;
use TravelBlog\Entity\UserIdentity;
use Yaoi\Database\Definition\Table;
use Yaoi\Database\TableSet;

class DatabaseTables extends TableSet
{
    public function getTables()
    {
        /** @var Table[] $tables */
        $tables = array(
            Identity::table(),
            IdentityProvider::table(),
            Session::table(),
            User::table(),
            UserIdentity::table(),

            Album::table(),
            ExifTag::table(),
            Image::table(),
            ImageExif::table(),
        );
        return $tables;
    }

}