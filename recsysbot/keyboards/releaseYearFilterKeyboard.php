<?php
function releaseYearFilterKeyboard() {
	
	$emojis = require '/app/recsysbot/variables/emojis.php';
	
	$keyboard = [ 
			[ 
					"".$emojis['calendar']." 1910s - 1950s" 
			],
			[ 
					"".$emojis['calendar']." 1950s - 1980s" 
			],
			[ 
					"".$emojis['calendar']." 1980s - 2000s" 
			],
			[ 
					"".$emojis['calendar']." 2000s - today" 
			] 
	];
	
	return $keyboard;
}