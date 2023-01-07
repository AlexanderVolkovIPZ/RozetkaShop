<?php

namespace models;

use core\Core;

class Order
{
    protected static string $tableName = '_order_';
    public static function createOreder(){

    }

    public static function getAllTowns(){
        $towns = Core::getInstance()->db->select('towns');
        return $towns;
    }

    public static function getAllDestinations(){
        $destinations = Core::getInstance()->db->select('destination',['id','name']);
        return $destinations;
    }

    public static function getAllDestinationsByIdTown($id){
        $destinations = Core::getInstance()->db->select('destination',"*",[
            'id_town'=>$id
        ]);
        return $destinations;
    }
}