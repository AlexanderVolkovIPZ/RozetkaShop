<?php

namespace models;

use core\Core;

class Power
{
    protected static string $tableName = 'power';

    public static function getPower()
    {
        $power= Core::getInstance()->db->select(self::$tableName);
        return $power;
    }
}