<?php
/**
 * @author Francesco Baccaro
 */
return [ 
		// Telegram TOKEN movierecsysbot
		'token' => 'EAAE0Lnad6ywBAGrnw7jHREnIc0CiZAuOpLV8iykP1WOFS8ykXFeoLm4340Js0ZCmZCdZAH6wwpkV6Lr5PoeWZA7b8miJP9vUjfWerd8rF9v95ORNWhdMPUFJmjZBhl4nxW0DDaCImlZBjgqYFpewFhHtVAiHkMBbgKgVVwT7E2lswZDZD',
		// The timezone setting, Guzzle suggests having this for proper requests/responses
		'timezone' => 'Europe/Rome',
		// If no response is found, this will be used as response
		'default_fallback_response' => 'Sorry, could you repeat that?',
		// Greeting string
		'greeting' => "Do you like Movies? \u{1F37F}\u{1F37F}\u{1F37F}\u{1F37F}\u{1F37F}\nI can find the perfect 🎬 #movie for you, based on your tastes \u{1F609}",
		// Facebook payload returned from "Start" button
		'getStartedPayload' => "get_started"
];
?>