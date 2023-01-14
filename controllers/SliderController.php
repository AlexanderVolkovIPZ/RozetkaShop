<?php

namespace controllers;

use core\Controller;
use core\Core;
use models\Category;
use models\PhotoProduct;
use models\Product;
use models\Slider;
use models\User;
use MongoDB\BSON\Regex;

class SliderController extends Controller
{
    public function indexAction()
    {
        return $this->render();
    }

    public function addAction()
    {
        if (!User::isUserAdmin()) {
            return $this->error(403);
        }
        if (Core::getInstance()->requestMethod === 'POST') {
            $sliderPhotos = Slider::getPhoto();
            if (!empty($sliderPhotos)) {
                foreach ($sliderPhotos as $photo) {
                    $filePath = 'files/discount/' . $photo['name'];
                    if (is_file($filePath)) {
                        unlink($filePath);
                    }
                }
            }
            Slider::deletePhoto();
            $arrayURL = [];
            foreach ($_POST as $key => $value) {
                if (preg_match("/url\\d*/", $key)) {
                    $arrayURL[] = $value;
                }
            }
            Slider::addPhoto($_FILES['file']['tmp_name'], $_POST['photoSelected'], $arrayURL);
            return $this->redirect('/');
        } else {
            return $this->render();
        }
    }

    public function deleteAction($params)
    {
        $confirmDeleting = boolval($params[0] === 'confirm');
        if (!User::isUserAdmin()) {
            return $this->error(403);
        }
        $photos = Slider::getPhoto();
        if ($confirmDeleting) {
            foreach ($photos as $photo) {
                $filePath = 'files/discount/' . $photo['name'];
                if (is_file($filePath)) {
                    unlink($filePath);
                }
            }
            Slider::deletePhoto();
            return $this->redirect('/');
        }
        return $this->render();
    }
}