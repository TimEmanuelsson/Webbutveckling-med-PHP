<?php

require_once('./src/news/view/NewsView.php');
require_once('./src/news/view/AllNewsView.php');
require_once('./src/news/model/SportModel.php');
require_once('./src/news/model/AllNewsModel.php');
require_once('./src/news/model/PleasureModel.php');

Class NewsController {

	private $News = '';

	public function doNews() {

		 try {

		 	switch (NewsView::getAction()) {

		 		case NewsView::$actionSport:
		 			$model = new SportModel();
		 			$SportList = $model->getSportList();
		 			$this->News = "Sport";
		 			//TODO: Skicka med en lista med sportnyheter
		 			$view = new AllNewsView();
					$result = $view->showAllNews($SportList, $this->News);
					return $result;

		 			break;

		 		case NewsView::$actionPleasure:
		 			$model = new PleasureModel();
		 			$PleasureList = $model->getPleasureList();
		 			$this->News = "Nöje";
		 		//TODO: Skicka med en lista med ekonominyheter
		 			$view = new AllNewsView();
					$result = $view->showAllNews($PleasureList, $this->News);
					return $result;

		 			break;	

		 		case NewsView::$actionNews:
				default:
					$model = new AllNewsModel();
		 			$AllNewsList = $model->getAllNewsList();
		 			$this->News = "Alla Nyheter";
					//TODO: Skicka med en lista med alla nyheter
					$view = new AllNewsView();
					$result = $view->showAllNews($AllNewsList, $this->News);
					return $result;

					break;
			}		

		 } catch(Exception $e) {
		 	die($e->getMessage());
		 }
	}
}