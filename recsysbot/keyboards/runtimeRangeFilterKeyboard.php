<?php
function runtimeRangeFilterKeyboard() {
	
	$emojis = require '/app/recsysbot/variables/emojis.php';
	
	$keyboard = [ 
			[ 
					"".$emojis['clockflat']." <= 90 min" 
			],
			[ 
					"".$emojis['clockflat']." 90 - 120 min" 
			],
			[ 
					"".$emojis['clockflat']." 120 - 150 min" 
			],
			[ 
					"".$emojis['clockflat']." > 150 min" 
			] 
	];
	
	return $keyboard;
}