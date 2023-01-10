<?php

namespace core;


/**
 * Базовий клас для всіх контролерів
 * @package core
 */
class Controller
{
    protected string $viewPath;
    protected $moduleName;
    protected $actionName;
    public function __construct(){
        $this->moduleName = Core::getInstance()->application['moduleName'];
        $this->actionName = Core::getInstance()->application['actionName'];
        $this->viewPath = "views/{$this->moduleName}/{$this->actionName}.php";
    }

    public function render($viewPath = null, $params = null){
        if(empty($viewPath))
            $viewPath = $this->viewPath;
        $tpl = new Template($viewPath);
        if(!empty($params))
            $tpl->setParams($params);
        return $tpl->getHTML();
    }

    public function renderView($viewName){
        $path = "views/{$this->moduleName}/{$viewName}.php";
        $tpl = new Template($path);
        if(!empty($params)){
            $tpl->setParams($params);
        }
        return $tpl->getHTML();
    }

    public static function redirect($url){
        header("Location: {$url}");
        die;
    }

    public static function error($type,$message = null): Error
    {
        return new Error($type,$message);
    }
}