<?php
	include __DIR__."/../__modal/Database.php";
	$Database = new Database();

	print_r($Database->getParam('env'));