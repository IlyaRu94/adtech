-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Хост: 127.0.0.1:3307
-- Время создания: Окт 16 2023 г., 02:45
-- Версия сервера: 8.0.30
-- Версия PHP: 7.2.34

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- База данных: `adtech`
--

-- --------------------------------------------------------

--
-- Структура таблицы `adoffer`
--

CREATE TABLE `adoffer` (
  `id` int UNSIGNED NOT NULL,
  `name` varchar(191) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_520_ci NOT NULL,
  `theme` varchar(191) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_520_ci NOT NULL,
  `price` decimal(12,2) UNSIGNED NOT NULL DEFAULT '0.00',
  `url` varchar(191) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_520_ci NOT NULL,
  `userid` int UNSIGNED NOT NULL,
  `date` int UNSIGNED NOT NULL,
  `active` tinyint UNSIGNED DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_520_ci;

--
-- Дамп данных таблицы `adoffer`
--

INSERT INTO `adoffer` (`id`, `name`, `theme`, `price`, `url`, `userid`, `date`, `active`) VALUES
(1, 'Именной вечный календарь', 'Канцелярия', '10.00', 'http://calendar.ru', 32, 1696800704, 1),
(2, 'Котики', 'Животные', '10.00', 'http://котики.онлайн', 30, 1696010205, NULL),
(5, 'SkillFactory -Онлайн школа N1 в России', 'Обучение', '1011.00', 'http://skillfactory.ru', 30, 1696089312, 1),
(7, 'Батареи по оптовым ценам', 'Ремонт', '10.00', 'http://ya.ru', 30, 1696977855, 1),
(8, 'Казино 3 топора', 'Игры', '193.58', 'http://777', 30, 1696081034, 0),
(9, 'Входные двери по низким ценам', 'Ремонт', '123.58', 'http://двери.ру', 30, 1696082067, 1),
(10, 'Пластиковые окна по низким ценам', 'Ремонт', '123.58', 'http://пласитик.рф', 30, 1696970765, 1),
(11, 'Кухня на заказ', 'Мебель', '123.58', 'http://kuhnya.ru/sk_brigada', 30, 1696970711, 0),
(12, 'Портал доброты. Консультации психологов', 'Общение', '0.50', 'http://papa.ru', 30, 1696970795, 0),
(14, 'Диалоги о животных', 'Животные', '97.00', 'http://animals.ru', 30, 1696970587, 1),
(20, 'Текстовый портал', 'Обучение', '10.50', 'http://text.ru/', 34, 1697321060, 1);

-- --------------------------------------------------------

--
-- Структура таблицы `click`
--

CREATE TABLE `click` (
  `id` int NOT NULL,
  `masteruserid` varchar(191) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci DEFAULT '0',
  `date` int NOT NULL,
  `status` int NOT NULL,
  `url` varchar(191) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_520_ci NOT NULL,
  `offerid` varchar(191) DEFAULT NULL,
  `price` decimal(10,2) DEFAULT '0.00'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Дамп данных таблицы `click`
--

INSERT INTO `click` (`id`, `masteruserid`, `date`, `status`, `url`, `offerid`, `price`) VALUES
(1, '32', 1696692545, 3, '99a2c8ea1002e8bbb658ac57522fc6fc396aaf347ce8f7bc5f1ea959b1229b57', '3', NULL),
(2, '0', 1696692850, 0, '99a2c8ea1002e8bbb658ac57522fc6fc396aaf347ce8f7bc5f1ea959b1229b57', '0', NULL),
(3, '32', 1696692896, 2, '99a2c8ea1002e8bbb658ac57522fc6fc396aaf347ce8f7bc5f1ea959b1229b57', '3', NULL),
(4, '32', 1696693743, 2, '99a2c8ea1002e8bbb658ac57522fc6fc396aaf347ce8f7bc5f1ea959b1229b57', '3', NULL),
(5, '32', 1696705434, 2, '99a2c8ea1002e8bbb658ac57522fc6fc396aaf347ce8f7bc5f1ea959b1229b57', '3', NULL),
(6, '32', 1696710477, 2, '99a2c8ea1002e8bbb658ac57522fc6fc396aaf347ce8f7bc5f1ea959b1229b57', '3', NULL),
(7, '32', 1696710520, 3, '99a2c8ea1002e8bbb658ac57522fc6fc396aaf347ce8f7bc5f1ea959b1229b57', '3', NULL),
(8, '32', 1696710834, 3, '99a2c8ea1002e8bbb658ac57522fc6fc396aaf347ce8f7bc5f1ea959b1229b57', '3', NULL),
(9, '32', 1696710877, 3, '99a2c8ea1002e8bbb658ac57522fc6fc396aaf347ce8f7bc5f1ea959b1229b57', '3', NULL),
(10, '32', 1696711206, 3, '99a2c8ea1002e8bbb658ac57522fc6fc396aaf347ce8f7bc5f1ea959b1229b57', '3', NULL),
(11, '32', 1696711319, 2, '99a2c8ea1002e8bbb658ac57522fc6fc396aaf347ce8f7bc5f1ea959b1229b57', '3', NULL),
(12, '32', 1696711386, 3, '99a2c8ea1002e8bbb658ac57522fc6fc396aaf347ce8f7bc5f1ea959b1229b57', '3', NULL),
(13, '32', 1696711569, 3, '99a2c8ea1002e8bbb658ac57522fc6fc396aaf347ce8f7bc5f1ea959b1229b57', '3', NULL),
(14, '32', 1696716972, 2, '89b4303a43b298f036aaa440bc5243a188a20577a7fb521ab003ff62aa10c09b', '10', NULL),
(15, '32', 1696716998, 3, '89b4303a43b298f036aaa440bc5243a188a20577a7fb521ab003ff62aa10c09b', '10', NULL),
(16, '', 1696721536, 0, '89b4303a43b298f036aaa440bc5243a188a20577a7fb521ab003ff62aa10c09b', '', NULL),
(17, '0', 1696721629, 0, '89b4303a43b298f036aaa440bc5243a188a20577a7fb521ab003ff62aa10c09b', '0', NULL),
(18, '0', 1696769916, 0, '89b4303a43b298f036aaa440bc5243a188a20577a7fb521ab003ff62aa10c09b', '0', NULL),
(19, '33', 1696770013, 2, '3fa1eca4649f367224ef2c97df43fcef8b32b49fea7df4a76915ccb71a6998e8', '5', NULL),
(20, '33', 1696784947, 2, '3fa1eca4649f367224ef2c97df43fcef8b32b49fea7df4a76915ccb71a6998e8', '5', '0.00'),
(21, '33', 1696785244, 5, '3fa1eca4649f367224ef2c97df43fcef8b32b49fea7df4a76915ccb71a6998e8', '5', '1011.00'),
(22, '33', 1696785279, 2, '3fa1eca4649f367224ef2c97df43fcef8b32b49fea7df4a76915ccb71a6998e8', '5', '0.00'),
(23, '33', 1696787380, 3, '3fa1eca4649f367224ef2c97df43fcef8b32b49fea7df4a76915ccb71a6998e8', '5', '0.00'),
(24, '30', 1696794490, 5, '794d27ab6d52b8869ac1b8f93b91a24592d245cdcef0d0d14f9599d6b35376f2', '1', '10.00'),
(25, '30', 1696794736, 5, '794d27ab6d52b8869ac1b8f93b91a24592d245cdcef0d0d14f9599d6b35376f2', '1', '10.00'),
(26, '30', 1696842283, 5, '794d27ab6d52b8869ac1b8f93b91a24592d245cdcef0d0d14f9599d6b35376f2', '1', '10.00'),
(27, '30', 1696854431, 5, '794d27ab6d52b8869ac1b8f93b91a24592d245cdcef0d0d14f9599d6b35376f2', '1', '10.00'),
(28, '30', 1696931176, 5, '794d27ab6d52b8869ac1b8f93b91a24592d245cdcef0d0d14f9599d6b35376f2', '1', '10.00'),
(29, '32', 1696935003, 5, 'b22f54aa27d3b36b7e245b55b5c20bccea49db562a6600ca0dd939e4fb4605cd', '10', '123.58'),
(30, '30', 1696974716, 5, '794d27ab6d52b8869ac1b8f93b91a24592d245cdcef0d0d14f9599d6b35376f2', '1', '10.00'),
(31, '0', 1696974716, 0, 'aHR0cDovL3RleHQucnU', '0', '0.00'),
(32, '33', 1696974724, 0, '3fa1eca4649f367224ef2c97df43fcef8b32b49fea7df4a76915ccb71a6998e8', '5', '0.00'),
(33, '32', 1696974738, 0, '99a2c8ea1002e8bbb658ac57522fc6fc396aaf347ce8f7bc5f1ea959b1229b57', '3', '0.00'),
(34, '30', 1696974835, 0, 'd352c8c879c511497ca48ce283977276670d4b6c5890de59d3d859854cb8f37a', '20', '0.00'),
(35, '30', 1696974865, 0, '21906eb0a546c857dd4a3606aa5e79d19143b403845d138900c00390a3d094ec', '14', '0.00'),
(36, '30', 1696974898, 5, '794d27ab6d52b8869ac1b8f93b91a24592d245cdcef0d0d14f9599d6b35376f2', '1', '10.00'),
(37, '0', 1696974898, 0, 'aHR0cDovL3RleHQucnU', '0', '0.00'),
(38, '30', 1696974923, 0, '476b5a4b387dfd3dbed3635605e2e052f8af2e3f469dff6d41f5051dfad0fedc', '10', '0.00'),
(39, '30', 1696974969, 5, 'd0c9b7b677845360b3cbcadd72623c78140b031e34e83e8504655af1a407bf1f', '7', '10.00'),
(40, '0', 1696974969, 0, 'aHR0cDovL3RleHQucnU', '0', '0.00'),
(41, '30', 1696975047, 5, 'd0c9b7b677845360b3cbcadd72623c78140b031e34e83e8504655af1a407bf1f', '7', '10.00'),
(42, '0', 1696975047, 0, 'aHR0cDovL3RleHQucnU', '0', '0.00'),
(43, '30', 1696975219, 5, 'd0c9b7b677845360b3cbcadd72623c78140b031e34e83e8504655af1a407bf1f', '7', '10.00'),
(44, '30', 1696975364, 5, 'd0c9b7b677845360b3cbcadd72623c78140b031e34e83e8504655af1a407bf1f', '7', '10.00'),
(45, '30', 1696975416, 5, 'd0c9b7b677845360b3cbcadd72623c78140b031e34e83e8504655af1a407bf1f', '7', '10.00'),
(46, '30', 1696975439, 5, 'd0c9b7b677845360b3cbcadd72623c78140b031e34e83e8504655af1a407bf1f', '7', '10.00'),
(47, '30', 1696975481, 5, 'd0c9b7b677845360b3cbcadd72623c78140b031e34e83e8504655af1a407bf1f', '7', '10.00'),
(48, '30', 1696975639, 5, 'd0c9b7b677845360b3cbcadd72623c78140b031e34e83e8504655af1a407bf1f', '7', '10.00'),
(49, '30', 1696975714, 5, 'd0c9b7b677845360b3cbcadd72623c78140b031e34e83e8504655af1a407bf1f', '7', '10.00'),
(50, '30', 1696975755, 0, 'd0c9b7b677845360b3cbcadd72623c78140b031e34e83e8504655af1a407bf1f', '7', '0.00'),
(51, '30', 1696976064, 5, 'd0c9b7b677845360b3cbcadd72623c78140b031e34e83e8504655af1a407bf1f', '7', '10.00'),
(52, '30', 1696976178, 5, 'd0c9b7b677845360b3cbcadd72623c78140b031e34e83e8504655af1a407bf1f', '7', '10.00'),
(53, '30', 1696976283, 5, 'd0c9b7b677845360b3cbcadd72623c78140b031e34e83e8504655af1a407bf1f', '7', '10.00'),
(54, '30', 1696976683, 5, 'd0c9b7b677845360b3cbcadd72623c78140b031e34e83e8504655af1a407bf1f', '7', '10.00'),
(55, '30', 1696977185, 5, 'd0c9b7b677845360b3cbcadd72623c78140b031e34e83e8504655af1a407bf1f', '7', '10.00'),
(56, '30', 1696977200, 5, 'd0c9b7b677845360b3cbcadd72623c78140b031e34e83e8504655af1a407bf1f', '7', '10.00'),
(57, '30', 1696977208, 5, 'd0c9b7b677845360b3cbcadd72623c78140b031e34e83e8504655af1a407bf1f', '7', '10.00'),
(58, '30', 1696977223, 5, 'd0c9b7b677845360b3cbcadd72623c78140b031e34e83e8504655af1a407bf1f', '7', '10.00'),
(59, '30', 1696977234, 5, 'd0c9b7b677845360b3cbcadd72623c78140b031e34e83e8504655af1a407bf1f', '7', '10.00'),
(60, '30', 1696977239, 5, 'd0c9b7b677845360b3cbcadd72623c78140b031e34e83e8504655af1a407bf1f', '7', '10.00'),
(61, '30', 1696977241, 5, 'd0c9b7b677845360b3cbcadd72623c78140b031e34e83e8504655af1a407bf1f', '7', '10.00'),
(62, '30', 1696977242, 5, 'd0c9b7b677845360b3cbcadd72623c78140b031e34e83e8504655af1a407bf1f', '7', '10.00'),
(63, '30', 1696977244, 5, 'd0c9b7b677845360b3cbcadd72623c78140b031e34e83e8504655af1a407bf1f', '7', '10.00'),
(64, '30', 1696977246, 5, 'd0c9b7b677845360b3cbcadd72623c78140b031e34e83e8504655af1a407bf1f', '7', '10.00'),
(65, '30', 1696977248, 5, 'd0c9b7b677845360b3cbcadd72623c78140b031e34e83e8504655af1a407bf1f', '7', '10.00'),
(66, '30', 1696977250, 5, 'd0c9b7b677845360b3cbcadd72623c78140b031e34e83e8504655af1a407bf1f', '7', '10.00'),
(67, '30', 1696977254, 5, 'd0c9b7b677845360b3cbcadd72623c78140b031e34e83e8504655af1a407bf1f', '7', '10.00'),
(68, '30', 1696977255, 5, 'd0c9b7b677845360b3cbcadd72623c78140b031e34e83e8504655af1a407bf1f', '7', '10.00'),
(69, '30', 1696977256, 5, 'd0c9b7b677845360b3cbcadd72623c78140b031e34e83e8504655af1a407bf1f', '7', '10.00'),
(70, '30', 1696977258, 5, 'd0c9b7b677845360b3cbcadd72623c78140b031e34e83e8504655af1a407bf1f', '7', '10.00'),
(71, '30', 1696977260, 5, 'd0c9b7b677845360b3cbcadd72623c78140b031e34e83e8504655af1a407bf1f', '7', '10.00'),
(72, '30', 1696977269, 5, 'd0c9b7b677845360b3cbcadd72623c78140b031e34e83e8504655af1a407bf1f', '7', '10.00'),
(73, '30', 1696977275, 5, 'd0c9b7b677845360b3cbcadd72623c78140b031e34e83e8504655af1a407bf1f', '7', '10.00'),
(74, '30', 1696977312, 5, 'd0c9b7b677845360b3cbcadd72623c78140b031e34e83e8504655af1a407bf1f', '7', '10.00'),
(75, '30', 1696977357, 5, 'd0c9b7b677845360b3cbcadd72623c78140b031e34e83e8504655af1a407bf1f', '7', '10.00'),
(76, '30', 1696977365, 5, 'd0c9b7b677845360b3cbcadd72623c78140b031e34e83e8504655af1a407bf1f', '7', '10.00'),
(77, '30', 1696977368, 5, 'd0c9b7b677845360b3cbcadd72623c78140b031e34e83e8504655af1a407bf1f', '7', '10.00'),
(78, '30', 1696977370, 5, 'd0c9b7b677845360b3cbcadd72623c78140b031e34e83e8504655af1a407bf1f', '7', '10.00'),
(79, '30', 1696977372, 5, 'd0c9b7b677845360b3cbcadd72623c78140b031e34e83e8504655af1a407bf1f', '7', '10.00'),
(80, '30', 1696977374, 5, 'd0c9b7b677845360b3cbcadd72623c78140b031e34e83e8504655af1a407bf1f', '7', '10.00'),
(81, '30', 1696977376, 5, 'd0c9b7b677845360b3cbcadd72623c78140b031e34e83e8504655af1a407bf1f', '7', '10.00'),
(82, '30', 1696977824, 5, 'd0c9b7b677845360b3cbcadd72623c78140b031e34e83e8504655af1a407bf1f', '7', '10.00'),
(83, '30', 1696977832, 5, 'd0c9b7b677845360b3cbcadd72623c78140b031e34e83e8504655af1a407bf1f', '7', '10.00'),
(84, '30', 1696977860, 5, 'd0c9b7b677845360b3cbcadd72623c78140b031e34e83e8504655af1a407bf1f', '7', '10.00'),
(85, '30', 1696977875, 5, 'd0c9b7b677845360b3cbcadd72623c78140b031e34e83e8504655af1a407bf1f', '7', '10.00'),
(86, '30', 1696977879, 5, 'd0c9b7b677845360b3cbcadd72623c78140b031e34e83e8504655af1a407bf1f', '7', '10.00'),
(87, '30', 1696977885, 5, 'd0c9b7b677845360b3cbcadd72623c78140b031e34e83e8504655af1a407bf1f', '7', '10.00'),
(88, '30', 1696977889, 5, 'd0c9b7b677845360b3cbcadd72623c78140b031e34e83e8504655af1a407bf1f', '7', '10.00');

-- --------------------------------------------------------

--
-- Структура таблицы `masteroffer`
--

CREATE TABLE `masteroffer` (
  `id` int UNSIGNED NOT NULL,
  `userid` int UNSIGNED NOT NULL,
  `offerid` int UNSIGNED NOT NULL,
  `masterurl` varchar(191) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_520_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Дамп данных таблицы `masteroffer`
--

INSERT INTO `masteroffer` (`id`, `userid`, `offerid`, `masterurl`) VALUES
(3, 32, 7, 'ceaaaf869c89dae8a00c483521307e3cd3593ab6e5e6d39be26ab6c7cbb0a67e'),
(7, 33, 5, '3fa1eca4649f367224ef2c97df43fcef8b32b49fea7df4a76915ccb71a6998e8'),
(8, 30, 14, '21906eb0a546c857dd4a3606aa5e79d19143b403845d138900c00390a3d094ec'),
(9, 30, 1, '794d27ab6d52b8869ac1b8f93b91a24592d245cdcef0d0d14f9599d6b35376f2'),
(11, 30, 20, 'd352c8c879c511497ca48ce283977276670d4b6c5890de59d3d859854cb8f37a'),
(13, 32, 20, '41cdfad40719ee33a3d53ce0b65d3fcd0af43a91117ec70d1f5e5184ad48717d'),
(14, 32, 14, '3eef6106a1aa58b54e3ecd4d2f49f8e85d12c88866c5ff56d30c4581b8bd8a47'),
(16, 32, 10, 'b22f54aa27d3b36b7e245b55b5c20bccea49db562a6600ca0dd939e4fb4605cd'),
(17, 30, 10, '476b5a4b387dfd3dbed3635605e2e052f8af2e3f469dff6d41f5051dfad0fedc'),
(18, 30, 7, 'd0c9b7b677845360b3cbcadd72623c78140b031e34e83e8504655af1a407bf1f'),
(19, 30, 5, '8e0016519f95a3364826c5827c1c7f8440462aa18e44ee2c4267ec89c2e5898a');

-- --------------------------------------------------------

--
-- Структура таблицы `users`
--

CREATE TABLE `users` (
  `id` int UNSIGNED NOT NULL,
  `login` varchar(191) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_520_ci NOT NULL,
  `password` varchar(191) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_520_ci NOT NULL,
  `balance` decimal(12,2) UNSIGNED NOT NULL DEFAULT '0.00',
  `active` tinyint(1) NOT NULL DEFAULT '0',
  `is_admin` tinyint(1) NOT NULL DEFAULT '0',
  `ip` varchar(191) COLLATE utf8mb4_unicode_520_ci DEFAULT NULL,
  `name` varchar(191) COLLATE utf8mb4_unicode_520_ci DEFAULT NULL,
  `datetime` int UNSIGNED DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_520_ci;

--
-- Дамп данных таблицы `users`
--

INSERT INTO `users` (`id`, `login`, `password`, `balance`, `active`, `is_admin`, `ip`, `name`, `datetime`) VALUES
(30, 'user_1', '$2y$10$nadMnXSFkuTwmP3U2oZEqObFQYTMF1shXA431mHDhGfx2VuVxDubG', '299.34', 1, 0, '127.0.0.1', 'первый', 1697334017),
(32, 'user_3', '$2y$10$z1z2ApemDO0A/CEtcPb24ecAJNdy36aveb.0smeCkN2TYXTyUegoK', '198.12', 1, 0, '127.0.0.1', 'Тролль', 1696972904),
(33, 'user_2', '$2y$10$QODMkldFi6sC/BzJwhlFYOG6pPn70N6LIBPwCzoyIDkPZkDf8b9Qe', '808.80', 0, 0, NULL, 'Третий', NULL),
(34, 'user_4', '$2y$10$btPImwR7YOMwpQAOsNeRyePYPMixbFeyhKMx4jOxq59t7oMYLpyS.', '2.00', 1, 0, '127.0.0.1', '___Акробат__', NULL),
(35, 'superAdmin', '$2y$10$PpYhY..AEGNS0ca1RI7aiuy0exVC5VV753NtZa7dvC7E/NcHj8LEW', '0.00', 1, 1, '127.0.0.1', 'Администратор', 1697322477),
(43, '1234', '$2y$10$6h/VkXY1.hO9UmMI8UVod.P5cm2bk2OI6vWqnvWH2bPz5FI.GFYyW', '0.00', 0, 0, '127.0.0.1', '1234', 1697396724);

--
-- Индексы сохранённых таблиц
--

--
-- Индексы таблицы `adoffer`
--
ALTER TABLE `adoffer`
  ADD PRIMARY KEY (`id`),
  ADD KEY `userid` (`userid`);

--
-- Индексы таблицы `click`
--
ALTER TABLE `click`
  ADD PRIMARY KEY (`id`),
  ADD KEY `masteruserid` (`masteruserid`),
  ADD KEY `url` (`url`);

--
-- Индексы таблицы `masteroffer`
--
ALTER TABLE `masteroffer`
  ADD PRIMARY KEY (`id`),
  ADD KEY `masteroffer_userid` (`userid`),
  ADD KEY `masteroffer_offerid` (`offerid`),
  ADD KEY `masterurl` (`masterurl`);

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
-- AUTO_INCREMENT для таблицы `adoffer`
--
ALTER TABLE `adoffer`
  MODIFY `id` int UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=36;

--
-- AUTO_INCREMENT для таблицы `click`
--
ALTER TABLE `click`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=89;

--
-- AUTO_INCREMENT для таблицы `masteroffer`
--
ALTER TABLE `masteroffer`
  MODIFY `id` int UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=20;

--
-- AUTO_INCREMENT для таблицы `users`
--
ALTER TABLE `users`
  MODIFY `id` int UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=44;

--
-- Ограничения внешнего ключа сохраненных таблиц
--

--
-- Ограничения внешнего ключа таблицы `adoffer`
--
ALTER TABLE `adoffer`
  ADD CONSTRAINT `adoffer_ibfk_1` FOREIGN KEY (`userid`) REFERENCES `users` (`id`) ON DELETE CASCADE ON UPDATE RESTRICT;

--
-- Ограничения внешнего ключа таблицы `masteroffer`
--
ALTER TABLE `masteroffer`
  ADD CONSTRAINT `masteroffer_offerid` FOREIGN KEY (`offerid`) REFERENCES `adoffer` (`id`) ON DELETE CASCADE ON UPDATE RESTRICT,
  ADD CONSTRAINT `masteroffer_userid` FOREIGN KEY (`userid`) REFERENCES `users` (`id`) ON DELETE CASCADE ON UPDATE RESTRICT;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
