<?php

/* Класс - базовый класс. Подключение к базе данных и вывод сообщений */
class InitialClass {

	protected $host = 'localhost';
	protected $user = 'root';
	protected $password_db = '';
	protected $dataBase = 'my_project_3';

	///* Метод - подключение к серверу и базе данных */
	protected function connectToDataBase() {

		$connect_server = mysqli_connect($this->host, $this->user, $this->password_db, $this->dataBase);

		if (!$connect_server) {

			$this->showMessageError('Не удалось подключиться к базе данных!' . mysqli_connect_error());
			exit;
		} else {
			return $connect_server;
		}
	}

	/* Метод - очистка результирующего запроса и закрытие соединения */
	protected function cleaningQueryClosingConnect() {

		//if ($query) {

		//	mysqli_free_result($query); /* Очистка результирующего запроса */
		//}
		if ($this->connect_server) {

			mysqli_close($this->connect_server); /* закрытие соединения */ 
		}
	}

	/* Метод - получение адреса текущей страницы */
	public function getThisUrl() {

		return $url = $_SERVER['REQUEST_URI'];
	}

	/* Метод - показать сообщение */
	public function showMessage(String $message = '') {
		
		$this->url = $this->getThisUrl();

		$this->message = $message;

		if ($this->message) {

			print '<div class="message">';
			print ('<p>' . $this->message . '</p>');
			print '<div class="close-message"><a href="' . $this->url . '">Обновить</a></div>';
			print '</div>';

			$this->message = '';
		}
	}
		
	/* Метод - показать сообщение с ошибой */
	public function showMessageError(String $message = '') {
		
		$this->url = $this->getThisUrl();

		$this->message = $message;

		if ($this->message) {

			print '<div class="error-message">';
			print ('<p>' . $this->message . '</p>');
			print '<div class="close-message"><a href="' . $this->url . '">Обновить</a></div>';
			print '</div>';

			$this->message = '';
		}
	}
}

/* Класс - авторизации пользователя */
class Autorization extends InitialClass {

	private $login = '';
	private $password = '';

	/* Метод - валидация логина и пароля */
	protected function checkValidation() {

		if ($_POST['login'] && $_POST['password']) {
			
			$this->login = htmlentities(trim(mb_strtolower($_POST['login'], 'UTF-8')));
			$this->password = htmlentities(trim(mb_strtolower($_POST['password'], 'UTF-8')));

		} else {

			return $this->showMessageError('Логин или пароль не заданы!');
		}
		
	}
	
	/* Метод - получение массива с данными логинов и паролей и редирект 
	* на страницу администратора или страницу пользователей 
	*/
	public function getDataLoginPassw() {
		
		$this->checkValidation();

		$this->connect_server = $this->connectToDataBase();
		
		$query = mysqli_query($this->connect_server,"SELECT * FROM `users`");

		$count = NULL;
		while ($result = mysqli_fetch_array($query)) {
			
			if ($this->login == $result['login'] && $result['login'] != 'admin' && md5(trim(mb_strtolower($this->password, 'UTF-8'))) == $result['password']) {
				
				$_SESSION['name'] = $result['name'];

				header('HTTP/1.1 301 Moved Permanently');
				header('Location: users/user_panel.php');
				exit;
			} 
			if ($this->login == 'admin' && $result['login'] == 'admin' && md5(trim(mb_strtolower($this->password, 'UTF-8'))) == $result['password']) {

				$_SESSION['name'] = $result['name'];

				header('HTTP/1.1 301 Moved Permanently');
				header('Location: admin/admin_panel.php');
				exit;
			}
			$count++;
		}

		$this->cleaningQueryClosingConnect();

		if ($count) {

			$this->showMessageError('Пользователь с такими "ЛОГИН" и "ПАРОЛЬ" не зарегистрирован! Авторизуйтесь заново!');
		}
	}
}


/* Класс - получение данных по таблицам, построение
* и вывод таблиц на экран
*/
class WorkingWithTables extends InitialClass {

	protected $accessStatus = '';
	protected $tableName = '';
	protected $allNamesTables = array();

	public function __construct(String $accessStatus = '', Array $allNamesTables = array()) {
		
		$this->accessStatus = $accessStatus;
		$this->allNamesTables = $allNamesTables;

		foreach ($this->allNamesTables as $key => $value) {

			$_SESSION['tableName'] = $value;

			$this->tableName = $value;
		}
	}
		
	/* Метод - получить содержимое таблицы в массив */
	public function getDataTable () {

		$this->connect_server = $this->connectToDataBase();

		$array = [];

		$query = mysqli_query($this->connect_server, "SELECT * FROM `$this->tableName`");
		
		if (!$query || mysqli_num_rows($query) == 0)

			return NULL;
	
		while ($row = mysqli_fetch_assoc($query)) {

			$array[] = $row;
		}

		$this->cleaningQueryClosingConnect();
		
		return $array;
	}
	
	/* Метод - получить общий массив данных по всем таблицам */
	public function getTotalData () {

		$allNamesTables = $this->allNamesTables;

		if (!$allNamesTables) {
			return;
		}
		$this->connect_server = $this->connectToDataBase();
		
		$total = [];
		
		for ($i = 0; $i < count($allNamesTables); $i++) {
			
			$query = mysqli_query($this->connect_server, "SELECT * FROM `$allNamesTables[$i]`");
			
			if (!$query || mysqli_num_rows($query) == 0)
			
			return NULL;
			
			while ($row = mysqli_fetch_assoc($query)) {
				
				$total[$allNamesTables[$i]][] = $row;
			}
		}
		$this->cleaningQueryClosingConnect();
		
		return $total;
	}
	
	/* Метод - вывод таблицы на экран */
	public function showTable(String $typeTable = '') {
		
		$list = $this->getDataTable();
		
		$total = $this->getTotalData();
		
		if (empty($total)) {
			
			return;
		}
		if (empty($list)) {
			
			return;
		}
		if ($typeTable == 'total') {
			
			require('../' . $this->accessStatus . '/total_template_' . $this->accessStatus . '.tpl');
		} else {

			require('../' . $this->accessStatus . '/template_' . $this->accessStatus . '.tpl');
		}
	}
}

class AddDeleteTableData extends InitialClass {

	/* Метод - получить массив с выбранными чекбоксами */
	public function getCheckbox() {

		$checkboxId = [];

		$checkboxId = $_POST['checkboxId'];
		
		return $checkboxId;
	}
	/* Метод - получить массив с выбранными селектами */
	public function getSelect() {

		$selectArr = [];
		$selectArr = $_POST['select'];

		if (!empty($selectArr)) {

			return $selectArr;
		} else {

			return $this->showMessageError('Ничего не выбрано!');
		}
	}

	/* Метод - получение названия текущей таблицы с инпута */
	public function getInputTableName() {
		
		$TableName = $_POST['inputTableName'];

		return $TableName;
	}

	/* Метод - удалить выбранную строку или строки */
	public function deleteRow() {

		$this->checkboxId = $this->getCheckbox();

		$this->TableName = $this->getInputTableName();

		if (isset($_POST['delete']) && !empty($this->checkboxId)) {

			$this->connect_server = $this->connectToDataBase();
			
			foreach ($this->checkboxId as $selected) {
				
				$id[] = $selected;
			}
			
			if (sizeof($id) > 0) {

				$id = implode(', ', array_map(intval, $id));

				$query = "DELETE FROM `$this->TableName` WHERE `ID` IN ($id)";
				
				$queryDelete = mysqli_query($this->connect_server, $query);

				if ($queryDelete) {

					return $this->showMessage('Выбранное Вами удалено!');

				} else {

					return $this->showMessageError('Произошла ошибка!');
				}
				$this->cleaningQueryClosingConnect();
			}
		}
		if (isset($_POST['delete']) && empty($this->checkboxId)) {

			return $this->showMessageError('Не выделено ни одной строки!');
		}
	}
	
	/* Метод - добавление данных в таблицу */
	public function addDataInTable() {
	
		$this->TableName = $this->getInputTableName();

		if (isset($_POST['add'])) {

			$this->connect_server = $this->connectToDataBase();
			
			$array = [];
			
			$query = mysqli_query($this->connect_server, "SELECT * FROM `$this->TableName`");
			
			while ($row = mysqli_fetch_assoc($query)) {
				
				$array[] = $row;
			}
			$count = count($array[0]);

			$i = 0;
			$countNull = 0;

			foreach ($array[0] as $columnName => $columnValue) {
				
				$colName[] = $columnName;
				
				if (isset($_POST[$columnName]) && $i < $count) {
					
					if ($columnName == 'password' && !empty($_POST[$columnName])) {

						/* хэш пароля */
						$colValue[] = "'" . md5(htmlentities(trim(mb_strtolower($_POST[$columnName], 'UTF-8')))) . "'";
						
					} elseif ($_POST[$columnName] == '') {
						
						$colValue[] = 'NULL';

						$countNull++;
					} else {
						
						$colValue[] = "'" . htmlentities(trim(mb_strtolower($_POST[$columnName], 'UTF-8'))) . "'";
					} 
					$i++;
				}
				if ($countNull == count($colValue)) {

					$this->showMessageError('Заполните обязательные поля, перед тем как добавить!');
			
					return $this->cleaningQueryClosingConnect();
				}
			}
			
			$nameQueryToString = implode(', ', $colName);
			$valueQueryToString = implode(', ', $colValue);

			$query = "INSERT INTO `$this->TableName` ($nameQueryToString) VALUES ($valueQueryToString)";
			
			$queryAdd = mysqli_query($this->connect_server, $query);
			
			if ($queryAdd) {
				
				$this->showMessage('Строка успешно добавлена!');
			} else {
				
				$this->showMessageError('Произошла ошибка запроса! Проверте, заполнены ли обязальные поля?!');
			} 
			$this->cleaningQueryClosingConnect();
		}
	}

	/* Метод - добавление данных в обобщенной таблице полученных
	* из выпадающего списка
	*/
	public function addDataFromSelect() {

		$totalTableAdmin = new WorkingWithTables('admin', ['users', 'books', 'cars', 'summary_table']);
		$total = $totalTableAdmin->getTotalData();
		
		if (isset($_POST['select-add'])) {
			
			$this->selectArr = $this->getSelect();
			$this->connect_server = $this->connectToDataBase();
			
			$id_users = $_POST['id_user'];
			
			for ($i = 0; $i < count($this->selectArr); $i++) {

				if (mb_substr($this->selectArr[$i], 0, 1) == 'b') {

					$id_books = preg_replace('/[^0-9]/', '', $this->selectArr[$i]);
					$id_cars = 'NULL';

				} elseif (mb_substr($this->selectArr[$i], 0, 1) == 'c') {

					$id_cars = preg_replace('/[^0-9]/', '', $this->selectArr[$i]);
					$id_books = 'NULL';
				}
				
				$query = "INSERT INTO `summary_table`(`id`, `id_users`, `id_books`, `id_cars`) VALUES (NULL, $id_users, $id_books, $id_cars)";
				$queryAdd = mysqli_query($this->connect_server, $query);
			}
			if ($queryAdd) {
				
				$this->showMessage('Строк(а,-и) успешно добавлен(а,-ы)!');
			} else {
				
				$this->showMessageError('Произошла ошибка запроса! Повторите выбор из списка.');
			} 
			$this->cleaningQueryClosingConnect();
		}
	}
}
?>

