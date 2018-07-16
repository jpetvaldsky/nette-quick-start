<?php
namespace Model;

use Nette\Utils\Strings;
use Tracy\Debugger;

class PositionType extends DefaultModel {

    protected $title;
    protected $abbreviation;
    protected $createDate;
    protected $modifyDate;
    protected $active;

    protected static $table = 'related_positionType';
	
    public static function create($db,$formData) 
    {	
        $active = 0;	
        if (key_exists('active',$formData)) {
            if ($formData['active'] == 1) $active = 1;
        }
        $values = array(
            'title%s' => $formData["title"],
            'abbreviation%s' => $formData["abbreviation"],
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
            'abbreviation%s' => $formData["abbreviation"],
            'modifyDate%sql' => 'NOW()',
            'active%i' => $active
        );
        $res = $db->query("UPDATE %n SET %a WHERE [id]=%i",static::$table,$values,$formData['id']);
		return true;
    }

}
