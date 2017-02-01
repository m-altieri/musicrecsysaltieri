<?php

function startProfileAcquisitionKeyboard(){
	//userPropertyAcquisitionKeyboard
	//va capito quando far partire uno o l'altro a seconda se è possibile raccomandare un film 
   $keyboard = [
         ['🔴 Choose some movie properties'],
         ['🔵 Choose some movies'],
         ['👤 Explore my profile']
     ];

	return $keyboard;

}