<?php

namespace core;
/**
 *Клас шаблонізатора
 * @package core
 */
class Template
{
    protected array $parameters;
    protected $path;
    public function __construct($path)
    {
        $this->parameters = [];
        $this->path = $path;
    }

    public function setParam($name,$value){
        $this->parameters[$name] = $value;
    }

    public function setParams($params){
        foreach ($params as $name=>$value){
            $this->setParam($name,$value);
        }
    }
    public function getHTML(){
        ob_start();
        extract($this->parameters);
        include($this->path);
        $html = ob_get_contents();
        ob_end_clean();
        return $html;
    }
}
