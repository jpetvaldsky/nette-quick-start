<?php
namespace Model;

use Nette\Utils\Strings;
use Tracy\Debugger;

class User extends DefaultModel {

	protected $username;	
	protected $fullName;
	protected $email;
	protected $role;
	
	protected $active;

	protected static $table = 'user';

	public static function authorize($db,$u,$p){
		$res = $db->query('SELECT * FROM %n WHERE [username] = %s',static::$table,$u);
		if (count($res) > 0) {
			$userData = $res->fetch();
			Debugger::barDump($userData);
			Debugger::barDump(password_verify($p,$userData['password']));
			if (password_verify($p,$userData['password']) && $userData["active"] == 1) {
				return $userData;
			}
		}
		return null;
	}
}
