<?php
// source: latte/backend/editors/list/media-library.latte

use Latte\Runtime as LR;

class Template3f12fb93f4 extends Latte\Runtime\Template
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
		$this->createTemplate('../../components/moduls/cards/thumbnail.latte', get_defined_vars(), "includeblock")->renderToContentType('html');
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
		if (isset($this->params['item'])) trigger_error('Variable $item overwritten in foreach on line 9');
		$this->parentName = '../../@layout.latte';
		
	}


	function blockContent($_args)
	{
		extract($_args);
?>
<h2>Knihovna Medií</h2>

<?php
		if (isset($data)) {
?>
    <div class="row">
<?php
			$iterations = 0;
			foreach ($data as $item) {
?>
        <div class="col-sm-6 col-lg-4 col-xl-3">
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
		else {
			$this->renderBlock('noEntry', ['entryLink' => $pathPrefix] + $this->params, 'html');
		}
?>

<?php
	}

}
