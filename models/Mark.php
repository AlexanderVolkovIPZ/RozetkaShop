<?php

namespace models;
use core\Core;
use Couchbase\PrefixSearchQuery;


class Mark
{
    protected static string $tableName = 'product_mark';

    public static function getMark()
    {
        $marks = Core::getInstance()->db->select(self::$tableName);
        return $marks;
    }
}