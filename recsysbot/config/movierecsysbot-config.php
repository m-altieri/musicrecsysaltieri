<?php

return [ 
		// Facebook Token Test movierecsys
		'facebook_token' => 'EAACkzauyGUUBAHEXDtYQebqbvQYgfp9b4VcCnvxQJyXUbw2fDqup7SS4BhT4yZCkNyJptyQAcxBq2UbnTtCCSozptTgnvUYH0Qa8Mmvq9Ryupdgt55eg2UWZAHKu9j9twI3JqurQyZAtuhrqnIknW9ZBRGc3ZCadQ1bkbZCGn2zwZDZD',
		// Telegram Token TestMovieRecSys
		'telegram_token' => '503513204:AAFSJcwhmmzYYr6Xt3rxRusG8aPZpHmgsn4',
		// The timezone setting, Guzzle suggests having this for proper requests/responses
		'timezone' => 'Europe/Rome',
		// If no response is found, this will be used as response
		'default_fallback_response' => 'Sorry, could you repeat that?',
		// Greeting string
		'greeting' => "I'm a movie recommender system.\n" .
				"I'm able to suggest you movies 🎬 according to your preferences 😉\n" .
				"I need at least 3 preferences for generating recommendations 😉",
		// Facebook payload returned from "Start" button
		'getStartedPayload' => "get_started",
        // Base URI (Altieri)
        'base_uri' => '193.204.187.192:8092', //MODIFICABILE
		// Server application URI (Altieri)
		'application_uri' => '/musicrecsysservice', //MODIFICABILE
];
?>
