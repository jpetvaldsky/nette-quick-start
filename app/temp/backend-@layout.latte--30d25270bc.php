<?php
// source: latte/backend/@layout.latte

use Latte\Runtime as LR;

class Template30d25270bc extends Latte\Runtime\Template
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
  <body class="app header-fixed sidebar-fixed aside-menu-fixed sidebar-lg-show">
<?php
		/* line 21 */
		$this->createTemplate('components/header.latte', $this->params, "include")->renderToContentType('html');
?>
    <div class="app-body">
      <div class="sidebar">
        <nav class="sidebar-nav">
          <ul class="nav">
            <li class="nav-item">
              <a class="nav-link" href="index.html">
                <i class="nav-icon icon-home"></i> Úvodní strana
              </a>
            </li>
            <li class="nav-title">Správa obsahu</li>
            <li class="nav-item">
              <a class="nav-link" href="colors.html">
                <i class="nav-icon icon-organization"></i> Volné pozice</a>
            </li>
            <li class="nav-item">
              <a class="nav-link" href="typography.html">
                <i class="nav-icon icon-energy"></i> HR Team</a>
            </li>
            <li class="nav-item">
              <a class="nav-link" href="typography.html">
                <i class="nav-icon icon-notebook"></i> Novinky (Blog)</a>
            </li>
            <li class="nav-item">
              <a class="nav-link" href="typography.html">
                <i class="nav-icon icon-question"></i> FAQ</a>
            </li>
            <li class="nav-item">
              <a class="nav-link" href="typography.html">
                <i class="nav-icon icon-speech"></i> O SZIFu</a>
            </li>
            <li class="nav-title">Související obsah</li>
            <li class="nav-item">
              <a class="nav-link" href="#">
                <i class="nav-icon icon-chemistry"></i> Obor</a>
            </li>
            <li class="nav-item">
              <a class="nav-link" href="#">
                <i class="nav-icon icon-map"></i> Kraje</a>
            </li>
          </ul>
        </nav>
      </div>
      <main class="main">
        <!-- Breadcrumb-->
        <ol class="breadcrumb">
          <li class="breadcrumb-item active"><i class="nav-icon icon-home"></i> Úvodní strana</li>
          
          <!-- Breadcrumb Menu-->
          <li class="breadcrumb-menu d-md-down-none">
            <div class="btn-group" role="group" aria-label="Button group">
              <a class="btn" href="#">
                <i class="icon-plus"></i> Přidat novou položku
              </a>              
            </div>
          </li>
        </ol>
        <div class="container-fluid">
          <div class="animated fadeIn">
            Test
          </div>

        </div>
      </main>
    </div>
    <footer class="app-footer">
      <div>
        <span>&copy; 2018 </span><a href="https://deloittedigital.cz">Deloitte Digital</a>        
      </div>
    </footer>
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
