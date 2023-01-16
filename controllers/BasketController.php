<?php

namespace controllers;

use core\Core;
use models\Basket;
use models\Order;
use models\Product;
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
        if (isset($_GET['id'])) {
            Basket::addToBasket($_GET['id']);
        }
        exit(json_encode(Basket::getCountProductInBasket()));
    }

    public function deleteAction()
    {
        if (isset($_GET['id'])) {
            Basket::deleteFromBasket($_GET['id']);
        }
        exit(json_encode(Basket::getCountProductInBasket()));
    }

    public function updateAction()
    {
        if (isset($_GET['id']) && $_GET['count']) {
            if (Product::getProductById($_GET['id'])['count'] >= intval($_GET['count'])) {
                Basket::updateBasket($_GET['id'], intval($_GET['count']));
            }
        }
        exit(json_encode(array(Basket::getCountProductInBasket(), $_SESSION['basket'][$_GET['id']])));

    }

    public function sum_one_recordAction()
    {
        $id = intval($_GET['id']);
        $count = intval($_GET['count']);
        exit (json_encode(Basket::getSumOneRecord($id, $count)));
    }

    public static function sumAction()
    {
        exit (json_encode(Basket::getAllSumBasket()));
    }

    public static function destinationsAction()
    {
        $id = intval($_GET['id']);
        if (!empty($id)) {
            exit (json_encode(Order::getAllDestinationsByIdTown($id)));
        }
    }

    public function orderAction()
    {
        $basket = Basket::getProductsInBasket();
        $towns = Order::getAllTowns();
        if (Core::getInstance()->requestMethod == "POST") {
            $errors = [];
            $userId = User::getCarrentAuthenticatedUser()['id'];
            $firstName = trim($_POST['firstName']);
            $middleName = trim($_POST['middleName']);
            $mobile = trim($_POST['mobile']);
            $email = trim($_POST['email']);
            $selectTown = trim($_POST['selectTown']);
            $selectDestination = trim($_POST['selectDestination']);
            $typePayment = trim($_POST['typePayment']);
            $patternName = '/[А-ЯЇІ][а-яії]+/';
            $patternMobile = '/(?:(?:\+*38)*0)\d{9}/';
            if (!preg_match($patternMobile, $mobile)) {
                $errors['mobile'] = "Помилка введення номера мобільного телефону!";
            }
            if (!preg_match($patternName, $firstName)) {
                $errors['firstName'] = "Помилка введеня імені!";
            }

            if (!preg_match($patternName, $middleName)) {
                $errors['middleName'] = "Помилка введення прізвища!";
            }

            if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
                $errors['email'] = "Помилка введення електронної пошти!";
            }
            if (empty($selectDestination) || $selectDestination == 'default') {
                $errors['selectDestination'] = "Відсутнє місце доставки товару!";
            }

            if (User::isAuthenticatedUser()) {
                $user = User::getCarrentAuthenticatedUser();
                if (count($errors) > 0) {
                    return $this->render(null, [
                        'user' => $user,
                        'basket' => $basket,
                        'towns' => $towns,
                        'errors' => $errors
                    ]);
                } else {
                    foreach ($_SESSION['basket'] as $key => $value) {
                        $orderList = [
                            'id_product' => $key,
                            'id_destination' => $selectDestination,
                            'id_user' => $userId,
                            'mobile' => $mobile,
                            'typePayment_id' => $typePayment,
                            'count' => $value,
                            'date' => date("Y-m-d")
                        ];
                        Order::createOreder($orderList);
                        Basket::deleteProductFromBasketStorage($key, $userId);
                        Product::updateProduct($key, [
                            'count' => Product::getProductById($key)['count'] - $value
                        ]);
                    }
                }
            } else {
                if (count($errors) > 0) {
                    return $this->render(null, [
                        'basket' => $basket,
                        'towns' => $towns,
                        'errors' => $errors
                    ]);
                } else {
                    foreach ($_SESSION['basket'] as $key => $value) {
                        $orderList = [
                            'id_product' => $key,
                            'id_destination' => $selectDestination,
                            'mobile' => $mobile,
                            'firstName' => $firstName,
                            'middleName' => $middleName,
                            'login' => $email,
                            'typePayment_id' => $typePayment,
                            'count' => $value,
                            'date' => date("d/m/Y")
                        ];
                        Order::createOreder($orderList);
                    }
                }
            }
            $_SESSION['basket'] = [];
            $this->redirect('/basket/order_success');
        }


        if (User::isAuthenticatedUser()) {
            $user = User::getCarrentAuthenticatedUser();
            return $this->render(null, [
                'user' => $user,
                'basket' => $basket,
                'towns' => $towns
            ]);
        }
        return $this->render(null, [
            'basket' => $basket,
            'towns' => $towns
        ]);
    }

    public function order_successAction()
    {
        return $this->render();
    }

    public function order_statusAction()
    {
        $id = intval($_GET['id']);
        Order::updateOrderById([
            'status' => 1
        ], [
            'id' => $id
        ]);
    }
}

