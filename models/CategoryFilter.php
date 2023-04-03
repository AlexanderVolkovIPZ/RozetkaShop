<?php

namespace models;

use core\Core;

class CategoryFilter
{
    protected static string $tableName = 'category_filter';

    public static function selectCategoryFilter($fieldsList = "*", $conditionsArray = null, $orderByArray = null, $limit = null, $offset = null)
    {
        $values = Core::getInstance()->db->select(
            self::$tableName,
            $fieldsList,
            $conditionsArray,
            $orderByArray,
            $limit,
            $offset
        );
        return $values;
    }

    public static function addCategoryFilter($category_id, $filter_id){

        \core\Core::getInstance()->db->insert(self::$tableName,[
            'category_id'=>$category_id,
            'filter_id'=>$filter_id
        ]);
    }

}