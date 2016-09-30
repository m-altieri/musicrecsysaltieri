<?php
require './../vendor/autoload.php';

use GuzzleHttp\Client;
   
   //$client = new Client(['base_uri'=>'http://lodrecsysrestful.herokuapp.com']);
   //$stringGetRequest ='/restService/property?userID='.$userID.'&propertyType='.$propertyType;
   $userID = 8;
   $propertyType="genres";
   $client = new Client(['base_uri'=>'http://193.204.187.192:8080']);
   $stringGetRequest ='/lodrecsysrestful/restService/property?userID='.$userID.'&propertyType='.$propertyType;
   //$stringGetRequest ='/lodrecsysrestful/restService/property?userID=8&propertyType=writer';
   //$stringGetRequest ='/lodrecsysrestful/restService/property?userID=8&propertyType=runtime';
   $response = $client->request('GET', $stringGetRequest);
   $bodyMsg = $response->getBody()->getContents();
   $data = json_decode($bodyMsg);
   $result = array();
   $keyboard = array();

   foreach ($data as $key => $value){
      foreach ($value as $k => $v) {
         $property = str_replace("http://dbpedia.org/resource/", "", $v);
         $property = str_replace('_', ' ', $property); // Replaces all underscore with spaces.
         switch ($propertyType) {
               case "/directors": case "directors": case "director":
                  $result[] = array("📽"." ".$property);
                  break;
               case "/starring": case "starring":
                  $result[] = array("🕴"." ".$property);
                  break;
               case "/categories": case "categories": case "category":
                  $result[] = array("🗒"." ".$property);
                  break;
               case "/runtime": case "runtime":
                  $result[] = array("⏳"." ".$property);
                  break;
               case "/writers": case "writers": case "writer":
                   $result[] = array("✍"." ".$property);
                  break;
               case "/producers": case "producers": case "producer":
                   $result[] = array("💰"." ".$property);
                  break;
               case "/release date": case "release date": case "releaseDate":
                   $result[] = array("🗓"." ".$property);
                  break;
               case "/music composers": case "music composers": case "music composer": case "musicComposer":
                  //musicComposer
                  $result[] = array("🎼"." ".$property);
                  break;
               case "/cinematographies": case "cinematographies": case "cinematography":
                   $result[] = array("📷"." ".$property);
                  break;
               case "/based on": case "based on": case "basedOn":
                  //basedOn
                   $result[] = array("📔"." ".$property);
                  break;
               case "/editings": case "editings": case "editing":
                   $result[] = array("💼"." ".$property);
                  break;
               case "/distributors": case "distributors": case "distributor":
                   $result[] = array("🏢"." ".$property);
                  break;
               default:
                  break;
         }
      }
   }

   //Costruisco la tastiera Elimino i duplicati e i nomi anomali
      foreach($result as $key => $value){
         //if(($i = array_search($value,$result))!== FALSE and $key==$i and strlen($value[0]) < 30){   
         if(($i = array_search($value,$result))!== FALSE and $key==$i and strlen($value[0]) < 50){   
           $keyboard[] = $result[$i];
         }
         else{
            print_r("<br>Duplicato!! ");
            print_r($result[$i]);
            print_r("<br>");
         }
            
   }
/*   foreach($result as $ky => $vl){
      //print_r($vl[0]);  print_r("<br>");
      $name = substr($vl[0],5);
      print_r($name);
      if((($i = searchDuplicate($name,$result))!==false) and ($ky==$i) and (strlen($vl[0]) < 30)){
      //print_r(array_search($vl,$result));  print_r("<br>");
         print_r($vl[0]);
      print_r($result[$i]);
        $keyboard[] = $result[$i];
      }
   }*/

   $keyboard[] = array("Menu");

   //return $result;

   print_r($result);
   print_r("<br>");
   print_r("<br>Keyboard:");
   print_r("<br>");
   print_r($keyboard);

   exit;

function searchDuplicate($name, $result) {
    foreach($result as $index => $val) {
        if(strpos($val[0], $name) !== false) {
                  print_r($val[0]);
         print_r($name);
         return $index;
      }
    }
    return false;
}