<?php


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
						<title>RSS-flöde</title>
					</head>
					<body>
						$body
					</body>
					</html>
			";
	}
}