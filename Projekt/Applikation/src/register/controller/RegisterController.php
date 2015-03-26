<?php

require_once("./src/register/model/RegisterRepository.php");
require_once("./src/register/view/RegisterView.php");

Class RegisterController {

	private $view;
	private $model;
	private $regex = "/^[\ws*åäöÅÄÖ][^0-9]/";

	//Konstruktorn skapar RegisterRepository och en RegisterView.
	public function __construct() {
		$this->model = new RegisterRepository();
		$this->view = new RegisterView($this->model);
	}

	public function doRegister() {
		$message = "";

		$username = $this->view->getUsername();
		$password1 = $this->view->getPassword1();
		$password2 = $this->view->getPassword2();

		//Om alla valideringa stämmer så retunera didUserPressRegister true.
		if($this->view->didUserPressRegister()) {
					if($this->model->addUser($username, $password1)) {
						$message = "Registreringen lyckades!";
						return true;
					}else {
						$message = "Användarnamnet finns redan registrerat.";
					}
		}
		return $this->view->HTMLPage($message);
		
	}
}