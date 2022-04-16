<?php
	
	unset($_SESSION['user']);

	session_destroy();

	echo "<script>window.location.replace('../');</script>";

	include "main.html";