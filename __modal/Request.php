<?php
	session_start();

	require_once __DIR__."/Database.php";

	$database = new Database();
	
	if (isset($_POST['Auth']))
	{
		$user_email = $_POST['user_email'];
		$user_password = $_POST['user_password'];

		$responce = $database->getUser($user_email, $user_password);

		if ($responce)
		{
			$_SESSION['user'] = [
				'id' => $responce[0]['id'],
				'email' => $responce[0]['email'],
				'name' => $responce[0]['name'],
				'password' => $responce[0]['password'],
				'about' => $responce[0]['about'],
			];
			echo "<div class=\"alert alert-success\" role='alert'>Пользователь ".$user_email." успешно вошёл!</div>";
			echo "<script>window.location.replace('../');</script>";
		}
	}

	if (isset($_POST['message']))
	{
		if (!empty($_POST['message']))
		{
			if ($_SESSION['last_message'] != $_POST['message'])
			{
				$database->createMessage($_SESSION['user']['id'], $_POST['message']);
				$_SESSION['last_message'] = $_POST['message'];
			}
		}
	}

	if (isset($_POST['REFRESH']))
	{
		$last = $database->getLastMessage();

		if ($last[0]['id'] != $_POST['REFRESH'])
		{
			$chat_messages = $database->getMessages();

			$_SESSION['messages'] = $chat_messages;

			foreach ($chat_messages as $key => $value)
			{
				$response = $database->getChatUser($value['id_user']);

				echo "<h5>".$response[0]['name'].": <span class='lead'>".$value['messages']."</span></h5>";
			}

			$_SESSION['last'] = $chat_messages[0]['id'];
		}
		else
		{
			foreach ($_SESSION['messages'] as $key => $value)
			{
				$response = $database->getChatUser($value['id_user']);

				echo "<h5>".$response[0]['name'].": <span class='lead'>".$value['messages']."</span></h5>";
			}
		}
	}