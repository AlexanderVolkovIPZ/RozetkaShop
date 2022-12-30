<?php

namespace controllers;

use models\Basket;

class BasketController extends \core\Controller
{
    public function indexAction(){
//        Basket::addProduct(3,10);
        $basket = Basket::getProductsInBasket();
        return $this->render(null,[
            'basket'=>$basket
        ]);
    }
}