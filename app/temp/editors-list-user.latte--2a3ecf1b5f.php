<?php
// source: latte/backend/editors/list/user.latte

use Latte\Runtime as LR;

class Template2a3ecf1b5f extends Latte\Runtime\Template
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
		ob_start(function () {});
		$this->createTemplate('../../components/moduls/cards/user.latte', get_defined_vars(), "includeblock")->renderToContentType('html');
		echo rtrim(ob_get_clean());
?>

<?php
		if ($this->getParentName()) return get_defined_vars();
		$this->renderBlock('content', get_defined_vars());
		return get_defined_vars();
	}


	function prepare()
	{
		extract($this->params);
		if (isset($this->params['item'])) trigger_error('Variable $item overwritten in foreach on line 8');
		$this->parentName = '../../@layout.latte';
		
	}


	function blockContent($_args)
	{
		extract($_args);
		?><h2><?php echo LR\Filters::escapeHtmlText($headline) /* line 5 */ ?></h2>

<div class="row">
<?php
		$iterations = 0;
		foreach ($data as $item) {
?>

    <div class="col-lg-6">
<?php
			$this->renderBlock('cardBlock', ['item' => $item] + $this->params, 'html');
?>
    </div>
<?php
			$iterations++;
		}
?>
</div>


<?php
	}

}
