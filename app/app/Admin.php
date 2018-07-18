<?php


use Admin\BranchModul;
use Admin\MediaModul;
use Admin\PositionTypeModul;
use Admin\RegionModul;
use Admin\UserModul;

use Model\User;
use Model\Media;

use Tracy\Debugger;

class Admin 	{

	private $connection;
	private $session;
	private $editor;
	private $latte;

	private $password;
	private $role;	
	private $template = "login";
	private $user;

	public function __construct($db)
	{
		$this->connection = $db;

		$this->session = Session::getInstance();
		$this->latte = new Latte\Engine;
		$this->latte->setTempDirectory(ROOT_FOLDER.'/temp');

		$this->latte->addFilter('thumb', function($hash,$width=0,$height=0){			
			$file = Media::thumbnail($this->connection,$hash,$width,$height);
			if ($file != null) {
				return '<img src="'.$file.'" >';
			}
			return '-- error --';
		});


		$this->password = "845fd556c7b6248462317a5cfd70558b383083ab";//"EiQh3ef6yY";
		$this->salt = "Hrozne slozity salt na to aby neslo prolomit heslo";

		$this->pageData = array(
			'flashes' => array(),
			'flashMessages' => null,
		 	'output' => '',
			'json' => '',
			'jsVersion' => '1.3.1',
			'basePath' => '/backend',
			'superAdmin' => false,
			'section' => '',
			'newItem' => false,
			'user' => null,
			'pages' => array(
				array('link' => '', 'icon' => 'icon-home','title'=>'Úvodní strana')
			)
		);
	}

	public function authorize($route) {
		if (count($route) == 1) $route[1] = "";

		
		if ($this->authorizedUser())
		{
			$this->pageData["user"] = $this->user;
			if ($this->user->role == "superadmin") {
				$this->pageData["superAdmin"] = true;
			}
			
			$this->init($route);
		}
	}

	private function init($route){	
		$this->template = "dashboard";
		$this->pageData['section'] = 'homepage';
		if (count($route) > 1) {
			switch ($route[1]) {
				case "volne-pozice":
					break;				
				case "odhlasit-se":
					$this->session->destroy();
					$this->template = "login";
					break;
			}
			
			if ($this->user->role == "superadmin") {
				switch ($route[1]) {
					case "typy-pozic":
						$this->pageData['section'] = 'position-type';
						$this->editor = new PositionTypeModul($this->connection);
						$this->editor->init($this->template,$this->pageData,$route);
						break;
					case "pobocky":
						$this->pageData['section'] = 'branches';
						$this->editor = new BranchModul($this->connection);
						$this->editor->init($this->template,$this->pageData,$route);
						break;
					case "kraje":
						$this->pageData['section'] = 'regions';
						$this->editor = new RegionModul($this->connection);
						$this->editor->init($this->template,$this->pageData,$route);
						break;
					case "media":
						$this->pageData['section'] = 'media';
						$this->editor = new MediaModul($this->connection);
						$this->editor->init($this->template,$this->pageData,$route);
						break;
					case "uzivatele":
						$this->pageData['section'] = 'users';
						$this->editor = new UserModul($this->connection);
						$this->editor->init($this->template,$this->pageData,$route);
						break;
				}
			}
		}
	}


	private function authorizedUser(){
		if (isset($_POST)){
			if (key_exists('username',$_POST) && key_exists('password',$_POST)) {
				$userData = User::authorize($this->connection,$_POST['username'],$_POST['password']);				
				if ($userData != null){
					$this->user = new User($this->connection,$userData["id"]);
					$this->sessionInit();
				}
			}
		}
		if ($this->session->adminAuthorized == true) {
			if ($this->user == null) {
				$this->user = new User($this->connection,$this->session->adminID);
			}
			return true;
		}
		return false;
	}


	private function sessionInit(){
		$this->session->adminID = $this->user->id;
		$this->session->adminAuthorized = true;				
		$this->session->adminRole = $this->user->role;		
	}

	public function render() {
		if (count($this->pageData['flashes']) > 0) {
			$this->pageData['flashMessages'] = $this->pageData['flashes'];
		}
		$this->latte->render('latte/backend/'.$this->template.'.latte', $this->pageData);
	}
}
