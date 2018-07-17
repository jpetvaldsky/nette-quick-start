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
            <a href="<?php echo LR\Filters::escapeHtmlAttr(LR\Filters::safeUrl($basePath)) /* line 6 */ ?>/<?php
		echo LR\Filters::escapeHtmlAttr(LR\Filters::safeUrl($pathPrefix)) /* line 6 */ ?>/editovat/<?php echo LR\Filters::escapeHtmlAttr(LR\Filters::safeUrl($item->id)) /* line 6 */ ?>" class="card-header-action btn-setting"><i class="icon-pencil"></i></a>
            <a href="<?php echo LR\Filters::escapeHtmlAttr(LR\Filters::safeUrl($basePath)) /* line 7 */ ?>/<?php
		echo LR\Filters::escapeHtmlAttr(LR\Filters::safeUrl($pathPrefix)) /* line 7 */ ?>/smazat/<?php echo LR\Filters::escapeHtmlAttr(LR\Filters::safeUrl($item->id)) /* line 7 */ ?>" onclick="return confirm('Opravdu smazat?')" class="card-header-action btn-setting"><i class="icon-trash"></i></a>
        </div>
    </div>
    <div class="card-body">
        <div class="text-center">
            <?php echo call_user_func($this->filters->thumb, $item->mediaHash, 200, 0) /* line 12 */ ?>

        </div>
    </div>
</div>
<?php
	}

}
