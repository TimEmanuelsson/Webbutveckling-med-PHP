<?php

//HTML basklass som retunera html struktur och få in body som är html kod.
class HTMLView {
	public function echoHTML($body) {
		if($body == NULL){
			$body = "An unknown error has occured!<br />
			<a href='?'>Click here to return to start page</a>";
		}
			echo "
					<!DOCTYPE html>
					<html>
					<head>
						<meta charset='UTF-8'>
						<link href='./src/navigation/view/projekt.css' rel='stylesheet' type='text/css'>
						<title>RSS-flöde</title>
					</head>
					<body>
						$body
					</body>
					</html>
			";
	}
}