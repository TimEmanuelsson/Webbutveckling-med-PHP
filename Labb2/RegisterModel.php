<?php

Class RegisterModel {
	private $filename = 'Users.txt';

	public function __construct() {
		
	}

	public function CheckRegister($username) {

		$filename = $this->filename;
		
		if(file_exists($filename)) {
			$file = file($filename);

			$usernameInLowercase = strtolower(trim($username));
			$checkUsername = "/$usernameInLowercase/";

			foreach($file as $line) {
				if(preg_match($checkUsername, $line)) {
					return false;
				}
			}

			return true;

		}else {
			return true;
		}
		
	}

	public function RegisterUser($username, $password) {

		$usernameInLowercase = strtolower(trim($username));
		$cryptedPassword = md5(trim($password));

		$User = $usernameInLowercase.",".$cryptedPassword . PHP_EOL;

		file_put_contents($this->filename ,$User, FILE_APPEND);

		$_SESSION["lastName"] = $username;
	}

	public function getSession() {
		if(isset($_SESSION["lastName"])) {
			return $_SESSION["lastName"];
		}
	}

	public function DestroSession(){
		session_unset();
		session_destroy();
	}
}