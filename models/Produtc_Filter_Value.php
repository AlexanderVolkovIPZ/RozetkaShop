<?php

namespace models;

use core\Core;
use core\Utils;

class Produtc_Filter_Value
{
    protected static string $tableName = 'product_filter_value';

    public static function selectRecord($fieldsList = "*", $conditionsArray = null, $orderByArray = null, $limit = null, $offset = null)
    {
        $values= Core::getInstance()->db->select(self::$tableName,$fieldsList, $conditionsArray, $orderByArray, $limit, $offset);
        return $values;
    }

    public static function insertRecord($product_id,$filter_id,$value_id)
    {
        Core::getInstance()->db->insert(self::$tableName, [
            'product_id' => $product_id,
            'filter_id' => $filter_id,
            'value_id' => $value_id
        ]);
    }

    public static function  updateRecord($updatesArray,$where){
        $updatesArray = Utils::filterArray($updatesArray, ['product_id', 'filter_id', 'value_id']);
        \core\Core::getInstance()->db->update(
            self::$tableName,
            $updatesArray,
            $where
        );
    }

    public static function deleteRecord($where = null)
    {
        \core\Core::getInstance()->db->delete(
            self::$tableName,
            $where
        );
    }

}
