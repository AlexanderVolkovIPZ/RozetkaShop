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
        $_SESSION['wish'][$productId] = $count;
    }

    public static function deleteFromWish($productId){
        foreach($_SESSION['wish'] as $key=>$value){
            if($key == $productId){
                unset($_SESSION['wish'][$key]);
            }
        }
    }

    public static function getProductsById($userId)
    {
        $rows = Core::getInstance()->db->select(self::$tableName, "*", [
            'id_user' => $userId
        ]);
        return $rows;
    }


    public static function initializeWishList()
    {
        if (User::isAuthenticatedUser() && !User::isUserAdmin()) {
            $products = self::getProductsById(User::getCarrentAuthenticatedUser()['id']);
            foreach ($products as $product) {
                $_SESSION['wish'][$product['id_product']] = 1;
            }
        }
    }

    public static function updateWishListInDB($userId)
    {
        Core::getInstance()->db->delete(self::$tableName,[
            'id_user'=>$userId
        ]);

        foreach ($_SESSION['wish'] as $key=>$value){
            Core::getInstance()->db->insert(self::$tableName,[
                'id_user'=>$userId,
                'id_product'=>$key,
            ]);
        }
    }
}