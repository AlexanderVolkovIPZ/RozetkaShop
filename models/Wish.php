<?php

namespace models;

use core\Core;

class Wish
{
    protected static $tableName = 'wish_list';

    public static function addWish($productId, $count = 1)
    {
        if (!is_array($_SESSION['wish']))
            $_SESSION['wish'] = [];
        $_SESSION['wish'][$productId] += $count;
    }

    public static function deleteFromWish($productId){
        foreach($_SESSION['wish'] as $key=>$value){
            if($key == $productId){
                unset($_SESSION['wish'][$key]);
            }
        }
    }

    public static function initializeBasket()
    {
//        if (User::isAuthenticatedUser() && !User::isUserAdmin()) {
//            $products = self::getProductsById(User::getCarrentAuthenticatedUser()['id']);
//            foreach ($products as $product) {
//                $_SESSION['wish'][$product['id_product']] = $product['count'];
//            }
//        }
    }






//    public static function addWish($values){
//        Core::getInstance()->db->insert(self::$tableName, $values);
//    }
//
//    public static function selectWish($conditions,$fields="*"){
//        $rows = Core::getInstance()->db->select(self::$tableName, $fields,$conditions);
//        return $rows;
//    }
}