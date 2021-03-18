-- phpMyAdmin SQL Dump
-- version 4.9.0.1
-- https://www.phpmyadmin.net/
--
-- Хост: 127.0.0.1:3306
-- Время создания: Июн 04 2020 г., 12:08
-- Версия сервера: 10.3.13-MariaDB-log
-- Версия PHP: 7.1.32

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- База данных: `my_project_3`
--

-- --------------------------------------------------------

--
-- Структура таблицы `books`
--

CREATE TABLE `books` (
  `id` int(11) NOT NULL,
  `name` varchar(300) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Дамп данных таблицы `books`
--

INSERT INTO `books` (`id`, `name`) VALUES
(1, 'физика'),
(2, 'русский язык'),
(3, 'черчение'),
(4, 'биология'),
(6, 'химия'),
(7, 'астрономия'),
(8, 'английский язык'),
(9, 'алгебра'),
(10, 'тихий дон');

-- --------------------------------------------------------

--
-- Структура таблицы `cars`
--

CREATE TABLE `cars` (
  `id` int(11) NOT NULL,
  `name` varchar(300) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Дамп данных таблицы `cars`
--

INSERT INTO `cars` (`id`, `name`) VALUES
(1, 'lada vesta'),
(2, 'lada kalina'),
(3, 'lada priora'),
(4, 'pego'),
(5, 'reno'),
(6, 'mazda'),
(7, 'volkswagen'),
(8, 'volvo'),
(9, 'BMV'),
(10, 'mersedes');

-- --------------------------------------------------------

--
-- Структура таблицы `summary_table`
--

CREATE TABLE `summary_table` (
  `id` int(11) NOT NULL,
  `id_users` int(11) NOT NULL,
  `id_books` int(11) DEFAULT NULL,
  `id_cars` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Дамп данных таблицы `summary_table`
--

INSERT INTO `summary_table` (`id`, `id_users`, `id_books`, `id_cars`) VALUES
(28, 3, 8, 10),
(29, 1, 4, NULL),
(30, 1, 6, NULL),
(31, 1, 8, NULL),
(32, 1, NULL, 6),
(33, 1, NULL, 7),
(34, 1, NULL, 9);

-- --------------------------------------------------------

--
-- Структура таблицы `users`
--

CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `name` varchar(30) NOT NULL,
  `login` varchar(60) NOT NULL,
  `password` varchar(60) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Дамп данных таблицы `users`
--

INSERT INTO `users` (`id`, `name`, `login`, `password`) VALUES
(1, 'василий', 'vasa123', '202cb962ac59075b964b07152d234b70'),
(2, 'сергей петрович', 'sergeypet1956', 'e3408432c1a48a52fb6c74d926b38886'),
(3, 'иван', 'ivan789', '68053af2923e00204c3ca7c6a3150cf7'),
(4, 'алексей', 'admin', '21232f297a57a5a743894a0e4a801fc3');

--
-- Индексы сохранённых таблиц
--

--
-- Индексы таблицы `books`
--
ALTER TABLE `books`
  ADD PRIMARY KEY (`id`);

--
-- Индексы таблицы `cars`
--
ALTER TABLE `cars`
  ADD PRIMARY KEY (`id`);

--
-- Индексы таблицы `summary_table`
--
ALTER TABLE `summary_table`
  ADD PRIMARY KEY (`id`),
  ADD KEY `id_books` (`id_books`),
  ADD KEY `id_cars` (`id_cars`),
  ADD KEY `id_users` (`id_users`);

--
-- Индексы таблицы `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `login` (`login`);

--
-- AUTO_INCREMENT для сохранённых таблиц
--

--
-- AUTO_INCREMENT для таблицы `books`
--
ALTER TABLE `books`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=17;

--
-- AUTO_INCREMENT для таблицы `cars`
--
ALTER TABLE `cars`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT для таблицы `summary_table`
--
ALTER TABLE `summary_table`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=35;

--
-- AUTO_INCREMENT для таблицы `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=55;

--
-- Ограничения внешнего ключа сохраненных таблиц
--

--
-- Ограничения внешнего ключа таблицы `summary_table`
--
ALTER TABLE `summary_table`
  ADD CONSTRAINT `summary_table_ibfk_2` FOREIGN KEY (`id_books`) REFERENCES `books` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `summary_table_ibfk_3` FOREIGN KEY (`id_cars`) REFERENCES `cars` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `summary_table_ibfk_4` FOREIGN KEY (`id_users`) REFERENCES `users` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
