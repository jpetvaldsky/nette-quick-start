<?php
// source: latte/@layout.latte

use Latte\Runtime as LR;

class Template1ef20fbc26 extends Latte\Runtime\Template
{

	function main()
	{
		extract($this->params);
?>
<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>SZIF</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    
    <link rel="stylesheet" href="/assets/vendors/css/slider-pro.min.css">    
    <link rel="stylesheet" type="text/css" media="screen" href="/assets/css/loader.css">
</head>
<body>
<?php
		/* line 13 */
		$this->createTemplate('static/header.latte', $this->params, "include")->renderToContentType('html');
?>
    <div id="container">        
<?php
		$this->renderBlock('content', $this->params, 'html');
?>
        
    </div><!-- /#container -->
    
    
    
<?php
		/* line 21 */
		$this->createTemplate('static/footer.latte', $this->params, "include")->renderToContentType('html');
?>


    <script src="/assets/vendors/js/jquery.min.js"></script>
    <script src="/assets/vendors/js/jquery-ui.min.js"></script>
    <script src="/assets/vendors/js/jquery.sliderPro.min.js"></script>
    <script src="/assets/vendors/js/select2.min.js"></script>
    <script src="/assets/vendors/js/showdown.min.js"></script>

    
    <script src="/assets/js/app.js"></script>
    <script src="/assets/js/jobfilter.js"></script>
</body>
</html><?php
		return get_defined_vars();
	}

}
