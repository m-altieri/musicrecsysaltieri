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

   public function setClient(){
      //$this->client = new Client(['base_uri'=>'http://localhost:8080']);
      $this->client = new Client(['base_uri'=>'http://193.204.187.192:8080']);
    }

   public function getClient(){
      return $this->client;
    }

    public function setMovieToRating($film){
      $this->movieToRating = $film;
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
      $keyboard = $this->getKeyboardFilms();
      $reply_markup = $this->getTelegram()->replyKeyboardMarkup([
                             'keyboard' => $keyboard,
                             'resize_keyboard' => true,
                             'one_time_keyboard' => false
                             ]);
      //Get
      $userID = $this->getUserID();
      $movieURI = $this->getUserFilmToRating($userID);
      $movie = str_replace("http://dbpedia.org/resource/", "", $movieURI);
      $movie = str_replace('_', ' ', $movie); // Replaces all underscore with spaces.

      $text = "Do you like this movie?";
      $this->replyWithChatAction(['action' => Actions::TYPING]);
      $this->replyWithMessage([
            'text' => $text
            ]);

      $title = $this->getTitleAndPosterFilmToRating($movie);

      $this->replyWithChatAction(['action' => Actions::UPLOAD_PHOTO]);
      $this->replyWithPhoto([
             'photo' => './images/poster.jpg', 
             'caption' => $title
            ]);

      $text = "Skip, if you don\'t watch";
      $this->replyWithChatAction(['action' => Actions::TYPING]);
      $this->replyWithMessage([
            'text' => $text,
            'reply_markup' => $reply_markup
            ]);
   }


  private function getKeyboardFilms(){
      $keyboard = [
                      ['👍 Like','👎 Dislike','⏭ Skip']
                   ];

      return $keyboard;
   }

   public function getUserFilmToRating(){
      $userID = $this->getuserID();
      $client = $this->getClient();   
      //$stringGetRequest ='/lod-recsys-RESTful_Service/restService/preference?userID='.$userID;
      $stringGetRequest ='/lodrecsysrestful/restService/preference?userID='.$userID;
      $response = $client->request('GET', $stringGetRequest);
      $bodyMsg = $response->getBody()->getContents();
      $data = json_decode($bodyMsg);

      return $data;
   }

  public function putUserFilmToRating($rating){
      $movieToRating = $this->getMovieToRating();
      $userID = $this->getUserID();

      if ($movieToRating != "null"){
         $movieName = str_replace(' ', '_', $movieToRating); 
         $movieURI = 'http://dbpedia.org/resource/'.$movieName;

         $client = $this->getClient();
         //$stringGetRequest ='/lod-recsys-RESTful_Service/restService/rating/put?userID='.$userID.'&movieURI='.$movieURI.'&rating='.$rating;
         $stringGetRequest ='/lodrecsysrestful/restService/rating/put?userID='.$userID.'&movieURI='.$movieURI.'&rating='.$rating;
         $response = $client->request('PUT', $stringGetRequest);
         $bodyMsg = $response->getBody()->getContents();
         $data = json_decode($bodyMsg);
      }
      else{
         $data = null;
      }
/*    print_r( $userID);
      print_r("<br>");
      print_r( $movieURI);
      print_r("<br>");
      print_r( $rating);
      print_r("<br>");
      print_r($data);*/
      return $data;
   }

   public function getTitleAndPosterFilmToRating($movie){
      $movieName = str_replace(' ', '_', $movie);
      $client = $this->getClient();
      //$stringGetRequest ='/lod-recsys-RESTful_Service/restService/explanation?movieName='.$movieName;
      $stringGetRequest ='/lodrecsysrestful/restService/explanation?movieName='.$movieName;      
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

      $img = './images/poster.jpg';
      //file_put_contents($img, file_get_contents($poster));

      return $title;
   }

}

