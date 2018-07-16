<?php
namespace Admin;

use Nette\Utils\Strings;
use Tracy\Debugger;

class DefaultModul {
    
    protected $connection;
    protected $template;
    protected $pageData;

    protected $modelClass;
    protected $prefix;
    protected $pathPrefix;
    protected $pageIcon;
    protected $pageTitle;

    protected $data;

	public function __construct($db)
 	{
        $this->connection = $db;
    }

    public function init(&$template,&$pageData,$route){
        $this->template = $template;
        $this->pageData = $pageData;

        $this->template = "editors/list/".$this->prefix;
        
        
        $this->pageData["pages"][0]["link"] = $this->pageData["basePath"];

        array_push($this->pageData["pages"],array('link' => '', 'icon' => $this->pageIcon,'title'=>$this->pageTitle));
        
        $this->pageData["pathPrefix"] = $this->pathPrefix;
        $this->pageData["newItem"] = true;
        $this->pageData["newItemLink"] = $this->pageData["basePath"].'/'.$this->pathPrefix.'/novy-zaznam';

        $this->parseAction($route);
        
        $this->data = call_user_func(array($this->modelClass,'getList'),$this->connection);
        $this->pageData["data"] = $this->data;

        $template = $this->template;
        $pageData = $this->pageData;
    }

    protected function parseAction($route) {

    }

    
}