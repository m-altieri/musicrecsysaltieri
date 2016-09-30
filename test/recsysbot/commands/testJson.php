<?php
require './../vendor/autoload.php';

use GuzzleHttp\Client;
   $userID = 8;
   $propertyName = "Steven_Spielberg";
   $propertyType = "director";
   //$client = new Client(['base_uri'=>'http://193.204.187.192:8080']);
   //$stringGetRequest ='/restService/films?userID='.$userID.'&propertyName='.$propertyName.'&propertyType='.$propertyType;
   $client = new Client(['base_uri'=>'http://193.204.187.192:8080']);
   $stringGetRequest ='/lodrecsysrestful/restService/preference?userID=6';
   $response = $client->request('GET', $stringGetRequest);
   $bodyMsg = $response->getBody()->getContents();
   $data = json_decode($bodyMsg);
   $result = array();
   $keyboard = array();

   print_r($data);
   exit;

   foreach ($data as $key => $value){
        print_r($value);

         $film = str_replace("http://dbpedia.org/resource/", "", $value);
         $film = str_replace('_', ' ', $film); // Replaces all underscore with spaces.
         $result[] = array(" ".$film);

   }

   //Costruisco la tastiera Elimino i duplicati e i nomi anomali
   foreach($result as $key => $value){
      if(($i = array_search($value,$result))!== FALSE and $key==$i and strlen($value[0]) < 30){   
        $keyboard[] = $result[$i];
      }
   }
   $keyboard[] = array("Menu");

   //return $result;

   print_r($result);
   print_r("<br>");
   print_r("<br>");
   print_r($keyboard);

   exit;


/*  //Test propertyReply

    $userID = 8;
   $client = new Client(['base_uri'=>'http://193.204.187.192:8080']);
   $stringGetRequest ='/restService/property?userID='.$userID.'&propertyType='.$propertyType;
   $response = $client->request('GET', $stringGetRequest);
   $bodyMsg = $response->getBody()->getContents();
   $data = json_decode($bodyMsg);
   $keyboard = array();

   foreach ($data as $key => $value) 
   {
      $property = str_replace("http://dbpedia.org/resource/", "", $value[0]);
      $property = str_replace('_', ' ', $property); // Replaces all underscore with spaces.
      $property = utf8_decode($property);
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
         default:
            # code...
            break;
      }
      $result[] = array(" ".$property);
   }

   return $result;

   print_r($result);
  exit;*/
/*
      //Test Categorie
      $client = new Client(['base_uri'=>'http://193.204.187.192:8080']);
      $response = $client->request('GET', '/restService/categories');
      $bodyMsg = $response->getBody()->getContents();
      $data = json_decode($bodyMsg);
      $result = array();
//print_r($data);


      foreach ($data as $key => $value){
         foreach ($value as $id => $category){
            $categories = str_replace("http://dbpedia.org/resource/Category:", "", $category);
            $categories = str_replace('_', ' ', $categories); // Replaces all underscore with spaces.
            $result[] = array("🗒"." ".$categories);
          }
        }
      //Costruisco la tastiera Elimino gli attori duplicati e i nomi anomali
      foreach($result as $key => $value){
         if(($i = array_search($value,$result))==true and $key==$i and strpos($value[0], '1') == false){
            if (  strpos($value[0], 'drama') == true || 
                  strpos($value[0], 'Drama') == true || 
                  strpos($value[0], 'comedy') == true ||
                  strpos($value[0], 'Comedy') == true ||
                  strpos($value[0], 'crime') == true ||
                  strpos($value[0], 'Crime') == true ||
                  strpos($value[0], 'romantic') == true ||
                  strpos($value[0], 'Romantic') == true ||
                  strpos($value[0], 'christmas') == true ||
                  strpos($value[0], 'Christmas') == true ||
                  strpos($value[0], 'biographical') == true ||
                  strpos($value[0], 'Biographical') == true ||
                  strpos($value[0], 'musical') == true ||
                  strpos($value[0], 'Musical') == true ||
                  strpos($value[0], 'sports') == true ||
                  strpos($value[0], 'Sports') == true ||
                  strpos($value[0], 'thriller') == true ||
                  strpos($value[0], 'Thriller') == true ||
                  strpos($value[0], 'mystery') == true ||
                  strpos($value[0], 'Mystery') == true ||
                  strpos($value[0], 'win') == true ||
                  strpos($value[0], 'fantasy') == true ||
                  strpos($value[0], 'Fantasy') == true ) {
               $keyboard[] = $result[$i];
               print_r("<br>");
               print_r($result[$i]);
            }
            
          }
      }
//print_r($keyboard);*/



      //Test protagonisti
/*      $client = new Client(['base_uri'=>'http://193.204.187.192:8080']);
      $response = $client->request('GET', '/restService/actors');
      $bodyMsg = $response->getBody()->getContents();
      $data = json_decode($bodyMsg);
      $result = array();
      $keyboard = array();

              foreach ($data as $key => $value){
               foreach ($value as $id => $actor){
                  $starring = str_replace("http://dbpedia.org/resource/", "", $actor);
                  $starring = str_replace('_', ' ', $starring); // Replaces all underscore with spaces.
                  $result[] = array("🕴"." ".$starring);
                }
              }
            //Costruisco la stastiera Elimino gli attori duplicati e i nomi anomali
            foreach($result as $key => $value){
              if(($i = array_search($value,$result))==true and $key==$i and strlen($value[0]) < 30){   
                  $keyboard[] = $result[$i];
                }
            }
print_r($keyboard);*/




/*$msg = "📽 Chris Noonan";

//$msg = str_replace(' ', '_', $msg); // Replaces all spaces with underscore.
$NameDirector = substr($msg,5) ;// Replaces all underscore with spaces.

//$IdDirector = preg_replace('/_/', ' ', $NameDirector); // Replaces all underscore with spaces.
$IdDirector = str_replace(' ', '_', $NameDirector); // Replaces all spaces with underscore.
print_r($NameDirector);
print_r(" IdDirector: ".$IdDirector);
exit;

$stringGetRequest ='/restService/films?propertyName='.$IdDirector.'&propertyType=director';
$client = new Client(['base_uri'=>'http://193.204.187.192:8080']);
$response = $client->request('GET', $stringGetRequest);
$bodyMsg = $response->getBody()->getContents();
$data = json_decode($bodyMsg);
      $keyboard = array();
      //$directors = array();
foreach ($data as $key => $value) 
      {
        $film = str_replace("http://dbpedia.org/resource/", "", $value[0]);
        $film = preg_replace('/_/', ' ', $film);
        $keyboard[] = array("*"." ".$film);
        //array_push($directors,$director);
        //array_push($keyboard, $directors);
        //$directors = array();

      }


print_r($keyboard);
exit;*/