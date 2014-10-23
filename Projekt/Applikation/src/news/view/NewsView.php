<?php

Class NewsView {

	public static $actionNews = 'news';
	public static $actionSport = 'sport';
	public static $actionPleasure = 'pleasure';
	public static $actionUserFlow = 'userflow';
	public static $actionFollow = 'follow';
	public static $actionStopFollow = 'stopfollow';

	public static function getAction() {
		if(isset($_REQUEST[self::$actionFollow]) != isset($_REQUEST[self::$actionUserFlow]) &&
		 isset($_REQUEST[self::$actionFollow]) != isset($_REQUEST[self::$actionNews])) {
			return self::$actionFollow;
		}

		if(isset($_REQUEST[self::$actionStopFollow]) != isset($_REQUEST[self::$actionUserFlow]) &&
		 isset($_REQUEST[self::$actionStopFollow]) != isset($_REQUEST[self::$actionNews])) {
			return self::$actionStopFollow;
		}

		if(isset($_REQUEST[self::$actionSport]) != isset($_REQUEST[self::$actionFollow])) {
			return self::$actionSport;
		}

		if(isset($_REQUEST[self::$actionUserFlow]) != isset($_REQUEST[self::$actionFollow])) {
			return self::$actionUserFlow;
		}

		if(isset($_REQUEST[self::$actionPleasure]) != isset($_REQUEST[self::$actionFollow])) {
			return self::$actionPleasure;
		}

		return self::$actionNews;
	}
}