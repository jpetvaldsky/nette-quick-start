<?php
namespace Model;

use Tracy\Debugger;

class DefaultModel {

	protected $connection;

	protected $id;
	
	protected $createDate;
	protected $modifyDate;
	
    protected $tableName;

    protected static $table;


	public function __construct($db,$id)
 	{
		$this->connection = $db;
        $this->id = $id;
        $this->tableName = static::$table;
		$this->init();
	}

	public function __get($property) {
		if (property_exists($this, $property)) {
		  return $this->$property;
		}
	}
	
	public function __set($property, $value) {
		if (property_exists($this, $property)) {
			$this->$property = $value;
		}

		return $this;
	}

	private function init(){
		$res = $this->connection->query('SELECT * FROM %n WHERE [id] = %i',$this->tableName,$this->id);
		if (count($res) > 0) {
            $data = $res->fetch();
            foreach ($data as $key => $value) {
                $this->$key = $value;
            }			
		}
    }
    
    public static function check($db,$id) {
        $res = $db->query('SELECT * FROM %n WHERE [id] = %i',static::$table,$id);
		if (count($res) > 0) {
            return true;		
        }
        return false;
	}

	public static function getAttr($db,$id,$attribute="title") {
		if ($id != '') {
			$data = self::getByID($db,$id);
			if (key_exists($attribute,$data)) {
				return $data[$attribute];
			}
		}
		return $id;
	}
	
	public static function getByID($db,$id) {
        $res = $db->query('SELECT * FROM %n WHERE [id] = %i',static::$table,$id);
		if (count($res) > 0) {
            return $res->fetch();		
        }
        return null;
    }

	public static function getList($db) 
    {        
		$res = $db->query('SELECT * FROM %n ORDER BY [id] ASC',static::$table);
		if (count($res) > 0) {
			return $res->fetchAll();
		}
		return  null;
	}

    public static function delete($db,$id) 
    {	
		$res = $db->query('SELECT * FROM %n WHERE [id] = %i',static::$table,$id);
		if (count($res) > 0) {
			$del = $db->query('DELETE FROM %n WHERE [id] = %i',static::$table,$id);
			return true;
		}
		return  null;
    }
}
