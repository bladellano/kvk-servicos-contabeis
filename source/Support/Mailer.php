<?php

namespace Source\Support;

use Rain\Tpl;
use PHPMailer\PHPMailer\PHPMailer;

class Mailer
{
	const USERNAME = MAIL_EMAIL;
	const PASSWORD = MAIL_PASSWORD;
	const NAME_FROM = MAIL_NAME_FROM;
	const HOST = MAIL_HOST;

	private $mail;

	public function __construct($fromAdress, $fromName, $subject, $tplName, $data = array())
	{
		$config = array(
			"tpl_dir" => self::reverse_strrchr($_SERVER['SCRIPT_FILENAME'], '/') . "/views/",
			"cache_dir" => self::reverse_strrchr($_SERVER['SCRIPT_FILENAME'], '/') . "/views-cache/",
			"debug" => false
		);

		Tpl::configure($config);

		$tpl = new Tpl;

		foreach ($data as $key => $value) {
			$tpl->assign($key, $value);
		}

		$html = $tpl->draw($tplName, true);

		$this->mail = new PHPMailer();

		$this->mail->isSMTP();
		$this->mail->SMTPOptions = array(
			'ssl' => array(
				'verify_peer' => false,
				'verify_peer_name' => false,
				'allow_self_signed' => true
			)
		);

		$this->mail->SMTPDebug = 0;
		$this->mail->Debugoutput = 'html';
		$this->mail->Host = Mailer::HOST;
		$this->mail->Port = 465;
		$this->mail->SMTPSecure = 'ssl';
		$this->mail->SMTPAuth = true;
		$this->mail->Username = Mailer::USERNAME;
		$this->mail->Password = Mailer::PASSWORD;
		$this->mail->setFrom($fromAdress, $fromName);
		$this->mail->addAddress(Mailer::USERNAME, Mailer::NAME_FROM);
		$this->mail->Subject = $subject;
		$this->mail->msgHTML(utf8_decode($html));
		$this->mail->AltBody = 'This is a plain-text message body';
	}

	public function send()
	{
		/* $scheduledTime  = "1647475200";
		$currentTime  = strtotime(date("Y-m-d H:m:s"));
		if ($scheduledTime < $currentTime) return FALSE; */

		return $this->mail->send();
	}

	private static function reverse_strrchr($haystack, $needle)
	{
		$pos = strrpos($haystack, $needle);
		if ($pos === false) {
			return $haystack;
		}
		return substr($haystack, 0, $pos + 1);
	}
}
