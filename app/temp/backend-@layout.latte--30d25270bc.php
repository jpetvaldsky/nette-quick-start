<?php
// source: latte/backend/@layout.latte

use Latte\Runtime as LR;

class Template30d25270bc extends Latte\Runtime\Template
{

	function main()
	{
		extract($this->params);
		ob_start(function () {});
		$this->createTemplate('components/flash-messages.latte', get_defined_vars(), "includeblock")->renderToContentType('html');
		echo rtrim(ob_get_clean());
		ob_start(function () {});
		$this->createTemplate('components/no-entry.latte', get_defined_vars(), "includeblock")->renderToContentType('html');
		echo rtrim(ob_get_clean());
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
		/* line 24 */
		$this->createTemplate('components/header.latte', $this->params, "include")->renderToContentType('html');
?>
    <div class="app-body">
<?php
		/* line 26 */
		$this->createTemplate('components/sidebar.latte', $this->params, "include")->renderToContentType('html');
?>
      <main class="main">
        <!-- Breadcrumb-->
<?php
		/* line 29 */
		$this->createTemplate('components/breadcrumb.latte', $this->params, "include")->renderToContentType('html');
?>
        <div class="container-fluid">
          <div class="animated fadeIn">
<?php
		if (isset($flashMessages)) {
			$this->renderBlock('flashMessages', ['messages' => $flashMessages] + $this->params, 'html');
		}
		$this->renderBlock('content', $this->params, 'html');
?>
          </div>

        </div>
      </main>
    </div>
<?php
		/* line 41 */
		$this->createTemplate('components/footer.latte', $this->params, "include")->renderToContentType('html');
?>
    
<?php
		/* line 43 */
		$this->createTemplate('components/assets.latte', $this->params, "include")->renderToContentType('html');
?>
  </body>
</html><?php
		return get_defined_vars();
	}

}
