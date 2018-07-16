<?php
// source: latte/backend/components/breadcrumb.latte

use Latte\Runtime as LR;

class Templateef5ef1a007 extends Latte\Runtime\Template
{

	function main()
	{
		extract($this->params);
?>
<ol class="breadcrumb">
<?php
		$iterations = 0;
		foreach ($pages as $p) {
?>
    <li class="breadcrumb-item active">
<?php
			if ($p['link'] != '') {
				?>            <a href="<?php echo LR\Filters::escapeHtmlAttr(LR\Filters::safeUrl($basePath)) /* line 5 */ ?>"><i class="nav-icon <?php
				echo LR\Filters::escapeHtmlAttr($p['icon']) /* line 5 */ ?>"></i> <?php echo LR\Filters::escapeHtmlText($p['title']) /* line 5 */ ?></a>
<?php
			}
			else {
				?>            <i class="nav-icon <?php echo LR\Filters::escapeHtmlAttr($p['icon']) /* line 7 */ ?>"></i> <?php
				echo LR\Filters::escapeHtmlText($p['title']) /* line 7 */ ?>

<?php
			}
?>
    </li>
<?php
			$iterations++;
		}
?>
    
    <!-- Breadcrumb Menu-->
<?php
		if ($newItem) {
?>    <li class="breadcrumb-menu d-md-down-none">
    <div class="btn-group" role="group" aria-label="Button group">
        <a class="btn" href="<?php echo LR\Filters::escapeHtmlAttr(LR\Filters::safeUrl($newItemLink)) /* line 15 */ ?>">
        <i class="icon-plus"></i> Přidat novou položku
        </a>              
    </div>
    </li>
<?php
		}
		?></ol><?php
		return get_defined_vars();
	}


	function prepare()
	{
		extract($this->params);
		if (isset($this->params['p'])) trigger_error('Variable $p overwritten in foreach on line 2');
		
	}

}
