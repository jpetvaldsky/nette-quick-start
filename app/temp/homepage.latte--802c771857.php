<?php
// source: latte/homepage.latte

use Latte\Runtime as LR;

class Template802c771857 extends Latte\Runtime\Template
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
		$this->parentName = '@layout.latte';
		
	}


	function blockContent($_args)
	{
		extract($_args);
?>
<div class="maskShape shapeTop"></div>
<?php
		/* line 4 */
		$this->createTemplate('web/position-filter.latte', $this->params, "include")->renderToContentType('html');
?>
        <div class="wrapper">
            <div class="wrapperBackground">
                <div class="content">
<?php
		if (isset($jobPositions)) {
			/* line 9 */
			$this->createTemplate('web/position-list.latte', $this->params, "include")->renderToContentType('html');
		}
		/* line 11 */
		$this->createTemplate('web/watch-dog.latte', $this->params, "include")->renderToContentType('html');
?>
                    
<?php
		if (isset($team)) {
			/* line 14 */
			$this->createTemplate('web/hr-team.latte', $this->params, "include")->renderToContentType('html');
		}
?>
                    
<?php
		if (isset($news)) {
			/* line 18 */
			$this->createTemplate('web/news.latte', $this->params, "include")->renderToContentType('html');
		}
?>

<?php
		if (isset($faq)) {
			/* line 22 */
			$this->createTemplate('web/faq.latte', $this->params, "include")->renderToContentType('html');
		}
?>

<?php
		if (isset($about)) {
			/* line 26 */
			$this->createTemplate('web/about.latte', $this->params, "include")->renderToContentType('html');
		}
?>
                                        
                    <!-- /.about .contentBlock -->
                </div>                
            </div>
            <div class="maskShape shapeBottom"></div>
        </div>

<?php
	}

}
