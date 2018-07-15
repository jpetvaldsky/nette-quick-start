<?php
// source: latte/static/footer.latte

use Latte\Runtime as LR;

class Templatedf05a390b8 extends Latte\Runtime\Template
{

	function main()
	{
		extract($this->params);
?>
    <div class="floatingButton scrollTop hidden">
        <a href="#top"></a>
    </div>

    <footer id="footer">
        <div class="content">
            <div class="logo">
                <a href="http://www.szif.cz"><img src="/assets/img/logo-bw@2x.png"></a>
            </div>
            <div class="footerText">
                <p><span class="copyright">© 2018 Státní zemědělský intervenční fond</span> <span class="splitter">&nbsp;/&nbsp;</span> Ve Smečkách 33, Praha 1 <span class="splitter">&nbsp;/&nbsp;</span> 222 871 871 <span class="splitter">&nbsp;/&nbsp;</span> <a href="#">info@szif.cz</a> <span class="splitter">&nbsp;/&nbsp;</span> <a href="#hlidaci-pes" class="watchDogLink">Hlídací pes</a> <span class="splitter">&nbsp;/&nbsp;</span> <a href="https://www.facebook.com/statnizemedelskyintervencnifond/" target="_blank"><i class="fa fa-facebook-official"></i></a></p>
                <p><strong>Naše další projekty:</strong> <a href="https://www.eklasa.cz/" target="_blank">Klasa</a> <span class="splitter">&nbsp;/&nbsp;</span> <a href="https://www.regionalnipotravina.cz/" target="_blank">Regionální potravina</a> <span class="splitter">&nbsp;/&nbsp;</span> <a href="https://ovocedoskol.szif.cz/web/Default.aspx" target="_blank">Ovoce a zelenina do škol</a> <span class="splitter">&nbsp;/&nbsp;</span> <a href="https://www.szif.cz/irj/portal/szif/podpora-spotreby-skolniho-mleka" target="_blank">Mléko do škol</a></p>
            </div>
        </div>
    </footer><?php
		return get_defined_vars();
	}

}
