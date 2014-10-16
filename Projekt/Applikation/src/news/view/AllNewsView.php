<?php

Class AllNewsView {

	public function showAllNews($NewsList, $news) {

		$contentString = '';

		foreach ($NewsList->channel->item as $item) {

			$contentString  .= "
			<a href='" . $item->link . "'><h2>" . $item->title . "</h2></a>
			<p><b>" . $item->description . "</b></p>
			<p>" . $item->pubDate . "</p>
			<p>-----------------------------------------------------------------------------------------</p>

			";
		}

		$ret = "
				<h1>" . $news . "</h1>
				<a href='?'>Visa alla nyheter</a>
				<a href='?sport'>Visa sportnyheter</a>
				<a href='?pleasure'>Visa nöjesNyheter</a></br>
				<a href='?login'>Logga in</a>
				<ul>$contentString</ul>
		";
	
		return $ret;
	}
}