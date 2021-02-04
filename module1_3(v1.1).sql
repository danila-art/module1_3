-- phpMyAdmin SQL Dump
-- version 5.0.2
-- https://www.phpmyadmin.net/
--
-- Хост: 127.0.0.1:3306
-- Время создания: Фев 04 2021 г., 12:53
-- Версия сервера: 8.0.19
-- Версия PHP: 7.4.5

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- База данных: `module1_3`
--

-- --------------------------------------------------------

--
-- Структура таблицы `answer`
--

CREATE TABLE `answer` (
  `id_answer` int NOT NULL,
  `id_theme` int NOT NULL,
  `id_user` int NOT NULL,
  `text` text NOT NULL,
  `date` date NOT NULL,
  `time` time NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Дамп данных таблицы `answer`
--

INSERT INTO `answer` (`id_answer`, `id_theme`, `id_user`, `text`, `date`, `time`) VALUES
(1, 3, 8, 'Это самаый правильный ответ, который был написан чисто для теста...', '2021-02-02', '13:33:43');

-- --------------------------------------------------------

--
-- Структура таблицы `theme`
--

CREATE TABLE `theme` (
  `id_theme` int NOT NULL,
  `name` varchar(250) NOT NULL,
  `text` text NOT NULL,
  `status` varchar(60) NOT NULL,
  `date` date NOT NULL,
  `time` time NOT NULL,
  `id_user` int NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Дамп данных таблицы `theme`
--

INSERT INTO `theme` (`id_theme`, `name`, `text`, `status`, `date`, `time`, `id_user`) VALUES
(2, 'danila', 'asdsadasdasd////', 'Тема прошла модерацию', '2021-01-21', '12:27:08', 8),
(3, 'Любовь к буте', 'Кошмарить даниила как смысл жизини', 'Тема прошла модерацию', '2021-01-21', '12:32:20', 9),
(4, ',kffaoiuphfdQHFDH', '2FQWEEEEEEEEEEEEEEEEEEEEEEEEEEEEEEEASFDlkA2EHK', 'Тема ожидает модерацию', '2021-01-28', '12:18:31', 8),
(6, 'test1', 'test1test1test1test1test1test1test1test1test1test1test1///////', 'Тема ожидает модерацию', '2021-02-04', '09:40:24', 8);

-- --------------------------------------------------------

--
-- Структура таблицы `user`
--

CREATE TABLE `user` (
  `id` int NOT NULL,
  `email` varchar(30) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL,
  `name` varchar(20) NOT NULL,
  `surname` varchar(20) NOT NULL,
  `password` varchar(45) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Дамп данных таблицы `user`
--

INSERT INTO `user` (`id`, `email`, `name`, `surname`, `password`) VALUES
(8, 'danila.sivov.96@mail.ru', 'Danila', 'Sivov', '386f696269e8ba578a34c1bc4ea8e761'),
(9, 'ye.sb@yandex.ru', 'ye.sb', 'ye.sb', '25d55ad283aa400af464c76d713c07ad'),
(10, 'testemail@mail.ru', 'testBot', 'Bot', '4297f44b13955235245b2497399d7a93'),
(999, 'admin_admin@mail.ru', 'admin', 'admin', '00ba7ceab606427071d5d755ea99e976');

--
-- Индексы сохранённых таблиц
--

--
-- Индексы таблицы `answer`
--
ALTER TABLE `answer`
  ADD PRIMARY KEY (`id_answer`),
  ADD KEY `id_theme` (`id_theme`),
  ADD KEY `id_user` (`id_user`);

--
-- Индексы таблицы `theme`
--
ALTER TABLE `theme`
  ADD PRIMARY KEY (`id_theme`),
  ADD KEY `id_user` (`id_user`);

--
-- Индексы таблицы `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT для сохранённых таблиц
--

--
-- AUTO_INCREMENT для таблицы `theme`
--
ALTER TABLE `theme`
  MODIFY `id_theme` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT для таблицы `user`
--
ALTER TABLE `user`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=1002;

--
-- Ограничения внешнего ключа сохраненных таблиц
--

--
-- Ограничения внешнего ключа таблицы `answer`
--
ALTER TABLE `answer`
  ADD CONSTRAINT `answer_ibfk_1` FOREIGN KEY (`id_user`) REFERENCES `user` (`id`),
  ADD CONSTRAINT `answer_ibfk_2` FOREIGN KEY (`id_theme`) REFERENCES `theme` (`id_theme`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
