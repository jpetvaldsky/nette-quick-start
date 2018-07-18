<?php
namespace Admin;

use Model\Region;
use Nette\Utils\Strings;
use Tracy\Debugger;

class AboutSzifModul extends DefaultModul {

    protected $modelClass = "Model\AboutSzif";
    protected $prefix = "about";
    protected $pathPrefix = "o-szifu";
    protected $pageIcon = "icon-speech";
    protected $pageTitle = "O SZIFu";


}