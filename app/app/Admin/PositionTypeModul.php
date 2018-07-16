<?php
namespace Admin;

use Model\PositionType;
use Nette\Utils\Strings;
use Tracy\Debugger;

class PositionTypeModul extends DefaultModul {

    protected $modelClass = "Model\PositionType";
    protected $prefix = "position-type";
    protected $pathPrefix = "typy-pozic";
    protected $pageIcon = "icon-layers";
    protected $pageTitle = "Pozice";

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
                    if (PositionType::check($this->connection,$route[3])) {
                        $itemData = new PositionType($this->connection,$route[3]);
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
        }
    }

    private function processFormData($data,&$route) {
        if (key_exists("action",$data)) {
            if ($data["action"] == "create") {
                $insResult = PositionType::create($this->connection,$data);
                array_push($this->pageData["flashes"],array('type' => 'success', 'style' => 'success', 'text' => 'Nový záznam byl vytvořen v pořádku.'));
            }

            if ($data["action"] == "edit") {
                if (PositionType::check($this->connection,$data["id"])) {
                    $updResult = PositionType::update($this->connection,$data);
                    array_push($this->pageData["flashes"],array('type' => 'success', 'style' => 'success', 'text' => 'Záznam byl editován v pořádku.'));
                }
                
            }
        }
    }

}