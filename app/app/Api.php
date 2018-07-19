<?php

use Model\Media;
use Tracy\Debugger;

class Api {

	private $connection;
	private $output;
	private $media;

	public function __construct($db)
	{
		$this->output = array();
		$this->connection = $db;
		
	}

	public function init($route) {
		$this->output["route"] = $route;
		switch ($route[1]){
			case "job-positions":
				$positions = \Model\Position::getList($this->connection);				
				$output = $this->parsePositionOutput($positions);
				exit;
				break;
			case  "upload-media":
				$result = $this->handleUploadFile();
				if ($result["success"])
					$this->saveMediaFileToDatabase($result);
				break;
			case "upload-media-chunksdone":
				$result = $this->finishUpload();
				if ($result["success"])
					$this->saveMediaFileToDatabase($result);
				break;
			case "store-media-file":
				$this->output = $_POST;
				//$this->media->checkMediaFile($_POST['uuid'],"image");
				//$this->applicant->saveMediaFile($_POST['applicantID'],$_POST['fieldID'],$_POST['uuid']);
				break;
			case "test-call":
				$this->output["response"] = "Test works fine...";
				break;
			default:
				$this->output["response"] = "Hi there, API is working...";
				break;
		}
	}

	/* MEDIA UPLOAD */

	private function saveMediaFileToDatabase($result){
		if ($result["success"]){			
			$filename = $_POST["qqfilename"];
			$filesize = $_POST["qqtotalfilesize"];
			$serverPath = '/upload/'.$result["uuid"].'/'.$_POST["qqfilename"];
			$this->output["mediaResult"] = Media::saveMediaFile($this->connection,$result["uuid"],$filename,$serverPath,$filesize);
		}
	}

	public function handleUploadFile($limitExt=array("jpeg", "jpg", "png", "gif","pdf")) {
		$uploader = new \UploadHandler();
		$uploader->allowedExtensions = $limitExt;
		$uploader->sizeLimit = null;		
		$uploader->chunksFolder = ROOT_FOLDER . '/upload/chunks';
		$result = $uploader->handleUpload(ROOT_FOLDER . '/upload/');
		$this->output = $result;
		$this->output['debugMsg'] = 'Handle upload file...';
		return $result;	
	}

	public function finishUpload($limitExt=array("jpeg", "jpg", "png", "gif","pdf")) {
		$uploader = new \UploadHandler();
		$uploader->allowedExtensions = $limitExt;
		$uploader->chunksFolder = ROOT_FOLDER . '/upload/chunks';
		$result = $uploader->combineChunks(ROOT_FOLDER . '/upload/');
		$this->output = $result;
		$this->output['debugMsg'] = 'Chunks Done.';
		return $result;
	}	

	public function render() {
		header('Content-Type: application/json');
		echo json_encode($this->output);
	}

	private function parsePositionsOutput($data) {
		
	}
}
