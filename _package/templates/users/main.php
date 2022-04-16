<?php
	$nick = $_SESSION['user']['name'];

	if (!isset($_SESSION['last_message']))
	{
		$_SESSION['last_message'] = "";
	}

	$last_id = 0;

	$response = $database->getUsers();

	$chat_messages = $database->getMessages();

	$_SESSION['messages'] = $chat_messages;
	
	include "main.html";