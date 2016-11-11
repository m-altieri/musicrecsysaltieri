<?php
 
use GuzzleHttp\Client;

function getKeyboardFullMenu($chatId){

	$userID = 6;
		
	$director = getKeyboardProperty($userID, "director"); 
	$starring = getKeyboardProperty($userID, "starring");
	$category = getKeyboardProperty($userID, "category");
	$genre = getKeyboardProperty($userID, "genre");
	$writer = getKeyboardProperty($userID, "writer");
	$producer = getKeyboardProperty($userID, "producer");
	$releaseYear = getKeyboardProperty($userID, "releaseYear");
	$musicComposer = getKeyboardProperty($userID, "musicComposer");
	$runtimeRange = getKeyboardProperty($userID, "runtimeRange");
	$cinematography = getKeyboardProperty($userID, "cinematography");
	$basedOn = getKeyboardProperty($userID, "basedOn");
	$editing = getKeyboardProperty($userID, "editing");
	$distributor = getKeyboardProperty($userID, "distributor");

	$size_director = count($director);
	$size_starring = count($starring);
	$size_category = count($category);
	$size_genre = count($genre);
	$size_writer = count($writer);
	$size_producer = count($producer);
	$size_releaseYear = count($releaseYear);
	$size_musicComposer = count($musicComposer);
	$size_runtimeRange = count($runtimeRange);
	$size_cinematography = count($cinematography);
	$size_basedOn = count($basedOn);
	$size_editing = count($editing);
	$size_distributor = count($distributor);

	$fullMenuArray = array();

	$fullMenuArray[10+$size_director."director"] = "Director";
	$fullMenuArray[10+$size_starring."starring"] = "Actor";
	$fullMenuArray[10+$size_category."category"] = "Category";
	$fullMenuArray[10+$size_genre."genre"] = "Genre";
	$fullMenuArray[10+$size_writer."writer"] = "Writer";
	$fullMenuArray[10+$size_producer."producer"] = "Producer";
	$fullMenuArray[10+$size_releaseYear."releaseYear"] = "Release year";
	$fullMenuArray[10+$size_musicComposer."musicComposer"] = "Music";
	$fullMenuArray[10+$size_runtimeRange."runtimeRange"] = "Runtime";
	$fullMenuArray[10+$size_cinematography."cinematography"] = "Cinematography";
	$fullMenuArray[10+$size_basedOn."basedOn"] = "Based on";
	$fullMenuArray[10+$size_editing."editing"] = "Editing";
	$fullMenuArray[10+$size_distributor."distributor"] = "Distributor";
	krsort($fullMenuArray);

/*	print_r("<br>propertyArray: ");
	echo '<pre>'; print_r($fullMenuArray); echo '</pre>';
	foreach ($fullMenuArray as $key => $property) {
	    $result[] = array(" ".$property);
	}*/	
	//$keyboard = $result;
	//$keyboard[] = array('/profile','/help','<-');
   //return $keyboard;

   return $fullMenuArray;

}