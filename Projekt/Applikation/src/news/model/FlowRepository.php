<?php

require_once('./src/navigation/model/Repository.php');

Class FlowRepository extends Repository {

	private $id = 'ID';
	private $url = 'url';
	private $flowTypeID = 'flowtypeID';
	private $dbTable = 'flow';

	public function getAllFlow() {
		try {
			$db = $this -> connection();
			
			$allFlow = array();
			
			$sql = 'SELECT ' . $this->url . ' FROM ' . $this->dbTable . '';
			$query = $db -> prepare($sql);
			$query -> execute();
			$result = $query->fetchAll();
			
			foreach($result as $url) {
				$urlxml = simplexml_load_file($url['url'], 'SimpleXMLElement', LIBXML_NOCDATA);
				$allFlow[] = $urlxml;
			}
			
			return $allFlow;

		} catch(PDOException $e) {
			throw new Exception($e->getMessage());
		}
	}

	public function getFlowWithTypeID($id)
	{
		try
		{
			$db = $this -> connection();

			$sql = 'SELECT ' . $this->url . ' FROM ' . $this->dbTable . ' WHERE ' . $this->flowTypeID . ' = ?';
			$params = array($id);

			$query = $db -> prepare($sql);
			$query -> execute($params);
			$result = $query -> fetchAll();

			foreach($result as $url) {
				$urlxml = simplexml_load_file($url['url'], 'SimpleXMLElement', LIBXML_NOCDATA);
				$allFlow[] = $urlxml;
			}
			
			return $allFlow;
		}
		catch(PDOException $e)
		{
			throw new Exception('Kunde inte hämta ut medlemmen ur databasen.');
		}
	}

}