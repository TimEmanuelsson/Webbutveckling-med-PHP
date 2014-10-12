<?php

Class RegisterView {
	private $model;
	private $umessage;
	private $pmessage;
	private $Uvalue;
	private $Register = 'Register';
	private $regex = "/^[\ws*åäöÅÄÖ][^0-9]/";

	public function __construct(RegisterModel $model) {
		$this->model = $model;
	}

	public function getUsername1() {
		if(isset($_POST['username'])) {
			return $_POST['username'];
		}
	}

	public function getPassword1() {
		if(isset($_POST['password1'])) {
			return $_POST['password1'];
		}
	}

	public function getPassword2() {
		if(isset($_POST['password2'])) {
			return $_POST['password2'];
		}
	}

	public function didUserPressRegister() {
		if(isset($_POST[$this->Register])){
			if($this->CheckInput()) {
				return true;
			}
		}
		return false;
	}

	public function CheckInput() {
		if($_POST["username"] == "" || strlen($_POST["username"]) < 3) {
			$this->umessage = "Användarnamn har för få tecken. Minst 3 tecken!";
			$this->Uvalue = $_POST["username"];
		} elseif (!preg_match($this->regex, $_POST["username"])) {
			$this->umessage = "Användarnamn innehåller ogiltiga tecken!";
		}
		if($_POST["password1"] == "" || strlen($_POST["password1"]) < 6 && ($_POST["password2"]) == "" || strlen($_POST["password2"]) < 6) {
			$this->pmessage = "Lösenordet har för få tecken. Minst 6 tecken!";
			$this->Uvalue = $_POST["username"];
		}
		if(strlen($_POST["password1"]) > 5 && strlen($_POST["password2"]) > 5 && strlen($_POST["username"]) > 2) {
			if($_POST["password1"] != $_POST["password2"]) {
				$this->pmessage = "Lösenorden matchar inte!";
				$this->Uvalue = $_POST["username"];
			} else {
				$this->Uvalue = $_POST["username"];
			}
		}
		return true;
	}

	public function HTMLPage($message) {
		setlocale(LC_ALL, 'swedish');
		date_default_timezone_set('Europe/Stockholm');
		$Todaytime = ucwords(strftime("%A,den %d %B år %Y. Klockan är [%H:%M:%S]."));

		$ret = "
						<h1>Laborationskod te222ds</h1>
						<h2>Ej inloggad</h2>
						<form method='post'>
							<a href='?'>Tillbaka</a>
							<fieldset>
								<legend>Registrering - Välj användarnamn och lösenord</legend>
								<p>$message</p>
								<p>$this->umessage</p>
								<p>$this->pmessage</p>
								<label>Användarnamn  :</label>
								<input type=text size=20 name='username' id='UserNameID' value='$this->Uvalue'>
								<br>
								<label>Lösenord  :</label>
								<input type=password size=20 name='password1' id='PasswordID' value=''>
								<br>
								<label>Upprepa lösenord  :</label>
								<input type=password size=20 name='password2' id='PasswordID' value=''>
								<br>
								<input type=submit name='$this->Register' value='Registrera'>
							</fieldset>
						</form>
						<p>$Todaytime</p>";

		return $ret;
	}
}