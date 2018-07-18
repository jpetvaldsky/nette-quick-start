<?php
// source: latte/backend/editors/detail/media-library.latte

use Latte\Runtime as LR;

class Template5a3353c20a extends Latte\Runtime\Template
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
		$this->createTemplate('../../components/file-uploader.latte', get_defined_vars(), "includeblock")->renderToContentType('html');
		echo rtrim(ob_get_clean());
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
		?><h2><?php echo LR\Filters::escapeHtmlText($headline) /* line 4 */ ?></h2>
<form action="<?php echo LR\Filters::escapeHtmlAttr(LR\Filters::safeUrl($basePath)) /* line 5 */ ?>/<?php
		echo LR\Filters::escapeHtmlAttr(LR\Filters::safeUrl($pathPrefix)) /* line 5 */ ?>/" method="post" class="form-horizontal">
<div class="card">
    <div class="card-header">
        <strong><?php
		if (isset($item)) {
			?>Editace, ID: <?php
			echo LR\Filters::escapeHtmlText($item->id) /* line 8 */;
		}
		else {
			?>Nový záznam<?php
		}
?></strong>
    </div>
    <div class="card-body">
<?php
		$this->renderBlock('textInput', ['id'=>'title','title'=>'Název','placeholder'=>'Zadejte popisek souboru','value' => isset($item)? $item->title: ''] + $this->params, 'html');
?>
            
<?php
		$this->renderBlock('mediaUpload', $this->params, 'html');
?>
        
    </div>
    <div class="card-footer text-center">
        <input type="hidden" name="action" value="<?php echo LR\Filters::escapeHtmlAttr($formAction) /* line 17 */ ?>">
        <?php
		if (isset($item)) {
			?><input type="hidden" name="id" value="<?php echo LR\Filters::escapeHtmlAttr($item->id) /* line 18 */ ?>"><?php
		}
?>

        <button type="submit" class="btn btn-md btn-primary col-sm-12 col-md-4"><i class="fa fa-plus-circle"></i> Uložit</button>
    </div>
</div>

<?php
	}

}
