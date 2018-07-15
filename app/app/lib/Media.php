<?php

use Nette\Utils\FileSystem;
use Nette\Utils\Image;
use Tracy\Debugger;

class Media
{
    private $connection;

    public function __construct($db)
	{
        $this->connection = $db;
    }

    public function saveMediaFile($uuid,$filename,$serverPath,$type,$filesize){
        $values = array (
            'fileHash%s' => $uuid,
            'originalFilename%s' => $filename,
            'serverPath%s' => $serverPath,
            'type%s' => $type,
            'filesize%i' => $filesize,
            'createDate%sql' => 'NOW()',
        );
        try {
            $this->connection->query("INSERT INTO [media]",$values);
            return $values;
        } catch (Exception $e) {
            return $e;
        }
    }

    public function getByID($id){
        $res = $this->connection->query("SELECT * FROM [media] WHERE [id%i]",$id);
        if ($res) {
            if (count($res) > 0) {
                $mediaFile = $res->fetch();                
            }
        }
        return null;
    }

    public function getByHash($hash){
        $res = $this->connection->query("SELECT * FROM [media] WHERE [fileHash%i]",$hash);
        if ($res) {
            if (count($res) > 0) {
                $mediaFile = $res->fetch();                
            }
        }
        return null;
    }

}