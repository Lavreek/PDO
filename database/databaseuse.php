<?php
	if ($_SERVER['SERVER_ADDR'] == "::1")
	{
		include __DIR__."/../__modal/Database.php";
		$database = new DataBase();

		if (isset($_GET['showAllUsers']))
		{
			print_r($database->getUsers());
		}
		elseif (isset($_GET['showUser']))
		{
			print_r($database->getUser());
		}
		elseif (isset($_GET['createUser']))
		{
			print_r($database->createUser());
		}
		elseif (isset($_GET['updateUser']))
		{
			print_r($database->updateUser());
		}

		echo "<br><br>";
		echo "<a href='./databaseuse.php?showAllUsers'>Отобразить пользователей</a>";
		echo "<br><br>";
		echo "<a href='./databaseuse.php?showUser'>Отобразить пользователя</a>";
		echo "<br><br>";
		echo "<a href='./databaseuse.php?createUser'>Добавить пользователя</a>";
		echo "<br><br>";
		echo "<a href='./databaseuse.php?updateUser'>Изменить пользователя</a>";
		echo "<br><br>";
		echo "<h1></h1>";
		echo "<br><br>";
		echo "<a href='./database.php'>Перейти к созданию</a>";
		echo "<br><br>";
		echo "<a href='./databaseuse.php'>Обновить</a>";
		echo "<br><br>";
		echo "<a href='../'>Выйти</a>";
	}
	else
	{
		include __DIR__."/../index.php";
	}
