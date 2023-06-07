<?php

namespace models;
use core\Core;

class Backup
{

    public static function createBackup($filePath):bool
    {
        $result = Core::getInstance()->db->createBackup($filePath,DATABASE_LOGIN,DATABASE_PASSWORD,DATABASE_BASENAME);
        return $result;
    }
}