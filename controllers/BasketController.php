<?php

namespace controllers;

use models\Basket;
use models\User;

class BasketController extends \core\Controller
{
    public function indexAction()
    {
        $basket = Basket::getProductsInBasket();
        return $this->render(null, [
            'basket' => $basket
        ]);
    }

    public function addAction()
    {
        if(isset($_GET['id'])){
            Basket::addToBasket($_GET['id'],$_GET['count']);
        }
    }

    public function deleteAction(){
        Basket::deleteFromBasket($_GET['id']);
    }

    public function updateAction(){
        $value = Basket::updateBasket($_GET['id'],$_GET['count']);
        var_dump($value);
    }
}


