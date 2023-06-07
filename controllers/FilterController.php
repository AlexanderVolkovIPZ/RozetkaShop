<?php

namespace controllers;

use core\Core;
use models\Basket;
use models\CategoryFilter;
use models\Filter;

class FilterController extends \core\Controller
{
    public function filtersAction(){
        if (isset($_GET['id'])) {
            $values = CategoryFilter::selectCategoryFilter("filter_id",[
                "category_id"=>$_GET['id']
            ]);

            $array = [];
            if(count($values)>0){
                foreach ($values as $value){
                    array_push($array,intval($value['filter_id']));
                }
            }

            $arrayFilter = [];
            foreach ($array as $value){
                $arrayFilterVal = Filter::selectFilter(["name", "table_name"],[
                    "id"=>$value
                ]);
                array_push($arrayFilter, $arrayFilterVal[0]);
            }
            $arrayMeasureValue = [];
            foreach ($arrayFilter as $key=>$value){
                array_push($arrayMeasureValue, ['name'=>$arrayFilter[$key]['name'],'table_name'=>$arrayFilter[$key]['table_name'],'values'=>Core::getInstance()->db->select($value['table_name'])]);
            }
            exit(json_encode($arrayMeasureValue));
        }

    }
}