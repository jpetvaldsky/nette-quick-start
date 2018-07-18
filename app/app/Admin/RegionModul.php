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

}