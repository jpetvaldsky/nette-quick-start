<?php
namespace Model;

use Nette\Utils\Strings;
use Tracy\Debugger;

class Faq extends DefaultModel {

    protected $title;
    protected $content;
    protected $infographicsID;
    protected $order;
    
    protected $active;

    protected static $table = 'content_faq';
	
    public static function create($db,$formData) 
    {	
        $active = 0;	
        if (key_exists('active',$formData)) {
            if ($formData['active'] == 1) $active = 1;
        }
        
        $values = array(
            'title%s' => $formData["title"],
            'content%s' => $formData["content"],
            'infographicsID%s' => $formData["infographicsID"],            
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
        
        $values = array(
            'title%s' => $formData["title"],
            'content%s' => $formData["content"],
            'infographicsID%s' => $formData["infographicsID"],
            'order%i' => $formData["order"],
            'modifyDate%sql' => 'NOW()',
            'active%i' => $active
        );
        $res = $db->query("UPDATE %n SET %a WHERE [id]=%i",static::$table,$values,$formData['id']);
		return true;
    }

}
