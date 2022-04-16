<?php
	$root_link = $_SERVER['REQUEST_SCHEME']."://".$_SERVER['SERVER_NAME']."/";

	$links = [];

	$links += ["Главная страница" => $root_link."", "Игра" => $root_link."game/"];

	if (isset($_SESSION['user']))
	{
		$links += ["Профиль" => $root_link."profile/", "Пользователи" => $root_link."users/"];
	}
	else
	{
		$links += ["Вход" => $root_link."auth/"];
	}

	include "header.html";