<?php
namespace Model;

use Nette\Utils\Strings;
use Tracy\Debugger;

class AboutSzif extends DefaultModel {

    protected $headline;
    protected $content;
    protected $icon;
    protected $order;
    protected $createDate;
    protected $modifyDate;
    protected $active;

    protected static $table = 'content_company';
	
    public static function create($db,$formData) 
    {	
        $active = 0;	
        if (key_exists('active',$formData)) {
            if ($formData['active'] == 1) $active = 1;
        }
        $iconID = null;
        $iconID = ($formData["icon"] == '') ? null:$formData["icon"];
        
        $values = array(
            'headline%s' => $formData["headline"],
            'content%s' => $formData["content"],
            'photo%i' => $photoID,            
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

        $values = array(
            'headline%s' => $formData["headline"],
            'content%s' => $formData["content"],
            'photo%i' => $photoID,
            'order%i' => $formData["order"],
            'modifyDate%sql' => 'NOW()',
            'active%i' => $active
        );
        $res = $db->query("UPDATE %n SET %a WHERE [id]=%i",static::$table,$values,$formData['id']);
		return true;
    }

}
