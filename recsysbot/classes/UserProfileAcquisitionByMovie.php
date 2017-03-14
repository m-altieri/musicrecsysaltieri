<?php 

namespace Recsysbot\Classes;

use Telegram\Bot\Api;
use GuzzleHttp\Client;

/**
 * @author Francesco Baccaro
 */
class userProfileAcquisitionByMovie
{
   protected $telegram;
   protected $chatId;
   protected $messageId;
   protected $date;
   protected $text;
   protected $botName;

   protected $movieToRating;

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

   public function setUserMovieToRating($movie){
      $this->movieToRating = $movie;
   }
   public function getUserMovieToRating(){
      return $this->movieToRating;
   }

   public function handle(){

      //prendi il film da valutare
      $movie = $this->getUserMovieToRating($chatId);

      //valuta il film
      $this->movieRatingReply($movie);
      //$this->movieDetailReply($movie);      
   }

   public function putAcceptRecMovieToRating($movie){    
      $chatId = $this->getChatId();
      $messageId = $this->getMessageId();
      $botName = $this->getBotName();
      $context = "acceptRecMovieToRatingSelected";
      $replyText = "rateMovie, ".$movie;
      $replyFunctionCall = "userMovieprofileInstance"; 
      $pagerankCicle = getNumberPagerankCicle($chatId);
      $date = $this->getDate();
      $responseType = "button";
      $result = putChatMessage($chatId, $messageId, $context, $replyText, $replyFunctionCall, $pagerankCicle, $botName, $date, $responseType);
   }

   public function putMovieToRating($movie){
      $chatId = $this->getChatId();
      $messageId = $this->getMessageId();
      $botName = $this->getBotName();
      $context = "movieToRatingSelected";
      $replyText = "rateMovie, ".$movie;
      $replyFunctionCall = "userMovieprofileInstance"; 
      $pagerankCicle = getNumberPagerankCicle($chatId);
      $date = $this->getDate();
      $responseType = "button";
      $result = putChatMessage($chatId, $messageId, $context, $replyText, $replyFunctionCall, $pagerankCicle, $botName, $date, $responseType);
   }

   public function getAndSetUserAcceptRecMovieToRating($chatId){
      //prendi l'utimo film raccomandato accettato
      $data = getAcceptRecMovieToRating($chatId);
      $movieURI = $data;
      $movie_name = str_replace("http://dbpedia.org/resource/", "", $movieURI);
      $movie = str_replace('_', ' ', $movie_name); // Replaces all underscore with spaces.

      $this->setUserMovieToRating($movie);
      
      file_put_contents("php://stderr", "userMovieprofile->getAndSetUserAcceptRecMovieToRating - chatId: ".$chatId."/return movie:".$movie.PHP_EOL);

      return $movie;
   }


   public function getAndSetUserMovieToRating($chatId){
      //prendi il film da valutare
      $data = getMovieToRating($chatId);
      $movieURI = $data;
      $movie_name = str_replace("http://dbpedia.org/resource/", "", $movieURI);
      $movie = str_replace('_', ' ', $movie_name); // Replaces all underscore with spaces.

      $this->setUserMovieToRating($movie);
      
      file_put_contents("php://stderr", "userMovieprofile->getAndSetUserMovieToRating - chatId: ".$chatId."/return movie:".$movie.PHP_EOL);

      return $movie;
   }



   public function movieRatingReply($movie){

      $telegram = $this->getTelegram();
      $chatId = $this->getChatId();      

      $movie_name = str_replace(' ', '_', $movie); //tutti gli spazi con undescore
      
      file_put_contents("php://stderr", "userMovieprofile->movieRating() - chatId: ".$chatId.PHP_EOL);
      
      $title = $this->getTitleAndPosterMovieToRating($movie_name);

      $telegram->sendChatAction(['chat_id' => $chatId, 'action' => 'upload_photo']);

      $img = './recsysbot/images/poster.jpg';
      $telegram->sendChatAction(['chat_id' => $chatId, 'action' => 'upload_photo']);
      $telegram->sendPhoto(['chat_id' => $chatId,'photo' => $img, 'caption' => $title]);
      copy('./recsysbot/images/default.jpg', './recsysbot/images/poster.jpg'); //copia nel poster l'immagine di default

      $keyboard = $this->getUserRatedMovieKeyboard($chatId);
      $reply_markup = $telegram->replyKeyboardMarkup(['keyboard' => $keyboard, 'resize_keyboard' => true, 'one_time_keyboard' => false]);

      $text = "Do you 👍 like or 👎 dislike this movie?\nOtherwise, press ➡skip \nor type the name of the movie to rate";
      $telegram->sendChatAction(['chat_id' => $chatId, 'action' => 'typing']);       
      $telegram->sendMessage(['chat_id' => $chatId, 'text' => $text, 'reply_markup' => $reply_markup]);       

   }

/*   public function movieDetailReply($movie){
      $telegram = $this->getTelegram();
      $chatId = $this->getChatId();      

      $movie_name = str_replace(' ', '_', $movie); //tutti gli spazi con undescore
      $title = $this->getTitleAndPosterMovieToRating($movie_name);

      $inline_keyboard[] = [
                         //['text' => 'inline', 'switch_inline_query' => 'true'],
                         //['text' => 'callback', 'callback_data' => 'identifier'],
                         ['text' => 'trailer', 'url' => 'https://github.com/akalongman/php-telegram-bot']
                     ];


      $inlineKeyboardMarkup = $telegram->replyKeyboardMarkup(['inline_keyboard' => $inline_keyboard]);
      //$reply_markup = $telegram->replyKeyboardMarkup(['keyboard' => $keyboard, 'resize_keyboard' => true, 'one_time_keyboard' => false]);

      $text = "...more about ".$title."? choose:";
      //$text = "";
      $telegram->sendChatAction(['chat_id' => $chatId, 'action' => 'typing']);  
      $telegram->sendMessage(['chat_id' => $chatId, 
                              'text' => $text,
                              'reply_markup' => $inlineKeyboardMarkup]);



   }*/


  private function getUserRatedMovieKeyboard($chatId){
      $numberRatedMovies = getNumberRatedMovies($chatId);
      $numberRatedProperties = getNumberRatedProperties($chatId);
      $needNumberOfRatedProperties = 3 - ($numberRatedProperties + $numberRatedMovies);

      if ($needNumberOfRatedProperties <= 0)
         $keyboard = ratedMovieOldUserKeyboard();
      else
         $keyboard = ratedMovieNewUserKeyboard();

      return $keyboard;
   }

   public function putUserAcceptRecMovieRating($chatId, $movie, $rating){

      if ($movie !== "null"){
         $movie_name = str_replace(' ', '_', $movie); //tutti gli spazi con undescore  
         $movieURI = "http://dbpedia.org/resource/";
         $movieURI .= $movie_name;

         $data = putAcceptRecMovieRating($chatId, $movieURI, $rating); 
      }
      else{
         $data = null;
      }
      file_put_contents("php://stderr", "userMovieprofile->putUserAcceptRecMovieRating - chatId: ".$chatId." - movieURI: "." - rating:".$rating.PHP_EOL);

      return $data;
   }

  public function putUserMovieRating($chatId, $movie, $rating){

      if ($movie !== "null"){
         $movie_name = str_replace(' ', '_', $movie); //tutti gli spazi con undescore  
         $movieURI = "http://dbpedia.org/resource/";
         $movieURI .= $movie_name;

         $data = putMovieRating($chatId, $movieURI, $rating);
         
      }
      else{
         $data = null;
      }
      file_put_contents("php://stderr", "userMovieprofile->putUserMovieRating - chatId: ".$chatId." - movieURI: "." - rating:".$rating.PHP_EOL);

      return $data;
   }

   public function getTitleAndPosterMovieToRating($movie){

      $movie_name = str_replace(' ', '_', $movie); //tutti gli spazi con undescore   
      $data = getAllPropertyListFromMovie($movie_name);

      if ($data == "null") {
         $chatId = $this->getChatId();
         $pagerankCicle = getNumberPagerankCicle($chatId);
         $reply = movieToRatingSelected($chatId, $pagerankCicle);
         $movie = $reply[1];
         $movie_name = str_replace(' ', '_', $movie); //tutti gli spazi con undescore  
         $data = getAllPropertyListFromMovie($movie_name);
         file_put_contents("php://stderr", "ERROR - userMovieprofile->getTitleAndPosterMovieToRating - movie_name: ".$movie_name."/return title:".$title.PHP_EOL);
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
      file_put_contents("php://stderr", "userMovieprofile->getTitleAndPosterMovieToRating - movie_name: ".$movie_name."/return title:".$title.PHP_EOL);

      return $title;
   }

}

