<?php
function movieListFromPropertyValueKeyboard($chatId, $propertyName, $propertyType) {
	
	$emojis = require '/app/recsysbot/variables/emojis.php';
	
	$data = getMovieListFromProperty ( $chatId, $propertyName, $propertyType );
	
	$result = array ();
	$keyboard = array ();
	if ($data !== "null") {
		foreach ( $data as $key => $value ) {
			foreach ( $value as $k => $v ) {
				$propertyStr = str_replace ( "http://dbpedia.org/resource/", "", $v );
				$propertyStr = str_replace ( '_', ' ', $propertyStr ); // Replaces all underscore with spaces.
				list ( $score, $nodo ) = explode ( ',', $propertyStr );
				$propertyArray [$score] = $nodo;
				krsort ( $propertyArray );
			}
		}
		
		foreach ( $propertyArray as $key => $property ) {
			$result [] = array (
					"" . $property 
			);
		}
	}
	
	$keyboard = $result;
	$propertyType = "Properties";
	$keyboard [] = array (
			"".$emojis['backarrow']." Return to the list of Properties" 
	);
	
	return $keyboard;
}
