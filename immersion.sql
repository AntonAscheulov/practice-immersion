-- phpMyAdmin SQL Dump
-- version 5.1.0
-- https://www.phpmyadmin.net/
--
-- Хост: 127.0.0.1:3306
-- Время создания: Ноя 30 2022 г., 11:54
-- Версия сервера: 8.0.24
-- Версия PHP: 8.0.8

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- База данных: `immersion`
--

-- --------------------------------------------------------

--
-- Структура таблицы `users`
--

CREATE TABLE `users` (
  `id` int NOT NULL,
  `name` varchar(255) CHARACTER SET utf8 COLLATE utf8_general_ci DEFAULT NULL,
  `last_name` varchar(255) CHARACTER SET utf8 COLLATE utf8_general_ci DEFAULT NULL,
  `email` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  `job_title` varchar(255) NOT NULL DEFAULT 'Не заполнено',
  `status` varchar(255) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL DEFAULT 'online',
  `avatar` varchar(255) CHARACTER SET utf8 COLLATE utf8_general_ci DEFAULT NULL,
  `phone` varchar(255) NOT NULL DEFAULT 'Не заполнено',
  `address` varchar(255) NOT NULL DEFAULT 'Не заполнено',
  `VK` varchar(255) NOT NULL DEFAULT '#',
  `telegram` varchar(255) NOT NULL DEFAULT '#',
  `instagram` varchar(255) NOT NULL DEFAULT '#',
  `role` varchar(255) NOT NULL DEFAULT 'user'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3;

--
-- Дамп данных таблицы `users`
--

INSERT INTO `users` (`id`, `name`, `last_name`, `email`, `password`, `job_title`, `status`, `avatar`, `phone`, `address`, `VK`, `telegram`, `instagram`, `role`) VALUES
(12, 'Admin', 'Admin', 'admin@admin.com', '$2y$10$clSRzyqIXdguqLi4cY4cS.cQo6Ss/r3Ri5WIexeSv4dFORbRVeQXu', 'Работа мечты', 'online', 'uploads/avatars/user2-160x160.jpg63866f6682fc4.jpg', '+37533777777', 'Планета земля', '#', '#', '#', 'admin'),
(13, 'Oliver123', 'Kopyov123', 'oliver.kopyov@smartadminwebapp.com', '123', 'IT Director, Gotbootstrap Inc.', 'online', 'uploads/avatars/user1-128x128.jpg63870bf2c5346.jpg', '+1 317-456-2564', ' 15 Charist St, Detroit, MI, 48212, USA', '#', '#', '#', 'user'),
(14, 'Alita', 'Gray', 'Alita@smartadminwebapp.com', '123', 'Project Manager, Gotbootstrap Inc.', 'not_disturb', 'uploads/avatars/user3-128x128.jpg63870bff90099.jpg', 'Project Manager, Gotbootstrap Inc.', ' 134 Hamtrammac, Detroit, MI, 48314, USA', '#', '#', '#', 'user'),
(15, 'Dr. John ', 'Cook PhD', 'john.cook@smartadminwebapp.com', '123', 'Human Resources, Gotbootstrap Inc.', 'away', 'uploads/avatars/user8-128x128.jpg63870c10aa3a5.jpg', '+1 313-779-1347', '55 Smyth Rd, Detroit, MI, 48341, USA', '#', '#', '#', 'user'),
(16, 'Jim', 'Ketty', 'jim.ketty@smartadminwebapp.com', '123', 'Staff Orgnizer, Gotbootstrap Inc.', 'online', 'uploads/avatars/user6-128x128.jpg63870c2104c64.jpg', '+1 313-779-3314', '134 Tasy Rd, Detroit, MI, 48212, USA', '#', '#', '#', 'user'),
(17, 'Dr. John', 'Oliver', 'john.oliver@smartadminwebapp.com', '123', 'Oncologist, Gotbootstrap Inc.', 'online', 'uploads/avatars/2.jpg63870c6da85be.jpg', '+1 313-779-8134', '134 Gallery St, Detroit, MI, 46214, USA', '#', '#', '#', 'user'),
(18, 'Sarah', 'McBrook', 'sarah.mcbrook@smartadminwebapp.com', '123', 'Xray Division, Gotbootstrap Inc.', 'online', 'uploads/avatars/user4-128x128.jpg63870c2ee99d0.jpg', '+1 313-779-7613', '13 Jamie Rd, Detroit, MI, 48313, USA', '#', '#', '#', 'user');

--
-- Индексы сохранённых таблиц
--

--
-- Индексы таблицы `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT для сохранённых таблиц
--

--
-- AUTO_INCREMENT для таблицы `users`
--
ALTER TABLE `users`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=36;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
