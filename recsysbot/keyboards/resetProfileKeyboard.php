<?php
function resetProfileKeyboard() {
	$keyboard = [ 
			[ 
					$emojis['blacksquarebutton'].'All Properties',
					$emojis['whitesquarebutton'].'All Movies' 
			],
			[ 
					'🗑 Delete all preferences' 
			] 
	];
	
	return $keyboard;
}