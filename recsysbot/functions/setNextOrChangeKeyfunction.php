<?php
function setNextOrChangeKeyfunction($chatId) {
	$numberRatedRecMovieList = getNumberRatedRecMovieList ( $chatId );
	
	if ($numberRatedRecMovieList > 0) {
		$key = "Next 👉";
	} else {
		$key = "".$emojis['angersymbol']." Change";
	}
	
	return $key;
}