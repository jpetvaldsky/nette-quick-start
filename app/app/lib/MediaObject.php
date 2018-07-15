<?php

use Nette\Utils\FileSystem;
use Nette\Utils\Image;
use Tracy\Debugger;

class MediaObject
{
    private $connection;
    private $filename;
    private $type;
    private $filesize;


	public function __construct($db)
	{        
        $this->connection = $db;
    }
    
}