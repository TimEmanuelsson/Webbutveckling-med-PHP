<?php

require_once("RegisterModel.php");
require_once("RegisterView.php");

Class RegisterController {

	private $view;
	private $model;

	public function __construct() {
		$this->model = new RegisterModel();
		$this->view = new RegisterView($this->model);
	}

	public function doRegister() {

	}
}