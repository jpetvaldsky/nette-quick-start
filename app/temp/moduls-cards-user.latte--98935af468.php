<?php
// source: latte/backend/components/moduls/cards/user.latte

use Latte\Runtime as LR;

class Template98935af468 extends Latte\Runtime\Template
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
   <strong><?php echo LR\Filters::escapeHtmlText($item->fullName) /* line 4 */ ?></strong> <span class="badge badge-pill badge-primary">ID: <?php
		echo LR\Filters::escapeHtmlText($item->id) /* line 4 */ ?></span>
    <div class="card-header-actions">
        <a href="<?php echo LR\Filters::escapeHtmlAttr(LR\Filters::safeUrl($basePath)) /* line 6 */ ?>/<?php
		echo LR\Filters::escapeHtmlAttr(LR\Filters::safeUrl($pathPrefix)) /* line 6 */ ?>/editovat/<?php echo LR\Filters::escapeHtmlAttr(LR\Filters::safeUrl($item->id)) /* line 6 */ ?>" class="btn btn-primary btn-sm">Editovat</a>
        &nbsp;<a href="<?php echo LR\Filters::escapeHtmlAttr(LR\Filters::safeUrl($basePath)) /* line 7 */ ?>/<?php
		echo LR\Filters::escapeHtmlAttr(LR\Filters::safeUrl($pathPrefix)) /* line 7 */ ?>/smazat/<?php echo LR\Filters::escapeHtmlAttr(LR\Filters::safeUrl($item->id)) /* line 7 */ ?>" class="btn btn-warning btn-sm" onclick="return confirm('Opravdu smazat?')">Smazat</a>
   </div>
</div>
<div class="card-body">
    <div class="row">
        <div class="col-6">
            <strong>Uživatelské jméno</strong>
        </div>
        <div class="col-6">
            <?php echo LR\Filters::escapeHtmlText($item->username) /* line 16 */ ?>

        </div>
    </div>
    <div class="row">
        <div class="col-6">
            <strong>Email</strong>
        </div>
        <div class="col-6">
            <?php echo LR\Filters::escapeHtmlText($item->email) /* line 24 */ ?>

        </div>
    </div>
    <div class="row">
        <div class="col-6">
            <strong>Role</strong>
        </div>
        <div class="col-6">
            <?php echo LR\Filters::escapeHtmlText($item->role) /* line 32 */ ?>

        </div>
    </div>
    <div class="row mt-3">
        <div class="col-6">
            <a href="<?php echo LR\Filters::escapeHtmlAttr(LR\Filters::safeUrl($basePath)) /* line 37 */ ?>/<?php
		echo LR\Filters::escapeHtmlAttr(LR\Filters::safeUrl($pathPrefix)) /* line 37 */ ?>/editovat/<?php echo LR\Filters::escapeHtmlAttr(LR\Filters::safeUrl($item->id)) /* line 37 */ ?>" class="btn btn-primary btn-sm btn-block">Editovat</a>
        </div>
    </div>

</div>
</div>
<?php
	}

}
