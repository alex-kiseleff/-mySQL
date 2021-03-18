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
		<title>Страница администратора</title>
	</head>
	<body>
		<div class="content">
			<div class="header">
				<div class="hello">
					<?php print('Вы вошли на страницу <span>администратора</span> как: ' . '<span>' . $_SESSION['name'] . '</span>' . ', здравствуйте!'); ?>
				</div>
				<a href="../index.php">Выйти</a>
			</div>
			<div class="insert-table">

				<?php $addDelTableData = new AddDeleteTableData ?>
				<?php $addDelTableData->deleteRow(); ?>
				<?php $addDelTableData->addDataInTable(); ?>
				<?php $addDelTableData->addDataFromSelect(); ?>

				<?php $usersTableAdmin = new WorkingWithTables('admin', ['users']); ?>
				<?php $usersTableAdmin->showTable(); ?>

				<?php $booksTableAdmin = new WorkingWithTables('admin', ['books']); ?>
				<?php $booksTableAdmin->showTable(); ?>

				<?php $carsTableAdmin = new WorkingWithTables('admin', ['cars']); ?>
				<?php $carsTableAdmin->showTable(); ?>

				<?php $summaryTableAdmin = new WorkingWithTables('admin', ['summary_table']); ?>
				<?php $summaryTableAdmin->showTable(); ?>

				<?php $totalTableAdmin = new WorkingWithTables('admin', ['users', 'books', 'cars', 'summary_table']); ?>
				<?php $totalTableAdmin->showTable('total'); ?>
				
			</div>
		</div>
		<script src="../jQuery/jquery-3.4.1.min.js"></script>
		<script type="text/javascript" src="select.js"></script>
	</body>
</html>
