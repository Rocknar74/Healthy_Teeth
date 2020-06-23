-- phpMyAdmin SQL Dump
-- version 4.9.0.1
-- https://www.phpmyadmin.net/
--
-- Хост: 127.0.0.1:3306
-- Время создания: Май 31 2020 г., 13:18
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
-- Структура таблицы `news`
--

CREATE TABLE `news` (
  `id` int(11) NOT NULL COMMENT 'id',
  `image` varchar(999) COLLATE utf8mb4_unicode_ci DEFAULT NULL COMMENT 'Новость',
  `numeration` int(10) DEFAULT NULL COMMENT 'Порядковый номер новости на сайте'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Дамп данных таблицы `news`
--

INSERT INTO `news` (`id`, `image`, `numeration`) VALUES
(1, 'img/main/news/news_1.jpg', 1),
(3, 'img/main/news/news_3.jpg', 2),
(4, 'img/main/news/news_2.jpg', 3);

-- --------------------------------------------------------

--
-- Структура таблицы `personnel`
--

CREATE TABLE `personnel` (
  `id` int(11) NOT NULL COMMENT 'id',
  `photo` varchar(999) COLLATE utf8mb4_unicode_ci DEFAULT NULL COMMENT 'фото',
  `surname` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL COMMENT 'фамилия',
  `name` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL COMMENT 'имя',
  `patronymic` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL COMMENT 'Отчество',
  `profession` varchar(50) COLLATE utf8mb4_unicode_ci DEFAULT NULL COMMENT 'профессия',
  `description` varchar(200) COLLATE utf8mb4_unicode_ci DEFAULT NULL COMMENT 'описание',
  `numeration` int(10) DEFAULT NULL COMMENT 'порядковый номер при выводе на сайт'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci COMMENT='таблица персонала';

--
-- Дамп данных таблицы `personnel`
--

INSERT INTO `personnel` (`id`, `photo`, `surname`, `name`, `patronymic`, `profession`, `description`, `numeration`) VALUES
(1, 'img/main/personnel/1.jpg', 'Прохладова', 'Ангелина', 'Витальевна', 'Стоматолог', 'Опыт работы 11 лет, за это время вылечила более 1000 пациентов', 1),
(2, 'img/main/personnel/2.jpg', 'Воронцов', 'Алексей', 'Степанович', 'Стоматолог-терапевт', 'Опыт работы 15 лет. Автор уникальных разработок и методик протезирования зубов', 2),
(8, 'img/main/personnel/3.jpg', 'Зюзько', 'Мария', 'Прохорова', 'Стоматолог', 'Опыт работы 12 лет', 3),
(9, 'img/main/personnel/2.jpg', 'Щукин', 'Евгений', 'Антонович', 'Стоматолог', 'Опыт работы 12 лет', 4);

-- --------------------------------------------------------

--
-- Структура таблицы `registration`
--

CREATE TABLE `registration` (
  `id` int(11) NOT NULL COMMENT 'id',
  `date` varchar(10) COLLATE utf8mb4_unicode_ci NOT NULL COMMENT 'Дата заявки',
  `name` varchar(32) COLLATE utf8mb4_unicode_ci DEFAULT NULL COMMENT 'Имя',
  `phone` varchar(18) COLLATE utf8mb4_unicode_ci DEFAULT NULL COMMENT 'Телефон',
  `email` varchar(64) COLLATE utf8mb4_unicode_ci DEFAULT NULL COMMENT 'Электронная почта',
  `status` varchar(50) COLLATE utf8mb4_unicode_ci DEFAULT 'непросмотренно' COMMENT 'Статус заявки'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Дамп данных таблицы `registration`
--

INSERT INTO `registration` (`id`, `date`, `name`, `phone`, `email`, `status`) VALUES
(23, '2020-06-24', 'Андрей', '+78889998877', 'sd@gmail.com', 'рассматривается'),
(24, '2020-12-19', 'Никита', '+71231234451', '23@gmail.com', 'рассматривается'),
(25, '2020-06-26', 'Анна', '+71231234455', '123@y.ru', 'непросмотренно');

-- --------------------------------------------------------

--
-- Структура таблицы `reviews`
--

CREATE TABLE `reviews` (
  `id` int(11) NOT NULL COMMENT 'id',
  `date` datetime DEFAULT current_timestamp() COMMENT 'Дата отзыва',
  `name` varchar(32) COLLATE utf8mb4_unicode_ci DEFAULT NULL COMMENT 'Имя',
  `text_review` varchar(600) COLLATE utf8mb4_unicode_ci DEFAULT NULL COMMENT 'Текст отзыва',
  `numeration` int(10) DEFAULT NULL COMMENT 'Порядковый номер отзыва при выводе на сайте'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Дамп данных таблицы `reviews`
--

INSERT INTO `reviews` (`id`, `date`, `name`, `text_review`, `numeration`) VALUES
(45, '2020-05-23 15:18:55', 'Александр Кузнецов', 'Эта клиника открылась относительно недавно, но удивила низкими ценами, качественной работой. Пару недель назад у меня заболел зуб, в большенстве клиник нашего города очередь на месяц вперед. Я случайно наткнулась на эту новую стоматологию в центре города. я позвонила, мне ответила девушка, которая все подробно рассказала и записала на удобное время. Буквально через сутки я вышла с улыбкой из кабинета, боли больше не было, так еще и сделали скидку на гигиену рта. В целом довольна услугами. Не такое уж и дорогое пломбирование, укол и услуги врача. Все качественно, понятно и удобно. Спасибо.', 1),
(46, '2020-05-23 15:19:09', 'Стручкова Маргарита', 'Замечательная клиника. Лечила тут 5 зубов, цены низкие.Также хотелось бы отметить вежливый и понимающий персонал, сразу видно, что профессионалы своего дела. Если возникнут еще проблемы, то буду обращаться еще не раз.', 3),
(47, '2020-05-23 15:19:21', 'Анна', 'Всегда считала, что профилактика помогает избежать серьезных проблем со здоровьем зубов. Была на профессиональной чистку зубов у Прохладова Ангелина Витальевна. Профессионал своего дела! Рекомендую.', 2),
(55, '2020-05-31 11:18:14', 'Генадий', 'Приду повторно!', NULL);

-- --------------------------------------------------------

--
-- Структура таблицы `services`
--

CREATE TABLE `services` (
  `id` int(11) NOT NULL COMMENT 'id',
  `service_name` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL COMMENT 'Наименование услуги',
  `price` int(20) NOT NULL COMMENT 'Цена услуги'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Дамп данных таблицы `services`
--

INSERT INTO `services` (`id`, `service_name`, `price`) VALUES
(1, 'Средний кариес жевательного зуба', 100500),
(2, 'Средний кариес фронтального зуба', 4000),
(3, 'Глубокий кариес жевательного зуба', 4500),
(4, 'Глубокий кариес фронтального зуба', 5000),
(5, 'Лечение пульпита 1 канального зуба', 7500),
(6, 'Лечение пульпита 2-х канального зуба', 10000),
(7, 'Лечение пульпита 3-х канального зуба', 13000),
(8, 'Лечение пульпита 4-х канального зуба', 15000),
(9, 'Временная коронка на своем зубе', 3000),
(10, 'Временная коронка на имплантате', 8500),
(11, 'Удаление подвижного, молочного зуба', 1000),
(12, 'Удаление 1 корневого зуба', 2500);

--
-- Индексы сохранённых таблиц
--

--
-- Индексы таблицы `news`
--
ALTER TABLE `news`
  ADD PRIMARY KEY (`id`);

--
-- Индексы таблицы `personnel`
--
ALTER TABLE `personnel`
  ADD PRIMARY KEY (`id`);

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
-- Индексы таблицы `services`
--
ALTER TABLE `services`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT для сохранённых таблиц
--

--
-- AUTO_INCREMENT для таблицы `news`
--
ALTER TABLE `news`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT COMMENT 'id', AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT для таблицы `personnel`
--
ALTER TABLE `personnel`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT COMMENT 'id', AUTO_INCREMENT=16;

--
-- AUTO_INCREMENT для таблицы `registration`
--
ALTER TABLE `registration`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT COMMENT 'id', AUTO_INCREMENT=26;

--
-- AUTO_INCREMENT для таблицы `reviews`
--
ALTER TABLE `reviews`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT COMMENT 'id', AUTO_INCREMENT=56;

--
-- AUTO_INCREMENT для таблицы `services`
--
ALTER TABLE `services`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT COMMENT 'id', AUTO_INCREMENT=17;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
