<?php
// source: latte/backend/editors/position-type-list.latte

use Latte\Runtime as LR;

class Template8ca9575bc3 extends Latte\Runtime\Template
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
		$this->createTemplate('../components/no-entry.latte', get_defined_vars(), "includeblock")->renderToContentType('html');
		echo rtrim(ob_get_clean());
?>

<?php
		if ($this->getParentName()) return get_defined_vars();
		$this->renderBlock('content', get_defined_vars());
		return get_defined_vars();
	}


	function prepare()
	{
		extract($this->params);
		if (isset($this->params['item'])) trigger_error('Variable $item overwritten in foreach on line 20');
		$this->parentName = '../@layout.latte';
		
	}


	function blockContent($_args)
	{
		extract($_args);
?>
<h2>Typy pozic</h2>

<?php
		if (isset($data)) {
?>
<div class="card">
<table class="table table-striped table-responsive-sm">
    <thead>
        <tr>
            <th>ID</th>
            <th>Název</th>
            <th>Zkratka</th>
            <th>Status</th>
            <th></th>
        </tr>
    </thead>
    <tbody>
<?php
			$iterations = 0;
			foreach ($data as $item) {
?>
        <tr>
            <td><?php echo LR\Filters::escapeHtmlText($item->id) /* line 22 */ ?></td>
            <td><strong><?php echo LR\Filters::escapeHtmlText($item->title) /* line 23 */ ?></strong></td>
            <td><?php echo LR\Filters::escapeHtmlText($item->abbreviation) /* line 24 */ ?></td>
            <td><?php
				if ($item->active == 1) {
					?><span class="badge badge-success">Aktivní</span><?php
				}
				else {
					?><span class="badge badge-secondary">Vypnutý</span><?php
				}
?></td>
            <td>
                <a href="<?php echo LR\Filters::escapeHtmlAttr(LR\Filters::safeUrl($basePath)) /* line 27 */ ?>/typy-pozic/editovat/<?php
				echo LR\Filters::escapeHtmlAttr(LR\Filters::safeUrl($item->id)) /* line 27 */ ?>" class="btn btn-primary btn-sm">Editovat</a>
            </td>
        
        </tr>
<?php
				$iterations++;
			}
?>
    </tbody>
</table>
</div>
<?php
		}
		else {
			$this->renderBlock('noEntry', ['entryLink' => 'typy-pozic'] + $this->params, 'html');
		}
		
	}

}
