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
        $this->pageData["headline"] = $this->pageTitle;
        $this->pageData["newItem"] = true;
        $this->pageData["newItemLink"] = $this->pageData["basePath"].'/'.$this->pathPrefix.'/novy-zaznam';

        $this->parseAction($route);
        
        $this->data = call_user_func(array($this->modelClass,'getList'),$this->connection);
        $this->pageData["data"] = $this->data;

        $template = $this->template;
        $pageData = $this->pageData;
    }

    protected function parseAction($route) {
        if (isset($_POST)) {
            $this->processFormData($_POST,$route);
        }
        if (count($route) == 2) $route[2] = "";
        switch ($route[2]) {
            case "novy-zaznam":
                $this->pageData["formAction"] = "create";
                $this->template = "editors/detail/".$this->prefix;
                break;
            case "editovat":
                $itemData = null;
                if (count($route)> 2) {
                    $checkResult = call_user_func(array($this->modelClass,'check'),$this->connection,$route[3]);
                    if ($checkResult){
                        $itemData = new $this->modelClass($this->connection,$route[3]);
                    }
                }
                if ($itemData) {
                    $this->pageData["item"] = $itemData;
                    $this->pageData["formAction"] = "edit";
                    $this->template = "editors/detail/".$this->prefix;
                } else {
                    array_push($this->pageData["flashes"],array('type' => 'error', 'style' => 'danger', 'text' => 'Požadovaný záznam nebyl nalezen'));
                }                
                break;
            case "smazat":
                /*if (count($route)> 2) {
                    if (Media::check($this->connection,$route[3])) {
                        Media::delete($this->connection,$route[3]);
                        array_push($this->pageData["flashes"],array('type' => 'success', 'style' => 'success', 'text' => 'Záznam byl smazan.'));
                    } else {
                        array_push($this->pageData["flashes"],array('type' => 'error', 'style' => 'danger', 'text' => 'Požadovaný záznam nebyl nalezen'));
                    }
                }*/
                break;
        }
    }

    protected function processFormData($data,&$route) {
        if (key_exists("action",$data)) {
            if (key_exists('order',$data)) {
                if ($data['order'] == '') $data['order'] = 0;
            }
            if ($data["action"] == "create") {                
                $insResult = call_user_func(array($this->modelClass,'create'),$this->connection,$data);
                array_push($this->pageData["flashes"],array('type' => 'success', 'style' => 'success', 'text' => 'Nový záznam byl vytvořen v pořádku.'));
            }

            if ($data["action"] == "edit") {
                $checkResult = call_user_func(array($this->modelClass,'check'),$this->connection,$data["id"]);
                if ($checkResult) {
                    $insResult = call_user_func(array($this->modelClass,'update'),$this->connection,$data);
                    array_push($this->pageData["flashes"],array('type' => 'success', 'style' => 'success', 'text' => 'Záznam byl editován v pořádku.'));
                }
                
            }
        }
    }

    
}