<?php

Class PleasureModel {

	public function __construct() {
	}

	public function getPleasureList() {
		$xml = simplexml_load_file('http://www.aftonbladet.se/nojesbladet/rss.xml
			', 'SimpleXMLElement', LIBXML_NOCDATA);
		return $xml;
	}
}