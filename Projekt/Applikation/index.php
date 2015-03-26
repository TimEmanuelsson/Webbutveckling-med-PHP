<?php

//Starta session.
session_start();

require_once('src/navigation/controller/NavigationController.php');
require_once('src/navigation/view/HTMLView.php');

//Skapar en ny Navigation Controller.
$nc = new NavigationController();
$HTMLBody = $nc->doNavigation();

//Skapar en ny HTMLView.
$view =  new HTMLView();
$view->echoHTML($HTMLBody);
