<?php
// source: latte/backend/components/footer.latte

use Latte\Runtime as LR;

class Templated02a3446d5 extends Latte\Runtime\Template
{

	function main()
	{
		extract($this->params);
?>
    <footer class="app-footer">
      <div>
        <span>&copy; 2018 </span><a href="https://deloittedigital.cz">Deloitte Digital</a>        
      </div>
    </footer><?php
		return get_defined_vars();
	}

}
