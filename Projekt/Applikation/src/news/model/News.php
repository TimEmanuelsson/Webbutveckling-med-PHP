<?php

Class News {
	private $title;
	private $link;
	private $description;
	private $pubDate;

	public function __construct($title, $link, $description, $pubDate) {
		$this->title = $title;
		$this->link = $link;
		$this->description = $description;
		$this->pubDate = $pubDate;
	}

	public function getTitle() {
		return $this->title;
	}

	public function getLink() {
		return $this->link;
	}

	public function getDescription() {
		return $this->description;
	}

	public function getPubDate() {
		return $this->pubDate;
	}

}