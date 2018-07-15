<?php
// source: latte/backend/@layout-simple.latte

use Latte\Runtime as LR;

class Template02f65abada extends Latte\Runtime\Template
{

	function main()
	{
		extract($this->params);
?>
<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, shrink-to-fit=no">
    <meta name="description" content="SZIF - CMS">
    <meta name="author" content="Deloitte Digital Prague">
    <meta name="keyword" content="SZIF">
    <title>SZIF - CMS</title>
    <!-- Icons-->
    <link href="/assets/vendors/@coreui/icons/css/coreui-icons.min.css" rel="stylesheet">
    <link href="/assets/vendors/flag-icon-css/css/flag-icon.min.css" rel="stylesheet">
    <link href="/assets/vendors/font-awesome/css/font-awesome.min.css" rel="stylesheet">
    <link href="/assets/vendors/simple-line-icons/css/simple-line-icons.css" rel="stylesheet">
    <!-- Main styles for this application-->
    <link href="/assets/backend/css/style.css" rel="stylesheet">
    <link href="/assets/vendors/pace-progress/css/pace.min.css" rel="stylesheet">
  </head>
  <body class="app flex-row align-items-center">
    
<?php
		$this->renderBlock('content', $this->params, 'html');
?>
    
    <!-- Bootstrap and necessary plugins-->
    <script src="/assets/vendors/jquery/js/jquery.min.js"></script>
    <script src="/assets/vendors/popper.js/js/popper.min.js"></script>
    <script src="/assets/vendors/bootstrap/js/bootstrap.min.js"></script>
    <script src="/assets/vendors/pace-progress/js/pace.min.js"></script>
    <script src="/assets/vendors/perfect-scrollbar/js/perfect-scrollbar.min.js"></script>
    <script src="/assets/vendors/@coreui/coreui/js/coreui.min.js"></script>
    <!-- Plugins and scripts required by this view-->
    <script src="/assets/vendors/chart.js/js/Chart.min.js"></script>
    <script src="/assets/vendors/@coreui/coreui-plugin-chartjs-custom-tooltips/js/custom-tooltips.min.js"></script>
    <script src="/assets/backend/js/main.js"></script>
  </body>
</html><?php
		return get_defined_vars();
	}

}
