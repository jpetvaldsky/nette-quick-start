<?php
namespace Admin;

use Model\Region;
use Nette\Utils\Strings;
use Tracy\Debugger;

class BenefitModul extends DefaultModul {

    protected $modelClass = "Model\Benefit";
    protected $prefix = "benefit";
    protected $pathPrefix = "benefity";
    protected $pageIcon = "icon-present";
    protected $pageTitle = "Benefity";


}