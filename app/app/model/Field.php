<?php
namespace Model;

use Nette\Utils\Strings;
use Tracy\Debugger;

class Field extends DefaultModel {

    protected $title;
    protected $optionalTitle;
    protected $order;
    
    protected $active;

    protected static $table = 'related_fields';
	
    public static function create($db,$formData) 
    {	
        $active = 0;	
        if (key_exists('active',$formData)) {
            if ($formData['active'] == 1) $active = 1;
        }

        if (!key_exists('optionalTitle',$formData)) {
            $formData['optionalTitle'] = '';
        }

        $values = array(
            'title%s' => $formData["title"],
            'optionalTitle%s' => $formData["optionalTitle"],
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
        if (!key_exists('optionalTitle',$formData)) {
            $formData['optionalTitle'] = '';
        }

        $values = array(
            'title%s' => $formData["title"],
            'optionalTitle%s' => $formData["optionalTitle"],
            'order%i' => $formData["order"],
            'modifyDate%sql' => 'NOW()',
            'active%i' => $active
        );
        $res = $db->query("UPDATE %n SET %a WHERE [id]=%i",static::$table,$values,$formData['id']);
		return true;
    }

}
