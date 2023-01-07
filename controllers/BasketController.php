<?php

namespace controllers;

use core\Core;
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
//        var_dump($_POST);
        if(Core::getInstance()->requestMethod=="POST"){
            $userId = User::getCarrentAuthenticatedUser()['id'];
            $firstName = $_POST['firstName'];
            $middleName = $_POST['middleName'];
            $mobile= $_POST['mobile'];
            $email = $_POST['email'];
            $selectTown = $_POST['selectTown'];
            $selectDestination = $_POST['selectDestination'];
            $typePayment = $_POST['typePayment'];
            if (User::isAuthenticatedUser()){
                foreach ($_SESSION['basket'] as $key=>$value){
                    $orderList=[
                        'id_product'=>$key,
                        'id_destination'=>$selectDestination,
                        'id_user'=>$userId,
                        'mobile'=>$mobile,
                        'typePayment_id'=>$typePayment,
                        'count'=>$value
                    ];
                    Order::createOreder($orderList);
                    Basket::deleteProductFromBasketStorage($key, $userId);
                }
            }else{
                foreach ($_SESSION['basket'] as $key=>$value){
                    $orderList=[
                        'id_product'=>$key,
                        'id_destination'=>$selectDestination,
                        'mobile'=>$mobile,
                        'firstName'=>$firstName,
                        'middleName'=>$middleName,
                        'login'=>$email,
                        'typePayment_id'=>$typePayment,
                        'count'=>$value
                    ];
                    Order::createOreder($orderList);
                }
            }
            $_SESSION['basket'] = [];
            $this->redirect('/basket/order_success');
        }








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
        return $this->render(null,[
            'basket'=>$basket,
            'towns'=>$towns
        ]);
    }
    public function order_successAction(){
        return $this->render();
    }

}

