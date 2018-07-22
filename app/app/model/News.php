<?php
namespace Model;

use Nette\Utils\Strings;
use Tracy\Debugger;

class News extends DefaultModel {

    protected $title;
    protected $location;
    protected $publishDate;
    protected $perex;
    protected $content;
    protected $author;
    protected $authorPosition;
    protected $thumbnail;
    protected $background;

    protected $active;

    protected static $table = 'content_news';
	
    public static function create($db,$formData) 
    {	
        $active = 0;	
        if (key_exists('active',$formData)) {
            if ($formData['active'] == 1) $active = 1;
        }
        $iconID = null;
        $iconID = ($formData["thumbnail"] == '') ? null:$formData["thumbnail"];

        $backgroundID = null;
        $backgroundID = ($formData["background"] == '') ? null:$formData["background"];
        
        $values = array(
            'title%s' => $formData["title"],
            'location%s' => $formData["location"],
            'publishDate%d' => $formData["publishDate"],
            'perex%s' => $formData["perex"],
            'content%s' => $formData["content"],
            'author%s' => $formData["author"],
            'authorPosition%s' => $formData["authorPosition"],
            'thumbnail%i' => $iconID,
            'background%i' => $backgroundID,
            'createDate%sql' => 'NOW()',
            'active%i' => $active
        );
        $ins = $db->query("INSERT INTO %n",static::$table,$values);
		return true;
    }
    
    public static function update($db,$formData) 
    {	
        $active = 0;	
        if (key_exists('active',$formData)) {
            if ($formData['active'] == 1) $active = 1;
        }

        $iconID = null;
        $iconID = ($formData["thumbnail"] == '') ? null:$formData["thumbnail"];

        $backgroundID = null;
        $backgroundID = ($formData["background"] == '') ? null:$formData["background"];
        
        $values = array(
            'title%s' => $formData["title"],
            'location%s' => $formData["location"],
            'publishDate%d' => $formData["publishDate"],
            'perex%s' => $formData["perex"],
            'content%s' => $formData["content"],
            'author%s' => $formData["author"],
            'authorPosition%s' => $formData["authorPosition"],
            'thumbnail%i' => $iconID,
            'background%i' => $backgroundID,
            'modifyDate%sql' => 'NOW()',
            'active%i' => $active
        );
        $res = $db->query("UPDATE %n SET %a WHERE [id]=%i",static::$table,$values,$formData['id']);
		return true;
    }

}
