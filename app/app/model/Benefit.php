<?php
namespace Model;

use Nette\Utils\Strings;
use Tracy\Debugger;

class Benefit extends DefaultModel {

    protected $title;
    protected $content;
    protected $altContent;
    protected $icon;
    protected $order;
    
    protected $active;

    

    protected static $table = 'content_benefits';
	
    public static function create($db,$formData) 
    {	
        $active = 0;	
        if (key_exists('active',$formData)) {
            if ($formData['active'] == 1) $active = 1;
        }
        $iconID = null;
        $iconID = ($formData["icon"] == '') ? null:$formData["icon"];

        if (!key_exists("altContent",$formData))
            $formData["altContent"] = '';
        
        $values = array(
            'title%s' => $formData["title"],
            'content%s' => $formData["content"],
            'altContent%s' => $formData["altContent"],
            'icon%i' => $iconID,            
            'order%i' => $formData["order"],            
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
        $iconID = ($formData["icon"] == '') ? null:$formData["icon"];

        if (!key_exists("altContent",$formData))
            $formData["altContent"] = '';

        $values = array(
            'title%s' => $formData["title"],
            'content%s' => $formData["content"],
            'altContent%s' => $formData["altContent"],
            'icon%i' => $iconID,
            'order%i' => $formData["order"],
            'modifyDate%sql' => 'NOW()',
            'active%i' => $active
        );
        $res = $db->query("UPDATE %n SET %a WHERE [id]=%i",static::$table,$values,$formData['id']);
		return true;
    }

}
