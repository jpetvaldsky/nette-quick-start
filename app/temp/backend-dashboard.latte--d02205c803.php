<?php
// source: latte/backend/dashboard.latte

use Latte\Runtime as LR;

class Templated02205c803 extends Latte\Runtime\Template
{
	public $blocks = [
		'content' => 'blockContent',
	];

	public $blockTypes = [
		'content' => 'html',
	];


	function main()
	{
		extract($this->params);
		if ($this->getParentName()) return get_defined_vars();
		$this->renderBlock('content', get_defined_vars());
		return get_defined_vars();
	}


	function prepare()
	{
		extract($this->params);
		$this->parentName = '@layout.latte';
		
	}


	function blockContent($_args)
	{
		extract($_args);
?>
<div class="card">
    <div class="card-header">
        Administrace - <strong>SZIF</strong>
    </div>
    <div class="card-body">
        <h2><?php echo LR\Filters::escapeHtmlText($user->fullName) /* line 7 */ ?>, vítejte v administraci!</h2>
        <p>Vyberte si prosím v menu, které data chcete editovat.</p>
        <p>Webovou stránku <a href="http://pojdpomahatzemedelstvi.cz/" target="_blank">http://pojdpomahatzemedelstvi.cz</a>, můžete zobrazit kliknutím na tento odkaz:<br>
        <a href="http://pojdpomahatzemedelstvi.cz/" class="btn btn-primary mt-4" target="_blank">Přejít na stránku</a>
        </p>
    </div>
</div>
<?php
	}

}
