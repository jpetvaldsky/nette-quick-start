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

    

}