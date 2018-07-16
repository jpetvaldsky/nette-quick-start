<?php
// source: latte/backend/components/header.latte

use Latte\Runtime as LR;

class Templated535d2b6fb extends Latte\Runtime\Template
{

	function main()
	{
		extract($this->params);
?>
    <header class="app-header navbar">
      <button class="navbar-toggler sidebar-toggler d-lg-none mr-auto" type="button" data-toggle="sidebar-show">
        <span class="navbar-toggler-icon"></span>
      </button>
      <a class="navbar-brand" href="<?php echo LR\Filters::escapeHtmlAttr(LR\Filters::safeUrl($basePath)) /* line 5 */ ?>">
        <img class="navbar-brand-full" src="/assets/backend/img/brand/logo-szif.png" width="105" height="47" alt="SZIF">
        <img class="navbar-brand-minimized" src="/assets/backend/img/brand/logo-symbol-square.png" width="45" height="45" alt="SZIF">
      </a>      
      <ul class="nav navbar-nav ml-auto">
        <li class="nav-item dropdown">
          <a class="nav-link" data-toggle="dropdown" href="#" role="button" aria-haspopup="true" aria-expanded="false">
            <span class="avatar-icon img-avatar bg-secondary"><i class="cui-people"></i></span>
          </a>
          <div class="dropdown-menu dropdown-menu-right">
            <div class="dropdown-header text-center">
              <strong><?php echo LR\Filters::escapeHtmlText($user->fullName) /* line 16 */ ?></strong>
            </div>            
            <a class="dropdown-item" href="<?php echo LR\Filters::escapeHtmlAttr(LR\Filters::safeUrl($basePath)) /* line 22 */ ?>/odhlasit-se">
              <i class="fa fa-lock"></i> Odhlášení</a>
          </div>
        </li>
      </ul>
    </header><?php
		return get_defined_vars();
	}

}
