<?php

//Basklass för anslutning.
//Just nu inställt på lokalt.
abstract class Repository {
	protected $dbUsername = 'root';
	protected $dbPassword = '';
	protected $dbConnstring = 'mysql:host=localhost;dbname=projekt';
	protected $dbConnection;
	
	protected function connection() {
		if ($this->dbConnection == NULL) {
			$this->dbConnection = new PDO($this->dbConnstring, $this->dbUsername, $this->dbPassword);
		}
		
		$this->dbConnection->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
		
		return $this->dbConnection;
	}
}