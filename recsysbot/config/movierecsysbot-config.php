<?php
/**
 * @author Francesco Baccaro
 */

$emojis = require '/app/recsysbot/variables/emojis.php';

return [ 
		// Facebook Token Test movierecsys
// 		'token' => 'EAAE0Lnad6ywBAGrnw7jHREnIc0CiZAuOpLV8iykP1WOFS8ykXFeoLm4340Js0ZCmZCdZAH6wwpkV6Lr5PoeWZA7b8miJP9vUjfWerd8rF9v95ORNWhdMPUFJmjZBhl4nxW0DDaCImlZBjgqYFpewFhHtVAiHkMBbgKgVVwT7E2lswZDZD',
		// Telegram TOKEN movierecsysbot
		'token' => '422658992:AAH1c7kkVvuAIIuVDbbek7Mo4Zd0pKSU8nM',
		// The timezone setting, Guzzle suggests having this for proper requests/responses
		'timezone' => 'Europe/Rome',
		// If no response is found, this will be used as response
		'default_fallback_response' => 'Sorry, could you repeat that?',
		// Greeting string
		'greeting' => "Do you like Movies? " .
				$emojis['popcorn'] . $emojis['popcorn'] . $emojis['popcorn'] . $emojis['popcorn'] . $emojis['popcorn'] . 
				"\nI can find the perfect " .
				$emojis['clapperboard'] . 
				"#movie for you, based on your tastes " .
				$emojis['wink'],
		// Facebook payload returned from "Start" button
		'getStartedPayload' => "get_started",
                // Base URI (altieri)
                'base_uri' => '193.204.187.192:8090'
];
?>
