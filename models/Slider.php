<?php

namespace models;

use core\Core;
use core\Utils;

class Slider
{
    protected static $tableName = 'slider';

    public static function addPhoto($photos = null, $numberStartPhoto = null, $url = null)
    {
        if (!empty($photos)) {
            $number = 0;
            foreach ($photos as $photoPath) {
                if ($number == $numberStartPhoto) {
                    $startPhoto = 1;
                }
                do {
                    $fileName = uniqid() . ".jpg";
                    $path = "files/discount/{$fileName}";
                } while (file_exists($path));

                move_uploaded_file($photoPath, $path);
                Core::getInstance()->db->insert(self::$tableName, [
                    'name' => $fileName,
                    'first_image' => $startPhoto,
                    'url' => $url[$number]
                ]);
                $startPhoto = 0;
                $number += 1;
            }
        }
    }

    public static function deletePhoto()
    {
        Core::getInstance()->db->delete(self::$tableName);
    }

    public static function getPhoto()
    {
        $rows = Core::getInstance()->db->select(self::$tableName, "*");
        return $rows;
    }


    public static function updatePhoto($id, $row)
    {
        $fieldsList = ['count', 'name', 'price', 'id_category', 'brief_description', 'full_description', 'visibility'];
        $row = Utils::filterArray($row, $fieldsList);
        Core::getInstance()->db->update(self::$tableName, $row, [
            'id' => $id
        ]);
    }

}