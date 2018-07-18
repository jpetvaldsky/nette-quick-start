<?php
// source: latte/backend/components/file-uploader.latte

use Latte\Runtime as LR;

class Template7fd54307ff extends Latte\Runtime\Template
{
	public $blocks = [
		'fileUploader' => 'blockFileUploader',
	];

	public $blockTypes = [
		'fileUploader' => 'html',
	];


	function main()
	{
		extract($this->params);
		if ($this->getParentName()) return get_defined_vars();
		return get_defined_vars();
	}


	function blockFileUploader($_args)
	{
?><script type="text/template" id="qq-template">

    <div class="qq-uploader-selector card">
        <div class="card-header">
            Nahrání souboru
        </div>
        <div class="card-body">
            <div class="qq-upload-drop-area-selector qq-upload-drop-area" qq-hide-dropzone>
                <span>Přetáhněte soubor tady</span>
            </div>
            <div class="qq-upload-button-selector btn btn-primary">
                <div>Vybrat soubor</div>
            </div>
            <span class="qq-drop-processing-selector qq-drop-processing">
            <span>Nahrávám...</span>
            <span class="qq-drop-processing-spinner-selector qq-drop-processing-spinner"></span>
            </span>
            <ul class="qq-upload-list-selector qq-upload-list mt-2">
                <li>
                    <div class="qq-progress-bar-container-selector">
                        <div class="qq-progress-bar-selector qq-progress-bar"></div>
                    </div>
                    <span class="qq-upload-spinner-selector qq-upload-spinner"></span>
                    <img class="qq-thumbnail-selector" qq-max-size="100" qq-server-scale>
                    <span class="qq-edit-filename-icon-selector qq-edit-filename-icon"></span>
                    <span class="qq-upload-file-selector qq-upload-file"></span>
                    <input class="qq-edit-filename-selector qq-edit-filename" tabindex="0" type="text">
                    <span class="qq-upload-size-selector qq-upload-size"></span>
                    <a class="qq-upload-cancel-selector qq-upload-cancel" href="#">Zrušit</a>
                    <a class="qq-upload-retry-selector qq-upload-retry" href="#">Zkusit znovu</a>
                    <a class="qq-upload-delete-selector qq-upload-delete" href="#">Smazat</a>
                    <span class="qq-upload-status-text-selector qq-upload-status-text"></span>
                </li>
            </ul>
        </div>
    </div>
</script>
<?php
	}

}
