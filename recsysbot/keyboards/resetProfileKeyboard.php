<?php
function resetProfileKeyboard() {
	
	$emojis = require '/app/recsysbot/variables/emojis.php';
	
	$keyboard = [ 
			[ 
					$emojis['blacksquarebutton'].' All Properties',
					$emojis['whitesquarebutton'].' All Movies' 
			],
			[ 
					"".$emojis['wastebasket']." Delete all preferences" 
			] 
	];
	
	return $keyboard;
}