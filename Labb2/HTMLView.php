<?php

//HTML basklass
class HTMLView {
	public function echoHTML($body) {
		if($body == NULL) {
			throw new \Exception("Body not allow to be NULL!");	
		}
		echo "
				<!DOCTYPE html>
				<html>
				<head>
					<meta charset=UTF-8>
					<title>Tims login</title>
				</head>
				<body>
					$body
				</body>
				</html>
		";
	}
}