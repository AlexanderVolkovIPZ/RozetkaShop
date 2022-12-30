<?php

namespace controllers;

use core\Controller;
use core\Core;
use models\Category;
use models\PhotoProduct;
use models\Product;
use models\User;

class CategoryController extends Controller
{
    public function indexAction()
    {
        $rows = Category::getCategories();
        return $this->render(null, [
            'rows' => $rows
        ]);
    }

    public function addAction()
    {
        if (!User::isUserAdmin()) {
            return $this->error(403);
        }
        if (Core::getInstance()->requestMethod === 'POST') {
            $errors = [];
            $_POST['name'] = trim($_POST['name']);

            if (empty($_POST['name'])) {
                $errors['name'] = 'Відсутня назва категорії';
            }
            if (empty($errors)) {
                Category::addCategory($_POST['name'], $_FILES['file']['tmp_name']);
                return $this->redirect('/');
            } else {
                $model = $_POST;
                return $this->render(null, [
                    'errors' => $errors,
                    'model' => $model
                ]);
            }
        }
        return $this->render();
    }

    public function deleteAction($params)
    {
        $id = intval($params[0]);
        $confirmDeleting = boolval($params[1] === 'confirm');

        if (!User::isUserAdmin()) {
            return $this->error(403);
        }
        if ($id > 0) {
            $category = Category::getCategoryById($id);
            if ($confirmDeleting) {
                $filePath = 'files/category/' . $category['photo'];
                if (is_file($filePath)) {
                    unlink($filePath);
                }
                Category::deleteCategoryById($id);
                return $this->redirect('/');
            }
            return $this->render(null, [
                'category' => $category
            ]);
        } else {
            return $this->error(403);
        }
    }

    public function editAction($params)
    {
        $id = intval($params[0]);
        if (!User::isUserAdmin()) {
            return $this->error(403);
        }
        if ($id > 0) {
            $category = Category::getCategoryById($id);
            if (Core::getInstance()->requestMethod === 'POST') {
                $errors = [];
                $_POST['name'] = trim($_POST['name']);

                if (empty($_POST['name'])) {
                    $errors['name'] = 'Відсутня назва категорії';
                }
                if (empty($errors)) {
                    $category = Category::getCategoryById($id);
                    $filePath = 'files/category/' . $category['photo'];
                    if (is_file($filePath)) {
                        unlink($filePath);
                    }
                    Category::updateCategoryById($id, $_POST['name']);

                    if (!empty($_FILES['file']['tmp_name'])) {
                        Category::changePhoto($id, $_FILES['file']['tmp_name']);
                    }
                    return $this->redirect('/');
                } else {
                    $model = $_POST;
                    return $this->render(null, [
                        'errors' => $errors,
                        'model' => $model,
                        'category' => $category
                    ]);
                }
            }
            return $this->render(null, [
                'category' => $category
            ]);
        } else {
            return $this->error(403);
        }

    }

    public function viewAction($params){

        $id = intval($params[0]);
        $category = Category::getCategoryById($id);
        $products = Product::getProductInCategory($id);

        if(!empty($products)){
            if(is_array($products)){
                foreach($products as $product){
                    $productsNameInCategory[] = $product['name'];
                }
            }else{
                $productsNameInCategory[] = $products[0]['name'];
            }
        }


        $rows = PhotoProduct::getProductPhotoByName($productsNameInCategory,'name');
        return $this->render(null,[
            'category'=>$category,
            'products'=>$products,
            'rows'=>$rows
        ]);
    }
}