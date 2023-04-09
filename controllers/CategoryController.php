<?php

namespace controllers;

use core\Controller;
use core\Core;
use models\Category;
use models\CategoryFilter;
use models\Filter;
use models\PhotoProduct;
use models\Product;
use models\Produtc_Filter_Value;
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

        $filters = Filter::selectFilter();


        if (Core::getInstance()->requestMethod === 'POST') {
            $errors = [];
            $_POST['name'] = trim($_POST['name']);

            if (empty($_POST['name'])) {
                $errors['name'] = 'Відсутня назва категорії';
            }
            if (empty($errors)) {

                Category::addCategory($_POST['name'], $_FILES['file']['tmp_name']);

                $categoryId = Category::getCategories('id',[
                    'name'=>$_POST['name']
                ])[0]['id'];

                if (!empty($_POST['filters'])){
                    foreach ($_POST['filters'] as $key=>$value){
                       CategoryFilter::addCategoryFilter($categoryId, $value);
                    }
                }

                return $this->redirect('/');
            } else {
                $model = $_POST;
                return $this->render(null, [
                    'errors' => $errors,
                    'model' => $model
                ]);
            }
        }
        return $this->render(null,[
            'filters'=>$filters
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
            $category = Category::getCategoryById($id);
            if ($confirmDeleting) {
                $filePath = 'files/category/' . $category['photo'];
                if (is_file($filePath)) {
                    unlink($filePath);
                }

                $productsInCategory = Product::selectProduct([
                    'id_category' => $category['id']
                ], [
                    'name'
                ]);

                foreach ($productsInCategory as $item) {
                    $photoProduct = PhotoProduct::getProductPhotoByName($item['name']);
                    foreach ($photoProduct as $photo) {
                        $filePath = 'files/product/' . $photo['name'];
                        if (is_file($filePath) and $photo['name'] != 'default.png') {
                            unlink($filePath);
                        }
                    }
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

        $filters = Filter::selectFilter();
        $categoryFilter = CategoryFilter::selectCategoryFilter(['filter_id'],[
            'category_id'=>$id
        ]);

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
                    Category::changePhoto($id, $_FILES['file']['tmp_name']);
                    CategoryFilter::deleteCategoryFilter([
                        'category_id'=>$id
                    ]);

                    if (!empty($_POST['filters'])){
                        foreach ($_POST['filters'] as $key=>$value){
                            CategoryFilter::addCategoryFilter($id, $value);
                        }
                    }

                    $this->redirect('/');
                } else {
                    $model = $_POST;
                    return $this->render(null, [
                        'errors' => $errors,
                        'model' => $model,
                        'category' => $category,
                        'filters'=>$filters,
                        'categoryFilter'=>$categoryFilter
                    ]);
                }
            }
            return $this->render(null, [
                'category' => $category,
                'filters'=>$filters,
                'categoryFilter'=>$categoryFilter
            ]);
        } else {
            return $this->error(403);
        }

    }

    public function viewAction($params)
    {
//        echo "<pre>";
//        var_dump($_POST);
//        die();
//    var_dump($_GET);
//    die();
        if (Core::getInstance()->requestMethod === "GET" && $_GET['findProducts']) {
            if (!empty($_GET['searchName'])) {
                $products = Product::selectProduct(null, null, [
                        'name' => "%" . $_GET['searchName'] . "%"
                    ]
                );

                if (!empty($products)) {
                    if (is_array($products)) {
                        foreach ($products as $product) {
                            $productsNameInCategory[] = $product['name'];
                        }
                    } else {
                        $productsNameInCategory[] = $products[0]['name'];
                    }
                } else {
                    return $this->render('views/category/emptySearch.php');
                }

                $rows = PhotoProduct::getProductPhotoByName($productsNameInCategory, 'name');

                return $this->render(null, [
                    'products' => $products,
                    'rows' => $rows
                ]);
            } else {
                return $this->render('views/category/emptySearch.php');
            }
        }


        $id = intval($params[0]);
        $category = Category::getCategoryById($id);
        $array = [];
        if($_GET['submitFilter']){
            $countFilters = count($_GET)-2;
            foreach ($_GET as $key=>$value){
                if($key=='submitFilter'||$key=='path'){
                    continue;
                }else{

                    $idFilter = Filter::selectFilter('id',[
                        'table_name'=>$key
                    ])[0]['id'];

                    foreach ($value as $keyWork=>$valueWord){

                       $product_filter_value =  Produtc_Filter_Value::selectRecord('product_id',[
                            'filter_id'=>$idFilter,
                            'value_id'=>$valueWord
                        ])[0]['product_id'];
                       if($product_filter_value!=null){
                           $array[$product_filter_value]++;
                       }
                    }

                    foreach ($array as $key1=>$value1){
                        if($value1==$countFilters){
                            $products[] = Product::getProductInCategory(['id' => $key1, 'visibility' => 0])[0];
                        }
                    }
                }
            }
        }else{
            $products = Product::getProductInCategory(['id_category' => $id, 'visibility' => 0]);

        }

        if (!empty($products)) {
            if (is_array($products)) {
                foreach ($products as $product) {
                    $productsNameInCategory[] = $product['name'];
                }
            } else {
                $productsNameInCategory[] = $products[0]['name'];
            }
        } else {
            return $this->render('views/category/empty_category.php', [
                'name' => $category['name']
            ]);
        }

        $rows = PhotoProduct::getProductPhotoByName($productsNameInCategory, 'name');

                        $filters = Filter::selectFilter();
                $categoryFilter = CategoryFilter::selectCategoryFilter(['filter_id'],[
                    'category_id'=>$id
                ]);

                $arrayFilterValues = [];
                foreach ($filters as $key=>$value){
                    $arrayFilterValues[$filters[$key]['table_name']] = Core::getInstance()->db->select($filters[$key]['table_name']);
                }









        return $this->render(null, [
            'category' => $category,
            'products' => $products,
            'rows' => $rows,
            'filters'=>$filters,
            'categoryFilter'=>$categoryFilter,
            'arrayFilterValues'=>$arrayFilterValues
        ]);
    }
}