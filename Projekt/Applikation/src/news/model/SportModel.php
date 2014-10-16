<?php

Class SportModel {

	public function __construct() {
	}

	public function getSportList() {
		$xml = simplexml_load_file('http://www.aftonbladet.se/sportbladet/rss.xml', 'SimpleXMLElement', LIBXML_NOCDATA);
		return $xml;
	}
}