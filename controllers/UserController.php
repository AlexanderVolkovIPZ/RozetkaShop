<?php

namespace controllers;

use core\Controller;
use core\Core;
use models\Basket;
use models\Category;
use models\Order;
use models\User;

class UserController extends Controller
{
    public function indexAction()
    {
        $rows = Category::getCategories();
        return $this->render(null,[
            'rows'=>$rows
        ]);
    }

    public function registerAction()
    {
        if (User::isAuthenticatedUser()) {
            $this->redirect('/');
        }
        if (Core::getInstance()->requestMethod === 'POST') {
            $errors = [];
            if (!filter_var($_POST['login'], FILTER_VALIDATE_EMAIL))
                $errors['login'] = 'Помилка при введенні електронної пошти!';
            if (User::isLoginExist($_POST['login']))
                $errors['login'] = 'Даний логін є занятий!';

            if ($_POST['password1'] != $_POST['password2'] && !preg_match('/^(?=.*[a-z])(?=.*[A-Z]*)(?=.*\d)[a-zA-Z\d]{8,}$/',$_POST['password1'])) {
                $errors['password'] = 'Паролі не співпадають!';
            }

            $patternName = '/[А-ЯЇІ][а-яії]+/';
            if(!preg_match($patternName,trim($_POST['firstname']))){
                $errors['firstname'] = "Помилка введені імені!";
            }
            if(!preg_match($patternName,trim($_POST['middlename']))){
                $errors['middlename'] = "Помилка введені прізвища!";
            }
            if(!preg_match($patternName,trim($_POST['lastname']))){
                $errors['lastname'] = "Помилка введені по-батькові!";
            }

            if (count($errors) > 0) {
                $model = $_POST;
                return $this->render(null, [
                    'errors' => $errors,
                    'model' => $model

                ]);
            } else {
                User::addUser($_POST['login'], $_POST['password1'], $_POST['firstname'], $_POST['middlename'], $_POST['lastname']);
                return $this->renderView('register_success');
            }
        } else {
            return $this->render();
        }

    }

    public function loginAction()
    {
        if (User::isAuthenticatedUser()) {
            $this->redirect('/');
        }
        if(Core::getInstance()->requestMethod==='POST') {


            $user = User::getUserByLoginAndPassword($_POST['login'], $_POST['password']);
            $error = null;
            if (empty($user)) {
                $error = 'Неправилиний логін або пароль';

            } else {
                User::authenticationUser($user);
                Basket::initializeBasket();
                $this->redirect('/');
            }
        }
        return $this->render(null, [
            'error' => $error
        ]);
    }

    public function logoutAction(){
        if(User::isAuthenticatedUser() && !User::isUserAdmin())
            Basket::updateBasketInDB(User::getCarrentAuthenticatedUser()['id']);
        User::logoutUser();
        $this->redirect('/user/login');
    }

    public function chartAction(){
        if (!User::isUserAdmin()) {
            return $this->error(403);
        }
        $users = User::selectUser();
        return $this->render(null,[
            'users'=>$users
        ]);
    }

    public function accessAction()
    {
        if (!User::isUserAdmin()) {
            return $this->error(403);
        }
        User::updateUser(intval($_GET['id']), [
            "typeAccess" => intval($_GET['type'])
        ]);
        return $this->render();
    }


    public function settingsAction(){
        $userId = User::getCarrentAuthenticatedUser()['id'];
        if(Core::getInstance()->requestMethod="POST"){
            if(User::isAuthenticatedUser()){
                $firstName = trim($_POST['firstName']);
                $middleName = trim($_POST['middleName']);
                $lastName = trim($_POST['lastName']);
                $login = trim($_POST['loginUserEdit']);
                $password = trim($_POST['password']);
                $passwordRepeat = trim($_POST['passwordRepeat']);

                if(strlen($firstName)>=3&&strlen($middleName)>=3&&strlen($lastName)>=3){
                    User::updateUser($userId, [
                        'firstName' => $firstName,
                        'middleName'=>$middleName,
                        'lastName'=>$lastName,
                    ]);
                }else if(filter_var($login, FILTER_VALIDATE_EMAIL) && !User::isLoginExist($login)){
                    User::updateUser($userId, [
                        'login'=>$login
                    ]);
                }else if($password==$passwordRepeat&&$password>=3){
                    User::updateUser($userId, [
                        'password'=>User::hashPassword($password)
                    ]);
                }
            }
        }

        $user = User::selectUser('*',[
            'id'=>$userId
        ]);
        return $this->render(null,[
            'user' => $user[0],
        ]);
    }

    public function deleteAction($params){
        $confirmDeleting = boolval($params[0]=='confirm');
        if ($confirmDeleting) {
            User::deleteUser([
                'id' => User::getCarrentAuthenticatedUser()['id']
            ]);
            $this->redirect('/user/logout');

        }
        $userId = User::getCarrentAuthenticatedUser()['id'];
        return $this->render(null,[
            'id'=>$userId
        ]);
    }

    public function orderAction(){
        $orders = Order::getAllOrders();
        if($orders!=null){
            return $this->render(null,[
                'orders'=>$orders
            ]);
        }
        return $this->render();
    }

}