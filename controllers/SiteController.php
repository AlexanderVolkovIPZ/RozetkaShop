<?php

namespace controllers;

use core\Controller;
use models\Basket;
use models\Category;
use models\Slider;

class SiteController extends Controller
{
    public function indexAction()
    {
        $rows = Category::getCategories();

        $slider = Slider::getPhoto();
        return $this->render(null, [
            'rows' => $rows,
            'slider' => $slider
        ]);
    }

    public function adminAction()
    {
        $rows = Category::getCategories();
        return $this->render(null, [
            'rows' => $rows
        ]);
    }

    public function errorAction($code)
    {
        switch ($code) {
            case 404:
                return $this->render('views/site/error-404.php');
                break;
            case 403:
                return $this->render('views/site/error-404.php');
                break;
        }
    }
}