<?php

Class RegisterView {
	private $model;
	private $umessage;
	private $pmessage;
	private $Uvalue;
	private $regex = "/^[\ws*åäöÅÄÖ][^0-9]/";

	//Skapar en RegisterRepository.
	public function __construct(RegisterRepository $model) {
		$this->model = $model;
	}

	//Hämtar användarnamnet
	public function getUsername() {
		if(isset($_POST['username'])) {
			return $_POST['username'];
		}
	}

	//Hämtar första inmatade lösenordet.
	public function getPassword1() {
		if(isset($_POST['password1'])) {
			return $_POST['password1'];
		}
	}

	//Hämta de andra inmatade lösenordet.
	public function getPassword2() {
		if(isset($_POST['password2'])) {
			return $_POST['password2'];
		}
	}

	//Kollar om användaren tryckt registrera.
	//Kollar om checkinputs är sanna.
	public function didUserPressRegister() {
		if(isset($_POST['Register'])){
			if($this->CheckInput()) {
				return true;
			}
		}
		return false;
	}

	//Kollar om det inmata värderna stämmer med valideringen.
	//Stämmer allt så retunera den true, annars false.
	public function CheckInput() {
		$toShortUsername = false;
		$toShortPassword = false;
		$checkRegex = false;
		$passwordMatch = false;

		if($_POST["username"] == "" || strlen($_POST["username"]) < 3) {
			$this->umessage = "Användarnamn har för få tecken. Minst 3 tecken!";
			$this->Uvalue = $_POST["username"];
		} else {
			$toShortUsername = true;
		}

		if (!preg_match($this->regex, $_POST["username"])) {
			$this->umessage = "Användarnamn innehåller ogiltiga tecken!";
		} else {
			$checkRegex = true;
		}

		if($_POST["password1"] == "" || strlen($_POST["password1"]) < 6 && ($_POST["password2"]) == "" || strlen($_POST["password2"]) < 6) {
			$this->pmessage = "Lösenordet har för få tecken. Minst 6 tecken!";
			$this->Uvalue = $_POST["username"];
		} else {
			$toShortPassword = true;
		}
		if(strlen($_POST["password1"]) > 5 && strlen($_POST["password2"]) > 5 && strlen($_POST["username"]) > 2) {
			if($_POST["password1"] != $_POST["password2"]) {
				$this->pmessage = "Lösenorden matchar inte!";
				$this->Uvalue = $_POST["username"];
			} else {
				$passwordMatch = true;
				$this->Uvalue = $_POST["username"];
			}
		}
		if($toShortUsername == true && $toShortPassword == true && $checkRegex == true && $passwordMatch == true) {
			return true;
		} else {
			return false;
		}
		
	}

	//Retunera html kod som består av ett registeringsformulär.
	public function HTMLPage($message) {
		setlocale(LC_ALL, 'swedish');
		date_default_timezone_set('Europe/Stockholm');
		$Todaytime = ucwords(strftime("%A,den %d %B år %Y. Klockan är [%H:%M:%S]."));

		$ret = "
						<h1>Laborationskod te222ds</h1>
						<h2>Ej inloggad</h2>
						<form id='login' method='post'>
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
								<input type=submit name='Register' value='Registrera'>
							</fieldset>
						</form>
						<p id='meny'>$Todaytime</p>";

		return $ret;
	}
}