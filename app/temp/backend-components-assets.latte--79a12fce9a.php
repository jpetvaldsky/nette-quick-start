<?php
// source: latte/backend/components/assets.latte

use Latte\Runtime as LR;

class Template79a12fce9a extends Latte\Runtime\Template
{

	function main()
	{
		extract($this->params);
?>
    <!-- Bootstrap and necessary plugins-->
    <script src="/assets/vendors/jquery/js/jquery.min.js"></script>
    <script src="/assets/vendors/popper.js/js/popper.min.js"></script>
    <script src="/assets/vendors/bootstrap/js/bootstrap.min.js"></script>
    <script src="/assets/vendors/pace-progress/js/pace.min.js"></script>
    <script src="/assets/vendors/perfect-scrollbar/js/perfect-scrollbar.min.js"></script>
    <script src="/assets/vendors/@coreui/coreui/js/coreui.min.js"></script>
    <!-- Plugins and scripts required by this view-->
    <!--<script src="/assets/vendors/chart.js/js/Chart.min.js"></script>-->
    <script src="/assets/vendors/@coreui/coreui-plugin-chartjs-custom-tooltips/js/custom-tooltips.min.js"></script>
    

    <script src="/assets/vendors/fine-uploader/jquery.fine-uploader.min.js" type="text/javascript"></script>
    <link rel="stylesheet" href="/assets/vendors/fine-uploader/fine-uploader.css">

    <script src="/assets/backend/js/main.js"></script><?php
		return get_defined_vars();
	}

}
