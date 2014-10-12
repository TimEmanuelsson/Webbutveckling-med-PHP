<?php

require_once("RegisterController.php");
require_once("LoginController.php");

Class BaseController {

	private static $operationSuccess = true;

	private $RegisterController;
	private $LoginController;

	public function __construct() {
		$this->RegisterController = new RegisterController();
		$this->LoginController = new LoginController();
	}

	public function CheckWhereUserIs() {
		if($this->LoginController->didUserPressRegister()) {
			$result = $this->RegisterController->doRegister();
			if($result === self::$operationSuccess) {
				return $this->LoginController->doLogin(self::$operationSuccess);
			}
			return $result;
		}else {
			return $this->LoginController->doLogin();
		}
	}
}