<?php
namespace Admin;

use Model\Region;
use Nette\Utils\Strings;
use Tracy\Debugger;

class BranchModul extends DefaultModul {

    protected $modelClass = "Model\Branch";
    protected $prefix = "branches";
    protected $pathPrefix = "pobocky";
    protected $pageIcon = "icon-compass";
    protected $pageTitle = "Pobočky";


}