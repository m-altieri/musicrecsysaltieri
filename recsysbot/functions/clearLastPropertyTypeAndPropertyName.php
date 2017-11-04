<?php
function clearLastPropertyTypeAndPropertyName($fullText) {
	
	$emojis = require '/app/recsysbot/variables/emojis.php';
	
	$arrayText = explode ( " - ", $fullText );
	$text = $arrayText [0];
	$text = trim ( $text );
	// $text = str_replace(("".$emojis['pen'].""), 'writer,', $text);
	
	return $text;
}
