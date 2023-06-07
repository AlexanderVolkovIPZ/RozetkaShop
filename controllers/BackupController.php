<?php

namespace controllers;

use core\Core;
use models\Backup;
use models\Basket;
use models\User;

class BackupController extends \core\Controller
{
    public function indexAction()
    {
        if (!User::isUserAdmin()) {
            return $this->error(403);
        }
        if(Core::getInstance()->requestMethod == "POST"){
            $filePath = $_POST["filePath"];
            $result = Backup::createBackup($filePath);
            if($result){
                return $this->render('views/backup/backupSuccess.php');
            }else{
                return $this->render('views/backup/backupFailed.php');
            }
        }
        return $this->render();
    }
}