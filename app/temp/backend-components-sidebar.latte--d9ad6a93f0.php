<?php
// source: latte/backend/components/sidebar.latte

use Latte\Runtime as LR;

class Templated9ad6a93f0 extends Latte\Runtime\Template
{

	function main()
	{
		extract($this->params);
?>
    <div class="sidebar">
        <nav class="sidebar-nav">
          <ul class="nav">
            <li class="nav-item">
              <a class="nav-link<?php
		if ($section == 'homepage') {
			?> active<?php
		}
		?>" href="<?php echo LR\Filters::escapeHtmlAttr(LR\Filters::safeUrl($basePath)) /* line 5 */ ?>">
                <i class="nav-icon icon-home"></i> Úvodní strana
              </a>
            </li>
            <li class="nav-title">Správa obsahu</li>
            <li class="nav-item">
              <a class="nav-link<?php
		if ($section == 'positions') {
			?> active<?php
		}
		?>" href="<?php echo LR\Filters::escapeHtmlAttr(LR\Filters::safeUrl($basePath)) /* line 11 */ ?>/volne-pozice">
                <i class="nav-icon icon-organization"></i> Volné pozice</a>
            </li>
<?php
		if ($superAdmin) {
?>            <li class="nav-item">
              <a class="nav-link<?php
			if ($section == 'hr-team') {
				?> active<?php
			}
			?>" href="<?php echo LR\Filters::escapeHtmlAttr(LR\Filters::safeUrl($basePath)) /* line 15 */ ?>/hr-team">
                <i class="nav-icon icon-energy"></i> HR Team</a>
            </li>
<?php
		}
?>
            <li class="nav-item">
              <a class="nav-link<?php
		if ($section == 'news') {
			?> active<?php
		}
		?>" href="<?php echo LR\Filters::escapeHtmlAttr(LR\Filters::safeUrl($basePath)) /* line 19 */ ?>/novinky">
                <i class="nav-icon icon-notebook"></i> Novinky (Blog)</a>
            </li>
<?php
		if ($superAdmin) {
?>            <li class="nav-item">
              <a class="nav-link<?php
			if ($section == 'faq') {
				?> active<?php
			}
			?>" href="<?php echo LR\Filters::escapeHtmlAttr(LR\Filters::safeUrl($basePath)) /* line 23 */ ?>/faq">
                <i class="nav-icon icon-question"></i> FAQ</a>
            </li>
<?php
		}
		if ($superAdmin) {
?>            <li class="nav-item">
              <a class="nav-link<?php
			if ($section == 'about') {
				?> active<?php
			}
			?>" href="<?php echo LR\Filters::escapeHtmlAttr(LR\Filters::safeUrl($basePath)) /* line 27 */ ?>/o-szifu">
                <i class="nav-icon icon-speech"></i> O SZIFu</a>
            </li>
<?php
		}
		if ($superAdmin) {
?>            <li class="nav-item">
              <a class="nav-link<?php
			if ($section == 'benefit') {
				?> active<?php
			}
			?>" href="<?php echo LR\Filters::escapeHtmlAttr(LR\Filters::safeUrl($basePath)) /* line 31 */ ?>/benefity">
                <i class="nav-icon icon-present"></i> Benefity</a>
            </li>
<?php
		}
		if ($superAdmin) {
?>            <li class="nav-title">Související obsah</li>
<?php
		}
		if ($superAdmin) {
?>            <li class="nav-item">
              <a class="nav-link<?php
			if ($section == 'fields') {
				?> active<?php
			}
			?>" href="<?php echo LR\Filters::escapeHtmlAttr(LR\Filters::safeUrl($basePath)) /* line 36 */ ?>/obory">
                <i class="nav-icon icon-chemistry"></i> Obory</a>
            </li>
<?php
		}
		if ($superAdmin) {
?>            <li class="nav-item">
              <a class="nav-link<?php
			if ($section == 'position-type') {
				?> active<?php
			}
			?>" href="<?php echo LR\Filters::escapeHtmlAttr(LR\Filters::safeUrl($basePath)) /* line 40 */ ?>/typy-pozic">
                <i class="nav-icon icon-layers"></i> Pozice</a>
            </li>
<?php
		}
		if ($superAdmin) {
?>            <li class="nav-item">
              <a class="nav-link<?php
			if ($section == 'branches') {
				?> active<?php
			}
			?>" href="<?php echo LR\Filters::escapeHtmlAttr(LR\Filters::safeUrl($basePath)) /* line 44 */ ?>/pobocky">
                <i class="nav-icon icon-compass"></i> Pobočky</a>
            </li>
<?php
		}
		if ($superAdmin) {
?>            <li class="nav-item">
              <a class="nav-link<?php
			if ($section == 'regions') {
				?> active<?php
			}
			?>" href="<?php echo LR\Filters::escapeHtmlAttr(LR\Filters::safeUrl($basePath)) /* line 48 */ ?>/kraje">
                <i class="nav-icon icon-map"></i> Kraje</a>
            </li>
<?php
		}
		if ($superAdmin) {
?>            <li class="nav-title">Servisní data</li>
<?php
		}
		if ($superAdmin) {
?>            <li class="nav-item">
              <a class="nav-link<?php
			if ($section == 'media') {
				?> active<?php
			}
			?>" href="<?php echo LR\Filters::escapeHtmlAttr(LR\Filters::safeUrl($basePath)) /* line 53 */ ?>/media">
                <i class="nav-icon icon-picture"></i> Média</a>
            </li>
<?php
		}
		if ($superAdmin) {
?>            <li class="nav-item">
              <a class="nav-link<?php
			if ($section == 'users') {
				?> active<?php
			}
			?>" href="<?php echo LR\Filters::escapeHtmlAttr(LR\Filters::safeUrl($basePath)) /* line 57 */ ?>/uzivatele">
                <i class="nav-icon icon-people"></i> Uživatelé</a>
            </li>
<?php
		}
?>
          </ul>
        </nav>
      </div><?php
		return get_defined_vars();
	}

}
