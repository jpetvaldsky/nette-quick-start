<?php
// source: latte/backend/components/moduls/cards/thumbnail.latte

use Latte\Runtime as LR;

class Template69c339d3d9 extends Latte\Runtime\Template
{
	public $blocks = [
		'cardBlock' => 'blockCardBlock',
	];

	public $blockTypes = [
		'cardBlock' => 'html',
	];


	function main()
	{
		extract($this->params);
		if ($this->getParentName()) return get_defined_vars();
		return get_defined_vars();
	}


	function blockCardBlock($_args)
	{
		extract($_args);
?>
<div class="card">
    <div class="card-header">
        <?php
		if ($item->title != '') {
			echo LR\Filters::escapeHtmlText($item->title) /* line 4 */;
		}
		else {
			?><strong>ID:</strong> <?php
			echo LR\Filters::escapeHtmlText($item->id) /* line 4 */;
		}
?>

        <div class="card-header-actions">
<?php
		$this->renderBlock('actionButtons', ['item'=>$item] + $this->params, 'html');
?>
        </div>
    </div>
    <div class="card-body">
        <div class="text-center">
            <?php echo call_user_func($this->filters->thumb, $item->mediaHash, 200, 0) /* line 11 */ ?>

        </div>
    </div>
</div>
<?php
	}

}
