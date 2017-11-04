<?php
function resetProfileKeyboard() {
	$keyboard = [ 
			[ 
					$emojis['blacksquarebutton'].'All Properties',
					$emojis['whitesquarebutton'].'All Movies' 
			],
			[ 
					"".$emojis['wastebasket']." Delete all preferences" 
			] 
	];
	
	return $keyboard;
}