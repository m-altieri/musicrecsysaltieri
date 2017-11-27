<?php
use Recsysbot\Classes\userMovieRecommendation;
function recMovieRatingReply($telegram, $chatId, $rating, $lastChange, $messageId, $text, $botName, $date, $userMovieRecommendation) {
	
	$emojis = require '/app/recsysbot/variables/emojis.php';
	
	$pagerankCicle = getNumberPagerankCicle ( $chatId );
	
	$text = null;
	
	if ($rating == 1) {
		$reply = likeRecMovieSelected ( $chatId, $pagerankCicle );
		$text = "You Like";
		
	} elseif ($rating == 0) {
		$reply = dislikeRecMovieSelected ( $chatId, $pagerankCicle );
		$text = "You Dislike";
		
	}
		
	$movie = $reply [1];
	$movie = str_replace ( ' ', '_', $movie ); // tutti gli spazi con undescore
	$movie = str_replace('🎥_', '', $movie);
	$movie = str_replace('🎥', '', $movie);
	$userMovieRecommendation->putUserDislikeRecMovieRating ( $chatId, $movie, $rating, $lastChange );
	
	$title = $userMovieRecommendation->getTitleAndPosterRecMovieToRating ( $movie );
	
	$text = $text . " \"" . $title . "\" movie ".$emojis['smile']."";
	$telegram->sendChatAction ( [ 
			'chat_id' => $chatId,
			'action' => 'typing' 
	] );
	$telegram->sendMessage ( [ 
			'chat_id' => $chatId,
			'text' => $text 
	] );
	
	echo '<pre>';
	echo ($text);
	echo '</pre>';
	
	$page = $userMovieRecommendation->getPageFromMovieName ( $chatId, $movie );
	$page = $page + 1;
	$text = $page;
	backNextFunction ( $telegram, $chatId, $messageId, $text, $botName, $date, $userMovieRecommendation );
}