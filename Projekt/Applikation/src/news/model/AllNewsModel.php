<?php

//require_once('News.php');

Class AllNewsModel {

	public function __construct() {
	}

	public function getAllNewsList() {
		$xml = simplexml_load_file('http://www.aftonbladet.se/nyheter/rss.xml', 'SimpleXMLElement', LIBXML_NOCDATA);
		return $xml;
	}
}