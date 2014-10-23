<?php

require_once('./src/navigation/model/Repository.php');

Class LoginRepository extends Repository {

	public static $id = 'ID';
	private $username = 'username';
	private $password = 'password';

	private $dbTable = 'user';

	public function checkUser($username, $password, $cookie = false) {
			$username = strtolower($username);
			if(!$cookie) {
				$password = md5($password);
			}
			try {	    
				$db = $this->connection();

				$sql = "SELECT ID, username, password FROM " . $this->dbTable . " WHERE " . $this->username . "=:" . $this->username . "
				 AND " . $this->password . "=:" . $this->password . "";

				$query = $db->prepare($sql);

				$query->bindParam(':username', $username, PDO::PARAM_STR);
        		$query->bindParam(':password', $password, PDO::PARAM_STR);

				$query->execute();
				$result = $query->fetchAll();

				$CookieTime = file_get_contents('CookieTime.txt');

				if($result && $CookieTime > time()) {
					foreach ($result as $user) {
						$ID = $user['ID'];
					}
					$_SESSION['ID'] = $ID;
					$_SESSION["loginstatus"] = ucfirst($username);
					$_SESSION["browserstatus"] = $_SERVER['HTTP_USER_AGENT'];
					return true;

				} else {
					return false;
				}

		    } catch(PDOException $e) {
				throw new Exception($e->getMessage());
			}
		
	}

	//Förstör sessionen.
	public function logout(){
		session_unset();
		session_destroy();
	}

	//Kollar om sessionen är satt och retunera ture om användaren är inloggad
	//Kollar även om användaren försöker att logga in med fake session.
	public function loginstatus(){
		if(isset($_SESSION["browserstatus"]) && $_SESSION["browserstatus"] == $_SERVER['HTTP_USER_AGENT']){
			if(isset($_SESSION["loginstatus"])){
				return true;
			}
		}
		return false;
	}

	public function getSession() {
		if(isset($_SESSION["loginstatus"])) {
			return $_SESSION["loginstatus"];
		}
	}

	public function getUserID() {
		if(isset($_SESSION['ID'])) {
			return $_SESSION['ID'];
		}
	}
}