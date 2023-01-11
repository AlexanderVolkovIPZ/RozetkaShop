<?php

namespace core;

use controllers\SiteController;
use models\User;

/**
 * Головний клас ядра системи
 * SingleTone
 */
class Core
{
    private static ?Core $instance = null;
    public array $application;
    public DB $db;
    public $requestMethod;
    public array $pageParams;

    private function __construct()
    {
        global $pageParams;
        $this->application = [];
        $this->pageParams = $pageParams;
    }

    /**
     * Повертає екземпляр ядра системи
     * @return Core
     */
    public static function getInstance()
    {
        if (empty(self::$instance)) {
            self::$instance = new Core();
        }
        return self::$instance;
    }

    /**
     * Ініціалізація системи
     */
    public function initialize()
    {
        session_start();
        $this->db = new DB(DATABASE_HOST, DATABASE_LOGIN, DATABASE_PASSWORD, DATABASE_BASENAME);
        $this->requestMethod = $_SERVER['REQUEST_METHOD'];
    }

    /**
     * Виконує основний процес роботи CMS системи
     */
    public function run()
    {
        session_start();
        $path = $_GET['path'];
        $pathParts = explode('/', $path);
        $moduleName = strtolower(array_shift($pathParts));
        $actionName = strtolower(array_shift($pathParts));
        $statusCode = 200;
        if (empty($moduleName))
            $moduleName = "site";
        if (empty($actionName))
            if(User::isUserAdmin()){
                $actionName = "admin";
            }else{
                $actionName = "index";
            }

        $this->application['moduleName'] = $moduleName;
        $this->application['actionName'] = $actionName;
        $controllerName = '\controllers\\' . ucfirst($moduleName) . 'Controller';
        $actionName = $actionName . 'Action';
        if (class_exists($controllerName)) {
            $controller = new $controllerName();
            if (method_exists($controller, $actionName)) {
                $actionResult = $controller->$actionName($pathParts);
                if($actionResult instanceof Error)
                    $statusCode = $actionResult->code;
                $this->pageParams['content'] = $actionResult;
            } else {
                $statusCode = 404;
            }
        } else {
            $statusCode = 404;
        }
        $statusCodeType = intval($statusCode / 100);
        if ($statusCodeType == 4 || $statusCodeType == 5) {
            $siteController = new SiteController();
            $this->pageParams['content'] = $siteController->errorAction($statusCode);
        }
    }

    /**
     *Завершення роботи системи та виведення результату
     */
    public function done()
    {
        $pathToMainPage = 'themes/light/mainPage.php';
        $tpl = new Template($pathToMainPage);
        $tpl->setParams($this->pageParams);
        $html = $tpl->getHTML();
        echo $html;
    }
}

