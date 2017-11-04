<?php
function recommendationBackNextMovieReply($telegram, $chatId, $userMovieRecommendation) {
	
	$emojis = require '/app/recsysbot/variables/emojis.php';
	
	$text = "Please wait. I'm working for you ".$emojis['smile']."";
	
	echo '<pre>';
	print_r ( $text );
	echo '</pre>';
	$telegram->sendChatAction ( [ 
			'chat_id' => $chatId,
			'action' => 'typing' 
	] );
	$telegram->sendMessage ( [ 
			'chat_id' => $chatId,
			'text' => $text 
	] );
	
	$userMovieRecommendation->setPage ( 1 );
	$userMovieRecommendation->pagerank ();
}