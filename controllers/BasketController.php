<?php

namespace controllers;

use models\Basket;
use models\Order;
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
        if(isset($_GET['id'])) {
            Basket::addToBasket($_GET['id']);
        }
        exit(json_encode(Basket::getCountProductInBasket()));
    }

    public function deleteAction(){
        if(isset($_GET['id'])){
        Basket::deleteFromBasket($_GET['id']);
        }
        exit(json_encode(Basket::getCountProductInBasket()));
    }

    public function updateAction(){
        if(isset($_GET['id']) && $_GET['count']){
            Basket::updateBasket($_GET['id'],$_GET['count']);
        }
        exit(json_encode(Basket::getCountProductInBasket()));
    }
    public function sum_one_recordAction(){
        $id = intval($_GET['id']);
        $count = intval($_GET['count']);
        exit (json_encode(Basket::getSumOneRecord($id,$count)));
    }

    public static function sumAction(){
        exit (json_encode(Basket::getAllSumBasket()));
    }

    public static function destinationsAction(){
        $id = intval($_GET['id']);
        if(!empty($id)){
            exit (json_encode(Order::getAllDestinationsByIdTown($id)));
        }

    }

    public  function orderAction(){
        $basket = Basket::getProductsInBasket();
        $towns = Order::getAllTowns();
        if(User::isAuthenticatedUser()){
            $user = User::getCarrentAuthenticatedUser();
            return $this->render(null,[
                'user'=>$user,
                'basket'=>$basket,
                'towns'=>$towns
            ]);
        }
        return $this->render();
    }
}


