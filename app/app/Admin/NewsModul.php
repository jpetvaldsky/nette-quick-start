<?php
namespace Admin;

use Model\Region;
use Nette\Utils\Strings;
use Tracy\Debugger;

class NewsModul extends DefaultModul {

    protected $modelClass = "Model\News";
    protected $prefix = "news";
    protected $pathPrefix = "novinky";
    protected $pageIcon = "icon-notebook";
    protected $pageTitle = "Novinky / Blog";


}