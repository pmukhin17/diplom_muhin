-- phpMyAdmin SQL Dump
-- version 5.0.1
-- https://www.phpmyadmin.net/
--
-- Хост: 127.0.0.1
-- Время создания: Мар 06 2020 г., 09:03
-- Версия сервера: 10.4.11-MariaDB
-- Версия PHP: 7.3.14

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- База данных: `surdo`
--

--
-- Дамп данных таблицы `permissions`
--

INSERT INTO `permissions` (`id`, `key`, `table_name`, `created_at`, `updated_at`) VALUES
(1, 'browse_jest_obraz_parameters', 'Параметры поиска жестов', NULL, NULL),
(2, 'browse_jest_paradigm_parameters', 'Параметры поиска жестов', NULL, NULL),
(3, 'browse_jest_vid_parameters', 'Параметры поиска жестов', NULL, NULL),
(4, 'browse_hand_double_parameters', 'Параметры поиска жестов', NULL, NULL),
(5, 'browse_jest_theme_parameters', 'Параметры поиска жестов', NULL, NULL),
(6, 'browse_conf_begin_parameters', 'Параметры поиска жестов', NULL, NULL),
(7, 'browse_conf_end_parameters', 'Параметры поиска жестов', NULL, NULL),
(8, 'browse_off_conf_begin_parameters', 'Параметры поиска жестов', NULL, NULL),
(9, 'browse_off_conf_end_parameters', 'Параметры поиска жестов', NULL, NULL),
(10, 'browse_deviant', 'Параметры поиска жестов', NULL, NULL),
(11, 'browse_admin', NULL, '2019-12-16 11:42:15', '2019-12-16 11:42:15'),
(12, 'browse_bread', NULL, '2019-12-16 11:42:15', '2019-12-16 11:42:15'),
(13, 'browse_database', NULL, '2019-12-16 11:42:15', '2019-12-16 11:42:15'),
(14, 'browse_media', NULL, '2019-12-16 11:42:15', '2019-12-16 11:42:15'),
(15, 'browse_compass', NULL, '2019-12-16 11:42:15', '2019-12-16 11:42:15'),
(16, 'browse_menus', 'menus', '2019-12-16 11:42:15', '2019-12-16 11:42:15'),
(17, 'read_menus', 'menus', '2019-12-16 11:42:15', '2019-12-16 11:42:15'),
(18, 'edit_menus', 'menus', '2019-12-16 11:42:15', '2019-12-16 11:42:15'),
(19, 'add_menus', 'menus', '2019-12-16 11:42:16', '2019-12-16 11:42:16'),
(20, 'delete_menus', 'menus', '2019-12-16 11:42:16', '2019-12-16 11:42:16'),
(21, 'browse_roles', 'roles', '2019-12-16 11:42:16', '2019-12-16 11:42:16'),
(22, 'read_roles', 'roles', '2019-12-16 11:42:16', '2019-12-16 11:42:16'),
(23, 'edit_roles', 'roles', '2019-12-16 11:42:16', '2019-12-16 11:42:16'),
(24, 'add_roles', 'roles', '2019-12-16 11:42:16', '2019-12-16 11:42:16'),
(25, 'delete_roles', 'roles', '2019-12-16 11:42:16', '2019-12-16 11:42:16'),
(26, 'browse_users', 'users', '2019-12-16 11:42:16', '2019-12-16 11:42:16'),
(27, 'read_users', 'users', '2019-12-16 11:42:16', '2019-12-16 11:42:16'),
(28, 'edit_users', 'users', '2019-12-16 11:42:16', '2019-12-16 11:42:16'),
(29, 'add_users', 'users', '2019-12-16 11:42:16', '2019-12-16 11:42:16'),
(30, 'delete_users', 'users', '2019-12-16 11:42:16', '2019-12-16 11:42:16'),
(31, 'browse_settings', 'settings', '2019-12-16 11:42:16', '2019-12-16 11:42:16'),
(32, 'read_settings', 'settings', '2019-12-16 11:42:16', '2019-12-16 11:42:16'),
(33, 'edit_settings', 'settings', '2019-12-16 11:42:16', '2019-12-16 11:42:16'),
(34, 'add_settings', 'settings', '2019-12-16 11:42:16', '2019-12-16 11:42:16'),
(35, 'delete_settings', 'settings', '2019-12-16 11:42:16', '2019-12-16 11:42:16'),
(36, 'browse_hooks', NULL, '2019-12-16 11:42:18', '2019-12-16 11:42:18'),
(37, 'browse_edit_jest', 'Редактирование жеста', NULL, NULL),
(38, 'browse_admin_checked_parameters', 'Параметры поиска жестов', NULL, NULL),
(39, 'browse_nedooformleno_parameters', 'Параметры поиска жестов', NULL, NULL),
(40, 'edit_name_jest_parameters', 'Редактирование жеста', NULL, NULL),
(41, 'edit_dialect_parameters', 'Редактирование жеста', NULL, NULL),
(42, 'edit_translate_parameters', 'Редактирование жеста', NULL, NULL),
(43, 'edit_words_parameters', 'Редактирование жеста', NULL, NULL),
(44, 'edit_sostav_parameters', 'Редактирование жеста', NULL, NULL),
(45, 'edit_analogs_parameters', 'Редактирование жеста', NULL, NULL),
(46, 'edit_theme_parameters', 'Редактирование жеста', NULL, NULL),
(47, 'edit_paradigma_parameters', 'Редактирование жеста', NULL, NULL),
(48, 'edit_base_obraz_parameters', 'Редактирование жеста', NULL, NULL),
(49, 'edit_vid_parameters', 'Редактирование жеста', NULL, NULL),
(50, 'edit_napravlenie_parameters', 'Редактирование жеста', NULL, NULL),
(51, 'edit_actual_parameters', 'Редактирование жеста', NULL, NULL),
(52, 'edit_hand_double_parameters', 'Редактирование жеста', NULL, NULL),
(53, 'edit_base_obraz_start_parameters', 'Редактирование жеста', NULL, NULL),
(54, 'edit_base_obraz_end_parameters', 'Редактирование жеста', NULL, NULL),
(55, 'edit_hand_base_obraz_start_parameters', 'Редактирование жеста', NULL, NULL),
(56, 'edit_hand_base_obraz_end_parameters', 'Редактирование жеста', NULL, NULL),
(57, 'edit_admin_checked_parameters', 'Редактирование жеста', NULL, NULL),
(58, 'edit_nedooformleno_parameters', 'Редактирование жеста', NULL, NULL),
(60, 'browse_statistic', 'Статистика жестов', '2020-02-22 20:29:49', '2020-02-22 20:29:49'),
(61, 'create_jest', 'Добавление жеста', '2020-02-23 13:08:52', '2020-02-23 13:08:52'),
(62, 'edit_bibliographies_parameters', 'Редактирование жеста', '2020-02-26 10:17:28', '2020-02-26 10:17:28');
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
