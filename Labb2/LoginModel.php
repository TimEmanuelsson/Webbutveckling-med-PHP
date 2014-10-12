<?php

class LoginModel {

	private $filename = 'Users.txt';
	private $status = 'browserstatus';

	public function __construct() {

	}

	//Förstör sessionen.
	public function logout(){
		session_unset();
		session_destroy();
	}

	//Kollar om sessionen är satt och retunera ture om användaren är inloggad
	//Kollar även om användaren försöker att logga in med fake session.
	public function loginstatus(){
		if(isset($_SESSION[$this->status]) && $_SESSION[$this->status] == $_SERVER['HTTP_USER_AGENT']){
			if(isset($_SESSION["loginstatus"])){
				return true;
			}
		}
		return false;

	}

	//Kollar så att cookie uppgifterna stämmer
	public function CheckloginWithCookie($username, $password){
		$CookieTime = file_get_contents('CookieTime.txt');

			$filename = $this->filename;
			$file = file($filename);

			$usernameToLowercase = strtolower($username);
			$checkUsername = "/$usernameToLowercase/";

			$checkPassword = "/$password/";

			foreach($file as $line) {
				if(preg_match($checkUsername, $line) && preg_match($checkPassword, $line) && $CookieTime > time()) {
					$_SESSION["loginstatus"] = $username;
					$_SESSION["browserstatus"] = $_SERVER['HTTP_USER_AGENT'];
					return true;
				}
			}
	}
	

	//Kollar om det inmatade värdena ställer överens med rätt inlogg.
	public function Checklogin($username, $password){

		$filename = $this->filename;
		
		if(file_exists($filename)) {
			$file = file($filename);

			$usernameToLowercase = strtolower($username);
			$checkUsername = "/$usernameToLowercase/";

			$cryptedPassword = md5($password);
			$checkPassword = "/$cryptedPassword/";

			foreach($file as $line) {
				if(preg_match($checkUsername, $line) && preg_match($checkPassword, $line)) {
					$_SESSION["loginstatus"] = $username;
					$_SESSION["browserstatus"] = $_SERVER['HTTP_USER_AGENT'];
					return true;
				}
			}

		}else {
			return false;
		}
	}
}