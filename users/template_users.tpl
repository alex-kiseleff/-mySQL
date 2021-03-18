<div class="wrapp-table">
	<h4>таблица: "<?php print($_SESSION['tableName']); ?>"</h4>
	<div class="table">
		<form action="../users/users_panel.php" enctype="application/x-www-form-urlencoded" method="POST">
			<input type="text" name="inputTableName" class="input-none" value="<?php print($_SESSION['tableName']); ?>" />
			<div class="button">
				<input type="submit" name="add" class="add" onclick="if(confirm('Точно хотите добавить ???'))submit();else return false;" value="Добавить" />
				<input type="submit" name="delete" class="delete" onclick="if(confirm('Точно хотите удалить ???'))submit();else return false;" value="Удалить" />
			</div>
			<div>
				<div class="t-row" style="font-weight: bold">
					<div class="t-cell wrap-checkbox"></div>
					<?php foreach ($list[0] as $columnName => $columnValue): ?>
					<div class="t-cell"><?php print($columnName); ?></div>
					<?php endforeach; ?>
				</div>
			</div>
			<div>
				<?php foreach ($list as $row): ?>
				<div class="t-row">
					<div class="t-cell wrap-checkbox">
						<input type="checkbox" name="checkboxId[]" class="checkbox" value="<?php print $row['id']; ?>" />
					</div>
					<?php foreach ($row as $columnValue): ?>
					<div class="t-cell"><?php print ($columnValue); ?></div>
					<?php endforeach; ?>
				</div>
				<?php endforeach; ?>
			</div>
			<div class="t-row">
				<input type="text" class="t-cell-enter first" disabled />
				<?php foreach ($list[0] as $columnName => $columnValue): ?>
				<input type="text" name="<?php print($columnName); ?>" class="t-cell-enter next" autocomplete="off" placeholder=">" />
				<?php endforeach; ?>
			</div>
		</form>
	</div>
</div>