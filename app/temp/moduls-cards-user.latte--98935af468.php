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
</div>
<div class="card-body">
    <div class="row">
        <div class="col-6">
            <strong>Uživatelské jméno</strong>
        </div>
        <div class="col-6">
            <?php echo LR\Filters::escapeHtmlText($item->username) /* line 12 */ ?>

        </div>
    </div>
    <div class="row">
        <div class="col-6">
            <strong>Email</strong>
        </div>
        <div class="col-6">
            <?php echo LR\Filters::escapeHtmlText($item->email) /* line 20 */ ?>

        </div>
    </div>
    <div class="row">
        <div class="col-6">
            <strong>Role</strong>
        </div>
        <div class="col-6">
            <?php echo LR\Filters::escapeHtmlText($item->role) /* line 28 */ ?>

        </div>
    </div>
    <div class="row mt-3">
        <div class="col-6">
            <a href="<?php echo LR\Filters::escapeHtmlAttr(LR\Filters::safeUrl($basePath)) /* line 33 */ ?>/uzivatele/editovat/<?php
		echo LR\Filters::escapeHtmlAttr(LR\Filters::safeUrl($item->id)) /* line 33 */ ?>" class="btn btn-primary btn-sm btn-block">Editovat</a>
        </div>
    </div>

</div>
</div>
<?php
	}

}