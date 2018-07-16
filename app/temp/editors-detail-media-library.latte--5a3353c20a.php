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
?>
<h2>Média</h2>
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
            <div class="form-group row">
                <label class="col-md-3 col-form-label" for="title">Název</label>
                <div class="col-md-9">
                    <input type="text" id="title" name="title" value="<?php
		if (isset($item)) {
			echo LR\Filters::escapeHtmlAttr($item->title) /* line 14 */;
		}
?>" class="form-control" placeholder="Zadejte popisek souboru">
                </div>
            </div>
            <div class="form-group row">
                <label class="col-md-3 col-form-label" for="title">Soubor</label>
                <div class="col-md-9">
                    <div id="mediaContainer" data-uuid="" class="media-uploader"></div>
                    <input type="hidden" id="mediaContainerID" name="mediaHash" value="<?php
		if (isset($item)) {
			echo LR\Filters::escapeHtmlAttr($item->mediaHash) /* line 21 */;
		}
?>">
                </div>
            </div>
        
    </div>
    <div class="card-footer text-center">
        <input type="hidden" name="action" value="<?php echo LR\Filters::escapeHtmlAttr($formAction) /* line 27 */ ?>">
        <?php
		if (isset($item)) {
			?><input type="hidden" name="id" value="<?php echo LR\Filters::escapeHtmlAttr($item->id) /* line 28 */ ?>"><?php
		}
?>

        <button type="submit" class="btn btn-md btn-primary col-sm-12 col-md-4"><i class="fa fa-plus-circle"></i> Uložit</button>
    </div>
</div>


<?php
		$this->renderBlock('fileUploader', ['label' => 'Nahrát soubor'] + $this->params, 'html');
		
	}

}
