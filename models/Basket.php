<?php

namespace models;

use core\Core;

class Basket
{
    protected static string $tableName = 'basket';

    public static function addToBasket($productId, $count = 1)
    {
        if (!is_array($_SESSION['basket']))
            $_SESSION['basket'] = [];
        $_SESSION['basket'][$productId] += $count;
    }

    public static function deleteFromBasket($productId){
        foreach($_SESSION['basket'] as $key=>$value){
            if($key == $productId){
                unset($_SESSION['basket'][$key]);
            }
        }
    }

    public static function updateBasket($productId, $count){
        foreach($_SESSION['basket'] as $key=>$value){
            if($key == $productId){
                $_SESSION['basket'][$key] = $count;
            }
        }
        return $count;
    }

    public static function updateBasketInDB($userId)
    {
        Core::getInstance()->db->delete(self::$tableName,[
            'id_user'=>$userId
        ]);

        foreach ($_SESSION['basket'] as $key=>$value){
            Core::getInstance()->db->insert(self::$tableName,[
                'id_user'=>$userId,
                'id_product'=>$key,
                'count'=>$value
            ]);
        }
    }

    public static function getProductsById($userId)
    {
        $rows = Core::getInstance()->db->select(self::$tableName, "*", [
            'id_user' => $userId
        ]);
        return $rows;
    }

    public static function initializeBasket()
    {
        if (User::isAuthenticatedUser() && !User::isUserAdmin()) {
            $products = self::getProductsById(User::getCarrentAuthenticatedUser()['id']);
            foreach ($products as $product) {
                $_SESSION['basket'][$product['id_product']] = $product['count'];
            }
        }
    }

    public static function getProductsInBasket()
    {
        if (is_array($_SESSION['basket'])) {
            $resultBasketArray = [];
            $products = [];
            $totalPrice = 0;
            foreach ($_SESSION['basket'] as $productId => $count) {
                $product = Product::getProductById($productId, ['count', 'price', 'name', 'id']);
                $photo = PhotoProduct::getProductPhotoByName($product['name']);
                $totalPrice += $product['price'] * $count;
                $products[] = ['product' => $product, 'count' => $count, 'photo' => $photo[0]['name']];
            }
            $resultBasketArray['products'] = $products;
            $resultBasketArray['totalPrice'] = $totalPrice;
            return $resultBasketArray;
        }
        return null;
    }
}
