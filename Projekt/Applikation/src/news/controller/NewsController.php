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
	private $sport = 'Sport';
	private $Pleasure = 'Nöje';
	private $allnews = 'Alla nyheter';
	private $userFlow = 'Userflow';

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
			 		$userID = $this->loginmodel->getUserID();
			 		$this->userflowmodel->deleteUserFlow($userID, $currentAction);
			 		
			 		$AllNewsList = $this->flowModel->getAllFlow();
		 			$this->News = $this->allnews;
					$result = $this->view->showAllNews($AllNewsList, $this->News, $loginPage, $Message);
					return $result;

			 		break;

		 		case NewsView::$actionFollow:
		 			$currentAction = $this->checkAction();
		 			$userID = $this->loginmodel->getUserID();

		 			$this->userflowmodel->addUserFlow($userID, $currentAction);

		 			$UserFlowList = $this->userflowmodel->getFlowWithUserID($userID);
		 			$this->News = $this->userFlow;
					$result = $this->view->showAllNews($UserFlowList, $this->News, $loginPage, $Message);
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
		 			$this->News = $this->sport;
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
		 			$this->News = $this->Pleasure;
					$result = $this->view->showAllNews($PleasureList, $this->News, $loginPage, $Message, $this->checkUserFlow);
					return $result;

		 			break;

		 			case NewsView::$actionUserFlow:
		 			$userID = $this->loginmodel->getUserID();
		 			$UserFlowList = $this->userflowmodel->getFlowWithUserID($userID);
		 			$this->News = $this->userFlow;
					$result = $this->view->showAllNews($UserFlowList, $this->News, $loginPage, $Message);
					return $result;

		 			break;

		 		case NewsView::$actionNews:
				default:
		 			$AllNewsList = $this->flowModel->getAllFlow();
		 			$this->News = $this->allnews;
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
			$this->News = $this->sport;
			return $currentAction = $this->view->getSportID();
		} else {
			$this->News = $this->Pleasure;
			return $currentAction = $this->view->getPleasureID();
		}

	}
}