<?php
// source: latte/backend/components/card-list.latte

use Latte\Runtime as LR;

class Templatedf47aae224 extends Latte\Runtime\Template
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
?>

<?php
		if ($this->getParentName()) return get_defined_vars();
		return get_defined_vars();
	}


	function blockCardBlock($_args)
	{
?><div class="card">
<div class="card-header">
Card actions
<div class="card-header-actions">
<a href="#" class="card-header-action btn-setting">
<i class="icon-settings"></i>
</a>
<a href="#" class="card-header-action btn-minimize" data-toggle="collapse" data-target="#collapseExample" aria-expanded="true">
<i class="icon-arrow-up"></i>
</a>
<a href="#" class="card-header-action btn-close">
<i class="icon-close"></i>
</a>
</div>
</div>
<div class="card-body collapse show" id="collapseExample" style="">
Lorem ipsum dolor sit amet, consectetuer adipiscing elit, sed diam nonummy nibh euismod tincidunt ut laoreet dolore magna aliquam erat volutpat. Ut wisi enim ad minim veniam, quis nostrud exerci tation ullamcorper suscipit lobortis nisl ut aliquip ex
ea commodo consequat.
</div>
</div>
<?php
	}

}