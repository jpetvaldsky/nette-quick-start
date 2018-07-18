<?php
namespace Model;

use Nette\Utils\FileSystem;
use Nette\Utils\Image;
use Nette\Utils\Strings;
use Tracy\Debugger;

class Media extends DefaultModel {

    
    
    protected $title;
    protected $mediaHash;
    protected $filename;
    protected $serverPath;
    protected $type;
    protected $filesize;
    protected $createDate;
    protected $modifyDate;

	protected static $table = 'media';
	
	
	public static function getByHash($db,$hash) 
    {
		$res = $db->query('SELECT * FROM %n WHERE [mediaHash]=%s',static::$table,$hash);
		if (count($res) > 0) {
			return $res->fetch();
		}
		return null;
	}

	public static function saveMediaFile($db,$uuid,$filename,$serverPath,$filesize,$title=''){
		$m = Media::getByHash($db,$uuid);
		if (file_exists(ROOT_FOLDER.$serverPath)) {
			$type = mime_content_type(ROOT_FOLDER.$serverPath);		
			$values = array (
				'title%s' => $title,
				'mediaHash%s' => $uuid,
				'filename%s' => $filename,
				'serverPath%s' => $serverPath,
				'type%s' => $type,
				'filesize%i' => $filesize,
				'createDate%sql' => 'NOW()',
			);
			if ($m == null) {
				try {
					$db->query("INSERT INTO %n",static::$table,$values);
					return $values;
				} catch (Exception $e) {
					return $e;
				}
			} else {
				$values['modifyDate%sql'] = 'NOW()';
				try {
					$db->query("UPDATE %n SET %a WHERE [mediaHash]=%s",static::$table,$values,$uuid);
					return $values;
				} catch (Exception $e) {
					return $e;
				}
			}
		}
	}

	public static function thumbnail($db,$hash,$width=0,$height=0) {
		$mediaFile = Media::getByHash($db,$hash);
		if (file_exists(ROOT_FOLDER.$mediaFile["serverPath"])) {
			FileSystem::createDir(ROOT_FOLDER.THUMB_FOLDER.$hash);
			$ext = 'jpg';
			$imageType = Image::JPEG;
			if ($mediaFile["type"] == "image/png") {
				$ext = 'png';
				$imageType = Image::PNG;
			}
			$filename = THUMB_FOLDER.$hash.'/'.$width.'x'.$height.'.'.$ext;
			$output = ROOT_FOLDER.$filename;
			if (!file_exists($output)) {
				$image = Image::fromFile(ROOT_FOLDER.$mediaFile["serverPath"]);
				$image->resize($width, $height,Image::FIT | Image::SHRINK_ONLY);
				$image->save($output, 90, $imageType);
			}
			return $filename;
		}
		return null;
	}

	public static function update($db,$id,$values) 
    {	
        $values['modifyDate%sql'] = 'NOW()';
        $res = $db->query("UPDATE %n SET %a WHERE [id]=%i",static::$table,$values,$id);
		return true;
	}
	
	public static function delete($db,$id) {
		$mediaFile = Media::getByID($db,$id);	
		if ($mediaFile != null) {			
			if (file_exists(ROOT_FOLDER.$mediaFile["serverPath"])) {				
				if (is_file(ROOT_FOLDER.$mediaFile["serverPath"])) {
					//FileSystem::delete(ROOT_FOLDER.$mediaFile["serverPath"]);
				}
			}
		}
		parent::delete($db,$id);
	}
}