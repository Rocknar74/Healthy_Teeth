-- phpMyAdmin SQL Dump
-- version 4.9.0.1
-- https://www.phpmyadmin.net/
--
-- Хост: 127.0.0.1:3306
-- Время создания: Мар 07 2020 г., 22:48
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
-- База данных: `healthy_teeth`
--
CREATE DATABASE IF NOT EXISTS `healthy_teeth` DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci;
USE `healthy_teeth`;

-- --------------------------------------------------------

--
-- Структура таблицы `registration`
--

CREATE TABLE `registration` (
  `id` int(11) NOT NULL,
  `date` varchar(10) COLLATE utf8mb4_unicode_ci NOT NULL,
  `name` varchar(32) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `phone` varchar(18) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `email` varchar(64) COLLATE utf8mb4_unicode_ci DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Структура таблицы `reviews`
--

CREATE TABLE `reviews` (
  `id` int(11) NOT NULL,
  `date` datetime DEFAULT current_timestamp(),
  `name` varchar(32) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `text_review` varchar(600) COLLATE utf8mb4_unicode_ci DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Дамп данных таблицы `reviews`
--

INSERT INTO `reviews` (`id`, `date`, `name`, `text_review`) VALUES
(1, '2020-02-04 00:00:00', 'Александр Кузнецов', 'Эта клиника открылась относительно недавно, но удивила низкими ценами, качественной работой. Пару недель назад у меня заболел зуб, в большенстве клиник нашего города очередь на месяц вперед. Я случайно наткнулась на эту новую стоматологию в центре города. я позвонила, мне ответила девушка, которая все подробно рассказала и записала на удобное время. Буквально через сутки я вышла с улыбкой из кабинета, боли больше не было, так еще и сделали скидку на гигиену рта. В целом довольна услугами. Не такое уж и дорогое пломбирование, укол и услуги врача. Все качественно, понятно и удобно. Спасибо.'),
(2, '2020-02-15 00:00:00', 'Стручкова Маргарита', 'Замечательная клиника. Лечила тут 5 зубов, цены низкие.Также хотелось бы отметить вежливый и понимающий персонал, сразу видно, что профессионалы своего дела. Если возникнут еще проблемы, то буду обращаться еще не раз.'),
(3, '2020-02-25 00:00:00', 'Анна', 'Всегда считала, что профилактика помогает избежать серьезных проблем со здоровьем зубов. Была на профессиональной чистку зубов у Прохладова Ангелина Витальевна. Профессионал своего дела! Рекомендую.');

--
-- Индексы сохранённых таблиц
--

--
-- Индексы таблицы `registration`
--
ALTER TABLE `registration`
  ADD PRIMARY KEY (`id`);

--
-- Индексы таблицы `reviews`
--
ALTER TABLE `reviews`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT для сохранённых таблиц
--

--
-- AUTO_INCREMENT для таблицы `registration`
--
ALTER TABLE `registration`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT для таблицы `reviews`
--
ALTER TABLE `reviews`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=38;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
