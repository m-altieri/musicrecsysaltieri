<?php 

namespace Recsysbot\Classes;

use Telegram\Bot\Api;
use GuzzleHttp\Client;

/**
 * @author Francesco Baccaro
 */
class userMovieRecommendation
{
   protected $telegram;
   protected $chatId;
   protected $messageId;
   protected $date;
   protected $text;
   protected $page;
   protected $botName;
   
   protected $movieToRecommender;
   protected $movieListTop5;
   protected $recMovieToRating;

   public function __construct($telegram, $chatId, $messageId, $date, $text, $botName){
      $this->setTelegram($telegram);     
      $this->setChatId($chatId);
      $this->setMessageId($messageId);
      $this->setDate($date);
      $this->setText($text);
      $this->setBotName($botName);
   }

   private function setTelegram($telegram){
      $this->telegram = $telegram;
   } 
   public function getTelegram(){
      return $this->telegram;
   }

   public function setChatId($chatId){
      $this->chatId = $chatId;
   }
   public function getChatId(){
      return $this->chatId;
   }

   public function setMessageId($messageId){
      $this->messageId = $messageId;
   } 
   public function getMessageId(){
      return $this->messageId;
   }

   public function setText($text){
      $this->text = $text;
   } 
   public function getText(){
      return $this->text;
   }

   public function setPage($page){
      $this->page = filter_var($page, FILTER_SANITIZE_NUMBER_INT);
   } 
   public function getPage(){
      return $this->page;
   }

   public function setDate($date){
      $this->date = $date;
   } 
   public function getDate(){
      return $this->date;
   }

   public function setBotName($botName){
      $this->botName = $botName;
   } 
   public function getBotName(){
      return $this->botName;
   }

   private function setMovieToRecommender($movieName){
      $this->movieToRecommender = $movieName;
   }
   public function getMovieToRecommender(){
      return $this->movieToRecommender;
   }

   public function setMovieListTop5($movieListTop5){
      $this->movieListTop5 = $movieListTop5;
   }
   public function getMovieListTop5(){
      return $this->movieListTop5;
   }

   public function setUserRecMovieToRating($movie){
      $this->recMovieToRating = $movie;
   }
   public function getUserRecMovieToRating(){
      return $this->recMovieToRating;
   }


   public function handle(){

      $telegram = $this->getTelegram();
      $chatId = $this->getChatId();
      $messageId = $this->getMessageId();    
      $date = $this->getDate();
      $page = $this->getpage();
      $botName = $this->getBotName();
      
      $movieListTop5 = $this->getUserMovieListTop5($chatId);
      $this->setMovieListTop5($movieListTop5);
      $movieName = $movieListTop5[$page];

      $this->setMovieToRecommender($movieName);  

      $context = "recMovieSelected";
      $replyText = $page."recMovie,".$movieName;
      $replyFunctionCall = "movieDetailReply"; 
      $pagerankCicle = getNumberPagerankCicle($chatId);
      $responseType = "button";
      $result = putChatMessage($chatId, $messageId, $context, $replyText, $replyFunctionCall, $pagerankCicle, $botName, $date, $responseType);

      movieDetailReply($telegram, $chatId, $movieName, $page);

      file_put_contents("php://stderr", "userMovieRecommendation handle: page: ".$page." - movieName: ".$movieName.PHP_EOL);

   }

   public function getUserMovieListTop5($chatId){

      $keyboard = recommendationMovieListTop5Keyboards($chatId);
      $movieListTop5 = array();
          
      if (sizeof($keyboard) == 1) {
         $movieListTop5 = array();
      } 
      else {
         $i = 1;
         foreach ($keyboard as $key => $property) {
            if (stristr($property[0], '🔙') == false) {
               $movie = $property[0];
               $movie = str_replace('🎥', '', $movie);
               $movie = trim($movie);
               $movieListTop5[$i] = $movie;
               $i++;
            }                
         }
      }

      return $movieListTop5;
   }

   public function getPageFromMovieName($chatId,$movieName){

      $keyboard = recommendationMovieListTop5Keyboards($chatId);
      $movieListTop5 = array();

      $page = null;
          
      if (sizeof($keyboard) == 1) {
         $page = null;
      } 
      else {
         $i = 1;
         foreach ($keyboard as $key => $property) {
            if (stristr($property[0], '🔙') == false) {
               $movie = $property[0];
               $movie = str_replace('🎥', '', $movie);
               $movie = trim($movie);
               $movieListTop5[$i] = $movie;
               $i++;
            }                
         }
         //$i = array_search($movieName,$movieListTop5);
         $i = array_search(strtolower($movieName),array_map('strtolower',$movieListTop5)); 
         $page = $i;
      }
      file_put_contents("php://stderr", "userMovieRecommendation getPageFromMovieName: i: ".$i." - movieName: ".$movieName.PHP_EOL);
      file_put_contents("php://stderr", "userMovieRecommendation getPageFromMovieName: page: ".$page." - movieListTop5: ".print_r($movieListTop5, true).PHP_EOL);
      
      return $page;
   }


      
  public function putUserRecMovieRating($chatId, $movie, $rating){
      if ($movie !== "null"){
         $movie_name = str_replace(' ', '_', $movie); //tutti gli spazi con undescore  
         $movieURI = "http://dbpedia.org/resource/";
         $movieURI .= $movie_name;
         $position = $this->getPageFromMovieName($chatId,$movie);
         $pagerank_cicle = getNumberPagerankCicle($chatId);
         $refineRefocus = "null";
         $botName = $this->getBotName();
         $message_id = $this->getMessageId();
         $bot_timestamp = $this->getDate();
         // $recommendatinsListArray = $this->getMovieListTop5();
         // $recommendatinsList = implode(",", $recommendatinsListArray);
         // $ratingsListArray = movieOrPropertyToRatingKeyboard($chatId);
         //$ratingsList = implode(",", $ratingsListArray);
         $recommendatinsList = "null";
         $ratingsList = "null";
         $number_recommendation_list = getNumberPagerankCicle($chatId);

         $data = putRecMovieRating($chatId, $movieURI, $rating, $position, $pagerank_cicle, $refineRefocus, $botName, $message_id, $bot_timestamp, $recommendatinsList, $ratingsList, $number_recommendation_list);
                  //putRecMovieRating?userID=6&movieURI=http://dbpedia.org/resource/Chariots_of_Fire&rating=1&position=2&pagerankCicle=0&refineRefocus=null&botName=xtextrecsysbot&messageID=28801&botTimestamp=1489481920&recommendatinsList=&ratingsList=Array&numberRecommendationList=0` 
         
      }
      else{
         $data = null;
      }
      file_put_contents("php://stderr", "userMovieRecommendation->putUserRecMovieRating - chatId: ".$chatId." - movieURI: "." - rating:".$rating.PHP_EOL);

      return $data;
   }
   public function putUserRecMovieRefine($chatId, $movie){
      if ($movie !== "null"){
         $movie_name = str_replace(' ', '_', $movie); //tutti gli spazi con undescore  
         $movieURI = "http://dbpedia.org/resource/";
         $movieURI .= $movie_name;
         $position = $this->getPageFromMovieName($chatId,$movie);
         $pagerank_cicle = getNumberPagerankCicle($chatId);
         $refineRefocus = "refine";
         $botName = $this->getBotName();
         $message_id = $this->getMessageId();
         $bot_timestamp = $this->getDate();
         // $recommendatinsListArray = $this->getMovieListTop5();
         // $recommendatinsList = implode(",", $recommendatinsListArray);
         // $ratingsListArray = movieOrPropertyToRatingKeyboard($chatId);
         //$ratingsList = implode(",", $ratingsListArray);
         $recommendatinsList = "null";
         $ratingsList = "null";
         $number_recommendation_list = getNumberPagerankCicle($chatId);
         $rating = 3;
         $data = putRecMovieRating($chatId, $movieURI, $rating, $position, $pagerank_cicle, $refineRefocus, $botName, $message_id, $bot_timestamp, $recommendatinsList, $ratingsList, $number_recommendation_list);
                  //putRecMovieRating?userID=6&movieURI=http://dbpedia.org/resource/Chariots_of_Fire&rating=1&position=2&pagerankCicle=0&refineRefocus=null&botName=xtextrecsysbot&messageID=28801&botTimestamp=1489481920&recommendatinsList=&ratingsList=Array&numberRecommendationList=0` 
         
      }
      else{
         $data = null;
      }
      file_put_contents("php://stderr", "userMovieRecommendation->putUserRecMovieRating - chatId: ".$chatId." - movieURI: "." - rating:".$rating.PHP_EOL);

      return $data;
   }

   public function getTitleAndPosterRecMovieToRating($movie){

      $movie_name = str_replace(' ', '_', $movie); //tutti gli spazi con undescore   
      $data = getAllPropertyListFromMovie($movie_name);

      if ($data == "null") {
         $chatId = $this->getChatId();
         $pagerankCicle = getNumberPagerankCicle($chatId);
         $reply = movieToRatingSelected($chatId, $pagerankCicle);
         $movie = $reply[1];
         $movie_name = str_replace(' ', '_', $movie); //tutti gli spazi con undescore  
         $data = getAllPropertyListFromMovie($movie_name);
         file_put_contents("php://stderr", "ERROR - userMovieRecommendation->getTitleAndPosterMovieToRating - movie_name: ".$movie_name."/return title:".$title.PHP_EOL);
      }       

      copy('./recsysbot/images/default.jpg', './recsysbot/images/poster.jpg'); //copia nel poster l'immagine di default
      $poster = $title = "";

      foreach ((array)$data as $key => $value){
         foreach ((array)$value as $k => $v) {
            $propertyType = str_replace("http://dbpedia.org/ontology/", "", $v[1]);
            $property = str_replace("http://dbpedia.org/resource/", "", $v[2]);
            $property = str_replace('_', ' ', $property); // Replaces all underscore with spaces.

            switch ($propertyType) {
               case "poster":
                  $poster = $property;
                  break;
               case "title":
                  $title = $property;
                  break;
               default:
                  break;
            }
         }
      }

      if ($poster != '' AND $poster != "N/A" ) {   
         $img = './recsysbot/images/poster.jpg';
         copy($poster, $img); //copia nell'immagine l'immagine del poster
      }
      file_put_contents("php://stderr", "userMovieRecommendation->getTitleAndPosterMovieToRating - movie_name: ".$movie_name."/return title:".$title.PHP_EOL);

      return $title;
   }

}