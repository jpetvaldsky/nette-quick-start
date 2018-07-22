<?php
namespace Model;

use Nette\Utils\Strings;
use Tracy\Debugger;

class Position extends DefaultModel {

    protected $title;
    protected $subtitle;
    protected $branch;
    protected $field;
    protected $publishDate;
    protected $expireDate;
    protected $hideOnExpire;
    protected $type;
    protected $salary;
    protected $content;
    protected $requirements;
    protected $hrPersona;
    protected $hrRandom;
    protected $positionURL;
        
    protected $active;


    protected static $table = 'content_jobPositions';
	
    public static function create($db,$formData) 
    {	
        $active = 0;	
        if (key_exists('active',$formData)) {
            if ($formData['active'] == 1) $active = 1;
        }

        $hide = 0;
        if (key_exists('hideOnExpire',$formData)) {
            if ($formData['hideOnExpire'] == 1) $hide = 1;
        }

        $random = 0;
        if (key_exists('hrRandom',$formData)) {
            if ($formData['hrRandom'] == 1) $random = 1;
        }        
       
        $pDate = null;
        if ($formData["publishDate"] != ''){
            $pDate = \DateTime::createFromFormat('j.n.Y', $formData["publishDate"])->format('Y-m-d');            
        }
        
        $eDate = null;
        if ($formData["expireDate"] != ''){
            $eDate = \DateTime::createFromFormat('j.n.Y', $formData["expireDate"])->format('Y-m-d');
        }

        $values = array(
            'title%s' => $formData["title"],
            'subtitle%s' => $formData["subtitle"],
            'field%i' => ($formData["field"] == '') ? null:$formData["field"],
            'branch%i' => ($formData["branch"] == '') ? null:$formData["branch"],
            'publishDate%s' => $pDate,
            'expireDate%d' => $eDate,
            'hideOnExpire%i' => $hide,
            'type%i' => ($formData["type"] == '') ? null:$formData["type"],
            'salary%s' => $formData["salary"],
            'content%s' => $formData["content"],
            'requirements%s' => $formData["requirements"],
            'hrPersona%i' => ($formData["hrPersona"] == '') ? null:$formData["hrPersona"],
            'hrRandom%i' => $random,
            'positionURL%s' => $formData["positionURL"],
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

        $hide = 0;
        if (key_exists('hideOnExpire',$formData)) {
            if ($formData['hideOnExpire'] == 1) $hide = 1;
        }

        $random = 0;
        if (key_exists('hrRandom',$formData)) {
            if ($formData['hrRandom'] == 1) $random = 1;
        }        

        $pDate = null;
        if ($formData["publishDate"] != ''){
            $pDate = \DateTime::createFromFormat('j.n.Y', $formData["publishDate"])->format('Y-m-d');            
        }
        
        $eDate = null;
        if ($formData["expireDate"] != ''){
            $eDate = \DateTime::createFromFormat('j.n.Y', $formData["expireDate"])->format('Y-m-d');
        }
        
        
        $values = array(
            'title%s' => $formData["title"],
            'subtitle%s' => $formData["subtitle"],
            'field%i' => ($formData["field"] == '') ? null:$formData["field"],
            'branch%i' => ($formData["branch"] == '') ? null:$formData["branch"],
            'publishDate%s' => $pDate,
            'expireDate%d' => $eDate,
            'hideOnExpire%i' => $hide,
            'type%i' => ($formData["type"] == '') ? null:$formData["type"],
            'salary%s' => $formData["salary"],
            'content%s' => $formData["content"],
            'requirements%s' => $formData["requirements"],
            'hrPersona%i' => ($formData["hrPersona"] == '') ? null:$formData["hrPersona"],
            'hrRandom%i' => $random,
            'positionURL%s' => $formData["positionURL"],
            'modifyDate%sql' => 'NOW()',
            'active%i' => $active
        );
        $res = $db->query("UPDATE %n SET %a WHERE [id]=%i",static::$table,$values,$formData['id']);
		return true;
    }

}
