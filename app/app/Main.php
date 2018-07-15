<?php

use Model\Applicant;
use Model\Service;
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
			default:
				break;
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
