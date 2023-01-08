<?php

namespace controllers;

use models\Order;
use models\User;

class Orders_storyController extends \core\Controller
{
    public function indexAction(){
        $user = User::getCarrentAuthenticatedUser();
        $orders = Order::getAllOrders([
            'id_user'=>$user['id']
        ]);

        if(!empty($orders)){
            return $this->render(null,[
                'user'=>$user,
                'orders'=>$orders
            ]);
        }else{
            return $this->render("views/orders_story/empty.php");
        }
    }

    public function emptyAction(){
        return $this->render();
    }
}