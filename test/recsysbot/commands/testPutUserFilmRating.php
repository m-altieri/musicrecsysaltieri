<?php
require './../vendor/autoload.php';

use GuzzleHttp\Client;
//use RS\RecSysBot\Command\FilmsCommand;   
use RS\RecSysBot\Command\RatingCommand;
   //$filmsCommand = new FilmsCommand();
   $filmsCommand = new RatingCommand();

   $movieURI = $filmsCommand->getUserFilmToRating();
   $film = str_replace("http://dbpedia.org/resource/", "", $movieURI);
   $film = str_replace('_', ' ', $film); // Replaces all underscore with spaces.
   $filmsCommand->setMovieToRating($film);
   //print_r($movieURI);
   //print_r("<br>");
   //print_r($filmsCommand->getMovieToRating());

   print_r($filmsCommand->putUserFilmToRating(1));
   print_r("<br>");
   
   exit;
