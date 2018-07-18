<?php
//phpinfo();
//exit;
use Tracy\Debugger;

# Include the Autoloader (see "Libraries" for install instructions)
require 'vendor/autoload.php';

require 'config.php';
require 'app/lib/DatabaseConnection.php';
require 'app/lib/Helpers.php';
require 'app/lib/Sessions.php';
require 'app/lib/UploadHandler.php';

require 'app/Main.php';
require 'app/Api.php';
require 'app/Admin.php';


require 'app/Admin/DefaultModul.php';
require 'app/Admin/AboutSzifModul.php';
require 'app/Admin/BenefitModul.php';
require 'app/Admin/BranchModul.php';
require 'app/Admin/FaqModul.php';
require 'app/Admin/FieldModul.php';
require 'app/Admin/HRTeamModul.php';
require 'app/Admin/MediaModul.php';
require 'app/Admin/PositionTypeModul.php';
require 'app/Admin/RegionModul.php';
require 'app/Admin/UserModul.php';



require 'app/Model/Default.php';
require 'app/Model/AboutSzif.php';
require 'app/Model/Benefit.php';
require 'app/Model/Branch.php';
require 'app/Model/Faq.php';
require 'app/Model/Field.php';
require 'app/Model/HRTeam.php';
require 'app/Model/Media.php';
require 'app/Model/PositionType.php';
require 'app/Model/Region.php';
require 'app/Model/User.php';



define("UPLOAD_FOLDER","/upload/");
define("THUMB_FOLDER","/thumbnails/");
define("ROOT_FOLDER",__DIR__);



if (PRODUCTION_MODE) {
	Debugger::enable(Debugger::PRODUCTION,ROOT_FOLDER.'/log/');
} else {
	Debugger::enable(Debugger::DEVELOPMENT,ROOT_FOLDER.'/log/');
}

$db = new DatabaseConnection();

$routeParams = explode("?",trim($_SERVER["REQUEST_URI"],"/"));
$route = explode("/",$routeParams[0]);


switch ($route[0]) {
	case "api":
		$api = new Api($db->get());
		$api->init($route);
		$api->render();
		break;
	case "backend":
		$admin = new Admin($db->get());
		$admin->authorize($route);
		$admin->render();
		break;
	case "clean":
		$x = Session::getInstance();
		$x->destroy();
		break;
	default:
		$app = new Main($db->get());
		$app->init($route);
		$app->render();
		break;
}


