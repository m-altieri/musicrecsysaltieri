<?php 

namespace Recsysbot\Classes;

use Telegram\Bot\Api;
use GuzzleHttp\Client;

/**
 * @author Francesco Baccaro
 */
class userProfileAcquisitionByMovie
{
   protected $name = "profile";
   protected $description = "RecSysBot - create user profile command";
   protected $telegram;
   protected $chatId; 
   protected $text;
   protected $client;
   protected $movieToRating;

   public function __construct($telegram, $chatId, $text){
      $this->setTelegram($telegram);     
      $this->setChatId($chatId);
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

   private function setText($text){
      $this->text = $text;
   } 
   public function getText(){
      return $this->text;
   }

   private function setMovieToRating($movieName){
      $this->movieToRating = $movieName;
   }
   public function getMovieToRating(){
      return $this->movieToRating;
   }

   public function handle(){

      $telegram = $this->getTelegram();
      $chatId = $this->getChatId();
      file_put_contents("php://stderr", "handle - chatId: ".$chatId.PHP_EOL);

      $movieName = $this->getUserMovieToRating($chatId); 
      $title = $this->getTitleAndPosterMovieToRating($movieName);
      
      
      //bot
      $text = "Do you like this movie?";
      $telegram->sendChatAction(['chat_id' => $chatId, 'action' => 'typing']);       
      $telegram->sendMessage(['chat_id' => $chatId, 'text' => $text]); 

      $telegram->sendChatAction(['chat_id' => $chatId, 'action' => 'upload_photo']);

      $img = './recsysbot/images/poster.jpg';
      $telegram->sendChatAction(['chat_id' => $chatId, 'action' => 'upload_photo']);
      $telegram->sendPhoto(['chat_id' => $chatId,'photo' => $img, 'caption' => $title]);
      copy('./recsysbot/images/default.jpg', './recsysbot/images/poster.jpg');

      $keyboard = $this->getKeyboardFilms();
      $reply_markup = $telegram->replyKeyboardMarkup(['keyboard' => $keyboard,
                             'resize_keyboard' => true,
                             'one_time_keyboard' => false
                             ]);
      
      $text = "Skip, if you don't watch";
      $telegram->sendChatAction(['chat_id' => $chatId, 'action' => 'typing']);        
      $telegram->sendMessage(['chat_id' => $chatId, 'text' => $text,
            'reply_markup' => $reply_markup
            ]);
   }


  private function getKeyboardFilms(){
      $keyboard = [
                      ['👍 Like','👎 Dislike','💬 Skip']
                   ];

      return $keyboard;
   }

   public function getUserMovieToRating($chatId){

      $data = getMovieToRating($chatId);
      $movieURI = $data;
      $movieName = str_replace("http://dbpedia.org/resource/", "", $movieURI);
      $movieName = str_replace('_', ' ', $movieName); // Replaces all underscore with spaces.
      
      $this->setMovieToRating($movieName);

      return $movieName;
   }

  public function putUserMovieToRating($chatId, $movieName, $rating){

      if ($movieName != "null"){
         $movieName = str_replace(' ', '_', $movieName);
         $movieURI = "http://dbpedia.org/resource/";
         $movieURI .= $movieName;

         $data = putMovieRating($chatId, $movieURI, $rating);
         
      }
      else{
         $data = null;
      }

      return $data;
   }

   public function getTitleAndPosterMovieToRating($movieName){

      $movieName = str_replace(' ', '_', $movieName);      
      $data = getAllPropertyListFromMovie($movieName);

      $poster = $title = "";

      foreach ($data as $key => $value){
         foreach ($value as $k => $v) {
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
         copy($poster, $img);
      }

      return $title;
   }

}

