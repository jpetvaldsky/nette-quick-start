<?php

use Model\Applicant;
use Model\Service;
use Tracy\Debugger;

class Api {

	private $connection;
	private $output;
	private $service;
	private $applicant;
	private $media;

	public function __construct($db)
	{
		$this->output = array();
		$this->connection = $db;
		$this->applicant = new Applicant($db);
		$this->media = new Media($db);
		$this->service = new Service($db);
	}

	public function init($route) {
		$this->output["route"] = $route;
		switch ($route[1]){
			case  "upload-image":
				$this->handleUploadImage();
				break;
			case "upload-image-chunksdone":
				$result = $this->finishImageUpload();				
				if ($result["success"]){
					$filename = $_POST["qqfilename"];
					$filesize = $_POST["qqtotalfilesize"];
					$serverPath = '/upload/images/'.$result["uuid"].'/'.$_POST["qqfilename"];
					$this->output["mediaResult"] = $this->media->saveMediaFile($result["uuid"],$filename,$serverPath,"image",$filesize);
					
				}
				//{"success":true,"uuid":"94013205-b388-4993-82f1-2570ecb2e623","post":{"qquuid":"94013205-b388-4993-82f1-2570ecb2e623","qqfilename":"0.jpeg","qqtotalfilesize":"9302"}
				break;
			case "store-media-file":
				$this->output = $_POST;
				$this->applicant->saveMediaFile($_POST['applicantID'],$_POST['fieldID'],$_POST['uuid']);
				break;
			case "test-call":
				$this->output["response"] = "Test works fine...";
				break;
			default:
				$this->output["response"] = "Hi there, API is working...";
				break;
		}
	}

	public function handleUploadImage() {
		$uploader = new \UploadHandler();
		$uploader->allowedExtensions = array("jpeg", "jpg", "png", "gif","pdf");
		$uploader->sizeLimit = null;		
		$uploader->chunksFolder = ROOT_FOLDER . '/upload/chunks';
		$result = $uploader->handleUpload(ROOT_FOLDER . '/upload/images');
		$this->output = $result;
		return $result;	
	}

	public function finishImageUpload() {
		$uploader = new \UploadHandler();
		$uploader->allowedExtensions = array();
		$uploader->chunksFolder = ROOT_FOLDER . '/upload/chunks';
		$result = $uploader->combineChunks(ROOT_FOLDER . '/upload/images');
		$this->output = $result;		
		return $result;
	}

	public function render() {
		header('Content-Type: application/json');
		echo json_encode($this->output);
	}
}
