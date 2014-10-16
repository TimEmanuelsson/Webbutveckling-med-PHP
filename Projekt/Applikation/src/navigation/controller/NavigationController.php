<?php

require_once('./src/news/controller/NewsController.php');
require_once('./src/navigation/view/NavigationView.php');
require_once('./src/login/controller/LoginController.php');
require_once('./src/register/controller/RegisterController.php');



Class NavigationController {

	private static $operationSuccess = true;

	public function doNavigation() {
		
		try {

			switch (NavigationView::getAction()) {

				case NavigationView::$actionLogin:
					$controller = new LoginController();
					$result = $controller->doLogin();
					return $result;

					break;

				case NavigationView::$actionRegister:
					$controller = new RegisterController();
					$result = $controller->doRegister();
					if($result === self::$operationSuccess) {
						$controller = new LoginController();
						return $controller->doLogin(self::$operationSuccess);
					}
					return $result;

					break;

				case NavigationView::$actionNews:
				default:
					$controller = new NewsController();
					$result = $controller->doNews();
					return $result;

					break;
			}

		} catch(Exception $e) {
			die($e->getMessage());
		}
	}
}