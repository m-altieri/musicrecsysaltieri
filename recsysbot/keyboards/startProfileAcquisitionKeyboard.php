<?php

function startProfileAcquisitionKeyboard(){
	
	$emojis = require '/app/recsysbot/variables/emojis.php';
	
   $keyboard = [
         ['🔴 Rate movie properties'],
         ['🔵 Rate movies'],
         ['".$emojis['gear']." Profile']
     ];

	return $keyboard;

}