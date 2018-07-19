<?php
// source: latte/static/header.latte

use Latte\Runtime as LR;

class Templateba52c626ec extends Latte\Runtime\Template
{

	function main()
	{
		extract($this->params);
?>
    <header id="header">
        <div class="headerBackground bg-default"></div>        
    </header>
    <div id="menu">
        <div class="inner">
            <div class="logo">
                <a href="/"><img src="/assets/img/logo-color@2x.png"></a>
            </div>
            <div class="topMenu">
                <ul>
                    <?php
		if (isset($team)) {
			?><li><a href="#nas-hr-tym">Náš HR tým</a></li><?php
		}
?>

                    <?php
		if (isset($news)) {
			?><li><a href="#novinky">NOVINKY</a></li><?php
		}
?>

                    <?php
		if (isset($faq)) {
			?><li><a href="#caste-dotazy">Částé dotazy</a></li><?php
		}
?>

                    <?php
		if (isset($about)) {
			?><li><a href="#co-je-szif">Co je SZIF</a></li><?php
		}
?>

                </ul>
            </div>
        </div>
    </div><?php
		return get_defined_vars();
	}

}
