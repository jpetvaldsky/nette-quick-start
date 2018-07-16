<?php
namespace Admin;

use Model\Region;
use Nette\Utils\Strings;
use Tracy\Debugger;

class RegionModul extends DefaultModul {

    protected $modelClass = "Model\Region";
    protected $prefix = "regions";
    protected $pathPrefix = "kraje";
    protected $pageIcon = "icon-map";
    protected $pageTitle = "Kraje";

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
                    if (Region::check($this->connection,$route[3])) {
                        $itemData = new Region($this->connection,$route[3]);
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
                $insResult = Region::create($this->connection,$data);
                array_push($this->pageData["flashes"],array('type' => 'success', 'style' => 'success', 'text' => 'Nový záznam byl vytvořen v pořádku.'));
            }

            if ($data["action"] == "edit") {
                if (Region::check($this->connection,$data["id"])) {
                    $updResult = Region::update($this->connection,$data);
                    array_push($this->pageData["flashes"],array('type' => 'success', 'style' => 'success', 'text' => 'Záznam byl editován v pořádku.'));
                }
                
            }
        }
    }

}