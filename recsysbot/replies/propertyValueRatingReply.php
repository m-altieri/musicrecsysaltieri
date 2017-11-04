<?php
function propertyValueRatingReply($telegram, $chatId, $pagerankCicle) {
	
	$emojis = require '/app/recsysbot/variables/emojis.php';
	
	$reply = propertyTypeAndPropertyValueSelected ( $chatId, $pagerankCicle );
	$propertyType = $reply [0];
	$propertyName = $reply [1];
	
	$text = "Do you like \"" . ucwords ( $propertyName ) . "\"?";
	$keyboard = [ 
			[ 
					"".$emojis['smilesimple']." I like \"" . ucwords ( $propertyName ) . "\"" 
			],
			[ 
					"😑 I dislike \"" . ucwords ( $propertyName ) . "\"" 
			],
			[ 
					"🤔 Is indifferent to me" 
			] 
		// ["".$emojis['backarrow']." Return to the list of ".$propertyType]
	];
	
	// echo '<pre>'; print_r($keyboard); echo '</pre>';
	
	$reply_markup = $telegram->replyKeyboardMarkup ( [ 
			'keyboard' => $keyboard,
			'resize_keyboard' => true,
			'one_time_keyboard' => false 
	] );
	
	$telegram->sendChatAction ( [ 
			'chat_id' => $chatId,
			'action' => 'typing' 
	] );
	$telegram->sendMessage ( [ 
			'chat_id' => $chatId,
			'text' => $text,
			'reply_markup' => $reply_markup 
	] );
}
