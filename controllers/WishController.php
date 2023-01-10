<?php

namespace controllers;

use models\Category;
use models\PhotoProduct;
use models\Product;
use models\User;
use models\Wish;

class WishController extends \core\Controller
{
    public function indexAction(){
        $products = [];
        $photoProduct = [];
        if(!empty($_SESSION['wish'])){
            foreach ($_SESSION['wish'] as $key => $value){
                $products[$key]=Product::getProductById($key);
                $photoProduct[$key] = PhotoProduct::getProductPhotoByName(Product::getProductById($key)['name'])[0];
            }
            return $this->render(null,[
                'products'=>$products,
                'photoProduct'=>$photoProduct
            ]);
        }else{
            return $this->render("views/wish/empty.php");
        }

    }

    public function addAction(){
        $idProduct = intval($_GET['idProduct']);
        Wish::addWish($idProduct);
//        $idUser = User::getCarrentAuthenticatedUser()['id'];
//        if(!empty($idProduct)&&!empty($idUser)){
//            Wish::addWish([
//                'id_product'=>$idProduct,
//                'id_user'=>$idUser
//            ]);
//        }
    }

    public function removeAction(){
        $idProduct = intval($_GET['idProduct']);
        Wish::deleteFromWish($idProduct);
    }
}