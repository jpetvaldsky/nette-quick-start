<?php
namespace Admin;

use Model\Region;
use Nette\Utils\Strings;
use Tracy\Debugger;

class PositionModul extends DefaultModul {

    protected $modelClass = "Model\Position";
    protected $prefix = "positions";
    protected $pathPrefix = "volne-pozice";
    protected $pageIcon = "icon-organization";
    protected $pageTitle = "Volné pozice";


}