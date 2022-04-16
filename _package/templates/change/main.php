<?php
	$root_link = $_SERVER['REQUEST_SCHEME']."://".$_SERVER['SERVER_NAME']."/";

	if (isset($_POST))
	{	
		$id = $_SESSION['user']['id'];

		if (isset($_POST['changename']))
		{
			if (!empty($_POST['name']) and !empty($_POST['password']))
			{
				if ($_POST['password'] == $_SESSION['user']['password'])
				{
					foreach ($_POST as $key => $value) {
						if (isset($_SESSION['user'][$key]) and $key != "password")
						{
							$responce = $database->updateUser($id, $key, $_POST[$key]);
					
							if ($responce)
							{
								$_SESSION['user'][$key] = $_POST[$key];
							}
						}
					}

					$message = "Профиль изменен";
				}
				else
				{
					$message = "Пароль неверный.";
				}
			}
			else
			{
				$message = "Не все поля были заполнены.";
			}
		}
		if (isset($_POST['changepassword']))
		{
			if (!empty($_POST['old']) and !empty($_POST['new']))
			{
				if ($_POST['old'] == $_SESSION['user']['password']) {
					if ($_POST['new'] != $_POST['old'])
					{
						$responce = $database->updateUser($id, "password", $_POST['new']);

						if ($responce)
						{
							$_SESSION['user']['password'] = $_POST['new'];
							$message = "Пароль изменен";
						}
					}
				}
				else
				{
					$message = "Старый пароль введён неверно.";
				}
			}
			else
			{
				$message = "Не все поля были заполнены.";
			}
		}
	}

	if (isset($_GET['changeprofile']))
	{
		$nick = $_SESSION['user']['name'];
		$about = $_SESSION['user']['about'];

		include __DIR__."/assets/profile.html";
	}
	elseif (isset($_GET['changepassword']))
	{
		include __DIR__."/assets/password.html";
	}
	else
	{
		include "main.html";
	}
