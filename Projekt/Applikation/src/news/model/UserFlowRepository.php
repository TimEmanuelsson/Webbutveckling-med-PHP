<?php

require_once('./src/navigation/model/Repository.php');

Class UserFlowRepository extends Repository {

	private $id = 'userID';
	private $flowTypeID = 'flowTypeID';
	private $dbTable = 'userflow';
	
	public function getFlowWithUserID($id)
	{
		try
		{
			$db = $this -> connection();

			$sql = 'SELECT f.url
					FROM userflow AS uf
					  INNER JOIN user AS u
					    ON uf.userID = u.ID
					  INNER JOIN flowType AS ft
					    ON uf.flowTypeID = ft.ID
					  INNER JOIN flow as f
					  	on f.flowTypeID = ft.ID
					    WHERE u.ID = ?';

			$params = array($id);

			$query = $db -> prepare($sql);
			$query -> execute($params);
			$result = $query -> fetchAll();

			foreach($result as $url) {
				$urlxml = simplexml_load_file($url['url'], 'SimpleXMLElement', LIBXML_NOCDATA);
				$allFlow[] = $urlxml;
			}

			if(isset($allFlow)) {
				return $allFlow;
			}

			return false;
		}
		catch(PDOException $e)
		{
			throw new Exception('Kunde inte hämta ut medlemmen ur databasen.');
		}
	}

	public function addUserFlow($userID, $flowTypeID)
	{
		try
		{
			$db = $this -> connection();

			$sql = "INSERT INTO " . $this->dbTable . "(" . $this->id . ", " . $this->flowTypeID . ") VALUES (?, ?)";
			$params = array($userID, $flowTypeID);

			$query = $db -> prepare($sql);
			$query -> execute($params);
		}
		catch (PDOException $e)
		{
			throw new Exception($e->getMessage());
		}
	}

	public function checkUserFlow($userID, $flowTypeID) {

			try {	    
				$db = $this->connection();

				$sql = "SELECT " . $this->id . ", " . $this->flowTypeID . " FROM " . $this->dbTable . " WHERE " . $this->id . "=:" . $this->id . "
				 AND " . $this->flowTypeID . "=:" . $this->flowTypeID . "";

				$query = $db->prepare($sql);

				$query->bindParam($this->id, $userID, PDO::PARAM_STR);
        		$query->bindParam($this->flowTypeID, $flowTypeID, PDO::PARAM_STR);

				$query->execute();
				$result = $query->fetchAll();

				if($result) {
					return true;

				} else {
					return false;
					
				}

		    } catch(PDOException $e) {
				throw new Exception($e->getMessage());
			}
		
	}

}