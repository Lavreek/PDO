<?php
	$route = "users"; // Имя каталога (папки)
	$title = "Пользователи"; // Название страницы (шапка)

	require_once __DIR__."/../__modal/Database.php";
	
	$database = new Database();

	include __DIR__."/../_package/templates/index.php"; // Подключение