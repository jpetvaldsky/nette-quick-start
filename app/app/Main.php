<?php

use Model\Media;

use Nette\Mail\Message;
use Nette\Mail\SendmailMailer;
use Nette\Utils\FileSystem;
use Nette\Utils\Strings;
use Tracy\Debugger;

class Main 	{

	private $connection;
	private $session;
	private $route;
	private $content;
	private $latte;


	public function __construct($db)
	{
		$this->connection = $db;
		$this->session = Session::getInstance();

		$this->latte = new Latte\Engine;
		$this->latte->setTempDirectory(ROOT_FOLDER.'/temp');

		$this->latte->addFilter('parsedown',function($input){
			$Parsedown = new Parsedown();
			return $Parsedown->text($input);
		});		

		$this->latte->addFilter('thumb', function($hash,$width=0,$height=0){			
			$file = Media::thumbnail($this->connection,$hash,$width,$height);			
			if ($file != null) {
				return '<img src="'.$file.'" >';
			}
			return '&nbsp;';
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


		$json = file_get_contents(ROOT_FOLDER.'/app/content.json');
		$this->content = json_decode($json);

		if ($this->content == null) {
			Debugger::dump("Invalid JSON !!!");
			exit;
		} else {
			//Debugger::barDump($this->content);
		}

		Debugger::barDump($_SESSION);

		$this->pageData = array(
			'flashes' => array(),
			'jsVersion' => '1.2.8',
			'json' => $this->content,
			'output' => '',
			'formData' => array()			
		);
		
	}


	public function init($route) {
		$this->route = $route;
		$this->template = "homepage";

		switch ($this->route[0]) {
			case "novinka":
				$newsDetail = false;
				if (count($this->route) > 1) {
					$newsRouteParam = explode("-",$this->route[1]);					
					if (Model\News::check($this->connection,$newsRouteParam[0])) {
						$this->pageData["newsItem"] = Model\News::getByID($this->connection,$newsRouteParam[0]);
						$this->template = "news";
					}
				}
				if (!$newsDetail) {
					$this->initHomepage();
				}
				break;
			case "detail-pozice":
				break;
			default:
				$this->initHomepage();
				break;
		}
	}

	private function initHomepage(){
		$this->getJobsData();
		$this->getNewsData();
		$this->getTeamData();
		$this->getFAQData();
		$this->getAboutData();
	}

	private function getJobsData(){
		$this->pageData["fields"] = Model\Field::getList($this->connection);
		
		$this->pageData["watchDog"] = true;
		$res = $this->connection->query('SELECT * FROM %n WHERE [active] = 1 ORDER BY [publishDate] DESC','content_jobPositions');
		$data = array();
		if (count($res) > 0) {
			$jp = $res->fetchAll();
			foreach ($jp as $job) {
				if ($job['hideOnExpire'] == 1) {
					if (strtotime($job['expireDate']) > time()) {
						array_push($data,$job);
					}
				} else {
					array_push($data,$job);
				}
			}
		}
		if (count($data) > 0) {
			$this->pageData["watchDog"] = false;
			$this->pageData["jobPositions"] = $data;
		}
		
	}

	private function getNewsData(){		
		$res = $this->connection->query('SELECT * FROM %n WHERE [active] = 1 ORDER BY [publishDate] DESC','content_news');
		$data = array();
		if (count($res) > 0) {
			$news = $res->fetchAll();
			foreach ($news as $item) {				
				array_push($data,$item);				
			}
		}
		if (count($data) > 0) {			
			$this->pageData["news"] = $data;
		}
		
	}

	private function getTeamData(){
		$teamMembers = \Model\HRTeam::getList($this->connection);
		$data = array();
		foreach ($teamMembers as $item) {		
			array_push($data,$item);
		}
		if (count($data) > 0) {
			$this->pageData["team"] = $data;
		}
	}

	private function getFAQData(){
		$faqBlocks = \Model\Faq::getList($this->connection);
		$data = array();
		foreach ($faqBlocks as $item) {		
			array_push($data,$item);
		}
		if (count($data) > 0) {
			$this->pageData["faq"] = $data;
		}
	}

	private function getAboutData(){
		$aboutBlocks = \Model\AboutSzif::getList($this->connection);
		$data = array();
		foreach ($aboutBlocks as $item) {		
			array_push($data,$item);
		}
		if (count($data) > 0) {
			$this->pageData["about"] = $data;
		}
	}


	public function render() {
		Debugger::barDump($this->template);
		if ($this->template == null){
			header("HTTP/1.0 404 Not Found");
			$this->latte->render('latte/error.latte');
		} else {
			$this->latte->render('latte/'.$this->template.'.latte', $this->pageData);
		}
	}
}
