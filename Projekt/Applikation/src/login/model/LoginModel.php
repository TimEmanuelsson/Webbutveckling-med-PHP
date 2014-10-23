<?php

class LoginModel {

	public function __construct() {

	}

	//Kollar så att cookie uppgifterna stämmer
	public function CheckloginWithCookie($username, $password){
		

			$filename = 'Users.txt';
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

			/*
			if ($username == $this->username && $password == md5($this->password) && $CookieTime > time()){
				$_SESSION["loginstatus"] = $username;
				$_SESSION["browserstatus"] = $_SERVER['HTTP_USER_AGENT'];
    			return true;
			}
			else{
				return false;
			}
			*/
	}
	

	//Kollar om det inmatade värdena ställer överens med rätt inlogg.
	public function Checklogin($username, $password){

		$filename = 'Users.txt';
		
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
		/*
		if($username == $this->username && $password == $this->password){
			$_SESSION["loginstatus"] = $username;
			$_SESSION["browserstatus"] = $_SERVER['HTTP_USER_AGENT'];
			return true;
		}
		else {
			return false;
		}
		*/

	}

	

}