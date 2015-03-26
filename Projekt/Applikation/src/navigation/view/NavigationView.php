<?php

//Requesta för att se var användaren befinner sig.
Class NavigationView {

	public static $actionNews = 'news';
	public static $actionRegister = 'registerUser';

	public static function getAction() {
		if(isset($_REQUEST[self::$actionRegister])) {
			return self::$actionRegister;
		}
		return self::$actionNews;
	}
}