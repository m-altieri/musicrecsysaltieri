<?php 

use GuzzleHttp\Client;

//Costruscire la tastiera di ProfileReply
function movieOrPropertyToRatingKeyboard($chatId, $context){ 

	$emojis = require '/app/recsysbot/variables/emojis.php';
	
   file_put_contents("php://stderr", "movieOrPropertyToRatingKeyboard".PHP_EOL);

   $data = getAllMovieOrPropertyRatings($chatId);
//   echo '<pre>'; print_r($data); echo '</pre>';
  
   $keyboard = array();
   $propertyArray = array();
   $result = array();
   if ($data !== "null") {
      foreach ($data as $typeAndUriKey => $rating) {
      	$property = explode(',', $typeAndUriKey);
      	$propertyTypeUri = $property[0];
      	$propertyValueUri = $property[1];      	
         $propertyValue = replaceUriWithName($propertyValueUri);
         $propertyType = replaceUriWithName($propertyTypeUri);
         
         $movieOrPropertyRating = addmovieOrPropertyRating($propertyValue, $propertyType, $rating);
         switch ($propertyType) {
	         case "/directors": case "directors": case "director":
	            $result[] = array("".$emojis['clapperboard'].""." ".$movieOrPropertyRating);
	            break;
	         case "/starring": case "starring":
	            $result[] = array("".$emojis['manhovering'].""." ".$movieOrPropertyRating);
	            break;
	         case "/categories": case "categories": case "category":	case "http://purl.org/dc/terms/subject": 
	            $movieOrPropertyRating = str_replace("Category:", "", $movieOrPropertyRating);
	            $result[] = array("".$emojis['videocassette'].""." ".$movieOrPropertyRating);
	            break;
	         case "/genres": case "genres": case "genre":
	            $result[] = array("".$emojis['filmframe'].""." ".$movieOrPropertyRating);
	            break;
	         case "/writers": case "writers": case "writer":
	             $result[] = array("".$emojis['pen'].""." ".$movieOrPropertyRating);
	            break;
	         case "/producers": case "producers": case "producer":
	             $result[] = array("".$emojis['moneybag'].""." ".$movieOrPropertyRating);
	            break;
	         case "/release year": case "release year": case "releaseYear":
	             $result[] = array("".$emojis['calendar'].""." ".$movieOrPropertyRating);
	            break;
	         case "/music composers": case "music composers": case "music composer": case "musicComposer": case "music":
	            $result[] = array("".$emojis['musicscore'].""." ".$movieOrPropertyRating);
	            break;
	         case "/runtimeRange": case "runtimeRange": case "runtime":
	            $result[] = array("".$emojis['clockflat'].""." ".$movieOrPropertyRating);
	            break;
	         case "/cinematographies": case "cinematographies": case "cinematography":
	             $result[] = array("".$emojis['camera'].""." ".$movieOrPropertyRating);
	            break;
	         case "/based on": case "based on": case "basedOn":
	             $result[] = array("".$emojis['notebook'].""." ".$movieOrPropertyRating);
	            break;
	         case "/editings": case "editings": case "editing":
	             $result[] = array("".$emojis['briefcase'].""." ".$movieOrPropertyRating);
	            break;
	         case "/distributors": case "distributors": case "distributor":
	             $result[] = array("".$emojis['building'].""." ".$movieOrPropertyRating);
	            break;
	         case "movie": 
	             $result[] = array("".$emojis['projector'].""." ".$movieOrPropertyRating);
	            break;
	         default:
	            break;
	      }
	   }   
   }
   if (strcasecmp($context, "recContext") == 0) {

   	   if(!empty($result)){
			   $keyboard = $result;
			   $keyboard[] = array("".$emojis['backarrow']." Back to Movies","".$emojis['bookorange']." Help");
			}
			else{
				$keyboard[] = array("".$emojis['backarrow']." Back to Movies","".$emojis['bookorange']." Help");
			}

   }
   else{

   	   if(!empty($result)){
			   $keyboard = $result;
			   $keyboard[] = array("".$emojis['backarrow']." Home","".$emojis['bookorange']." Help");
			   $keyboard[] = array("".$emojis['x']." Reset");
			}
			else{
				$keyboard[] = array("".$emojis['backarrow']." Home","".$emojis['bookorange']." Help");
			}

   }     

   return $keyboard;
}
