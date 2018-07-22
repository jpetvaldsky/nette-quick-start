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
		$this->logValues(array('value%s' => 'ROUTE: '.json_encode($route)));
		//$this->logValues(array('value%s' => 'GET: '.json_encode($_GET)));
		$this->logValues(array('value%s' => 'POST: '.json_encode($_POST)));

		$this->output["route"] = $route;
		switch ($route[1]){
			case "job-positions":
				$positions = \Model\Position::getList($this->connection);				
				$output = $this->parsePositionOutput($positions);
				break;
			case  "upload-media":
				$result = $this->handleUploadFile();
				$chunkUpload = false;
				if (key_exists('qqtotalparts',$_POST)) {
					if ($_POST['qqtotalparts'] > 0) {
						$chunkUpload = true;
					}
				}
				if ($result["success"] && !$chunkUpload) {
					$this->logValues(array('value%s' => 'SAVE ON UPLOAD'));
					$this->saveMediaFileToDatabase($result);
				}
				break;
			case "upload-media-chunksdone":
				$result = $this->finishUpload();
				if ($result["success"]) {
					$this->logValues(array('value%s' => 'SAVE ON CHUNK UPLOAD DONE'));
					$this->saveMediaFileToDatabase($result);
				}
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
		$this->logValues(array('value%s' => 'UPLOAD RESULT:'.json_encode($result)));
		if ($result["success"]){
			$filename = $_POST["qqfilename"];
			$filesize = $_POST["qqtotalfilesize"];
			$serverPath = '/upload/'.$result["uuid"].'/'.$_POST["qqfilename"];

			$updated = false;
			if (key_exists('id',$_POST)) {
				$mediaID = 0;
				if ($_POST["id"] != '') $mediaID = $_POST['id']+0;
				if ($mediaID > 0) {
					if (Media::check($this->connection,$_POST["id"])) {
						$this->logValues(array('value%s' => 'MEDIA EXISTS, NEED UPDATE'));
						$updated = true;
						$this->output["mediaResult"] = Media::updateMediaFile($this->connection,$_POST["id"],$result["uuid"],$filename,$serverPath,$filesize);
					}
				}
			}

			if (!$updated) {
				$this->logValues(array('value%s' => 'MEDIA NOT FOUND, INSERT NEW'));
				$this->output["mediaResult"] = Media::saveMediaFile($this->connection,$result["uuid"],$filename,$serverPath,$filesize);
			}
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

	private function parsePositionOutput($data) {
		return '';
	}

	private function logValues($v){
		$v['createDate%sql'] = 'NOW()';
		$this->connection->query("INSERT INTO [test]",$v);
	}
}
