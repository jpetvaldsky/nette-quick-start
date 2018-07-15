<?php
namespace Model;

use Nette\Utils\Strings;
use Tracy\Debugger;

class Users 	{

	private $connection;

	public function __construct($db)
 	{
		$this->connection = $db;
	}

	public function getUserSkills($userID) {
		$skills = $this->connection->query(
				"SELECT c.name, ls.skill_id FROM [link_skills] as ls
				LEFT JOIN [skills] as c ON c.id = ls.skill_id
				WHERE [user_id] = %i ORDER BY c.order",$userID);
		if (count($skills) > 0) {
			return $skills->fetchAll();
		} else {
			return null;
		}
	}

	public function getUserCompetences($userID) {
		$competences = $this->connection->query(
				"SELECT c.name, lc.competence_id FROM [link_competence] as lc
				LEFT JOIN [competence] as c ON c.id = lc.competence_id
				WHERE [user_id] = %i ORDER BY c.order",$userID);
		if (count($competences) > 0) {
			return $competences->fetchAll();
		} else {
			return null;
		}
	}


	public function applyForCompetition($data,$fileCV=null,$filePhoto=null) {
		$u = $this->getUserByEmail($data["email"]);
		Debugger::barDump($u);
		if ($u != null) {
			$p = $this->getUserProfile($u["id"]);
			if ($p == null) {
				$values = array(
					'user_id%i' => $u["id"],
					'first_name%s' => $data["first-name"],
					'last_name%s' => $data["last-name"],
          'gsm%s' => $data["gsm"],
					'age%i' => $data["age"],
					'gender%s' => $data["gender"],
					'legal_entity%s' => $data["legal-entity"],
          'country%s' => $data["country"],
          'team-participants%s' => $data["team-participants"],
          'new-ideas%s' => $data["new-ideas"],
          'new-function%s' => $data["new-function"],
          'future-vision%s' => $data["future-vision"],
          'hackathon-attend%s' => $data["hackathon-attend"],
          'english_level%s' => $data["english_level"],
					'submission_date%sql' => 'NOW()'
				);

				if ($fileCV != null) {
					$values['cv_filename%s'] = $fileCV["cv_filename"];
					$values['cv_filestorage%s'] = $fileCV["cv_filestorage"];
				}

        if ($filePhoto != null) {
            $values['photo_filename%s'] = $filePhoto["photo_filename"];
            $values['photo_filestorage%s'] = $filePhoto["photo_filestorage"];
        }

				$p = $this->createUserProfile($u["id"],$values);
				if ($p !== null) {

					$insertCompetence = $this->connection->query("INSERT INTO [link_competence]",array('user_id%i' =>  $u["id"], 'competence_id' => $data["competence"]));
                    if ($insertCompetence == null) {
                        Debugger::barDump("Insert Error");
                    }

                    $this->setProfileSkills($data["skills"],$u["id"]);

					$this->update($u["id"],array('disclaimer_competition_accepted%i' => 1, 'disclaimer_competition_accept_date%sql' => 'NOW()' ));
					return $u["id"];
				}
			}
		}
		return false;
	}

	private function setProfileSkills($skills,$id) {
		foreach ($skills as $skillID) {
			$insertSkill = $this->connection->query("INSERT INTO [link_skills]",array('user_id%i' =>  $id, 'skill_id' => $skillID));
		}
	}

	public function createUserProfile($id,$data) {
		$u = $this->getUserProfile($id);
		if ($u === null)
		{
			$ins = $this->connection->query("INSERT INTO [contestant_profile]",$data);
			if ($ins)
			{
				return $this->getUserProfile($id);
			}
		}
		return $u;
	}

	public function getUserProfile($id) {
		$user = $this->connection->query("SELECT * FROM [contestant_profile] WHERE [user_id]=%s",$id);
		if (count($user) > 0)
		{
			return $user->fetch();
		}
		return null;
	}

	public function getUserByEmail($email) {
		$user = $this->connection->query("SELECT * FROM [user] WHERE [email]=%s",Strings::lower($email));
		if (count($user) > 0)
		{
			return $user->fetch();
		}
		return null;
	}

	public function getUserByHash($hash) {
		$user = $this->connection->query("SELECT * FROM [user] WHERE [auth_hash]=%s",$hash);
		if (count($user) > 0)
		{
			return $user->fetch();
		}
		return null;
	}

	public function create($email)
	{
		$user = $this->getUserByEmail($email);
		if ($user == null) {
			$values = array(
				'email%s' => Strings::lower($email),
				'auth_hash%s' => $this->getUserAuthHash($email),
				'create_date%sql' => 'NOW()'
			);
			$ins = $this->connection->query("INSERT INTO [user]",$values);
			$user = $this->getUserByEmail($email);
		}
		return $user;
	}

	public function update($id,$values)
	{
		$res = $this->connection->query("UPDATE [user] SET",$values," WHERE [id]=%i",$id);
		return $res;
	}

	public function setValidationDate($id){
		$values = array(
			'email_is_valid%i' => 1,
			'validation_date%sql' => 'NOW()',
			'is_active%i' => 1
		);
		return $this->update($id,$values);
	}

	private function getUserAuthHash($email)
	{
		return sha1(SALT_HASH.$email);
	}

}
