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
        <div class="inner">
            <div class="logo">
                <a href="http://www.szif.cz"><img src="/assets/img/logo-color@2x.png"></a>
            </div>
            <div class="topMenu">
                <ul>
                    <li><a href="#nas-hr-tym">Náš HR tým</a></li>
                    <li><a href="#novinky">NOVINKY</a></li>
                    <li><a href="#caste-dotazy">Částé dotazy</a></li>
                    <li><a href="#co-je-szif">Co je SZIF</a></li>
                </ul>
            </div>
        </div>
    </header><?php
		return get_defined_vars();
	}

}
