<?php
ob_start();
session_start();

header('Content-type: text/html; charset=utf-8');
ini_set('display_errors', 1);
error_reporting(E_ALL);
define('ROOT', dirname(__FILE__));

require_once('library/lib.php');
?>
<!DOCTYPE html>
<html lang="ru">
	<head>
		<meta charset="UTF-8" />
		<meta name="viewport" content="width=device-width, initial-scale=1.0" />
		<link rel="stylesheet" href="stylesheet/styles.css" />
		<title>Document</title>
	</head>
	<body>
		<div class="container">
			<form action="index.php" class="form" enctype="application/x-www-form-urlencoded" method="POST">
				<h2>Авторизация</h2>
				<input name="login" type="text" class="login input" autofocus="on" placeholder="Логин" autocomplete="off" required />
				<input name="password" type="password" class="password input" placeholder="Пароль" required />
				<input type="submit" name="entrance" value="Войти" class="submit input" />
			</form>
			<?php

			if (isset($_POST['entrance'])) {

				$userAuth = new Autorization();
				$userAuth->getDataLoginPassw();
			}

			?>
		</div>
		<script src="new.js"></script>

	</body>
</html>