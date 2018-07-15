<?php

use Nette\Mail\Message;
use Nette\Mail\SendmailMailer;
use Tracy\Debugger;

class Emails
{
    public static function AuthEmailSent($recipient,$hash,$instrument='') {
        $latte = new Latte\Engine;
		$latte->setTempDirectory(ROOT_FOLDER.'/temp');

        $mail = new Message;
		$authLink = APP_DOMAIN."/profile/".$hash;

		$htmlContent = $latte->renderToString('latte/email/email-auth.latte', array('link' => $authLink,'instrument'=>$instrument));
		$mail->setFrom(SENDER_FROM)
		    ->addTo($recipient)
		    ->setSubject('CNIC 2019 - Authorization link')
				->setHtmlBody($htmlContent);

        $mailer = new SendmailMailer;
        
        try {
            $mailer->send($mail);
            return true;
        } catch (Exception $e) {
           Debugger::barDump($e);
           return false;
        }
		
    }
}