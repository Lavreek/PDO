<?php
	if ($_SERVER['SERVER_ADDR'] == "::1")
	{
		include __DIR__."/../__modal/DatabaseHandler.php";
		$database = new DatabaseHandler("mysql");

		if (isset($_GET['createDatabase']))
		{
			$database->createDatabase();
		}
		elseif (isset($_GET['dropDatabase']))
		{
			$database->dropDatabase();
		}
		elseif (isset($_GET['createTables']))
		{
			$database->createDatabaseTables();
		}
		elseif (isset($_GET['dropTables']))
		{
			$database->dropDatabaseTables();
		}
		elseif (isset($_GET['createSchema']))
		{
			$database->createSchema();
		}
		elseif (isset($_GET['dropSchema']))
		{
			$database->dropSchema();
		}

		echo "<br><br>";
		echo "<h1>Добавить</h1>";
		echo "<br><br>";
		echo "<a href='./database.php?createDatabase'>Создать базу данных</a>";
		echo "<br><br>";
		echo "<a href='./database.php?createTables'>Добавить таблицы в базу данных</a>";
		echo "<br><br>";
		echo "<a href='./database.php?createSchema'>Создать схему</a>";
		echo "<br><br>";
		echo "<h1>Удалить</h1>";
		echo "<br><br>";
		echo "<a href='./database.php?dropDatabase'>Удалить базу данных</a>";
		echo "<br><br>";
		echo "<a href='./database.php?dropTables'>Удалить таблицы из базы данных</a>";
		echo "<br><br>";
		echo "<a href='./database.php?dropSchema'>Удалить схему</a>";
		echo "<br><br>";
		echo "<h1></h1>";
		echo "<br><br>";
		echo "<a href='./databaseuse.php'>Перейти к использованию</a>";
		echo "<br><br>";
		echo "<a href='./database.php'>Обновить</a>";
		echo "<br><br>";
		echo "<a href='../'>Домой</a>";
	}
	else
	{
		include __DIR__."/../index.php";
	}