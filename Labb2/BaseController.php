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
			return $this->RegisterController->doRegister();
		}else {
			return $this->LoginController->doLogin();
		}
	}
}