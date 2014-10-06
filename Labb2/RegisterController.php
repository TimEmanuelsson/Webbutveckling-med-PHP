<?php

require_once("RegisterModel.php");
require_once("RegisterView.php");

Class RegisterController {

	private $view;
	private $model;
	private $regex = "/^[\ws*åäöÅÄÖ][^0-9]/";

	public function __construct() {
		$this->model = new RegisterModel();
		$this->view = new RegisterView($this->model);
	}

	public function doRegister() {
		$message = "";

		$username = $this->view->getUsername1();
		$password1 = $this->view->getPassword1();
		$password2 = $this->view->getPassword2();

		if($this->view->didUserPressRegister()) {
			//Ful lösning, ändra i didUserPressRegister!!!!
			if(strlen($_POST["password1"]) > 5 && strlen($_POST["password2"]) > 5 && strlen($_POST["username"]) > 2 && $_POST["password1"] == $_POST["password2"]) {
				if(preg_match($this->regex, $username)) {
					if($this->model->CheckRegister($username)) {
						$this->model->RegisterUser($username, $password1);
						$message = "Registreringen lyckades!";
					}else {
						$message = "Användarnamnet finns redan registrerat.";
					}
				}
			}
		}
		return $this->view->HTMLPage($message);
		
	}
}