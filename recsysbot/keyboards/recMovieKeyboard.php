<?php

function recMovieKeyboard($chatId, $page){

	$emojis = require '/app/recsysbot/variables/emojis.php';
	
   $keyboard = array();

   if ($page == 1) {
   	$nextPage = $page+1;
   	$keyboard = [
	                  ["😃 Like", "🙁 Dislike","🌀 Like, but..."],
	                  ["📑 Details","📣 Why?"],
	                  ["Next ".$nextPage." 👉"],
	                  ["".$emojis['backarrow']." Home",'📗 Help','👤 Profile']

	               ];
	} 
	elseif ($page > 1 && $page < 5) {
	   $nextPage = $page+1;
	   $backPage = $page-1;
	   $keyboard = [
	                  ["😃 Like", "🙁 Dislike","🌀 Like, but..."],
	                  ["📑 Details","📣 Why?"],
	                  ["👈 Back ".$backPage,"Next ".$nextPage." 👉"],
	                  ["".$emojis['backarrow']." Home",'📗 Help','👤 Profile']

	               ];
	}
	elseif($page > 4) {
		$nextPage = setNextOrChangeKeyfunction($chatId);
	   $backPage = 4;
	   $keyboard = [
	                  ["😃 Like", "🙁 Dislike","🌀 Like, but..."],
	                  ["📑 Details","📣 Why?"],
	                  ["👈 Back ".$backPage."", "".$nextPage],
	                  ["".$emojis['backarrow']." Home",'📗 Help','👤 Profile']
	               ];
	}

	return $keyboard;

}