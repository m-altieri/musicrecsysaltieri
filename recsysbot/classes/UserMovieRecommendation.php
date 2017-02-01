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
   
   protected $movieToRecommender;
   protected $movieListTop5;

   public function __construct($telegram, $chatId, $messageId, $date, $text){
      $this->setTelegram($telegram);     
      $this->setChatId($chatId);
      $this->setMessageId($messageId);
      $this->setDate($date);
      $this->setText($text);
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

   public function setDate($date){
      $this->date = $date;
   } 
   public function getDate(){
      return $this->date;
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


   public function handle(){

      $telegram = $this->getTelegram();
      $chatId = $this->getChatId();
      $messageId = $this->getMessageId();
      $pagerankCicle = getNumberPagerankCicle($chatId);
      $date = $this->getDate();
      $replyFunctionCall = "lastMovie"; //movieDetailReply
      file_put_contents("php://stderr", "userMovieRecommendation handle - chatId: ".$chatId.PHP_EOL);
      $text = $this->getText();
      $page = filter_var($text, FILTER_SANITIZE_NUMBER_INT);

      $movieListTop5 = $this->getUserMovieListTop5($chatId);
      $this->setMovieListTop5($movieListTop5);
      $movieName = $movieListTop5[$page];
      $this->setMovieToRecommender($movieName);

      file_put_contents("php://stderr", "userMovieRecommendation handle: page: ".$page." - movieName: ".$movieName.PHP_EOL);
      
      $result = putChatMessage($chatId, $messageId, $replyFunctionCall, $movieName, $pagerankCicle, $date); 
      movieDetailReply($telegram, $chatId, $movieName, $page);

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
               $movieListTop5[$i] = $movie;
               $i++;
            }                
         }
      }

      return $movieListTop5;
   }
}