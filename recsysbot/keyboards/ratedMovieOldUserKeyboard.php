<?php

function ratedMovieOldUserKeyboard(){

	$emojis = require '/app/recsysbot/variables/emojis.php';
	
   $keyboard = [
                ["".$emojis['globe']." Recommend Movies"],
                ['📋 Details','👍','👎','➡ Skip'],
                ['🔴 Properties','📘 Help',"".$emojis['gear']." Profile"]
                
            ];

   return $keyboard;

}