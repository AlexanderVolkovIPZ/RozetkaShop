<?php

namespace controllers;

use core\Core;
use models\Basket;
use models\Category;
use models\Comment;
use models\Order;
use models\User;

class StatisticsController extends \core\Controller
{
    public function indexAction()
    {
        if (!User::isUserAdmin()) {
            return $this->error(403);
        }
        $years = Order::getAllOrders([
            'status'=>1
        ],[
           "YEAR(date) as year"
        ],null,['year']);

        if (Core::getInstance()->requestMethod == 'POST'){
            if($_POST['diagramType']=='default'){
                $_POST['diagramType'] = 'bar';
            }
            $date = Order::getAllOrders([
                'YEAR(date)'=>$_POST['year']
            ],[
                'MONTH(date) AS month', 'SUM(_order_.count*product.price) AS sum'
            ],null,['month'],null,null,null,null,"JOIN product on _order_.id_product = product.id");

            $chartData = [];
            if(!empty($date)){
                foreach ($date as $key=>$value){
                    $chartData[$value['month']] = $value['sum'];
                }
            }

            $type = $_POST['diagramType'];
            $year = $_POST['year'];
            return $this->render(null,[
                'years'=>$years,
                'date'=>$chartData,
                'type'=>$type,
                'year'=>$year
            ]);
        }

        return $this->render(null,[
            'years'=>$years,
        ]);
    }

    public function volume_by_categoryAction()
    {
        if (!User::isUserAdmin()) {
            return $this->error(403);
        }
        $monthsLabels = ['Jan','Feb','Mar','Apr','May','Jun','Jul','Aug','Sep','Oct','Nov','Dec'];

        if(Core::getInstance()->requestMethod == 'GET'&&isset($_GET['year'])){

            $months = Order::getAllOrders([
                'status'=>1,
                'YEAR(date)'=>$_GET['year']
            ],[
                "MONTH(date) as month"
            ]);
            $resultArray = [];
            foreach ($months as $key=>$value){
                $resultArray[$value['month']] = $monthsLabels[$value['month']-1];
            }
            exit(json_encode($resultArray));
        }

        $years = Order::getAllOrders([
            'status'=>1
        ],[
            "YEAR(date) as year"
        ],null,['year']);

        if (Core::getInstance()->requestMethod == 'POST'){
            if($_POST['diagramType']=='default'){
                $_POST['diagramType'] = 'bar';
            }
            $date = Order::getAllOrders([
                'YEAR(date)'=>$_POST['year'],
                'MONTH(date)'=>$_POST['month']
            ],[
                'id_category',
               'sum(_order_.count) AS count'
            ],null,['id_category'],'count>0',null,null,null,"JOIN product on _order_.id_product = product.id");

            $months = [];
            $monthArr = Order::getAllOrders([
                'status'=>1,
                'YEAR(date)'=>$_POST['year']
            ],[
                "MONTH(date) as month"
            ]);
            foreach ($monthArr as $key=>$value){
                $months[$value['month']] = $monthsLabels[$value['month']-1];
            }

            $chartData = [];
            $categoriesName = [];
            if(!empty($date)){
                foreach ($date as $key=>$value){
                    $chartData[$value['id_category']] = $value['count'];
                    $categoriesName[$value['id_category']]=Category::getCategoryById($value['id_category'])['name'];
                }
            }

            $type = $_POST['diagramType'];
            $year = $_POST['year'];
            $month = $_POST['month'];

            return $this->render(null,[
                'years'=>$years,
                'data'=>$chartData,
                'type'=>$type,
                'year'=>$year,
                'categoriesName'=>$categoriesName,
                'months'=>$months,
                'month'=>$month
            ]);
        }

        return $this->render(null,[
            'years'=>$years,
        ]);
    }

    public function type_paymentAction(){
        if (!User::isUserAdmin()) {
            return $this->error(403);
        }
        $orderWithCashCount = count(Order::getAllOrders([
            'typePayment_id'=>1
        ]));
        $orderWithNoCashCount = count(Order::getAllOrders([
            'typePayment_id'=>2
        ]));
        $sum = $orderWithCashCount+$orderWithNoCashCount;
        $orderWithCashCountPercent = $orderWithCashCount*100/$sum;
        $orderWithNoCashCountPercent = 100 - $orderWithCashCountPercent;
        $orderWithCashCount = ["Готівковий розрахунок"=>$orderWithCashCountPercent];
        $orderWithNoCashCount = ["Безготівковий розрахунок"=>$orderWithNoCashCountPercent];

        if (Core::getInstance()->requestMethod == 'POST') {
            $type = $_POST['diagramType'];
            return $this->render(null,[
                'cashPayment'=>$orderWithCashCount,
                'noCashPayment'=>$orderWithNoCashCount,
                'type'=>$type
            ]);
        }

        return $this->render(null,[
            'cashPayment'=>$orderWithCashCount,
            'noCashPayment'=>$orderWithNoCashCount,
            'type'=>'bar'
        ]);
    }

    public function reiting_by_categoryAction()
    {
        if (!User::isUserAdmin()) {
            return $this->error(403);
        }
        $categories = Category::getCategories(['id','name']);
        $categoriesArray = [];
                foreach ($categories as $key=>$value){
            $categoriesArray[$value['id']]=$value['name'];
        }
        $values = Comment::selectComments(['id_category', 'sum(comment_products.reiting)/count(comment_products.reiting) as mark'],null,null,'product.id_category',null,null,null,null,'JOIN product on product.id=comment_products.id_product');
        $categoriesMarks = [];
        foreach ($values as $key=>$value){
            $categoriesMarks[$categoriesArray[$value["id_category"]]]=$value["mark"];
        }

        if(Core::getInstance()->requestMethod=='POST'){
            return $this->render(null,[
                'categoriesMarks'=>$categoriesMarks,
                'type'=>$_POST['diagramType']
            ]);
        }
        return $this->render(null,[
            'categoriesMarks'=>$categoriesMarks
        ]);
    }

}