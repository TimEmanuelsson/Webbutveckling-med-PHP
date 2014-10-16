<?php

Class NewsView {

	public static $actionNews = 'news';
	public static $actionSport = 'sport';
	public static $actionPleasure = 'pleasure';

	public static function getAction() {
		if(isset($_REQUEST[self::$actionSport])) {
			return self::$actionSport;
		}

		if(isset($_REQUEST[self::$actionPleasure])) {
			return self::$actionPleasure;
		}

		return self::$actionNews;
	}
}