<?php
namespace Model;

use Emails;
use Nette\Utils\Strings;
use Tracy\Debugger;

class Applicant {

	private $connection;

	public function __construct($db)
 	{
		$this->connection = $db;
	}
	

	public function createProfile($data) {
        $profile = $this->getProfileByEmail($data["email"]);
        
        if ($profile == null) {
            $dateOfBirth = strtotime($data['day-birth'].' '.$data['month-birth'].' '.$data['year-birth']);
            $dateOfBirth = date("Y-m-d",$dateOfBirth);
            $hash = $this->getUserAuthHash($data["email"]);
            $values = array(
                'firstName%s' => $data["first-name"],
                'lastName%s' => $data["last-name"],
                'email%s' => $data["email"],
                'instrument%s' => $data["instrument"],
                'dateOfBirth%d' => $dateOfBirth,
                'createDate%sql' => 'NOW()',
                'authHash%s' => $hash
            );

            $ins = $this->connection->query("INSERT INTO [applicant-profile]",$values);
            if ($ins)
            {
                $res = Emails::AuthEmailSent($data["email"],$hash,$data["instrument"]);
                $usr = $this->getProfileByEmail($data["email"]);
                return $usr;
            }
        }
		return false;
    }
    
    public function getProfileByEmail($email){
        try {
            $result = $this->connection->query("
                SELECT 
                [profile].*,
                [info].[applicantID],
                [info].[postalAddress],
                [info].[phoneNumber],
                [info].[nationality],
                [info].[resident],
                [info].[sex],
                [info].[languages],
                [info].[personalPhoto],
                [info].[passportPhoto]
                FROM [applicant-profile] as profile 
                LEFT JOIN [applicant-information] as info ON [info].[applicantID] = [profile].[id]
                WHERE [profile].[email]=%s",$email);
            if (count($result) > 0)
            {
                return $result->fetch();
            }
        } catch (Exception $e) {

        }
		return null;
    }
    
    public function getProfileByHash($hash){
        try {
            $result = $this->connection->query("
                SELECT 
                [profile].*,
                [info].[applicantID],
                [info].[postalAddress],
                [info].[phoneNumber],
                [info].[nationality],
                [info].[resident],
                [info].[sex],
                [info].[languages],
                [info].[personalPhoto],
                [info].[passportPhoto]
                FROM [applicant-profile] as profile 
                LEFT JOIN [applicant-information] as info ON [info].[applicantID] = [profile].[id]
                WHERE [profile].[authHash]=%s",$hash);                
            if (count($result) > 0)
            {
                return $result->fetch();
            }
        } catch (Exception $e) {
            Debugger::dump($e);
        }
		return null;
    }

    public function setApplicantInformation($id,$data){
        $values = array(
            'modifyDate%sql' => 'NOW()'
        );
        $allowedKeys = array("postalAddress","phoneNumber","nationality","resident","sex","languages","personalPhoto","passportPhoto");
        foreach ($data as $key=>$value) {
            if (in_array($key,$allowedKeys)) {
                $values[$key.'%s'] = $value;
            }
        }
        $res = $this->connection->query("SELECT * FROM [applicant-information] WHERE [applicantID]=%i",$id);
        try {
            if (count($res) > 0) {
                $upd = $this->connection->query("UPDATE [applicant-information] SET",$values," WHERE [applicantID]=%i",$id);
            } else {
                $values['applicantID%i'] = $id;
                $values['createDate%sql'] = 'NOW()';
                $ins = $this->connection->query("INSERT INTO [applicant-information]",$values);
            }
            
            return true;
        } catch (Exception $e) {
            Debugger::barDump($e);
        }
        return false;
    }

    public function saveMediaFile($id,$fileID,$uuid){
        $values = array(
            $fileID.'%s' => $uuid
        );
        $upd = $this->connection->query("UPDATE [applicant-information] SET",$values," WHERE [applicantID]=%i",$id);
    }

    public function setEmailVerified($id) {
        Debugger::barDump('set email verify');
        $values = array(
            'modifyDate%sql' => 'NOW()',
			'isVerified%i' => 1,
			'verifyDate%sql' => 'NOW()',
			'active%i' => 1
		);
		return $this->update($id,$values);
    }

    public function getApplicationState($id) {
        $res = $this->connection->query("SELECT * FROM [applicant-session] WHERE [applicantID]=%i ORDER BY [createDate] DESC",$id);
        if (count($res) > 0) {
            $states = $res->fetchAll();
            return $states;
        }
        return false;
        
    }

    public function setApplicationState($id,$stateName) {
        $values = array(
            'applicantID%i' => $id,
            'sessionName%s' => $stateName
        );
        $ins = $this->connection->query("INSERT INTO [applicant-session]",$values);
    }

    public function update($id,$values)
	{
		$res = $this->connection->query("UPDATE [applicant-profile] SET",$values," WHERE [id]=%i",$id);
		return $res;
	}	

	private function getUserAuthHash($email)
	{
		return sha1(SALT_HASH.$email);
    }

    private function setPaymentDone($id) {
        Debugger::barDump('set payment done');
        $values = array(            
			'paymentComplete%i' => 1,
			'paymentDate%sql' => 'NOW()'
		);
		return $this->update($id,$values);
    }
    
    public function storePaymentInfo($id,$chargeObject)
    {
        $values = array(
            'applicantID%i' => $id,
            'paymentChargeID%s' => $chargeObject->id,
            'paymentStatus%s' => $chargeObject->status,
            'paymentDate%sql' => 'NOW()'
        );

        if ($chargeObject->status != "succeeded") {            
            $values['paymentFailureCode%s'] = $chargeObject->failure_code;
            $values['paymentFailureMessage%s'] = $chargeObject->failure_message;
            $values['paymentSuccess%i'] = 0;
        } else {
            $this->setPaymentDone($id);
            $values['paymentSuccess%i'] = 1;
        }

        $ins = $this->connection->query("INSERT INTO [applicant-payment]",$values);
    }
}