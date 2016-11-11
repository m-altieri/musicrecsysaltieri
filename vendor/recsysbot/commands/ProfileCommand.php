<?php 
 
namespace Vendor\Recsysbot\Commands;
 
use Telegram\Bot\Actions;
use Telegram\Bot\Commands\Command;
use GuzzleHttp\Client;
 
/**
 * @author Francesco Baccaro
 */
class ProfileCommand extends Command
{
   protected $name = "profile";
   protected $description = "RecSysBot - create user profile command";
   protected $client;
   protected $movieToRating;
   protected $userID;
   protected $i;  
 
   public function __construct(){      
      $this->setClient();
      $this->setUserID();
      $this->setIndex(0);
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
 
   public function setUserID(){
      $this->userID = 6;
    }
 
   public function getUserID(){
      return $this->userID;
    }
 
   public function setIndex($i){
      $this->i = $i;
   }
 
   public function getIndex(){
      return $this->i;
   }
 
   public function handle($arguments){
 
      //Get
      $userID = $this->getUserID();
      $movieName = $this->getUserMovieToRating($userID); 
      $title = $this->getTitleAndPosterMovieToRating($movieName);
       
      //bot  
 
      $this->replyWithChatAction(['action' => Actions::UPLOAD_PHOTO]);
      $this->replyWithPhoto([
             'photo' => './images/poster.jpg', 
             'caption' => $title
            ]);
      copy('./images/default.jpg', './images/poster.jpg');
 
      $keyboard = $this->getKeyboardFilms();
      $reply_markup = $this->getTelegram()->replyKeyboardMarkup([
                             'keyboard' => $keyboard,
                             'resize_keyboard' => true,
                             'one_time_keyboard' => false
                             ]);

      $this->replyWithChatAction(['action' => Actions::TYPING]);
      $text = "Do you like this movie?";
      $this->replyWithMessage([
            'text' => $text
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
                      ['👍 Like','👎 Dislike','🗯 Skip']
                   ];
 
      return $keyboard;
   }
 
   public function getUserMovieToRating($userID){
      $client = $this->getClient();   
      $stringGetRequest ='/lodrecsysrestful/restService/movieToRating/getMovieToRating?userID='.$userID;
      $response = $client->request('GET', $stringGetRequest);
      $bodyMsg = $response->getBody()->getContents();
      $movieURI = json_decode($bodyMsg);
      $movieName = str_replace("http://dbpedia.org/resource/", "", $movieURI);
      $movieName = str_replace('_', ' ', $movieName); // Replaces all underscore with spaces.
       
      $this->setMovieToRating($movieName);
      echo $movieURI."<br>";
      return $movieName;
   }
 
  public function putUserMovieToRating($userID, $movieName, $rating){
 
      if ($movieName != "null"){
         $movieName = str_replace(' ', '_', $movieName);
         $movieURI = "http://dbpedia.org/resource/";
         $movieURI .= $movieName;
 
         $client = $this->getClient();        
         $stringGetRequest ='/lodrecsysrestful/restService/movieRating/putMovieRating?userID='.$userID.'&movieURI='.$movieURI.'&rating='.$rating;     
         $response = $client->request('GET', $stringGetRequest);
         $bodyMsg = $response->getBody()->getContents();
         $data = json_decode($bodyMsg);
      }
      else{
         $data = null;
      }
 
      print_r( $userID);
      print_r("<br>");
      print_r( $movieName);
      print_r("<br>");
      print_r( $movieURI);
      print_r("<br>");
      print_r( $rating);
      print_r("<br>");
      print_r($data);
      print_r("<br>");
      print_r($bodyMsg);
      print_r("<br>");
 
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
         $img = './images/poster.jpg';
         copy($poster, $img);
      }
 
      return $title;
   }
 
   public function getNumberOfRatedMovies($chatId){
      $userID = 6;
      $client = new Client(['base_uri'=>'http://193.204.187.192:8080']);
      $stringGetRequest ='/lodrecsysrestful/restService/movieRating/getNumberRatedMovies?userID='.$userID;
      $response = $client->request('GET', $stringGetRequest);
      $bodyMsg = $response->getBody()->getContents();
      $data = json_decode($bodyMsg);
      return $data;
      }

}