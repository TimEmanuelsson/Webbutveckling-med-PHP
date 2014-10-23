<?php

require_once('./src/navigation/model/Repository.php');
require_once('News.php');

Class FlowRepository extends Repository {

	private $id = 'ID';
	private $url = 'url';
	private $flowTypeID = 'flowTypeID';
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

				/*
				foreach ($allFlow as $flow) {
					var_dump($flow->title);
					$article = new News($flow->title, $flow->link, $flow->description, $flow->pubDate);
					$allFlowArticle[] = $article;
				}
				*/
			}
			
			return $allFlow;

		} catch(PDOException $e) {
			throw new Exception($e->getMessage());
		}
	}

	/*
	function cmp($a, $b){ 
    	return strcmp($b['db'], $a['db']); 
	}
	*/

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