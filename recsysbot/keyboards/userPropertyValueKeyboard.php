<?php

function userPropertyValueKeyboard(){

	$emojis = require '/app/recsysbot/variables/emojis.php';
	
   $keyboard = [
         ["".$emojis['globe']." Recommend Movies"],
         ['🔴 Rate movie properties'],
         ['🔵 Rate movies'],
         ["".$emojis['gear']." Profile"]
     ];

	return $keyboard;

}