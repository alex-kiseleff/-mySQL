<?php
session_start();

require_once('../library/lib.php');


?>

<!DOCTYPE html>
<html lang="ru">
	<head>
		<meta charset="UTF-8">
		<meta name="viewport" content="width=device-width, initial-scale=1.0">
		<link rel="stylesheet" href="../stylesheet/styles.css" />
		<link rel="stylesheet" href="../stylesheet/tables-style.css" />
		<title>Страница пользователей</title>
	</head>
	<body>
		<div class="content">
			<div class="header">
				<div class="hello">
					<?php print('Вы вошли на страницу <span>пользователей</span> как: ' . '<span>' . $_SESSION['name'] . '</span>' . ', здравствуйте!'); ?>
				</div>
				<a href="../index.php">Выйти</a>
			</div>
			<div class="insert-table">

				<p><span>На странице пользователей ведутся работы, возможности ограничены. Приношу свои извинения. Администратор.</span></p>

				<?php $addDelTableData = new AddDeleteTableData ?>
				<?php $addDelTableData->deleteRow(); ?>
				<?php $addDelTableData->addDataInTable(); ?>

				<?php $booksTablUsers = new WorkingWithTables( 'users', ['books']); ?>
				<?php $booksTableUsers->showTable(); ?>

				<?php $carsTableUsers = new WorkingWithTables('users', ['cars']); ?>
				<?php $carsTableUsers->showTable(); ?>

			</div>

		</div>
	</body>
</html>