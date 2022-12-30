<?php

namespace models;

class Basket
{
    public static function addProduct($productId,$count = 1){
        if(!is_array($_SESSION['basket']))
            $_SESSION['basket'] =[];
        $_SESSION['basket'][$productId] = $count;

    }

    public static function getProductsInBasket(){
        if(is_array($_SESSION['basket'])){
            $resultBasketArray = [];
            $products = [];
            $totalPrice = 0;
            foreach($_SESSION['basket'] as $productId=>$count){
                $product = Product::getProductById($productId);
                $totalPrice+=$product['price']*$count;
                $products[] = ['product'=>$product,'count'=>$count];
            }
            $resultBasketArray['products'] =$products;
            $resultBasketArray['totalPrice'] = $totalPrice;
            return $resultBasketArray;
        }
        return null;
    }
}