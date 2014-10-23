<?php

session_start();

require_once('src/navigation/controller/NavigationController.php');
require_once('src/navigation/view/HTMLView.php');

$nc = new NavigationController();
$HTMLBody = $nc->doNavigation();

$view =  new HTMLView();
$view->echoHTML($HTMLBody);
