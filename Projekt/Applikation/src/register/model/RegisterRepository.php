<?php

require_once('./src/navigation/model/Repository.php');

//Ärver från Repository som innehåller anslutningen.
Class RegisterRepository extends Repository {

	private $id = 'ID';
	private $username = 'username';
	private $password = 'password';

	private $dbTable = 'user';

	//Lägger till en användare.
	//Om användarnamnet redan finns retuneras falskt.
	public function addUser($username, $password) {
		try {
			$username = strtolower($username);
			$password = md5($password);
			$db = $this->connection();

			$sqlDuplicate = 'SELECT * FROM ' . $this->dbTable . ' WHERE ' . $this->username . ' =:' . $this->username . '';
			
			$queryDuplicate = $db->prepare($sqlDuplicate);

			$queryDuplicate->bindParam(':username', $username);

			$queryDuplicate->execute();
			$result = $queryDuplicate->fetchAll();

			if ($result) {
				return false;

			} else {
				$sql = "INSERT INTO " . $this->dbTable . " (" . $this->username . ", " . $this->password . ") VALUES (?, ?)";
				$params = array($username, $password);

				$query = $db -> prepare($sql);
				$query -> execute($params);
				return true;
			}

		} catch (PDOException $e) {
			throw new Exception('Något gick fel när en användare skulle läggas till!');
		}
	}
}