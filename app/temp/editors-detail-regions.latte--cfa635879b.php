<?php
// source: latte/backend/editors/detail/regions.latte

use Latte\Runtime as LR;

class Templatecfa635879b extends Latte\Runtime\Template
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
		$this->parentName = '../../@layout.latte';
		
	}


	function blockContent($_args)
	{
		extract($_args);
		?><h2><?php echo LR\Filters::escapeHtmlText($headline) /* line 3 */ ?></h2>
<form action="<?php echo LR\Filters::escapeHtmlAttr(LR\Filters::safeUrl($basePath)) /* line 4 */ ?>/<?php
		echo LR\Filters::escapeHtmlAttr(LR\Filters::safeUrl($pathPrefix)) /* line 4 */ ?>/" method="post" class="form-horizontal">
<div class="card">
    <div class="card-header">
        <strong><?php
		if (isset($item)) {
			?>Editace, ID: <?php
			echo LR\Filters::escapeHtmlText($item->id) /* line 7 */;
		}
		else {
			?>Nový záznam<?php
		}
?></strong>
    </div>
    <div class="card-body">
            <div class="form-group row">
                <label class="col-md-3 col-form-label" for="title">Název</label>
                <div class="col-md-9">
                    <input type="text" id="title" name="title" value="<?php
		if (isset($item)) {
			echo LR\Filters::escapeHtmlAttr($item->title) /* line 13 */;
		}
?>" class="form-control" placeholder="Zadejte název kraje">
                </div>
            </div>
            <div class="form-group row">
                <label class="col-md-3 col-form-label" for="mapClass">Ikona mapy</label>
                <div class="col-md-9">
                    <input type="text" id="mapClass" name="mapClass" value="<?php
		if (isset($item)) {
			echo LR\Filters::escapeHtmlAttr($item->mapClass) /* line 19 */;
		}
?>" class="form-control" placeholder="ID ikony">
                </div>
            </div>            
<?php
		$this->renderBlock('activeCheckbox', $this->params, 'html');
?>
        
    </div>
<?php
		$this->renderBlock('formSubmit', $this->params, 'html');
?>
</div>
</form>
<?php
	}

}
