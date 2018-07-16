<?php
// source: latte/backend/editors/detail/position-type.latte

use Latte\Runtime as LR;

class Templatec1538dd715 extends Latte\Runtime\Template
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
?>
<h2>Typy pozic</h2>
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
?>" class="form-control" placeholder="Zadejte název pozice">
                </div>
            </div>
            <div class="form-group row">
                <label class="col-md-3 col-form-label" for="abbreviation">Zkratka</label>
                <div class="col-md-9">
                    <input type="text" id="abbreviation" name="abbreviation" value="<?php
		if (isset($item)) {
			echo LR\Filters::escapeHtmlAttr($item->abbreviation) /* line 19 */;
		}
?>" class="form-control" placeholder="Zkratka názvu pozice">
                </div>
            </div>            
            <div class="form-group row">
                <label class="col-md-3 col-form-label">Aktivní záznam</label>
                <div class="col-md-9 col-form-label">
                    <div class="form-check checkbox">
<?php
		if (isset($item)) {
			if ($item->active == 1) {
?>
                            <input class="form-check-input" type="checkbox" name="active" value="1" checked id="active">
<?php
			}
			else {
?>
                            <input class="form-check-input" type="checkbox" name="active" value="1" id="active">
<?php
			}
		}
		else {
?>
                            <input class="form-check-input" type="checkbox" name="active" value="1" checked id="active">
<?php
		}
?>
                        
                        <label class="form-check-label" for="active">
                            Aktivovat
                        </label>
                    </div>
                </div>
            </div>
        
    </div>
    <div class="card-footer text-center">
        <input type="hidden" name="action" value="<?php echo LR\Filters::escapeHtmlAttr($formAction) /* line 45 */ ?>">
        <?php
		if (isset($item)) {
			?><input type="hidden" name="id" value="<?php echo LR\Filters::escapeHtmlAttr($item->id) /* line 46 */ ?>"><?php
		}
?>

        <button type="submit" class="btn btn-md btn-primary col-sm-12 col-md-4"><i class="fa fa-plus-circle"></i> Uložit</button>
    </div>
</div>
</form>
<?php
	}

}
