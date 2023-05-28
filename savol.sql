-- phpMyAdmin SQL Dump
-- version 5.1.3
-- https://www.phpmyadmin.net/
--
-- Хост: 127.0.0.1:3306
-- Время создания: Май 28 2023 г., 19:18
-- Версия сервера: 5.5.62
-- Версия PHP: 7.4.29

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";

--
-- База данных: `savol`
--

-- --------------------------------------------------------

--
-- Структура таблицы `categories`
--

CREATE TABLE `categories` (
  `id` int(11) NOT NULL,
  `name` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Дамп данных таблицы `categories`
--

INSERT INTO `categories` (`id`, `name`) VALUES
(1, 'Математика'),
(2, 'Литература'),
(3, 'Алгебра'),
(4, 'Русский язык'),
(5, 'Геометрия'),
(6, 'Английский язык'),
(7, 'Химия'),
(8, 'Физика'),
(9, 'Биология'),
(10, 'История'),
(11, 'Обществознание'),
(12, 'Окружающий мир'),
(13, 'География'),
(14, 'Забони точики'),
(15, 'Адабиёти точик'),
(16, 'Мировая литература'),
(17, 'Українська мова'),
(18, 'Информатика'),
(19, 'Українська література'),
(20, 'Қазақ тiлi'),
(21, 'Экономика'),
(22, 'Музыка'),
(23, 'Право'),
(24, 'Беларуская мова'),
(25, 'Французский язык'),
(26, 'Немецкий язык'),
(27, 'МХК'),
(28, 'ОБЖ'),
(29, 'Психология'),
(30, 'Оʻzbek tili'),
(31, 'Кыргыз тили'),
(32, 'Астрономия'),
(33, 'Физкультура и спорт'),
(34, 'Испанский язык'),
(35, 'Итальянский язык'),
(36, 'Турецкий язык'),
(37, 'Китайский язык'),
(38, 'Японский язык'),
(39, 'Корейский язык'),
(40, 'Арабский язык'),
(41, 'Польский язык'),
(42, 'Шведский язык'),
(43, 'Датский язык'),
(44, 'Нидерландский язык'),
(45, 'Португальский язык'),
(46, 'Греческий язык'),
(47, 'Индонезийский язык'),
(48, 'Малайский язык'),
(49, 'Венгерский язык'),
(50, 'Тайский язык'),
(51, 'Вьетнамский язык'),
(52, 'Финский язык'),
(53, 'Норвежский язык'),
(54, 'Прочее');

-- --------------------------------------------------------

--
-- Структура таблицы `questions`
--

CREATE TABLE `questions` (
  `id` int(11) NOT NULL,
  `MainText` text,
  `DateCreate` timestamp NULL DEFAULT NULL,
  `DateLastEdit` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `Category` varchar(255) DEFAULT NULL,
  `Status` int(11) DEFAULT NULL,
  `UserId` int(11) DEFAULT NULL,
  `HideUser` tinyint(1) DEFAULT NULL,
  `PhotoPath` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Индексы сохранённых таблиц
--

--
-- Индексы таблицы `categories`
--
ALTER TABLE `categories`
  ADD PRIMARY KEY (`id`);

--
-- Индексы таблицы `questions`
--
ALTER TABLE `questions`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT для сохранённых таблиц
--

--
-- AUTO_INCREMENT для таблицы `categories`
--
ALTER TABLE `categories`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=55;

--
-- AUTO_INCREMENT для таблицы `questions`
--
ALTER TABLE `questions`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=32;
COMMIT;