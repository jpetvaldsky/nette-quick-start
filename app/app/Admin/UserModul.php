<?php
namespace Admin;

use Model\User;
use Nette\Utils\Strings;
use Tracy\Debugger;

class UserModul extends DefaultModul {

    protected $modelClass = "Model\User";
    protected $prefix = "user";
    protected $pathPrefix = "uzivatele";
    protected $pageIcon = "icon-people";
    protected $pageTitle = "Uživatelé";
    

    protected function parseAction($route) {
        if (count($route) == 2) $route[2] = "";
        switch ($route[2]) {
            case "novy-zaznam":
                break;
            case "editace":
                break;
        }
    }

}