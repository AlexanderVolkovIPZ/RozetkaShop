<?php

namespace models;
use core\Core;
class Category
{
    protected static string $tableName = 'category_product';


    public static function addCategory($categoryName,$photoPath=null){

        $fileName = "default.svg";
    if($photoPath!=null){
        do{
            $fileName = uniqid().".svg";
            $path = "files/category/{$fileName}";
        }while(file_exists($path));
        move_uploaded_file($photoPath,$path);
    }
         Core::getInstance()->db->insert(self::$tableName,[
            'name' => $categoryName,
             'photo'=>$fileName
        ]);
    }

    public static function getCategoryById($id){
        $rows = Core::getInstance()->db->select(self::$tableName,'*',[
            'id' => $id
        ]);

        if(!empty($rows))
            return $rows[0];
        else
            return 0;
    }

    public static function deleteCategoryById($id){
        Core::getInstance()->db->delete(self::$tableName,[
            'id' => $id
        ]);
    }

    public static function updateCategoryById($id,$newName){
        Core::getInstance()->db->update(self::$tableName,[
            'name'=>$newName
        ],
        [
            'id'=>$id
        ]);
    }


    public  static function getCategories(){
        $rows = Core::getInstance()->db->select(self::$tableName);
        return $rows;
    }

    public static function changePhoto($id,$photoPath){
        $row = self::getCategoryById($id);
        $path = "files/category/".$row['photo'];
        if(is_file($path) && $row['photo']!='default.svg'){

            unlink($path);
        }
            do{
                $fileName = uniqid().".svg";
                $path = "files/category/{$fileName}";
            }while(file_exists($path));
            move_uploaded_file($photoPath,$path);
        Core::getInstance()->db->update(self::$tableName,[
            'photo'=>$fileName
        ],[
            'id'=>$id
        ]);
    }
}