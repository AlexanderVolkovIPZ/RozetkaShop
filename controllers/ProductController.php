<?php

namespace controllers;

use core\Controller;
use core\Core;
use models\Category;
use models\PhotoProduct;
use models\Product;
use models\User;

class ProductController extends Controller
{
    public function indexAction()
    {
        return $this->render();
    }

    public function addAction()
    {
        if (!User::isUserAdmin()) {
            return $this->error(403);
        }
        $categories = Category::getCategories();
        if (Core::getInstance()->requestMethod === 'POST') {
            $errors = [];
            $_POST['name'] = trim($_POST['name']);

            if (empty($_POST['name'])) {
                $errors['name'] = 'Відсутня назва товару';
            }
            if (empty($_POST['id_category'])) {
                $errors['id_category'] = 'Відсутній індекс категорії';
            }
            if ($_POST['price'] <= 0) {
                $errors['price'] = 'Некоректно задана ціна товару';
            }
            if ($_POST['count'] < 0) {
                $errors['count'] = 'Некоректно задана кількість товару';
            }

            if (empty($errors)) {
                Product::addProduct($_POST);
//                var_dump($_FILES['file']['tmp_name']);
                PhotoProduct::addPhoto($_POST['name'], $_FILES['file']['tmp_name']);
                return $this->redirect('/');
            } else {
                $model = $_POST;
                return $this->render(null, [
                    'errors' => $errors,
                    'model' => $model,
                    'categories' => $categories
                ]);
            }
        }
        return $this->render(null, [
            'categories' => $categories
        ]);
    }

    public function editAction($params)
    {
        $id = intval($params[0]);
        if (!User::isUserAdmin()) {
            return $this->error(403);
        }
        if ($id > 0) {

            $product= Product::getProductById($id);
            $photos= PhotoProduct::getProductPhotoByName($product['name']);
            $categories = Category::getCategories();
            if (Core::getInstance()->requestMethod === 'POST') {
                $errors = [];
                $_POST['name'] = trim($_POST['name']);

                if (empty($_POST['name'])) {
                    $errors['name'] = 'Відсутня назва товару';
                }
                if (empty($_POST['id_category'])) {
                    $errors['id_category'] = 'Відсутня категорія товару';
                }
                if (empty($_POST['count'])) {
                    $errors['count'] = 'Відсутня кількість товару';
                }
                if (empty($_POST['price'])) {
                    $errors['price'] = 'Відсутня ціна товару';
                }

                if (empty($errors)) {

//                    if(!empty($FILES)){
//                        foreach ($photos as $photo){
//                            $filePath = 'files/product/' . $photo['name'];
//                            if (is_file($filePath)) {
//                                unlink($filePath);
//                            }
//                        }
//                    }

                    Product::updateProduct($id,$_POST);

                    if (!empty($_FILES)) {
                        PhotoProduct::changePhoto($_POST['name'],$_FILES['file']['tmp_name']);
                    }
                    return $this->redirect('/');
                } else {
                    $model = $_POST;
                    return $this->render(null, [
                        'errors' => $errors,
                        'categories' => $categories,
                        'product'=>$product,
                        'productPhoto'=>$photos
                    ]);
                }
            }

            return $this->render(null, [
                'categories' => $categories,
                'product'=>$product,
                'productPhoto'=>$photos
            ]);
        } else {
            return $this->error(403);
        }
    }


    public function viewAction($params)
    {
        $id = intval($params[0]);
        $rows = PhotoProduct::getProductPhotoByName(Product::getProductById($id)['name'], 'name');

        $product = Product::getProductById($id);
        return $this->render(null, [
            'product' => $product,
            'rows' => $rows
        ]);
    }


    public function deleteAction($params)
    {
        $id = intval($params[0]);
        $confirmDeleting = boolval($params[1] === 'confirm');
        if (!User::isUserAdmin()) {
            return $this->error(403);
        }
        if ($id > 0) {
            $product = Product::getProductById($id);
            $photoProduct = PhotoProduct::getProductPhotoByName($product['name']);

            if ($confirmDeleting) {
                foreach ($photoProduct as $photo){
                    $filePath = 'files/product/' . $photo['name'];
                    echo $filePath;
                    if (is_file($filePath) and $photo['name']!='default.png') {
                        unlink($filePath);
                    }
                }
                Product::deleteProductById($id);
                 $this->redirect("/category/view/".$product['id_category']);
            }
            return $this->render(null, [
                'product' => $product
            ]);
        } else {
            return $this->error(403);
        }
    }
}