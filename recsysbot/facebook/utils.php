<?php

function sendMessageURI() {
	return 'https://graph.facebook.com/v2.6/me/messages?access_token=' . token();
}
	
function token() {
	return 'EAACkzauyGUUBAHEXDtYQebqbvQYgfp9b4VcCnvxQJyXUbw2fDqup7SS4BhT4yZCkNyJptyQAcxBq2UbnTtCCSozptTgnvUYH0Qa8Mmvq9Ryupdgt55eg2UWZAHKu9j9twI3JqurQyZAtuhrqnIknW9ZBRGc3ZCadQ1bkbZCGn2zwZDZD';
}