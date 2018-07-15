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
require 'app/Main.php';
require 'app/Api.php';
require 'app/Admin.php';

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
