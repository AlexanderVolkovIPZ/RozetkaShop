<?php

namespace models;

use core\Core;

class Order
{
    protected static string $tableName = '_order_';
    public static function createOreder($filedList){
        Core::getInstance()->db->insert(self::$tableName,$filedList);
    }

    public static function getAllTowns(){
        $towns = Core::getInstance()->db->select('towns');
        return $towns;
    }

    public static function getAllDestinations(){
        $destinations = Core::getInstance()->db->select('destination',['id','name']);
        return $destinations;
    }

    public static function getDestinationById($id){
        $destination = Core::getInstance()->db->select('destination','*',[
            'id'=>$id
        ]);
        return $destination[0];
    }

    public static function getTypePaymentById($id){
        $type = Core::getInstance()->db->select('typePayment','*',[
            'id'=>$id
        ]);
        return $type[0];
    }

    public static function getAllDestinationsByIdTown($id){
        $destinations = Core::getInstance()->db->select('destination',"*",[
            'id_town'=>$id
        ]);
        return $destinations;
    }

    public static function getAllOrders($condition = null){
        $orders = Core::getInstance()->db->select(self::$tableName,"*",$condition);
        if(!empty($orders)){
            return $orders;
        }else{
            return null;
        }
    }

    public static function updateOrderById($fields,$conditions=null){
        Core::getInstance()->db->update(self::$tableName,$fields,$conditions);
    }
}