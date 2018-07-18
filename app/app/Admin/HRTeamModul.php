<?php
namespace Admin;

use Model\Region;
use Nette\Utils\Strings;
use Tracy\Debugger;

class HRTeamModul extends DefaultModul {

    protected $modelClass = "Model\HRTeam";
    protected $prefix = "hr-team";
    protected $pathPrefix = "hr-team";
    protected $pageIcon = "icon-energy";
    protected $pageTitle = "HR Team";


}