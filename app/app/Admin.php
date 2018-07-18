<?php

use Admin\AboutSzifModul;
use Admin\BenefitModul;
use Admin\BranchModul;
use Admin\FaqModul;
use Admin\FieldModul;
use Admin\HRTeamModul;
use Admin\MediaModul;
use Admin\PositionModul;
use Admin\PositionTypeModul;
use Admin\RegionModul;
use Admin\UserModul;

use Model\AboutSzif;
use Model\Benefit;
use Model\Branch;
use Model\Faq;
use Model\Field;
use Model\HRTeam;
use Model\Position;
use Model\PositionType;
use Model\Region;
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

		$this->registerFilters();


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
					$this->pageData['section'] = 'positions';
					$this->editor = new PositionModul($this->connection);
					$this->editor->init($this->template,$this->pageData,$route);
					break;
				case "odhlasit-se":
					$this->session->destroy();
					$this->template = "login";
					break;
			}
			
			if ($this->user->role == "superadmin") {
				switch ($route[1]) {					
					case "hr-team":
						$this->pageData['section'] = 'hr-team';
						$this->editor = new HRTeamModul($this->connection);
						$this->editor->init($this->template,$this->pageData,$route);
						break;
					case "faq":
						$this->pageData['section'] = 'faq';
						$this->editor = new FaqModul($this->connection);
						$this->editor->init($this->template,$this->pageData,$route);
						break;
					case "o-szifu":
						$this->pageData['section'] = 'about';
						$this->editor = new AboutSzifModul($this->connection);
						$this->editor->init($this->template,$this->pageData,$route);
						break;
					case "benefity":
						$this->pageData['section'] = 'benefit';
						$this->editor = new BenefitModul($this->connection);
						$this->editor->init($this->template,$this->pageData,$route);
						break;
					case "obory":
						$this->pageData['section'] = 'fields';
						$this->editor = new FieldModul($this->connection);
						$this->editor->init($this->template,$this->pageData,$route);
						break;
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
				Debugger::barDump($userData);
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

	/* FILTERS */
	private function registerFilters() {
		//THUMBNAIL
		$this->latte->addFilter('thumb', function($hash,$width=0,$height=0){			
			$file = Media::thumbnail($this->connection,$hash,$width,$height);
			if ($file != null) {
				return '<img src="'.$file.'" >';
			}
			return '&nbsp;';
		});

		//RELATED CONTENT
		$this->latte->addFilter('relatedContent', function($model,$selected=null){			
			$data = call_user_func(array($model,'getList'),$this->connection);
			Debugger::barDump($data);
			if (count($data) > 0) {
				$output = '';
				foreach ($data as $item) {
					$titleValue = '';
					if (key_exists('title',$item)) $titleValue = $item['title'];
					if (key_exists('fullName',$item)) $titleValue = $item['fullName'];

					if ($item["id"] == $selected) {
						$output .= '<option selected="selected" value="'.$item["id"].'">'.$titleValue.'</option>';
					} else {
						$output .= '<option value="'.$item["id"].'">'.$titleValue.'</option>';
					}
				}
				return $output;
			}
			return null;
		});

		//GET OBJECT ATTRIBUTE
		$this->latte->addFilter('getAttr', function($id,$model,$attribute="title") {
			if ($id != '') {
				$data = call_user_func(array($model,'getByID'),$this->connection,$id);
				if (key_exists($attribute,$data)) {
					return $data[$attribute];
				}
			}
			return $id;
		});
	}
}
