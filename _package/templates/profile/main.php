<?php
	$root_link = $_SERVER['REQUEST_SCHEME']."://".$_SERVER['SERVER_NAME']."/";

	$buttons = [
		"Изменение профиля" => $root_link."change/?changeprofile",
		"Изменение пароля" => $root_link."change/?changepassword",
		"Выйти из профиля" => $root_link."logout/",
	];

	include "main.html";