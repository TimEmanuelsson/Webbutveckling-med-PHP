<?php

require_once('./src/news/view/NewsView.php');
require_once('./src/news/view/AllNewsView.php');
require_once('./src/news/model/FlowRepository.php');
require_once('./src/news/model/UserFlowRepository.php');
require_once('./src/login/model/LoginRepository.php');

Class NewsController {

	private $News = '';
	private $FlowTypeID;
	private $checkUserFlow;

	private $view;
	private $loginmodel;
	private $userflowmodel;
	private $flowModel;

	public function __construct() {
		$this->view = new AllNewsView();
		$this->loginmodel = new LoginRepository();
		$this->userflowmodel = new UserFlowRepository();
		$this->flowModel = new FlowRepository();
	}

	public function doNews($loginPage, $operationSuccess = FALSE) {
		$Message = '';


		 try {

		 	if($operationSuccess)
			{
				$Message = "Registreringen lyckades!";
			}

		 	switch (NewsView::getAction()) {

		 		case NewsView::$actionStopFollow:
			 		$currentAction = $this->checkAction();
			 		//TODO:SLUTA FÖLJA
			 		//TODO: Skapa funktion i UserFlowRepository för att ta bort följningen.



		 		case NewsView::$actionFollow:
		 			if($this->view->getSportID()) {
		 				$currentAction = $this->view->getSportID();
		 				$this->News = "Sport";
		 			} else {
		 				$currentAction = $this->view->getPleasureID();
		 				$this->News = "Nöje";
		 			}
		 			
		 			$userID = $this->loginmodel->getUserID();

		 			$this->userflowmodel->addUserFlow($userID, $currentAction);
		 			$List = $this->flowModel->getFlowWithTypeID($currentAction);

		 			if($this->loginmodel->loginstatus()) {
			 			$this->checkUserFlow = $this->checkUserFlow($userID, $currentAction);
		 			}

					$result = $this->view->showAllNews($List, $this->News, $loginPage, $Message, $this->checkUserFlow);
					return $result;

		 			break;

		 		case NewsView::$actionSport:
		 			$userID = $this->loginmodel->getUserID();
		 			$currentAction = $this->view->getSportID();

		 			if($this->loginmodel->loginstatus()) {
			 			$this->checkUserFlow = $this->checkUserFlow($userID, $currentAction);
		 			}
		 			$this->FlowTypeID = $this->view->getSportID();
		 			$SportList = $this->flowModel->getFlowWithTypeID($this->FlowTypeID);
		 			$this->News = "Sport";
					$result = $this->view->showAllNews($SportList, $this->News, $loginPage, $Message, $this->checkUserFlow);
					return $result;

		 			break;

		 		case NewsView::$actionPleasure:
		 			$userID = $this->loginmodel->getUserID();
		 			$currentAction = $this->view->getPleasureID();
		 			
		 			if($this->loginmodel->loginstatus()) {
			 			$this->checkUserFlow = $this->checkUserFlow($userID, $currentAction);
		 			}
		 			$this->FlowTypeID = $this->view->getPleasureID();
		 			$PleasureList = $this->flowModel->getFlowWithTypeID($this->FlowTypeID);
		 			$this->News = "Nöje";
					$result = $this->view->showAllNews($PleasureList, $this->News, $loginPage, $Message, $this->checkUserFlow);
					return $result;

		 			break;

		 			case NewsView::$actionUserFlow:
		 			$userID = $this->loginmodel->getUserID();
		 			$UserFlowList = $this->userflowmodel->getFlowWithUserID($userID);
		 			$this->News = "UserFlow";
					$result = $this->view->showAllNews($UserFlowList, $this->News, $loginPage, $Message);
					return $result;

		 			break;

		 		case NewsView::$actionNews:
				default:
		 			$AllNewsList = $this->flowModel->getAllFlow();
		 			$this->News = "Alla Nyheter";
					$result = $this->view->showAllNews($AllNewsList, $this->News, $loginPage, $Message);
					return $result;

					break;
			}		

		 } catch(Exception $e) {
		 	die($e->getMessage());
		 }
	}

	public function checkUserFlow($userID, $currentAction) {
		if($this->userflowmodel->checkUserFlow($userID, $currentAction)) {
			return $this->checkUserFlow = true;

		} else {
			return $this->checkUserFlow = false;
		}
	}

	public function checkAction() {
		if($this->view->getSportID()) {
			$this->News = "Sport";
			return $currentAction = $this->view->getSportID();
		} else {
			$this->News = "Nöje";
			return $currentAction = $this->view->getPleasureID();
		}

	}
}