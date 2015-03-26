<?php

require_once('./src/navigation/model/Repository.php');

//Ärver från Repository som innehåller anslutningen.
Class LoginRepository extends Repository {

	private $loginstatus = 'loginstatus';
	private $browserstatus = 'browserstatus';
	private $httpUserAgent = 'HTTP_USER_AGENT';

	private $id = 'ID';
	private $username = 'username';
	private $password = 'password';

	private $dbTable = 'user';

	//Kollar om användarnamet och lösenordet finns.
	//Om sant, logga in. Annars Fel lösenord eller användarnamn.
	public function checkUser($username, $password, $cookie = false) {
			$username = strtolower($username);
			if(!$cookie) {
				$password = md5($password);
			}
			try {	    
				$db = $this->connection();

				$sql = "SELECT " . $this->id . ", " . $this->username . ", " . $this->password . " FROM " . $this->dbTable . " WHERE " . $this->username . "=:" . $this->username . "
				 AND " . $this->password . "=:" . $this->password . "";

				$query = $db->prepare($sql);

				$query->bindParam(':username', $username, PDO::PARAM_STR);
        		$query->bindParam(':password', $password, PDO::PARAM_STR);

				$query->execute();
				$result = $query->fetchAll();

				$CookieTime = file_get_contents('CookieTime.txt');

				if($result && $CookieTime > time()) {
					foreach ($result as $user) {
						$ID = $user[$this->id];
					}
					$_SESSION[$this->id] = $ID;
					$_SESSION[$this->loginstatus] = ucfirst($username);
					$_SESSION[$this->browserstatus] = $_SERVER[$this->httpUserAgent];
					return true;

				} else {
					return false;
				}

		    } catch(PDOException $e) {
				throw new Exception('Något gick fel när du försökte logga in!');
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
		if(isset($_SESSION[$this->browserstatus]) && $_SESSION[$this->browserstatus] == $_SERVER[$this->httpUserAgent]){
			if(isset($_SESSION[$this->loginstatus])){
				return true;
			}
		}
		return false;
	}

	//Används för att se vem som är inloggad.
	public function getSession() {
		if(isset($_SESSION[$this->loginstatus])) {
			return $_SESSION[$this->loginstatus];
		}
	}

	//Används för att se vilket ID användaren som är inloggad har.
	public function getUserID() {
		if(isset($_SESSION[$this->id])) {
			return $_SESSION[$this->id];
		}
	}
}