<?php

namespace models;

use core\Core;

class PhotoProduct
{
    protected static string $tableName = 'product_photo';

    public static function addPhoto($product_name, $photoPath = null)
    {
        $fileName = "default.jpg";
        if (!empty($photoPath)) {
            if ($photoPath != null) {
                foreach ($photoPath as $item) {
                    if ($item != "") {
                        do {
                            $fileName = uniqid() . ".jpg";
                            $path = "files/product/{$fileName}";
                        } while (file_exists($path));
                        move_uploaded_file($item, $path);

                        Core::getInstance()->db->insert(self::$tableName, [
                            'product_name' => $product_name,
                            'name' => $fileName
                        ]);
                    }
                }
            }
        }
    }

    public static function getProductPhotoByName($product_name, $fields = '*')
    {
        if (is_array($product_name)) {
            $rows = [];
            foreach ($product_name as $product) {
                $rows["${product}"] = Core::getInstance()->db->select(self::$tableName, $fields, [
                    'product_name' => $product
                ]);
            }

        } else {
            $rows = Core::getInstance()->db->select(self::$tableName, $fields, [
                'product_name' => $product_name
            ]);
        }

        if (!empty($rows))
            return $rows;
        else
            return null;
    }

    public static function changePhoto($name, $photoPath)
    {
        $rows = self::getProductPhotoByName($name);

        echo count($rows);

        foreach ($rows as $row) {
            $path = "files/product/" . $row['name'];
            if (is_file($path) && $row['photo'] != 'default.svg') {
                unlink($path);
                Core::getInstance()->db->delete(self::$tableName, [
                    'name' => $row['name']
                ]);
            }
        }

        foreach ($photoPath as $photoPathItem) {
            do {
                $fileName = uniqid() . ".jpg";
                $path = "files/product/{$fileName}";
            } while (file_exists($path));

            move_uploaded_file($photoPathItem, $path);
            Core::getInstance()->db->insert(self::$tableName, [
                'name' => $fileName,
                'product_name' => $name
            ]);
        }
    }
}