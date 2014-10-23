<?php

require_once("./src/login/model/LoginRepository.php");
require_once("./src/login/view/LoginView.php");

class LoginController {
	private $view;
	private $model;

	public function __construct() {
		$this->model = new LoginRepository();
		$this->view = new LoginView($this->model);
	}

	/*
	public function didUserPressRegister() {
		if($this->view->didUserPressRegister() == true) {
			return true;
		}
	}
	*/

	//Kollar om användaren vill logga in
	public function doLogin($operationSuccess = FALSE) {
		$Message = "";
		
		//Inloggning via cookies
		if($this->model->loginstatus() == false){
			if($this->view->isRemembered()){
				$cookie = true;
				if($this->model->checkUser($this->view->getCookieUsername(), $this->view->getCookiePassword(), $cookie)){
					$Message = "Inloggning lyckades via cookies!";
				}else{
					$this->view->removeCookie();
					$Message = "Felaktig information i cookie!";
				}
			}
		}

		//Hämtar ut användarnamnet och lösenordet.
		$username = $this->view->getUsername();
		$password = $this->view->getPassword();

		//Kollar om användaren vill logga in.
		//Kollar så att det är rätt användarnamn och lösenord. Om inte, skicka felmeddelande.
		if($this->view->didUserPressLogin()){
			if($username != "" && $password != ""){
				if($this->model->checkUser($username, $password) == false){
					$Message = "Felaktigt användarnamn och/eller lösenord";
				}else {
					//Kollar om användaren vill hålla sig inloggd
					if($this->view->Checkbox()){
						$this->view->RememberMe();
					}else{
						$Message = "Inloggningen lyckades!";
					}
				}
			}
		}

		//Kollar om man klickat på logout knappen.
		//Anropar logout funktionen som förstör sessionen.
		if($this->view->didUserPressLogout()){
			$this->model->logout();
		}

		return $this->view->HTMLPage($Message);
	}
}