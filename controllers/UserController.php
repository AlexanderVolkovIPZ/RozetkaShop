<?php

namespace controllers;

use core\Controller;
use core\Core;
use models\Category;
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


            if ($_POST['password1'] != $_POST['password2']) {
                $errors['password'] = 'Паролі не співпадають!';
            }
            /* Валідація інших ролів форми */
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
            die;
        }
        if(Core::getInstance()->requestMethod==='POST') {


            $user = User::getUserByLoginAndPassword($_POST['login'], $_POST['password']);
            $error = null;
            if (empty($user)) {
                $error = 'Неправилиний логін або пароль';

            } else {
                User::authenticationUser($user);
                $this->redirect('/');
            }
        }
        return $this->render(null, [
            'error' => $error
        ]);
    }

    public function logoutAction(){
        User::logoutUser();
        $this->redirect('/user/login');
    }
}