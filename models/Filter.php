<?php

namespace models;

use core\Core;

class Filter
{
protected static string $tableName = 'filter';

    public static function selectFilter($fieldsList = "*", $conditionsArray = null, $orderByArray = null, $limit = null, $offset = null)
    {
        $filters = Core::getInstance()->db->select(
            self::$tableName,
            $fieldsList,
            $conditionsArray,
            $orderByArray,
            $limit,
            $offset
        );
        return $filters;
    }
}