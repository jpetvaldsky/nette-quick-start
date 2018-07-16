<?php
namespace Model;

use Nette\Utils\Strings;
use Tracy\Debugger;

class Region extends DefaultModel {

    protected $title;
    protected $mapIcon;
    protected $createDate;
    protected $modifyDate;
    protected $active;

    protected static $table = 'related_regions';
	
    public static function create($db,$formData) 
    {	
        $active = 0;	
        if (key_exists('active',$formData)) {
            if ($formData['active'] == 1) $active = 1;
        }
        $values = array(
            'title%s' => $formData["title"],
            'mapIcon%s' => ($formData["mapIcon"] == '') ? null:$formData["mapIcon"],
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
            'mapIcon%s' => ($formData["mapIcon"] == '') ? null:$formData["mapIcon"],
            'modifyDate%sql' => 'NOW()',
            'active%i' => $active
        );
        $res = $db->query("UPDATE %n SET %a WHERE [id]=%i",static::$table,$values,$formData['id']);
		return true;
    }

}
