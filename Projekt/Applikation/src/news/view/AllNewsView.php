<?php

require_once('./src/login/model/LoginRepository.php');

Class AllNewsView {

	private $loginModel;

	public function __construct() {
		$this->loginModel = new LoginRepository();
	}

	public function getSportID() {
			if(isset($_GET['sport'])) {
				return $_GET['sport'];
			} else {
				return false;
			}
		}

		public function getPleasureID() {
			if(isset($_GET['pleasure'])) {
				return $_GET['pleasure'];
			} else {
				return false;
			}
		}

		public function getLastFollow() {
			if(isset($_GET['lastfollow'])) {
				return $_GET['lastfollow'];
			}
		}

	public function showAllNews($NewsList, $news, $loginPage, $Message, $checkUserFlow = false) {

		$contentString = '';
		$showYourFlow = '';

		$currentAction = NewsView::getAction();

		if($currentAction == 'sport') {
 				$flowID = $this->getSportID();
 			} else {
 				$flowID = $this->getPleasureID();
 		}

 		if($this->loginModel->loginstatus()) {
 			$showYourFlow = "<a href='?userflow'>Visa egna flödet</a>";

			if($news == 'Sport' || $news == 'Nöje') {
				if(!$checkUserFlow) {
					$contentString .= "</br><a id='follow' href='?" . $currentAction . "=". $flowID . "&follow'>Följ</a>";
				} else {
					$contentString .= "</br><a id='follow' href='?" . $currentAction . "=". $flowID . "&stopfollow'>Sluta följ</a>";
				}
			}
		}

		if($NewsList == true) {
			foreach ($NewsList as $flow) {
				foreach ($flow->channel->item as $item) {

				$contentString  .= "<ul id='article'>
				<a href='" . $item->link . "'><h2>" . $item->title . "</h2></a>
				<p><b>" . $item->description . "</b></p>
				<p>" . $item->pubDate . "</p>

				</ul>";
				}
			}
		} else {
			$contentString .= '<h2>Något gick fel när data skulle hämtas ut.</h2>';
		}

		$ret = "
				<h1>$Message</h1>
				$loginPage </br>
				<h1>" . $news . "</h1>
				<div id='meny'>
					<a href='?'>Visa alla nyheter</a>
					<a href='?sport=1'>Visa sportnyheter</a>
					<a href='?pleasure=2'>Visa nöjesNyheter</a>
					$showYourFlow
				</div>
				$contentString
		";
	
		return $ret;
	}
}