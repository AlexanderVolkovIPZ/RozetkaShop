<?php

namespace models;

use core\Core;
use core\Utils;

class Product
{
    protected static $tableName = 'product';

    public static function addProduct($row)
    {
        $fieldsList = ['count', 'name', 'price', 'id_category', 'brief_description', 'full_description', 'visibility'];
        $row = Utils::filterArray($row, $fieldsList);
        Core::getInstance()->db->insert(self::$tableName, $row);
    }

    public static function deleteProductById($id)
    {
        Core::getInstance()->db->delete(self::$tableName, [
            'id' => $id
        ]);
    }

    public static function updateProduct($id, $row)
    {
        $fieldsList = ['count', 'name', 'price', 'id_category', 'brief_description', 'full_description', 'visibility'];
        $row = Utils::filterArray($row, $fieldsList);
        Core::getInstance()->db->update(self::$tableName, $row, [
            'id' => $id
        ]);
    }

    public static function getProductById($id, $array = "*")
    {

        $row = Core::getInstance()->db->select(self::$tableName, $array, [
            'id' => $id
        ]);

        if (!empty($row)) {
            return $row[0];
        } else {
            return null;
        }
    }

    public static function getProductInCategory($id_category)
    {
        $rows = Core::getInstance()->db->select(self::$tableName, '*', [
            'id_category' => $id_category
        ]);
        return $rows;
    }

    public static function selectProduct($arrayCondition = null, $fieldsList = "*", $arrayConditionLike = null)
    {
        $rows = Core::getInstance()->db->select(self::$tableName, $fieldsList, $arrayCondition, $arrayConditionLike);
        return $rows;
    }
}

