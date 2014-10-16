<?php

Class RegisterModel {

	public function __construct() {
		
	}

	public function CheckRegister($username) {

		$filename = 'Users.txt';
		
		if(file_exists($filename)) {
			$file = file($filename);

			$usernameInLowercase = strtolower(trim($username));
			$checkUsername = "/$usernameInLowercase/";

			foreach($file as $line) {
				if(preg_match($checkUsername, $line)) {
					return false;
				}

				/*
				$userAndPassword = explode(",", $line);
				var_dump($userAndPassword[0]);

				if($userAndPassword[0] == $trimmedUsername) {
					return false;
				}
				*/
			}

			return true;

		}else {
			return true;
		}
		
	}

	public function RegisterUser($username, $password) {

		$usernameInLowercase = strtolower(trim($username));
		$cryptedPassword = md5(trim($password));

		$User = $usernameInLowercase.",".$cryptedPassword."\n";

		file_put_contents('Users.txt',$User, FILE_APPEND);
	}
}