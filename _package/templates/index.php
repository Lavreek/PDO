<?php
	session_start();
?>
<!DOCTYPE html>
<html lang="ru">
	<head>
		<meta charset="UTF-8">
		<meta name="viewport" content="width=device-width, initial-scale=1">
		<title>
			<?php
				echo $title;
			?>
		</title>
		<link rel="stylesheet" href="../_bootstrap/css/bootstrap.min.css">
		<link rel="stylesheet" type="text/css" href="../_styles/header-support.css">
		<link rel="stylesheet" type="text/css" href="../_styles/main-support.css">
		<link rel="stylesheet" type="text/css" href="../_styles/body-support.css">
		<link rel="stylesheet" type="text/css" href="../_styles/sidebars.css">

	</head>
	<body>
		<?php
			include __DIR__."/assets/header/header.php";

			include __DIR__."/".$route."/main.php";

			include __DIR__."/assets/footer/footer.php";
		?>
		<script type="text/javascript" src="../_bootstrap/js/bootstrap.min.js"></script>
		<script type="text/javascript" src="../_scripts/jquery-3.6.0.min.js"></script>
    	<script type="text/javascript" src="../_scripts/function.js"></script>
    	<script type="text/javascript" src="../_scripts/sidebars.js"></script>

	</body>
</html>