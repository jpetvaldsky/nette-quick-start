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
			$Parsedown->setUrlsLinked(false);
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
					$routeParam = explode("-",$this->route[1]);					
					if (Model\News::check($this->connection,$routeParam[0])) {
						$newsDetail = true;
						$this->pageData["newsItem"] = Model\News::getByID($this->connection,$routeParam[0]);
						$this->template = "news";
					}
				}
				if (!$newsDetail) {
					$this->initHomepage();
				}
				break;			
			case "detail-pozice":
				$jobDetail = false;
				if (count($this->route) > 1) {
					$routeParam = explode("-",$this->route[1]);					
					if (Model\Position::check($this->connection,$routeParam[0])) {
						$jobDetail = true;
						$this->pageData["jobItem"] = Model\Position::getByID($this->connection,$routeParam[0]);
						$rb = $this->connection->query("SELECT * FROM [content_benefits] WHERE [active] = %i ORDER BY [order] ASC",1);
						if ($rb) {
							$this->pageData["benefits"] = $rb->fetchAll();
						}
						if ($this->pageData["jobItem"]["hrRandom"] == 1) {
							$hrPeople = Model\HRTeam::getList($this->connection);
							$randIndex = rand (0, count($hrPeople)-1);
							$this->pageData["recruiter"] = $hrPeople[$randIndex];
						} else {
							if ($this->pageData["jobItem"]["hrPersona"] != null) {
								if (Model\HRTeam::check($this->connection,$this->pageData["jobItem"]["hrPersona"])) {
									$this->pageData["recruiter"] = 	Model\HRTeam::getByID($this->connection,$this->pageData["jobItem"]["hrPersona"]);
								}
							}							
						}						
						$this->template = "job-detail";
					}
				}
				if (!$jobDetail) {
					$this->initHomepage();
				}
				break;	
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
		$this->pageData["locations"] = Model\Region::getList($this->connection);
		
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
