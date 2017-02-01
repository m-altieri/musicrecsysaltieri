<?php
 
function createKeaboardFromPropertyArrayAsScoreToPropertyValueFunction($propertyArray, $propertyType){

	$result = array();
	foreach ($propertyArray as $key => $property) {
         switch ($propertyType) {
            case "/directors": case "directors": case "director":
               $result[] = array("🎬"." ".ucwords($property));
               break;
            case "/starring": case "starring":
               $result[] = array("🕴"." ".ucwords($property));
               break;
            case "/categories": case "categories": case "category":
               $property = str_replace("Category:", "", $property);
               $result[] = array("📼"." ".ucwords($property));
               break;
            case "/genres": case "genres": case "genre":
               $result[] = array("🎞"." ".ucwords($property));
               break;
            case "/writers": case "writers": case "writer":
                $result[] = array("🖊"." ".ucwords($property));
               break;
            case "/producers": case "producers": case "producer":
                $result[] = array("💰"." ".ucwords($property));
               break;
            case "/release year": case "release year": case "releaseYear":
                $result[] = array("🗓"." ".ucwords($property));
               break;
            case "/music composers": case "music composers": case "music composer": case "musicComposer": case "music":
               $result[] = array("🎼"." ".ucwords($property));
               break;
            case "/runtimeRange": case "runtimeRange": case "runtime":
               $result[] = array("🕰"." Under ".ucwords($property)." minutes");
               break;
            case "/cinematographies": case "cinematographies": case "cinematography":
                $result[] = array("📷"." ".ucwords($property));
               break;
            case "/based on": case "based on": case "basedOn":
                $result[] = array("📔"." ".ucwords($property));
               break;
            case "/editings": case "editings": case "editing":
                $result[] = array("💼"." ".ucwords($property));
               break;
            case "/distributors": case "distributors": case "distributor":
                $result[] = array("🏢"." ".ucwords($property));
               break;
            default:
               break;
         }
      }
   return $result;
}
