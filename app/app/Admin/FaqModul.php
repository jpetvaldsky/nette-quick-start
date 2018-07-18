<?php
namespace Admin;

use Model\Region;
use Nette\Utils\Strings;
use Tracy\Debugger;

class FaqModul extends DefaultModul {

    protected $modelClass = "Model\Faq";
    protected $prefix = "faq";
    protected $pathPrefix = "faq";
    protected $pageIcon = "icon-question";
    protected $pageTitle = "FAQ";


}