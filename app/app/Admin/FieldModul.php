<?php
namespace Admin;

use Model\Region;
use Nette\Utils\Strings;
use Tracy\Debugger;

class FieldModul extends DefaultModul {

    protected $modelClass = "Model\Field";
    protected $prefix = "fields";
    protected $pathPrefix = "obory";
    protected $pageIcon = "icon-chemistry";
    protected $pageTitle = "Obory";

}