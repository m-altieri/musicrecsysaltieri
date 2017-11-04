<?php

function ratedMovieNewUserKeyboard(){
   
	$emojis = require '/app/recsysbot/variables/emojis.php';
	
   $keyboard = [
                   ['📋 Details','👍','👎','➡ Skip'],
                   ['🔴 Properties','📘 Help',"".$emojis['gear']." Profile"]
               ];

   return $keyboard;

}