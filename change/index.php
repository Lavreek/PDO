<?php
	$route = "change"; // Имя каталога (папки)
	$title = "Изменение профиля"; // Название страницы (шапка)

	require_once __DIR__."/../__modal/Database.php";

	$database = new Database();

	$message = "";

	include __DIR__."/../_package/templates/index.php"; // Подключение