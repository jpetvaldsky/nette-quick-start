<?php
namespace Model;

use Nette\Utils\Strings;
use Tracy\Debugger;

class Branch extends DefaultModel {

    protected $title;
    protected $address;
    protected $city;
    protected $region;
    protected $phoneNumber;
    protected $email;
    protected $photo;
    protected $createDate;
    protected $modifyDate;
    protected $active;

    protected static $table = 'related_branches';
	
    public static function create($db,$formData) 
    {	
        $active = 0;	
        if (key_exists('active',$formData)) {
            if ($formData['active'] == 1) $active = 1;
        }
        $values = array(
            'title%s' => $formData["title"],
            'address%s' => $formData["address"],
            'city%s' => $formData["city"],
            'region%i' => ($formData["region"] == '') ? null:$formData["region"],
            'phoneNumber%s' => $formData["phoneNumber"],
            'email%s' => $formData["email"],
            'photo%i' => ($formData["photo"] == '') ? null:$formData["photo"],
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
            'address%s' => $formData["address"],
            'city%s' => $formData["city"],
            'region%i' => ($formData["region"] == '') ? null:$formData["region"],
            'phoneNumber%s' => $formData["phoneNumber"],
            'email%s' => $formData["email"],
            'photo%i' => ($formData["photo"] == '') ? null:$formData["photo"],
            'modifyDate%sql' => 'NOW()',
            'active%i' => $active
        );
        $res = $db->query("UPDATE %n SET %a WHERE [id]=%i",static::$table,$values,$formData['id']);
		return true;
    }

}
