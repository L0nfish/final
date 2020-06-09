-- phpMyAdmin SQL Dump
-- version 5.0.2
-- https://www.phpmyadmin.net/
--
-- Хост: 127.0.0.1:3306
-- Время создания: Июн 09 2020 г., 08:59
-- Версия сервера: 10.3.22-MariaDB
-- Версия PHP: 7.1.33

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- База данных: `uchinvent`
--

-- --------------------------------------------------------

--
-- Структура таблицы `dolzhnost`
--

CREATE TABLE `dolzhnost` (
  `dolzhnost_id` bigint(20) NOT NULL,
  `name` varchar(50) COLLATE utf8mb4_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Дамп данных таблицы `dolzhnost`
--

INSERT INTO `dolzhnost` (`dolzhnost_id`, `name`) VALUES
(1, 'директор склада'),
(2, 'завхоз'),
(3, 'разнорабочий');

-- --------------------------------------------------------

--
-- Структура таблицы `inventar`
--

CREATE TABLE `inventar` (
  `inventar_id` bigint(20) NOT NULL,
  `name` varchar(50) COLLATE utf8mb4_unicode_ci NOT NULL,
  `type_inventar_id` bigint(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Дамп данных таблицы `inventar`
--

INSERT INTO `inventar` (`inventar_id`, `name`, `type_inventar_id`) VALUES
(1, 'лопата', 1),
(2, 'стремянка', 3),
(3, 'куртка', 2);

-- --------------------------------------------------------

--
-- Структура таблицы `naklad`
--

CREATE TABLE `naklad` (
  `naklad_id` bigint(11) NOT NULL,
  `sklad_id` bigint(20) NOT NULL,
  `date` date NOT NULL,
  `type_naklad_id` bigint(20) NOT NULL,
  `user_id` bigint(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Дамп данных таблицы `naklad`
--

INSERT INTO `naklad` (`naklad_id`, `sklad_id`, `date`, `type_naklad_id`, `user_id`) VALUES
(1, 1, '2020-06-02', 1, 1);

-- --------------------------------------------------------

--
-- Структура таблицы `role`
--

CREATE TABLE `role` (
  `role_id` tinyint(4) NOT NULL,
  `sys_name` varchar(50) COLLATE utf8mb4_unicode_ci NOT NULL,
  `name` varchar(50) COLLATE utf8mb4_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Дамп данных таблицы `role`
--

INSERT INTO `role` (`role_id`, `sys_name`, `name`) VALUES
(1, 'admin', 'администратор'),
(2, 'zavxoz', 'завхоз');

-- --------------------------------------------------------

--
-- Структура таблицы `sklad`
--

CREATE TABLE `sklad` (
  `sklad_id` bigint(20) NOT NULL,
  `nomer` varchar(50) COLLATE utf8mb4_unicode_ci NOT NULL,
  `name` varchar(50) COLLATE utf8mb4_unicode_ci NOT NULL,
  `telephone` varchar(50) COLLATE utf8mb4_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Дамп данных таблицы `sklad`
--

INSERT INTO `sklad` (`sklad_id`, `nomer`, `name`, `telephone`) VALUES
(1, '21', 'строй склад', '34354623564');

-- --------------------------------------------------------

--
-- Структура таблицы `type_invent`
--

CREATE TABLE `type_invent` (
  `type_inventar_id` bigint(20) NOT NULL,
  `name` varchar(50) COLLATE utf8mb4_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Дамп данных таблицы `type_invent`
--

INSERT INTO `type_invent` (`type_inventar_id`, `name`) VALUES
(1, 'Инструменты'),
(2, 'спецодежда'),
(3, 'подсобные средства');

-- --------------------------------------------------------

--
-- Структура таблицы `type_naklad`
--

CREATE TABLE `type_naklad` (
  `type_naklad_id` bigint(20) NOT NULL,
  `name` varchar(50) COLLATE utf8mb4_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Дамп данных таблицы `type_naklad`
--

INSERT INTO `type_naklad` (`type_naklad_id`, `name`) VALUES
(1, 'приходная накладная'),
(2, 'расходная накладная');

-- --------------------------------------------------------

--
-- Структура таблицы `user`
--

CREATE TABLE `user` (
  `user_id` bigint(20) NOT NULL,
  `lastname` varchar(50) COLLATE utf8mb4_unicode_ci NOT NULL,
  `firstname` varchar(50) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `patronymic` varchar(50) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `date_birth` date DEFAULT NULL,
  `sklad_id` bigint(50) NOT NULL,
  `dolzhnost_id` bigint(20) NOT NULL,
  `role_id` tinyint(4) NOT NULL,
  `login` varchar(50) COLLATE utf8mb4_unicode_ci NOT NULL,
  `pass` varchar(50) COLLATE utf8mb4_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Дамп данных таблицы `user`
--

INSERT INTO `user` (`user_id`, `lastname`, `firstname`, `patronymic`, `date_birth`, `sklad_id`, `dolzhnost_id`, `role_id`, `login`, `pass`) VALUES
(1, 'Моисеенко', 'Дмитрий', 'Юрьевич', '2001-03-15', 1, 1, 1, 'admin', 'admin');

-- --------------------------------------------------------

--
-- Структура таблицы `ychet_invent`
--

CREATE TABLE `ychet_invent` (
  `ychet_inventar_id` bigint(20) NOT NULL,
  `naklad_id` bigint(20) NOT NULL,
  `inventar_id` bigint(20) NOT NULL,
  `kol_vo` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Дамп данных таблицы `ychet_invent`
--

INSERT INTO `ychet_invent` (`ychet_inventar_id`, `naklad_id`, `inventar_id`, `kol_vo`) VALUES
(1, 1, 1, 2);

--
-- Индексы сохранённых таблиц
--

--
-- Индексы таблицы `dolzhnost`
--
ALTER TABLE `dolzhnost`
  ADD PRIMARY KEY (`dolzhnost_id`);

--
-- Индексы таблицы `inventar`
--
ALTER TABLE `inventar`
  ADD PRIMARY KEY (`inventar_id`),
  ADD KEY `FK_inventar_type_invent_type_inventar_id` (`type_inventar_id`);

--
-- Индексы таблицы `naklad`
--
ALTER TABLE `naklad`
  ADD PRIMARY KEY (`naklad_id`,`user_id`),
  ADD KEY `FK_naklad_sklad_sklad_id` (`sklad_id`),
  ADD KEY `FK_naklad_type_naklad_type_naklad_id` (`type_naklad_id`),
  ADD KEY `FK_naklad_user_user_id` (`user_id`);

--
-- Индексы таблицы `role`
--
ALTER TABLE `role`
  ADD PRIMARY KEY (`role_id`);

--
-- Индексы таблицы `sklad`
--
ALTER TABLE `sklad`
  ADD PRIMARY KEY (`sklad_id`);

--
-- Индексы таблицы `type_invent`
--
ALTER TABLE `type_invent`
  ADD PRIMARY KEY (`type_inventar_id`);

--
-- Индексы таблицы `type_naklad`
--
ALTER TABLE `type_naklad`
  ADD PRIMARY KEY (`type_naklad_id`);

--
-- Индексы таблицы `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`user_id`),
  ADD KEY `FK_user_dolzhnost_dolzhnost_id` (`dolzhnost_id`),
  ADD KEY `FK_user_sklad_sklad_id` (`sklad_id`),
  ADD KEY `FK_user_role_role_id` (`role_id`);

--
-- Индексы таблицы `ychet_invent`
--
ALTER TABLE `ychet_invent`
  ADD PRIMARY KEY (`ychet_inventar_id`),
  ADD KEY `FK_ychet_invent_naklad_naklad_id` (`naklad_id`),
  ADD KEY `FK_ychet_invent_inventar_inventar_id` (`inventar_id`);

--
-- AUTO_INCREMENT для сохранённых таблиц
--

--
-- AUTO_INCREMENT для таблицы `dolzhnost`
--
ALTER TABLE `dolzhnost`
  MODIFY `dolzhnost_id` bigint(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT для таблицы `inventar`
--
ALTER TABLE `inventar`
  MODIFY `inventar_id` bigint(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT для таблицы `naklad`
--
ALTER TABLE `naklad`
  MODIFY `naklad_id` bigint(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT для таблицы `role`
--
ALTER TABLE `role`
  MODIFY `role_id` tinyint(4) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT для таблицы `sklad`
--
ALTER TABLE `sklad`
  MODIFY `sklad_id` bigint(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT для таблицы `type_invent`
--
ALTER TABLE `type_invent`
  MODIFY `type_inventar_id` bigint(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT для таблицы `type_naklad`
--
ALTER TABLE `type_naklad`
  MODIFY `type_naklad_id` bigint(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT для таблицы `user`
--
ALTER TABLE `user`
  MODIFY `user_id` bigint(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT для таблицы `ychet_invent`
--
ALTER TABLE `ychet_invent`
  MODIFY `ychet_inventar_id` bigint(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- Ограничения внешнего ключа сохраненных таблиц
--

--
-- Ограничения внешнего ключа таблицы `inventar`
--
ALTER TABLE `inventar`
  ADD CONSTRAINT `FK_inventar_type_invent_type_inventar_id` FOREIGN KEY (`type_inventar_id`) REFERENCES `type_invent` (`type_inventar_id`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Ограничения внешнего ключа таблицы `naklad`
--
ALTER TABLE `naklad`
  ADD CONSTRAINT `FK_naklad_sklad_sklad_id` FOREIGN KEY (`sklad_id`) REFERENCES `sklad` (`sklad_id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `FK_naklad_type_naklad_type_naklad_id` FOREIGN KEY (`type_naklad_id`) REFERENCES `type_naklad` (`type_naklad_id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `FK_naklad_user_user_id` FOREIGN KEY (`user_id`) REFERENCES `user` (`user_id`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Ограничения внешнего ключа таблицы `user`
--
ALTER TABLE `user`
  ADD CONSTRAINT `FK_user_dolzhnost_dolzhnost_id` FOREIGN KEY (`dolzhnost_id`) REFERENCES `dolzhnost` (`dolzhnost_id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `FK_user_role_role_id` FOREIGN KEY (`role_id`) REFERENCES `role` (`role_id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `FK_user_sklad_sklad_id` FOREIGN KEY (`sklad_id`) REFERENCES `sklad` (`sklad_id`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Ограничения внешнего ключа таблицы `ychet_invent`
--
ALTER TABLE `ychet_invent`
  ADD CONSTRAINT `FK_ychet_invent_inventar_inventar_id` FOREIGN KEY (`inventar_id`) REFERENCES `inventar` (`inventar_id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `FK_ychet_invent_naklad_naklad_id` FOREIGN KEY (`naklad_id`) REFERENCES `naklad` (`naklad_id`) ON DELETE NO ACTION ON UPDATE NO ACTION;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
