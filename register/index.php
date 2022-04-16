<?php
	$route = "register"; // Имя каталога (папки)
	$title = "Регистрация пользователя"; // Название страницы (шапка)

	require_once "../__modal/Database.php";
	
	$database = new Database();

	include __DIR__."/../_package/templates/index.php"; // Подключение