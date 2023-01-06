<?php

namespace models;

use core\Core;
use Couchbase\PrefixSearchQuery;

class Comment
{
    protected static string $tableName = 'comment_products';

    public static function addComment($rows){
        Core::getInstance()->db->insert(self::$tableName, $rows);
    }

    public static function deleteCommentByUserProductId($userId,$productId){
        Core::getInstance()->db->delete(self::$tableName,[
            'id_user'=>$userId,
            'id_product'=>$productId
        ]);
    }

    public static function isLevedCommentByUser($productId,$userId){
        $row = Core::getInstance()->db->select(self::$tableName,"*",[
                'id_user'=>$userId,
                'id_product'=>$productId
            ]);
        if(empty($row))
            return false;
        else
            return true;
    }

    public static function selectCommentsByProductId($productId){
        $rows = Core::getInstance()->db->select(self::$tableName,"*",[
            'id_product'=>$productId
        ]);
        return $rows;
    }
}