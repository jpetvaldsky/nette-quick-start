<?php
use Tracy\Debugger;

class Admin 	{

	private $connection;
	private $session;
	private $latte;

	private $password;
	private $salt;
	private $template = "login";

	public function __construct($db)
	{
		$this->connection = $db;

		$this->session = Session::getInstance();
		$this->latte = new Latte\Engine;
		$this->latte->setTempDirectory(ROOT_FOLDER.'/temp');


		$this->password = "845fd556c7b6248462317a5cfd70558b383083ab";//"EiQh3ef6yY";
		$this->salt = "Hrozne slozity salt na to aby neslo prolomit heslo";

		$this->pageData = array(
			'flashes' => array(),
		 	'output' => '',
			'json' => '',
			'jsVersion' => '1.3.1'
		);
	}

	public function authorize($route) {
		if (count($route) == 1) $route[1] = null;
		if ($this->authorizedUser())
		{
			$this->init($route);
		}
	}

	private function init($route){
		$this->template = "dashboard";
		/*
		if ($route[1] == "detail" && count($route) > 2){
			$this->getUserDetail($route[2]);
		} else {
			$this->template = "list";
			$this->pageData["renew"] = false;
			$userResult = $this->connection->query("
				SELECT u.id as userID, u.email, u.email_is_valid, u.validation_date, p.*
				FROM [user] as u
					LEFT JOIN [contestant_profile] as p ON p.user_id = u.id
				ORDER BY [u.id] ASC");

			if ($userResult) {
				$users = $userResult->fetchAll();
				Debugger::barDump($users);
				$this->pageData["users"] = $this->composeUserData($users);

				//TODO: ADD EXPORT TO CSV FEATURE
				if ($route[1] == "export-data") {
					$this->pageData["flashes"][] = array('type' => 'flash-message-info', 'message' => 'All user data export to file succesfully.');
					$this->exportUserData();
				}
			}

		}*/
	}

	private function authorizedUser(){
		if (isset($_POST)){
			if (isset($_POST["password"])) {
				$p = sha1($_POST["password"].$this->salt);
				if ($p == $this->password) {
					$this->session->adminAuthorized = true;
					return true;
				}
			}
		}
		if ($this->session->adminAuthorized == true) return true;
		return false;
	}

	public function render() {
		$this->latte->render('latte/backend/'.$this->template.'.latte', $this->pageData);
	}
}
