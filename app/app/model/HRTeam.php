<?php
namespace Model;

use Nette\Utils\Strings;
use Tracy\Debugger;

class HRTeam extends DefaultModel {

    protected $fullName;
    protected $position;
    protected $location;
    protected $motto;    
    protected $content;    
    protected $avatar;
    protected $linkedinURL;
    
    protected $active;
 

    protected static $table = 'content_hrTeam';
	
    public static function create($db,$formData) 
    {	
        $active = 0;	
        if (key_exists('active',$formData)) {
            if ($formData['active'] == 1) $active = 1;
        }
        $avatar = null;
        $avatar = ($formData["avatar"] == '') ? null:$formData["avatar"];        
        
        $values = array(
            'fullName%s' => $formData["fullName"],
            'position%s' => $formData["position"],
            'location%i' => $formData["location"],
            'motto%s' => $formData["motto"],
            'content%s' => $formData["content"],            
            'avatar%i' => $avatar,
            'linkedinURL%s' => $formData["linkedinURL"],                        
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

        $avatar = null;
        $avatar = ($formData["avatar"] == '') ? null:$formData["avatar"];        
        
        $values = array(
            'fullName%s' => $formData["fullName"],
            'position%s' => $formData["position"],
            'location%i' => $formData["location"],
            'motto%s' => $formData["motto"],
            'content%s' => $formData["content"],            
            'avatar%i' => $avatar,
            'linkedinURL%s' => $formData["linkedinURL"],
            'modifyDate%sql' => 'NOW()',
            'active%i' => $active
        );
        $res = $db->query("UPDATE %n SET %a WHERE [id]=%i",static::$table,$values,$formData['id']);
		return true;
    }

}
