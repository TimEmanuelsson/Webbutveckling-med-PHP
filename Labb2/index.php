<?php

//Starta en ny session
session_start();

require_once("HTMLView.php");
require_once("BaseController.php");

//Skapar ny controller
$bc = new BaseController();
$HTMLBody = $bc->CheckWhereUserIs();

//Skapar ny HTMLView
$view = new HTMLView();
$view->echoHTML($HTMLBody);