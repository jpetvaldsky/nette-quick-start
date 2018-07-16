<?php
// source: latte/backend/components/flash-messages.latte

use Latte\Runtime as LR;

class Template702f88a401 extends Latte\Runtime\Template
{
	public $blocks = [
		'flashMessages' => 'blockFlashMessages',
	];

	public $blockTypes = [
		'flashMessages' => 'html',
	];


	function main()
	{
		extract($this->params);
		if ($this->getParentName()) return get_defined_vars();
		return get_defined_vars();
	}


	function prepare()
	{
		extract($this->params);
		if (isset($this->params['m'])) trigger_error('Variable $m overwritten in foreach on line 2');
		
	}


	function blockFlashMessages($_args)
	{
		extract($_args);
		$iterations = 0;
		foreach ($messages as $m) {
			?><div class="alert alert-<?php echo LR\Filters::escapeHtmlAttr($m['style']) /* line 3 */ ?>" role="alert">
    <?php echo LR\Filters::escapeHtmlText($m['text']) /* line 4 */ ?>

</div>
<?php
			$iterations++;
		}
		
	}

}
