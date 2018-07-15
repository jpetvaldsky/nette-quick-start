<?php
use Httpful\Request;
use Httpful\Mime;
use Tracy\Debugger;
use Nette\Utils\FileSystem;
class HubApi
{
    private static $instance;

    private $token;
    private $clientCredentials;
    private $stripeApiEndPoint;
    private $candidateID;
    private $db;

    private function __construct() {
        $this->clientCredentials = array(
            /*"clientId"=> PARTNER_CLIENT_ID,
            "clientSecret"=> PARTNER_CLIENT_SECRET,
            "grantType"=> "client_credentials"*/
        );
        $this->stripeApiEndPoint = STRIPE_API_ENDPOINT;
    }

    public static function getInstance()
    {
        if ( !isset(self::$instance))
        {
            self::$instance = new self;
        }
        return self::$instance;
    }

    public function setDbConnection($connection) {
        $this->db = $connection;
    }

    public function saveCandidateToLusk($data){
        $positionEndPoint = $this->stripeApiEndPoint.'/positions/'.POSITION_ID.'/candidates';
        $request = Request::post($positionEndPoint,null,Mime::JSON)
            ->addHeader("Content-Type", "multipart/form-data; boundary=BOUNDARY")
            ->body(array(
                    "email" => $data["email"],
                    "name"=> $data["name"],
                    "coverLetter" => $data["coverLetter"],
                    "privacyPolicyAgreement" => 1
                ),Mime::FORM);
            $tempFile = null;
            if ($data["cv"] != null) {
                if (file_exists($data["cv"])) {
                    $tempFile = ROOT_FOLDER."/upload/temp/".$data["filename"];
                    FileSystem::copy($data["cv"],$tempFile,true);
                    if (file_exists($tempFile)) {
                        $request->attach(array("files[0]" => $tempFile));
                    }
                }
            }
        $response = $request->send();
        Debugger::barDump($response);
        if ($tempFile != null)
            FileSystem::delete($tempFile);
        if ($response->code == 201) {

            return true;
        }
        return false;

    }

    public function getGenericApiEndpoint($url) {
        if ($this->requestToken()) {
            $response = Request::get($url,null,Mime::JSON)
                ->addHeader('Authorization', "Bearer ".$this->token)
                ->followRedirects()
                ->send();
                return $response;
        }
        return null;
    }


}
