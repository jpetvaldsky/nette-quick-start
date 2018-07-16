<?php
// source: latte/backend/components/no-entry.latte

use Latte\Runtime as LR;

class Templatec3cc0012e3 extends Latte\Runtime\Template
{
	public $blocks = [
		'noEntry' => 'blockNoEntry',
	];

	public $blockTypes = [
		'noEntry' => 'html',
	];


	function main()
	{
		extract($this->params);
		if ($this->getParentName()) return get_defined_vars();
		return get_defined_vars();
	}


	function blockNoEntry($_args)
	{
		extract($_args);
?>
<div class="jumbotron">
  <div class="container">
    <h1 class="display-4">Nebyl nalezen žádný záznam.</h1>
    <p class="lead">Tato sekce zatím neobsahuje žádná data, prosím přidejte nový záznam.</p>
    <hr class="my-4">
    <p class="lead">
        <a class="btn btn-primary btn-lg" href="<?php echo LR\Filters::escapeHtmlAttr(LR\Filters::safeUrl($basePath)) /* line 8 */ ?>/<?php
		echo LR\Filters::escapeHtmlAttr(LR\Filters::safeUrl($entryLink)) /* line 8 */ ?>/novy-zaznam" role="button">+ Přidat nový záznam</a>
    </p>
  </div>
</div>
<?php
	}

}
