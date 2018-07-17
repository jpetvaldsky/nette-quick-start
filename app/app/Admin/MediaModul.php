<?php
namespace Admin;

use Model\Media;
use Nette\Utils\Strings;
use Tracy\Debugger;

class MediaModul extends DefaultModul {
    
    protected $modelClass = "Model\Media";
    protected $prefix = "media-library";
    protected $pathPrefix = "media";
    protected $pageIcon = "icon-picture";
    protected $pageTitle = "Média";
    

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
                    if (Media::check($this->connection,$route[3])) {
                        $itemData = new Media($this->connection,$route[3]);
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
                if (count($route)> 2) {
                    if (Media::check($this->connection,$route[3])) {
                        Media::delete($this->connection,$route[3]);
                        array_push($this->pageData["flashes"],array('type' => 'error', 'style' => 'danger', 'text' => 'Záznam byl smazan.'));
                    }
                }
                array_push($this->pageData["flashes"],array('type' => 'error', 'style' => 'danger', 'text' => 'Požadovaný záznam nebyl nalezen'));
                break;
        }
    }

    private function processFormData($data,&$route) {
        if (key_exists("action",$data)) {
            if ($data["action"] == "create" || $data["action"] == "edit") {
                if ($_POST['mediaHash'] != ''){
                    $m = Media::getByHash($this->connection,$_POST['mediaHash']);
                    if ($m != null) {
                        $values = array(
                            'title%s' => $_POST['title']
                        );
                        Media::update($this->connection,$m->id,$values);
                        array_push($this->pageData["flashes"],array('type' => 'success', 'style' => 'success', 'text' => 'Záznam byl vytvořen/upraven v pořádku.'));
                        return;
                    }
                }
                if ($data['action'] == 'create' && $_POST['mediaHash'] == '') {
                    $route[2] = "novy-zaznam";
                    array_push($this->pageData["flashes"],array('type' => 'error', 'style' => 'danger', 'text' => 'Nelze vytvořit bez přiloženého souboru.'));
                    return;
                }
            }
            array_push($this->pageData["flashes"],array('type' => 'error', 'style' => 'danger', 'text' => 'Požadovaný záznam nebyl nalezen'));
        }
        return;
    }

}