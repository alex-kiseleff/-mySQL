<div class="wrapp-table">
	<h4>Обобщенная таблица</h4>
	<div class="table">
		<div>
			<div class="t-row" style="font-weight: bold">
				<?php $count = 0;?>
				<?php foreach ($total as $nameTable => $array_2) : ?>
				<div class="t-cell"><?php print(($nameTable)); ?></div>
					<?php if ($count == 2) : break;?>
					<?php else : $count++;?>
					<?php endif;?>
				<?php endforeach; ?>
			</div>
			<?php for ($i = 0; $i < count($total['users']); $i++) { ?>
			<div class="t-row">
				<div class="t-cell select js-cell-select" id="<?php print ($total['users'][$i]['id']); ?>">
				<?php print ($total['users'][$i]['name']); ?>
				</div>
				<div class="t-cell">
					<?php for ($j = 0; $j < count($total['summary_table']); $j++) { ?>
						<?php if ($total['summary_table'][$j]['id_users'] == $total['users'][$i]['id'] && isset($total['summary_table'][$j]['id_books'])) :?>
							<?php $id_books = intval($total['summary_table'][$j]['id_books']); ?>
							<?php for ($ii = 0; $ii < count($total['books']); $ii++) : ?>
								<?php if ($total['books'][$ii]['id'] == $id_books) : ?>
									<?php print ($total['books'][$ii]['name'] . ', '); ?>
								<?php endif; ?>
							<?php endfor; ?>
						<?php endif ?>
					<?php } ?>
				</div>
				<div class="t-cell">
					<?php for ($j = 0; $j < count($total['summary_table']); $j++) { ?>
						<?php if ($total['summary_table'][$j]['id_users'] == $total['users'][$i]['id'] && isset($total['summary_table'][$j]['id_cars'])) :?>
							<?php $id_books = intval($total['summary_table'][$j]['id_cars']); ?>
							<?php for ($ii = 0; $ii < count($total['cars']); $ii++) : ?>
								<?php if ($total['cars'][$ii]['id'] == $id_books) : ?>
									<?php print ($total['cars'][$ii]['name'] . ', '); ?>
								<?php endif; ?>
							<?php endfor; ?>
						<?php endif ?>
					<?php } ?>
				</div>
			</div>
			<?php } ?>
		</div>
	</div>
</div>
<form action="../admin/admin_panel.php" enctype="application/x-www-form-urlencoded" method="POST">
	<input type="text" class="input-none" name="id_user" value="" />
	<div class="wrapp-window-select js-select close">
		<select class="window-select js-select close" name="select[]" multiple="multiple">
			<option class="option-group" value="" disabled>Книги</option>
			<?php for ($i = 0; $i < count($total['books']); $i++) : ?>
			<option class="option" value="<?php print('b' . $total['books'][$i]['id']) ?>"><?php print($total['books'][$i]['name']) ?></option>
			<?php endfor ?>
			<option class="option-group" value="" disabled>Автомобили</option>
			<?php for ($i = 0; $i < count($total['cars']); $i++) : ?>
			<option class="option" value="<?php print('c' . $total['cars'][$i]['id']) ?>"><?php print($total['cars'][$i]['name']) ?></option>
			<?php endfor ?>
		</select>
		<div class="option-button-box">
			<button class="option-button cancel" type="reset" name="select-cancel" >Отмена</button>
			<button class="option-button add" type="submit" name="select-add" >Добавить</button>
		</div>
	</div>
</form>
