<?php 

namespace Recsysbot;

use Telegram\Bot\Actions;
use Telegram\Bot\Commands\Command;
use GuzzleHttp\Client;

/**
 * @author Francesco Baccaro
 */
class userProfile extends Command
{
    protected $name = "profile";
    protected $description = "RecSysBot - create user profile command";
    protected $client;
    protected $movieToRating;
    protected $chatId; 


    public function __construct(){      
      $this->setClient();
    }

   private function setClient(){
      //$this->client = new Client(['base_uri'=>'http://localhost:8080']);
      $this->client = new Client(['base_uri'=>'http://193.204.187.192:8080']);
    }

   public function getClient(){
      return $this->client;
    }

   private function setMovieToRating($movieName){
      $this->movieToRating = $movieName;
    }

    public function getMovieToRating(){
      return $this->movieToRating;
    }

   public function setChatId($userId){
      //$this->chatId = $userId;
      $this->chatId = 129877748;
    }

   public function getChatId(){
      return $this->chatId;
    }


   public function handle($arguments){


      //Get
      //$userId = 129877748;
      //$this->replyWithMessage(['text' => 'userId: '.$userId]);
      //$userId = $this->getUpdate()->getMessage()->getChat()->getId();

      //$this->setChatId($userId);
      $chatId = $this->getChatId();
      //$this->replyWithMessage(['text' => 'chatId: '.$chatId]);
/*        $this->replyWithChatAction(['action' => Actions::TYPING]);
        $arguments = $this->getTelegram()->getLastResponse()->getDecodedBody();
        $argument_array = explode(' ',$arguments);
        foreach ($argument_array as $key => $value) {
            $this->replyWithMessage(['text' => 'Argument '.$key.': '.$value]);
        }*/

      $movieName = $this->getUserMovieToRating($chatId); 
      $title = $this->getTitleAndPosterMovieToRating($movieName);
      
      //bot
      $this->replyWithChatAction(['action' => Actions::TYPING]);
      $text = "Do you like this movie?";
      $this->replyWithMessage([
            'text' => $text
            ]);      

      $this->replyWithChatAction(['action' => Actions::UPLOAD_PHOTO]);
      $this->replyWithPhoto([
             'photo' => './recsysbot/images/poster.jpg', 
             'caption' => $title
            ]);
      copy('./recsysbot/images/default.jpg', './recsysbot/images/poster.jpg');

      $keyboard = $this->getKeyboardFilms();
      $reply_markup = $this->getTelegram()->replyKeyboardMarkup([
                             'keyboard' => $keyboard,
                             'resize_keyboard' => true,
                             'one_time_keyboard' => false
                             ]);
      
      $this->replyWithChatAction(['action' => Actions::TYPING]);
      $text = "Skip, if you don't watch";
      $this->replyWithMessage([
            'text' => $text,
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
      //$userID = $chatId;
      $client = $this->getClient();   
      $stringGetRequest ='/lodrecsysrestful/restService/movieToRating/getMovieToRating?userID='.$chatId;
      $response = $client->request('GET', $stringGetRequest);
      $bodyMsg = $response->getBody()->getContents();
      $movieURI = json_decode($bodyMsg);
      $movieName = str_replace("http://dbpedia.org/resource/", "", $movieURI);
      $movieName = str_replace('_', ' ', $movieName); // Replaces all underscore with spaces.
      
      $this->setMovieToRating($movieName);
      echo $movieURI."<br>";
      return $movieName;
   }

  public function putUserMovieToRating($chatId, $movieName, $rating){

      //$userID = $chatId;

      if ($movieName != "null"){
         $movieName = str_replace(' ', '_', $movieName);
         $movieURI = "http://dbpedia.org/resource/";
         $movieURI .= $movieName;

         $client = $this->getClient();        
         $stringGetRequest ='/lodrecsysrestful/restService/movieRating/putMovieRating?userID='.$chatId.'&movieURI='.$movieURI.'&rating='.$rating;
         $response = $client->request('GET', $stringGetRequest);
         $bodyMsg = $response->getBody()->getContents();
         $data = json_decode($bodyMsg);
         
      }
      else{
         $data = null;
      }

      return $bodyMsg;
   }

   public function getTitleAndPosterMovieToRating($movieName){
      $movieName = str_replace(' ', '_', $movieName);
      
      $client = $this->getClient();
      $stringGetRequest ='/lodrecsysrestful/restService/movieDetail/getAllPropertyListFromMovie?movieName='.$movieName;      
      $response = $client->request('GET', $stringGetRequest);
      $bodyMsg = $response->getBody()->getContents();
      $data = json_decode($bodyMsg);

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

   public function getNumberOfRatedMovies($chatId){
      //$userID = $chatId;
      $client = new Client(['base_uri'=>'http://193.204.187.192:8080']);
      $stringGetRequest ='/lodrecsysrestful/restService/movieRating/getNumberRatedMovies?userID='.$chatId;
      $response = $client->request('GET', $stringGetRequest);
      $bodyMsg = $response->getBody()->getContents();
      $data = json_decode($bodyMsg);
      return $data;
      }

}

