-- phpMyAdmin SQL Dump
-- version 5.0.2
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Oct 22, 2020 at 05:22 AM
-- Server version: 10.4.13-MariaDB
-- PHP Version: 7.2.31

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `chicco-test`
--

-- --------------------------------------------------------

--
-- Table structure for table `categories`
--

CREATE TABLE `categories` (
  `id` int(10) UNSIGNED NOT NULL,
  `parent_id` int(10) UNSIGNED DEFAULT NULL,
  `order` int(11) NOT NULL DEFAULT 1,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `slug` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `data_rows`
--

CREATE TABLE `data_rows` (
  `id` int(10) UNSIGNED NOT NULL,
  `data_type_id` int(10) UNSIGNED NOT NULL,
  `field` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `type` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `display_name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `required` tinyint(1) NOT NULL DEFAULT 0,
  `browse` tinyint(1) NOT NULL DEFAULT 1,
  `read` tinyint(1) NOT NULL DEFAULT 1,
  `edit` tinyint(1) NOT NULL DEFAULT 1,
  `add` tinyint(1) NOT NULL DEFAULT 1,
  `delete` tinyint(1) NOT NULL DEFAULT 1,
  `details` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `order` int(11) NOT NULL DEFAULT 1
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `data_rows`
--

INSERT INTO `data_rows` (`id`, `data_type_id`, `field`, `type`, `display_name`, `required`, `browse`, `read`, `edit`, `add`, `delete`, `details`, `order`) VALUES
(1, 1, 'id', 'number', 'ID', 1, 0, 0, 0, 0, 0, '{}', 1),
(2, 1, 'name', 'text', 'Name', 1, 1, 1, 1, 1, 1, '{\"validation\":{\"rule\":\"required|max:255\"}}', 3),
(3, 1, 'email', 'text', 'Email', 1, 1, 1, 1, 1, 1, '{\"validation\":{\"rule\":\"required|email\"}}', 4),
(4, 1, 'password', 'password', 'Password', 1, 0, 0, 1, 1, 0, '{}', 5),
(5, 1, 'remember_token', 'text', 'Remember Token', 0, 0, 0, 0, 0, 0, '{}', 6),
(6, 1, 'created_at', 'timestamp', 'Created At', 0, 1, 1, 0, 0, 0, '{}', 7),
(7, 1, 'updated_at', 'timestamp', 'Updated At', 0, 0, 0, 0, 0, 0, '{}', 8),
(8, 1, 'avatar', 'image', 'Avatar', 0, 1, 1, 1, 1, 1, '{}', 9),
(9, 1, 'user_belongsto_role_relationship', 'relationship', 'Role', 0, 1, 1, 1, 1, 0, '{\"model\":\"TCG\\\\Voyager\\\\Models\\\\Role\",\"table\":\"roles\",\"type\":\"belongsTo\",\"column\":\"role_id\",\"key\":\"id\",\"label\":\"display_name\",\"pivot_table\":\"roles\",\"pivot\":\"0\",\"taggable\":\"0\"}', 11),
(10, 1, 'user_belongstomany_role_relationship', 'relationship', 'Roles', 0, 1, 1, 1, 1, 0, '{\"model\":\"TCG\\\\Voyager\\\\Models\\\\Role\",\"table\":\"roles\",\"type\":\"belongsToMany\",\"column\":\"id\",\"key\":\"id\",\"label\":\"display_name\",\"pivot_table\":\"user_roles\",\"pivot\":\"1\",\"taggable\":\"0\"}', 12),
(11, 1, 'settings', 'hidden', 'Settings', 0, 0, 0, 0, 0, 0, '{}', 13),
(12, 2, 'id', 'number', 'ID', 1, 0, 0, 0, 0, 0, NULL, 1),
(13, 2, 'name', 'text', 'Name', 1, 1, 1, 1, 1, 1, NULL, 2),
(14, 2, 'created_at', 'timestamp', 'Created At', 0, 0, 0, 0, 0, 0, NULL, 3),
(15, 2, 'updated_at', 'timestamp', 'Updated At', 0, 0, 0, 0, 0, 0, NULL, 4),
(16, 3, 'id', 'number', 'ID', 1, 0, 0, 0, 0, 0, NULL, 1),
(17, 3, 'name', 'text', 'Name', 1, 1, 1, 1, 1, 1, NULL, 2),
(18, 3, 'created_at', 'timestamp', 'Created At', 0, 0, 0, 0, 0, 0, NULL, 3),
(19, 3, 'updated_at', 'timestamp', 'Updated At', 0, 0, 0, 0, 0, 0, NULL, 4),
(20, 3, 'display_name', 'text', 'Display Name', 1, 1, 1, 1, 1, 1, NULL, 5),
(21, 1, 'role_id', 'text', 'Role', 0, 1, 1, 1, 1, 1, '{}', 10),
(22, 4, 'id', 'number', 'ID', 1, 0, 0, 0, 0, 0, NULL, 1),
(23, 4, 'parent_id', 'select_dropdown', 'Parent', 0, 0, 1, 1, 1, 1, '{\"default\":\"\",\"null\":\"\",\"options\":{\"\":\"-- None --\"},\"relationship\":{\"key\":\"id\",\"label\":\"name\"}}', 2),
(24, 4, 'order', 'text', 'Order', 1, 1, 1, 1, 1, 1, '{\"default\":1}', 3),
(25, 4, 'name', 'text', 'Name', 1, 1, 1, 1, 1, 1, NULL, 4),
(26, 4, 'slug', 'text', 'Slug', 1, 1, 1, 1, 1, 1, '{\"slugify\":{\"origin\":\"name\"}}', 5),
(27, 4, 'created_at', 'timestamp', 'Created At', 0, 0, 1, 0, 0, 0, NULL, 6),
(28, 4, 'updated_at', 'timestamp', 'Updated At', 0, 0, 0, 0, 0, 0, NULL, 7),
(29, 5, 'id', 'number', 'ID', 1, 0, 0, 0, 0, 0, NULL, 1),
(30, 5, 'author_id', 'text', 'Author', 1, 0, 1, 1, 0, 1, NULL, 2),
(31, 5, 'category_id', 'text', 'Category', 1, 0, 1, 1, 1, 0, NULL, 3),
(32, 5, 'title', 'text', 'Title', 1, 1, 1, 1, 1, 1, NULL, 4),
(33, 5, 'excerpt', 'text_area', 'Excerpt', 1, 0, 1, 1, 1, 1, NULL, 5),
(34, 5, 'body', 'rich_text_box', 'Body', 1, 0, 1, 1, 1, 1, NULL, 6),
(35, 5, 'image', 'image', 'Post Image', 0, 1, 1, 1, 1, 1, '{\"resize\":{\"width\":\"1000\",\"height\":\"null\"},\"quality\":\"70%\",\"upsize\":true,\"thumbnails\":[{\"name\":\"medium\",\"scale\":\"50%\"},{\"name\":\"small\",\"scale\":\"25%\"},{\"name\":\"cropped\",\"crop\":{\"width\":\"300\",\"height\":\"250\"}}]}', 7),
(36, 5, 'slug', 'text', 'Slug', 1, 0, 1, 1, 1, 1, '{\"slugify\":{\"origin\":\"title\",\"forceUpdate\":true},\"validation\":{\"rule\":\"unique:posts,slug\"}}', 8),
(37, 5, 'meta_description', 'text_area', 'Meta Description', 1, 0, 1, 1, 1, 1, NULL, 9),
(38, 5, 'meta_keywords', 'text_area', 'Meta Keywords', 1, 0, 1, 1, 1, 1, NULL, 10),
(39, 5, 'status', 'select_dropdown', 'Status', 1, 1, 1, 1, 1, 1, '{\"default\":\"DRAFT\",\"options\":{\"PUBLISHED\":\"published\",\"DRAFT\":\"draft\",\"PENDING\":\"pending\"}}', 11),
(40, 5, 'created_at', 'timestamp', 'Created At', 0, 1, 1, 0, 0, 0, NULL, 12),
(41, 5, 'updated_at', 'timestamp', 'Updated At', 0, 0, 0, 0, 0, 0, NULL, 13),
(42, 5, 'seo_title', 'text', 'SEO Title', 0, 1, 1, 1, 1, 1, NULL, 14),
(43, 5, 'featured', 'checkbox', 'Featured', 1, 1, 1, 1, 1, 1, NULL, 15),
(44, 6, 'id', 'number', 'ID', 1, 0, 0, 0, 0, 0, NULL, 1),
(45, 6, 'author_id', 'text', 'Author', 1, 0, 0, 0, 0, 0, NULL, 2),
(46, 6, 'title', 'text', 'Title', 1, 1, 1, 1, 1, 1, NULL, 3),
(47, 6, 'excerpt', 'text_area', 'Excerpt', 1, 0, 1, 1, 1, 1, NULL, 4),
(48, 6, 'body', 'rich_text_box', 'Body', 1, 0, 1, 1, 1, 1, NULL, 5),
(49, 6, 'slug', 'text', 'Slug', 1, 0, 1, 1, 1, 1, '{\"slugify\":{\"origin\":\"title\"},\"validation\":{\"rule\":\"unique:pages,slug\"}}', 6),
(50, 6, 'meta_description', 'text', 'Meta Description', 1, 0, 1, 1, 1, 1, NULL, 7),
(51, 6, 'meta_keywords', 'text', 'Meta Keywords', 1, 0, 1, 1, 1, 1, NULL, 8),
(52, 6, 'status', 'select_dropdown', 'Status', 1, 1, 1, 1, 1, 1, '{\"default\":\"INACTIVE\",\"options\":{\"INACTIVE\":\"INACTIVE\",\"ACTIVE\":\"ACTIVE\"}}', 9),
(53, 6, 'created_at', 'timestamp', 'Created At', 1, 1, 1, 0, 0, 0, NULL, 10),
(54, 6, 'updated_at', 'timestamp', 'Updated At', 1, 0, 0, 0, 0, 0, NULL, 11),
(55, 6, 'image', 'image', 'Page Image', 0, 1, 1, 1, 1, 1, NULL, 12),
(56, 8, 'id', 'text', 'Id', 1, 0, 0, 0, 0, 0, '{}', 1),
(57, 8, 'question_1', 'text', 'Question 1', 1, 1, 1, 1, 1, 1, '{}', 2),
(58, 8, 'question_2', 'text', 'Question 2', 1, 1, 1, 1, 1, 1, '{}', 3),
(59, 8, 'question_3', 'text', 'Question 3', 1, 1, 1, 1, 1, 1, '{}', 4),
(60, 8, 'question_4', 'text', 'Question 4', 1, 1, 1, 1, 1, 1, '{}', 5),
(61, 8, 'question_order', 'number', 'Question Order', 1, 1, 1, 1, 1, 1, '{}', 6),
(62, 8, 'description', 'text', 'Description', 0, 1, 1, 1, 1, 1, '{}', 7),
(63, 8, 'is_active', 'radio_btn', 'Is Active', 1, 1, 1, 1, 1, 1, '{\"default\":\"Y\",\"options\":{\"Y\":\"Yes\",\"N\":\"No\"}}', 8),
(64, 8, 'created_at', 'timestamp', 'Created At', 0, 1, 1, 1, 0, 1, '{}', 9),
(65, 8, 'updated_at', 'timestamp', 'Updated At', 0, 0, 0, 0, 0, 0, '{}', 10),
(66, 10, 'id', 'text', 'Id', 1, 0, 0, 0, 0, 0, '{}', 1),
(67, 10, 'kpi_grade', 'text', 'Grade', 1, 1, 1, 1, 1, 1, '{}', 2),
(68, 10, 'kpi_grade_from', 'number', 'Nilai dari', 1, 1, 1, 1, 1, 1, '{}', 3),
(69, 10, 'kpi_grade_until', 'number', 'Nilai sampai', 1, 1, 1, 1, 1, 1, '{}', 4),
(70, 10, 'description', 'text', 'Deskripsi', 0, 1, 1, 1, 1, 1, '{}', 5),
(71, 10, 'is_active', 'radio_btn', 'Aktif', 1, 1, 1, 1, 1, 1, '{\"default\":\"Y\",\"options\":{\"Y\":\"Yes\",\"N\":\"No\"}}', 6),
(72, 10, 'kpi_order', 'number', 'Order', 1, 1, 1, 1, 1, 1, '{\"default\":5}', 7),
(73, 10, 'created_at', 'timestamp', 'Dibuat tanggal', 0, 1, 1, 1, 0, 1, '{}', 8),
(74, 10, 'updated_at', 'timestamp', 'Diperbarui tanggal', 0, 0, 0, 0, 0, 0, '{}', 9),
(75, 1, 'nik', 'text', 'NIK', 0, 1, 1, 1, 1, 1, '{\"validation\":{\"rule\":\"required|max:40\"}}', 2),
(76, 12, 'id', 'text', 'Id', 1, 0, 0, 0, 0, 0, '{}', 1),
(77, 12, 'kpi_name', 'text_area', 'Sasaran Mutu / KPI', 1, 1, 1, 1, 1, 1, '{\"validation\":{\"rule\":\"required\"}}', 4),
(78, 12, 'division_id', 'text', 'Divisi', 0, 0, 0, 0, 0, 0, '{}', 5),
(79, 12, 'department_id', 'department_field', 'Departemen', 0, 1, 1, 1, 1, 1, '{}', 3),
(80, 12, 'section_id', 'text', 'Seksi', 0, 0, 0, 0, 0, 0, '{}', 6),
(81, 12, 'kpi_percentage', 'number', 'Bobot Persentase %', 1, 1, 1, 1, 1, 1, '{\"step\":\"0.01\"}', 7),
(82, 12, 'kpi_target', 'text', 'Target Bobot %', 1, 1, 1, 1, 1, 1, '{\"step\":\"0.01\"}', 8),
(83, 12, 'description', 'text', 'Deskripsi', 0, 1, 1, 1, 1, 1, '{}', 9),
(84, 12, 'is_active', 'radio_btn', 'Aktif', 1, 1, 1, 1, 1, 1, '{\"default\":\"Y\",\"options\":{\"Y\":\"Yes\",\"N\":\"No\"}}', 10),
(85, 12, 'kpi_order', 'hidden', 'Order', 0, 0, 0, 0, 0, 0, '{\"value\":5}', 11),
(86, 12, 'created_at', 'timestamp', 'Dibuat tanggal', 0, 1, 1, 1, 0, 1, '{}', 12),
(87, 12, 'updated_at', 'timestamp', 'Diperbarui tanggal', 0, 0, 0, 0, 0, 0, '{}', 13),
(89, 15, 'id', 'text', 'Id', 1, 0, 0, 0, 0, 0, '{}', 1),
(90, 15, 'level_id', 'level_field', 'Jabatan', 1, 1, 1, 1, 1, 1, '{}', 2),
(91, 15, 'quantitative_value', 'number', 'Quantitative Value', 1, 1, 1, 1, 1, 1, '{\"max\":100}', 3),
(92, 15, 'qualitative_value', 'number', 'Qualitative Value', 1, 1, 1, 1, 1, 1, '{\"max\":100}', 4),
(93, 15, 'description', 'text', 'Deskripsi', 0, 1, 1, 1, 1, 1, '{}', 5),
(94, 15, 'is_active', 'radio_btn', 'Aktif', 1, 1, 1, 1, 1, 1, '{\"default\":\"Y\",\"options\":{\"Y\":\"Iya\",\"N\":\"Engga\"}}', 6),
(95, 15, 'created_by', 'text', 'Created By', 1, 0, 0, 0, 0, 0, '{}', 7),
(96, 15, 'created_at', 'timestamp', 'Created At', 0, 1, 1, 1, 0, 1, '{}', 8),
(97, 15, 'updated_at', 'timestamp', 'Updated At', 0, 0, 0, 0, 0, 0, '{}', 9);

-- --------------------------------------------------------

--
-- Table structure for table `data_types`
--

CREATE TABLE `data_types` (
  `id` int(10) UNSIGNED NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `slug` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `display_name_singular` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `display_name_plural` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `icon` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `model_name` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `policy_name` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `controller` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `description` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `generate_permissions` tinyint(1) NOT NULL DEFAULT 0,
  `server_side` tinyint(4) NOT NULL DEFAULT 0,
  `details` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `data_types`
--

INSERT INTO `data_types` (`id`, `name`, `slug`, `display_name_singular`, `display_name_plural`, `icon`, `model_name`, `policy_name`, `controller`, `description`, `generate_permissions`, `server_side`, `details`, `created_at`, `updated_at`) VALUES
(1, 'users', 'users', 'User', 'Users', 'voyager-person', 'TCG\\Voyager\\Models\\User', 'TCG\\Voyager\\Policies\\UserPolicy', 'TCG\\Voyager\\Http\\Controllers\\VoyagerUserController', NULL, 1, 0, '{\"order_column\":null,\"order_display_column\":null,\"order_direction\":\"desc\",\"default_search_key\":null,\"scope\":null}', '2020-10-13 00:46:58', '2020-10-18 20:22:33'),
(2, 'menus', 'menus', 'Menu', 'Menus', 'voyager-list', 'TCG\\Voyager\\Models\\Menu', NULL, '', '', 1, 0, NULL, '2020-10-13 00:46:58', '2020-10-13 00:46:58'),
(3, 'roles', 'roles', 'Role', 'Roles', 'voyager-lock', 'TCG\\Voyager\\Models\\Role', NULL, '', '', 1, 0, NULL, '2020-10-13 00:46:58', '2020-10-13 00:46:58'),
(4, 'categories', 'categories', 'Category', 'Categories', 'voyager-categories', 'TCG\\Voyager\\Models\\Category', NULL, '', '', 1, 0, NULL, '2020-10-13 00:47:12', '2020-10-13 00:47:12'),
(5, 'posts', 'posts', 'Post', 'Posts', 'voyager-news', 'TCG\\Voyager\\Models\\Post', 'TCG\\Voyager\\Policies\\PostPolicy', '', '', 1, 0, NULL, '2020-10-13 00:47:13', '2020-10-13 00:47:13'),
(6, 'pages', 'pages', 'Page', 'Pages', 'voyager-file-text', 'TCG\\Voyager\\Models\\Page', NULL, '', '', 1, 0, NULL, '2020-10-13 00:47:15', '2020-10-13 00:47:15'),
(8, 'disc_questions', 'disc-questions', 'DISC Question', 'DISC Questions', NULL, 'App\\Models\\Disc\\DiscQuestion', NULL, NULL, NULL, 1, 1, '{\"order_column\":\"question_order\",\"order_display_column\":\"question_1\",\"order_direction\":\"desc\",\"default_search_key\":null,\"scope\":null}', '2020-10-13 02:01:29', '2020-10-18 20:24:49'),
(10, 'kpi_grades', 'kpi-grades', 'Grade', 'Grades', NULL, 'App\\Models\\Kpi\\KpiGrade', NULL, NULL, NULL, 1, 1, '{\"order_column\":\"kpi_order\",\"order_display_column\":\"kpi_grade\",\"order_direction\":\"asc\",\"default_search_key\":\"kpi_grade\",\"scope\":null}', '2020-10-18 19:07:05', '2020-10-19 20:54:03'),
(12, 'kpi_departments', 'kpi-departments', 'KPI Department', 'KPI Departments', NULL, 'App\\Models\\Kpi\\KpiDepartment', NULL, NULL, NULL, 1, 0, '{\"order_column\":\"kpi_order\",\"order_display_column\":\"kpi_name\",\"order_direction\":\"asc\",\"default_search_key\":null,\"scope\":\"currentUser\"}', '2020-10-18 21:42:37', '2020-10-21 07:49:52'),
(15, 'kpi_percentase_levels', 'kpi-percentase-levels', 'Master Grade Level', 'Master Grade Level', NULL, 'App\\Models\\Kpi\\KpiPercentaseLevel', NULL, NULL, NULL, 1, 0, '{\"order_column\":null,\"order_display_column\":null,\"order_direction\":\"asc\",\"default_search_key\":null,\"scope\":null}', '2020-10-21 09:15:10', '2020-10-21 09:19:18');

-- --------------------------------------------------------

--
-- Table structure for table `disc_questions`
--

CREATE TABLE `disc_questions` (
  `id` int(10) UNSIGNED NOT NULL,
  `question_1` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `question_2` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `question_3` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `question_4` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `question_order` int(11) NOT NULL,
  `description` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `is_active` char(1) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'Y',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `disc_questions`
--

INSERT INTO `disc_questions` (`id`, `question_1`, `question_2`, `question_3`, `question_4`, `question_order`, `description`, `is_active`, `created_at`, `updated_at`) VALUES
(2, 'Gampangan, mudah setuju', 'Percaya, mudah percaya pada orang lain', 'Petualangan, mengambil resiko', 'Toleran menghormati', 3, '', 'Y', '2020-10-13 02:11:00', '2020-10-15 21:20:12'),
(3, 'Lembut suara, pendiam', 'Optimistik, visioner', 'Pusat perhatian, suka gaul', 'Pendamai, membawa harmoni', 2, '', 'Y', '2020-10-15 21:16:00', '2020-10-15 21:20:12'),
(4, 'Menyemangati orang', 'Berusaha sempurna', 'Bagian dari kelompok', 'Ingin membuat tujuan', 1, '3', 'Y', '2020-10-15 21:16:40', '2020-10-15 21:20:12'),
(5, 'Menjadi frustasi', 'Menyimpan perasaan saya', 'Menceritakan sisi saya', 'Siap beroposisi', 4, '', 'Y', '2020-10-15 21:19:57', '2020-10-15 21:20:12');

-- --------------------------------------------------------

--
-- Table structure for table `kpi_departments`
--

CREATE TABLE `kpi_departments` (
  `id` int(10) UNSIGNED NOT NULL,
  `kpi_name` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `division_id` varchar(50) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `department_id` varchar(50) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `section_id` varchar(50) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `kpi_percentage` double(8,2) NOT NULL,
  `kpi_target` double(8,2) NOT NULL,
  `description` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `is_active` varchar(1) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'Y',
  `kpi_order` int(11) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `kpi_departments`
--

INSERT INTO `kpi_departments` (`id`, `kpi_name`, `division_id`, `department_id`, `section_id`, `kpi_percentage`, `kpi_target`, `description`, `is_active`, `kpi_order`, `created_at`, `updated_at`) VALUES
(1, 'Development Program sesuai dengan deadline yang telah disepakati', NULL, '303', NULL, 30.00, 100.00, '', 'Y', 1, '2020-10-18 23:17:41', '2020-10-19 00:04:10'),
(3, 'Menyelesaikan permintaan pekerjaan (minor) & perbaikan IT selama 1x24 jam semenjak permintaan di sistem FPP (kecuali pekerjaan ke vendor & kecuali tidak ada order spare part)', NULL, '303', NULL, 30.00, 100.00, '', 'Y', 2, '2020-10-19 00:02:46', '2020-10-19 00:04:10'),
(4, 'Melakukan perawatan IT hardware & software sesuai jadwal', NULL, '303', NULL, 15.00, 100.00, '', 'Y', 3, '2020-10-19 00:03:14', '2020-10-19 00:04:10'),
(5, 'Down time Network IT < 15 menit per kejadian', NULL, '303', NULL, 15.00, 100.00, '', 'Y', 4, '2020-10-19 00:03:43', '2020-10-19 00:04:10'),
(6, 'Melakukan backup data server dari server ke PC backup secara manual 1 bulan sekali sebelum tanggal 10 setiap bulannya', NULL, '303', NULL, 10.00, 100.00, '', 'Y', 5, '2020-10-19 00:03:59', '2020-10-19 00:04:10'),
(7, 'Serah terima barang kurang dari 1x24 jam setelah dokumen di terima', NULL, '402', NULL, 50.00, 100.00, '', 'Y', NULL, '2020-10-19 00:20:17', '2020-10-19 00:20:17'),
(8, 'Tidak ada selisih barang ATK pada saat stock opname		\n', NULL, '202', NULL, 30.00, 0.00, '', 'Y', NULL, '2020-10-21 09:46:53', '2020-10-21 09:46:53'),
(9, 'Mengusulkan dan membuat tindakan perbaikan (improvement) setiap bulan		\n', NULL, '202', NULL, 30.00, 0.00, '1 Improve/bln', 'Y', NULL, '2020-10-21 09:47:13', '2020-10-21 09:47:13'),
(10, 'Menindaklanjuti setiap permintaan pekerjaan GA dalam waktu 1x24 jam		\n', NULL, '202', NULL, 15.00, 100.00, '', 'Y', NULL, '2020-10-21 09:47:25', '2020-10-21 09:47:25'),
(11, 'Melakukan dan melaporkan general cleaning setiap 1 minggu sekali sesuai dengan jadwal yang telah ditentukan		\n', NULL, '202', NULL, 15.00, 100.00, '', 'Y', NULL, '2020-10-21 09:47:40', '2020-10-21 09:47:40'),
(12, 'Ketepatan waktu pengurusan perizinan umum		\n', NULL, '202', NULL, 10.00, 100.00, '', 'Y', NULL, '2020-10-21 09:47:52', '2020-10-21 09:47:52'),
(13, 'Evaluasi status karyawan (perpanjangan kontrak & promosi) dilakukan 20 HK sebelum kontrak berakhir atau dari pengajuan promosi sampai dengan diajukan kepada persetujuan jabatan tertinggi		\n', NULL, '203', NULL, 20.00, 100.00, '', 'Y', NULL, '2020-10-21 09:49:18', '2020-10-21 09:49:18'),
(14, 'Melakukan penilaian kompetensi karyawan 1 tahun sekali di bulan Desember		\n', NULL, '203', NULL, 20.00, 100.00, '1 tahun 1 kali', 'Y', NULL, '2020-10-21 09:49:41', '2020-10-21 09:49:41'),
(15, 'Melakukan evaluasi kinerja karyawan 1 tahun 2 kali yaitu di bulan Juli & Desember		\n', NULL, '203', NULL, 20.00, 100.00, '1 tahun 2 kali', 'Y', NULL, '2020-10-21 09:49:59', '2020-10-21 09:49:59'),
(16, 'Rekrutmen calon karyawan baru dapat dipenuhi semenjak permintaan disetujui sesuai dengan SK Direksi		\n', NULL, '203', NULL, 15.00, 100.00, 'Setiap Permintaan', 'Y', NULL, '2020-10-21 09:50:35', '2020-10-21 09:50:35'),
(17, 'Pemutakhiran data base karyawan setiap bulan		\n', NULL, '203', NULL, 15.00, 100.00, '', 'Y', NULL, '2020-10-21 09:50:47', '2020-10-21 09:50:47'),
(18, 'Induksi karyawan baru dilakukan sebelum karyawan gabung dengan perusahaan 		\n', NULL, '203', NULL, 10.00, 100.00, '', 'Y', NULL, '2020-10-21 09:51:00', '2020-10-21 09:51:00'),
(19, 'Tepat waktu dalam semua transaksi keuangan sesuai dengan jadwal yang telah ditentukan		\n', NULL, '302', NULL, 35.00, 100.00, '', 'Y', NULL, '2020-10-21 09:51:18', '2020-10-21 09:51:18'),
(20, 'Tidak ada kesalahan dalam semua pencatatan laporan keuangan (fisik & sistem sesuai)		\n', NULL, '302', NULL, 35.00, 100.00, '', 'Y', NULL, '2020-10-21 09:51:28', '2020-10-21 09:51:28'),
(21, 'Tepat dalam perhitungan, pembayaran dan pelaporan pajak sesuai dengan jadwal yang telah ditentukan		\n', NULL, '302', NULL, 20.00, 100.00, 'Setiap tgl 10 per bln', 'Y', NULL, '2020-10-21 09:51:00', '2020-10-21 09:52:15'),
(22, 'Tepat waktu dalam memberikan laporan keuangan		\n', NULL, '302', NULL, 10.00, 100.00, '', 'Y', NULL, '2020-10-21 09:51:59', '2020-10-21 09:51:59'),
(23, 'Pengendalian RM & PM ???......(Hrs tersedia)		\n', NULL, '403', NULL, 20.00, 100.00, '', 'Y', NULL, '2020-10-21 09:54:03', '2020-10-21 09:54:03'),
(24, 'Pencapaian hasil produksi sesuai dengan rencana jadwal produksi secara by volume untuk produk regular, maklon & jalur cepat		\n', NULL, '403', NULL, 20.00, 100.00, '', 'Y', NULL, '2020-10-21 09:54:15', '2020-10-21 09:54:15'),
(25, 'Buffer stock fast moving RM x ≥10% dan x ≤ 40% dari rata-rata penjualan per bulan		\n', NULL, '403', NULL, 20.00, 80.00, '', 'Y', NULL, '2020-10-21 09:54:26', '2020-10-21 09:54:26'),
(26, 'Stock WIP tidak boleh lebih dari 20 Ton atau 100 drum		\n', NULL, '403', NULL, 20.00, 100.00, '', 'Y', NULL, '2020-10-21 09:54:40', '2020-10-21 09:54:40'),
(27, 'Pemenuhan hasil cetak sticker sesuai dengan jadwal produksi		\n', NULL, '403', NULL, 10.00, 100.00, '', 'Y', NULL, '2020-10-21 09:54:52', '2020-10-21 09:54:52'),
(28, 'Tidak ada kesalahan cetak stiker		\n', NULL, '403', NULL, 10.00, 100.00, '', 'Y', NULL, '2020-10-21 09:55:02', '2020-10-21 09:55:02'),
(29, 'Pemenuhan sales order dari customer', NULL, '840', NULL, 30.00, 100.00, '', 'Y', NULL, '2020-10-21 09:57:29', '2020-10-21 09:57:29'),
(30, 'Pengembangan produk baru (E Commerce)', NULL, '840', NULL, 25.00, 100.00, '', 'Y', NULL, '2020-10-21 09:58:12', '2020-10-21 09:58:12'),
(31, 'Mendapatkan rating kepuasan pelanggan dengan nilai 4 dari skala 5 ', NULL, '840', NULL, 25.00, 100.00, '', 'Y', NULL, '2020-10-21 09:58:42', '2020-10-21 09:58:42'),
(32, 'Tindaklanjut penanganan komplain 2x24 jam ', NULL, '840', NULL, 20.00, 100.00, '', 'Y', NULL, '2020-10-21 09:59:14', '2020-10-21 09:59:14'),
(33, 'Penyelesaian project sesuai dengan time line', NULL, '601', NULL, 25.00, 100.00, '', 'Y', NULL, '2020-10-21 10:00:39', '2020-10-21 10:00:39'),
(34, 'Tidak ada penyimpangan dalam proses atau kemas dari kegiatan produksi		\n', NULL, '401', NULL, 30.00, 100.00, '', 'Y', NULL, '2020-10-21 10:00:50', '2020-10-21 10:00:50'),
(35, 'Tidak terjadi reject dari proses pengolahan produksi		\n', NULL, '401', NULL, 30.00, 100.00, '', 'Y', NULL, '2020-10-21 10:01:01', '2020-10-21 10:01:01'),
(36, 'Jumlah down time dalam 1 bulan maks 3 kali di mesin yang sama dari kerusakan yang sama', NULL, '601', NULL, 20.00, 100.00, '', 'Y', NULL, '2020-10-21 10:01:11', '2020-10-21 10:01:11'),
(37, 'Pengendalian reject dari proses kemas maks 2% dihitung berdasarkan total pemusnahan dibandingkan dengan output yang di proses atau dikemas per bulan		\n', NULL, '401', NULL, 30.00, 2.00, '', 'Y', NULL, '2020-10-21 10:01:25', '2020-10-21 10:01:25'),
(38, 'Akurasi data stock spare part tidak ada selisih', NULL, '601', NULL, 20.00, 100.00, '', 'Y', NULL, '2020-10-21 10:01:36', '2020-10-21 10:01:36'),
(39, 'Tidak ada temuan critical = 0 temuan, dan temuan mayor ≤ 5,  temuan saat audit eksternal SJH, CPOB & CPKB		\n', NULL, '401', NULL, 10.00, 100.00, '', 'Y', NULL, '2020-10-21 10:01:37', '2020-10-21 10:01:37'),
(40, 'Menindaklanjuti setiap permintaan perbaikan fasilitas produksi di sistem Permintaan Perbaikan dapat dipenuhi oleh dept Engineering maks. 1X24 jam', NULL, '601', NULL, 20.00, 100.00, '', 'Y', NULL, '2020-10-21 10:02:05', '2020-10-21 10:02:05'),
(41, 'Jumlah kesalahan dalam pengujian RM Produk ruahan & produk jadi\nJumlah kesalahan Kritis < 1, Mayor ≤ 5, Minor ≤ 10\"		\n', NULL, '801', NULL, 30.00, 100.00, '', 'Y', NULL, '2020-10-21 10:02:10', '2020-10-21 10:02:10'),
(42, 'Ketepatan waktu pengujian RM Sesuai dengan waktu yang telah ditentukan		\n', NULL, '801', NULL, 25.00, 100.00, '', 'Y', NULL, '2020-10-21 10:02:22', '2020-10-21 10:02:22'),
(43, 'Perilisan label hijau untuk produk FG reguler dilakukan di hari yang sama sebelum pukul 15:30		\n', NULL, '801', NULL, 20.00, 100.00, '', 'Y', NULL, '2020-10-21 10:02:33', '2020-10-21 10:02:33'),
(44, 'Rata-rata waktu yang dibutuhkan untuk pekerjaan pemeliharaan rutin (preventive) untuk AC dan mesin produksi adalah 2 jam', NULL, '601', NULL, 15.00, 100.00, '', 'Y', NULL, '2020-10-21 10:02:36', '2020-10-21 10:02:36'),
(45, 'Pembuatan FPP permintaan alat kalibrasi 3 bulan sebelum habis masa berlakunya		\n', NULL, '801', NULL, 15.00, 100.00, '', 'Y', NULL, '2020-10-21 10:02:42', '2020-10-21 10:02:42'),
(46, 'Tidak ada temual yang critical, temuan Major di QC  ≤ 5 temuan untuk audit eksternal CPOB/CPKB & BPOM		\n', NULL, '801', NULL, 10.00, 100.00, '', 'Y', NULL, '2020-10-21 10:02:53', '2020-10-21 10:02:53'),
(47, 'Ketepatan waktu pada saat awal pelaksanaan audit sesuai dengan jadwal yang telah ditentukan		\n', NULL, '820', NULL, 30.00, 100.00, '', 'Y', NULL, '2020-10-21 10:03:28', '2020-10-21 10:03:28'),
(48, 'Ketepatan waktu penyelesaian audit sesuai dengan jadwal yang telah ditentukan', NULL, '820', NULL, 30.00, 100.00, '', 'Y', NULL, '2020-10-21 10:04:06', '2020-10-21 10:04:06'),
(49, 'Ketepatan waktu release PO dari waktu yang telah ditentukan yaitu PO RM & PM, PO umum non tunai ≤ 3HK, PO umum tunai ≤ 5HK, PO Asset  ≤ 10HK		\n', NULL, '810', NULL, 30.00, 95.00, '', 'Y', NULL, '2020-10-21 10:04:16', '2020-10-21 10:04:16'),
(50, 'Substitusi supplier per tiga bulan sekali		\n', NULL, '810', NULL, 20.00, 100.00, '3 Supplier', 'Y', NULL, '2020-10-21 10:04:31', '2020-10-21 10:04:31'),
(51, 'Pelaporan hasil audit kepada manajemen dilaporkan melalui email', NULL, '820', NULL, 15.00, 100.00, '', 'Y', NULL, '2020-10-21 10:04:32', '2020-10-21 10:04:32'),
(52, 'Menindaklanjuiti setiap ketidaksesuaian yang ditemukan pada saat audit sampai dengan selesai', NULL, '820', NULL, 15.00, 100.00, '', 'Y', NULL, '2020-10-21 10:04:55', '2020-10-21 10:04:55'),
(53, 'Substitusi RM & PM masimg-masing 1 (satu)  item per bulan		\n', NULL, '810', NULL, 20.00, 100.00, '1 sub rm & 1 sub pm', 'Y', NULL, '2020-10-21 10:05:15', '2020-10-21 10:05:15'),
(54, 'Mempresentasikan kepada manajemen setiap audit dept. selesai maks. 2 minggu setelah pelaporan hasil audit', NULL, '820', NULL, 10.00, 100.00, '', 'Y', NULL, '2020-10-21 10:05:15', '2020-10-21 10:05:15'),
(55, 'Menurunkan harga pembelian RM, PM & Umum yang lebih rendah dari harga existing (5) lima item per bulan 		\n', NULL, '810', NULL, 15.00, 100.00, '5 item\\', 'Y', NULL, '2020-10-21 10:05:31', '2020-10-21 10:05:31'),
(56, 'Akurasi Stock RM, PM dan bahan pembantu lain', NULL, '402', NULL, 30.00, 100.00, '', 'Y', NULL, '2020-10-21 10:05:41', '2020-10-21 10:05:41'),
(57, 'Kesesuaian produk yang dibeli untuk pembelian barang umum harus sesuai spesifikasi		\n', NULL, '810', NULL, 15.00, 100.00, '', 'Y', NULL, '2020-10-21 10:05:45', '2020-10-21 10:05:45'),
(58, 'Ketepatan waktu pengeluaran barang', NULL, '402', NULL, 25.00, 100.00, '', 'Y', NULL, '2020-10-21 10:06:01', '2020-10-21 10:06:01'),
(59, 'Ketepatan waktu pengiriman', NULL, '402', NULL, 25.00, 100.00, '', 'Y', NULL, '2020-10-21 10:06:22', '2020-10-21 10:06:22'),
(60, 'Tidak ada temuan critical = 0 dan temuan mayor ≤ 5  saat audit ekstenal', NULL, '402', NULL, 20.00, 100.00, '', 'Y', NULL, '2020-10-21 10:06:43', '2020-10-21 10:06:43'),
(61, 'Jumlah/Presentase temuan audit eksternal yang belum ada temuannya pada audit eksternal', NULL, '701', NULL, 30.00, 100.00, '', 'Y', NULL, '2020-10-21 10:07:10', '2020-10-21 10:07:10'),
(62, 'Melakukan meeting koordinasi yang melibatkan manajemen setiap 1 bulan sekali', NULL, '701', NULL, 20.00, 100.00, '', 'Y', NULL, '2020-10-21 10:07:33', '2020-10-21 10:07:33'),
(63, 'Pelaksanaan kalibrasi internal sesuai jadwal', NULL, '701', NULL, 15.00, 100.00, '', 'Y', NULL, '2020-10-21 10:07:54', '2020-10-21 10:07:54'),
(64, 'Pelaksanaan audit internal sesuai program', NULL, '701', NULL, 15.00, 100.00, '', 'Y', NULL, '2020-10-21 10:08:15', '2020-10-21 10:08:15'),
(65, 'Reminder kalibrasi kepada masing-masing user sebelum ED melalui email', NULL, '701', NULL, 10.00, 100.00, '', 'Y', NULL, '2020-10-21 10:08:39', '2020-10-21 10:08:39'),
(66, 'Reminder pengendalian perubahan melalui email 1 bulan sekali', NULL, '701', NULL, 10.00, 100.00, '', 'Y', NULL, '2020-10-21 10:08:59', '2020-10-21 10:08:59');

-- --------------------------------------------------------

--
-- Table structure for table `kpi_grades`
--

CREATE TABLE `kpi_grades` (
  `id` int(10) UNSIGNED NOT NULL,
  `kpi_grade` varchar(15) COLLATE utf8mb4_unicode_ci NOT NULL,
  `kpi_grade_from` int(11) NOT NULL,
  `kpi_grade_until` int(11) NOT NULL,
  `description` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `is_active` char(1) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'Y',
  `kpi_order` int(11) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `kpi_grades`
--

INSERT INTO `kpi_grades` (`id`, `kpi_grade`, `kpi_grade_from`, `kpi_grade_until`, `description`, `is_active`, `kpi_order`, `created_at`, `updated_at`) VALUES
(1, 'A', 90, 100, '', 'Y', 1, '2020-10-18 19:14:41', '2020-10-18 19:14:41'),
(2, 'B', 80, 89, '', 'Y', 2, '2020-10-18 19:15:46', '2020-10-18 19:16:23'),
(3, 'C', 70, 79, '', 'Y', 3, '2020-10-18 19:15:59', '2020-10-18 19:16:23'),
(4, 'D', 60, 69, '', 'Y', 4, '2020-10-18 19:16:07', '2020-10-18 19:16:23'),
(5, 'E', 0, 59, '', 'Y', 5, '2020-10-18 19:16:17', '2020-10-18 19:16:17');

-- --------------------------------------------------------

--
-- Table structure for table `kpi_grade_levels`
--

CREATE TABLE `kpi_grade_levels` (
  `id` int(10) UNSIGNED NOT NULL,
  `kpi_grade` varchar(15) COLLATE utf8mb4_unicode_ci NOT NULL,
  `kpi_grade_from` int(11) NOT NULL,
  `kpi_grade_until` int(11) NOT NULL,
  `description` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `is_active` char(1) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'Y',
  `kpi_order` int(11) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `kpi_percentase_levels`
--

CREATE TABLE `kpi_percentase_levels` (
  `id` int(10) UNSIGNED NOT NULL,
  `level_id` varchar(15) COLLATE utf8mb4_unicode_ci NOT NULL,
  `quantitative_value` int(11) NOT NULL,
  `qualitative_value` int(11) NOT NULL,
  `description` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `is_active` char(1) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'Y',
  `created_by` int(11) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `kpi_percentase_levels`
--

INSERT INTO `kpi_percentase_levels` (`id`, `level_id`, `quantitative_value`, `qualitative_value`, `description`, `is_active`, `created_by`, `created_at`, `updated_at`) VALUES
(1, '03', 20, 80, '', 'Y', NULL, '2020-10-21 09:22:31', '2020-10-21 09:22:31'),
(2, '04', 30, 70, '', 'Y', NULL, '2020-10-21 09:25:59', '2020-10-21 09:25:59'),
(3, '05', 40, 60, '', 'Y', NULL, '2020-10-21 09:26:15', '2020-10-21 09:26:15'),
(4, '08', 60, 40, '', 'Y', NULL, '2020-10-21 09:26:29', '2020-10-21 09:26:29'),
(5, '06', 50, 50, '', 'Y', NULL, '2020-10-21 09:26:41', '2020-10-21 09:26:41');

-- --------------------------------------------------------

--
-- Table structure for table `kpi_trx_departments`
--

CREATE TABLE `kpi_trx_departments` (
  `id` int(10) UNSIGNED NOT NULL,
  `division_id` varchar(50) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `department_id` varchar(50) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `section_id` varchar(50) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `kpi_year_from` int(11) NOT NULL,
  `kpi_month_from` int(11) DEFAULT NULL,
  `kpi_year_until` int(11) NOT NULL,
  `kpi_month_until` int(11) DEFAULT NULL,
  `kpi_status` varchar(150) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `description` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `is_active` varchar(1) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'Y',
  `created_by` int(11) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `kpi_trx_departments`
--

INSERT INTO `kpi_trx_departments` (`id`, `division_id`, `department_id`, `section_id`, `kpi_year_from`, `kpi_month_from`, `kpi_year_until`, `kpi_month_until`, `kpi_status`, `description`, `is_active`, `created_by`, `created_at`, `updated_at`) VALUES
(1, NULL, '303', NULL, 2020, 6, 2020, 12, 'Draft', NULL, 'Y', 2, '2020-10-22 01:11:38', '2020-10-22 01:26:20'),
(2, NULL, '302', NULL, 2020, 6, 2020, 12, 'Draft', NULL, 'Y', 5, '2020-10-22 02:52:05', '2020-10-22 02:54:55');

-- --------------------------------------------------------

--
-- Table structure for table `kpi_trx_department_details`
--

CREATE TABLE `kpi_trx_department_details` (
  `id` int(11) NOT NULL,
  `id_detail` int(11) NOT NULL,
  `kpi_department_id` int(11) DEFAULT NULL,
  `kpi_year` int(11) NOT NULL,
  `kpi_month` int(11) DEFAULT NULL,
  `kpi_value` varchar(10) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `description` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `approve_at` datetime DEFAULT NULL,
  `approve_by` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `kpi_trx_department_details`
--

INSERT INTO `kpi_trx_department_details` (`id`, `id_detail`, `kpi_department_id`, `kpi_year`, `kpi_month`, `kpi_value`, `description`, `approve_at`, `approve_by`) VALUES
(1, 1, 1, 2020, 6, '4', NULL, NULL, NULL),
(1, 2, 1, 2020, 7, NULL, NULL, NULL, NULL),
(1, 3, 1, 2020, 8, NULL, NULL, NULL, NULL),
(1, 4, 1, 2020, 9, NULL, NULL, NULL, NULL),
(1, 5, 1, 2020, 10, NULL, NULL, NULL, NULL),
(1, 6, 1, 2020, 11, NULL, NULL, NULL, NULL),
(1, 7, 1, 2020, 12, NULL, NULL, NULL, NULL),
(1, 8, 3, 2020, 6, '4', NULL, NULL, NULL),
(1, 9, 3, 2020, 7, NULL, NULL, NULL, NULL),
(1, 10, 3, 2020, 8, NULL, NULL, NULL, NULL),
(1, 11, 3, 2020, 9, NULL, NULL, NULL, NULL),
(1, 12, 3, 2020, 10, NULL, NULL, NULL, NULL),
(1, 13, 3, 2020, 11, NULL, NULL, NULL, NULL),
(1, 14, 3, 2020, 12, NULL, NULL, NULL, NULL),
(1, 15, 4, 2020, 6, '4', NULL, NULL, NULL),
(1, 16, 4, 2020, 7, NULL, NULL, NULL, NULL),
(1, 17, 4, 2020, 8, NULL, NULL, NULL, NULL),
(1, 18, 4, 2020, 9, NULL, NULL, NULL, NULL),
(1, 19, 4, 2020, 10, NULL, NULL, NULL, NULL),
(1, 20, 4, 2020, 11, NULL, NULL, NULL, NULL),
(1, 21, 4, 2020, 12, NULL, NULL, NULL, NULL),
(1, 22, 5, 2020, 6, '4', NULL, NULL, NULL),
(1, 23, 5, 2020, 7, NULL, NULL, NULL, NULL),
(1, 24, 5, 2020, 8, NULL, NULL, NULL, NULL),
(1, 25, 5, 2020, 9, NULL, NULL, NULL, NULL),
(1, 26, 5, 2020, 10, NULL, NULL, NULL, NULL),
(1, 27, 5, 2020, 11, NULL, NULL, NULL, NULL),
(1, 28, 5, 2020, 12, NULL, NULL, NULL, NULL),
(1, 29, 6, 2020, 6, '5', NULL, NULL, NULL),
(1, 30, 6, 2020, 7, NULL, NULL, NULL, NULL),
(1, 31, 6, 2020, 8, NULL, NULL, NULL, NULL),
(1, 32, 6, 2020, 9, NULL, NULL, NULL, NULL),
(1, 33, 6, 2020, 10, NULL, NULL, NULL, NULL),
(1, 34, 6, 2020, 11, NULL, NULL, NULL, NULL),
(1, 35, 6, 2020, 12, NULL, NULL, NULL, NULL),
(2, 1, 19, 2020, 6, '4', NULL, NULL, NULL),
(2, 2, 19, 2020, 7, '4', NULL, NULL, NULL),
(2, 3, 19, 2020, 8, '4', NULL, NULL, NULL),
(2, 4, 19, 2020, 9, '4', NULL, NULL, NULL),
(2, 5, 19, 2020, 10, NULL, NULL, NULL, NULL),
(2, 6, 19, 2020, 11, NULL, NULL, NULL, NULL),
(2, 7, 19, 2020, 12, NULL, NULL, NULL, NULL),
(2, 8, 20, 2020, 6, '4', NULL, NULL, NULL),
(2, 9, 20, 2020, 7, '4', NULL, NULL, NULL),
(2, 10, 20, 2020, 8, '5', NULL, NULL, NULL),
(2, 11, 20, 2020, 9, '5', NULL, NULL, NULL),
(2, 12, 20, 2020, 10, NULL, NULL, NULL, NULL),
(2, 13, 20, 2020, 11, NULL, NULL, NULL, NULL),
(2, 14, 20, 2020, 12, NULL, NULL, NULL, NULL),
(2, 15, 21, 2020, 6, '5', NULL, NULL, NULL),
(2, 16, 21, 2020, 7, '5', NULL, NULL, NULL),
(2, 17, 21, 2020, 8, '5', NULL, NULL, NULL),
(2, 18, 21, 2020, 9, '5', NULL, NULL, NULL),
(2, 19, 21, 2020, 10, NULL, NULL, NULL, NULL),
(2, 20, 21, 2020, 11, NULL, NULL, NULL, NULL),
(2, 21, 21, 2020, 12, NULL, NULL, NULL, NULL),
(2, 22, 22, 2020, 6, '3', NULL, NULL, NULL),
(2, 23, 22, 2020, 7, '4', NULL, NULL, NULL),
(2, 24, 22, 2020, 8, '5', NULL, NULL, NULL),
(2, 25, 22, 2020, 9, '5', NULL, NULL, NULL),
(2, 26, 22, 2020, 10, NULL, NULL, NULL, NULL),
(2, 27, 22, 2020, 11, NULL, NULL, NULL, NULL),
(2, 28, 22, 2020, 12, NULL, NULL, NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `menus`
--

CREATE TABLE `menus` (
  `id` int(10) UNSIGNED NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `menus`
--

INSERT INTO `menus` (`id`, `name`, `created_at`, `updated_at`) VALUES
(1, 'admin', '2020-10-13 00:46:59', '2020-10-13 00:46:59');

-- --------------------------------------------------------

--
-- Table structure for table `menu_items`
--

CREATE TABLE `menu_items` (
  `id` int(10) UNSIGNED NOT NULL,
  `menu_id` int(10) UNSIGNED DEFAULT NULL,
  `title` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `url` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `target` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT '_self',
  `icon_class` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `color` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `parent_id` int(11) DEFAULT NULL,
  `order` int(11) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `route` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `parameters` text COLLATE utf8mb4_unicode_ci DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `menu_items`
--

INSERT INTO `menu_items` (`id`, `menu_id`, `title`, `url`, `target`, `icon_class`, `color`, `parent_id`, `order`, `created_at`, `updated_at`, `route`, `parameters`) VALUES
(1, 1, 'Beranda', '', '_self', 'voyager-boat', '#000000', NULL, 1, '2020-10-13 00:46:59', '2020-10-18 23:13:32', 'voyager.dashboard', 'null'),
(2, 1, 'Media', '', '_self', 'voyager-images', NULL, 5, 2, '2020-10-13 00:46:59', '2020-10-13 02:04:18', 'voyager.media.index', NULL),
(3, 1, 'Pengguna', '', '_self', 'voyager-person', '#000000', 10, 2, '2020-10-13 00:47:00', '2020-10-18 23:13:54', 'voyager.users.index', 'null'),
(4, 1, 'Hak Akses', '', '_self', 'voyager-lock', '#000000', 10, 3, '2020-10-13 00:47:00', '2020-10-18 23:14:03', 'voyager.roles.index', 'null'),
(5, 1, 'Tools', '', '_self', 'voyager-tools', '#000000', NULL, 5, '2020-10-13 00:47:00', '2020-10-18 19:09:35', NULL, ''),
(6, 1, 'Menu Builder', '', '_self', 'voyager-list', NULL, 5, 1, '2020-10-13 00:47:00', '2020-10-13 01:17:11', 'voyager.menus.index', NULL),
(7, 1, 'Database', '', '_self', 'voyager-data', '#000000', 5, 3, '2020-10-13 00:47:00', '2020-10-13 02:06:33', 'voyager.database.index', 'null'),
(8, 1, 'Compass', '', '_self', 'voyager-compass', NULL, 5, 4, '2020-10-13 00:47:00', '2020-10-13 02:04:18', 'voyager.compass.index', NULL),
(9, 1, 'BREAD', '', '_self', 'voyager-bread', NULL, 5, 5, '2020-10-13 00:47:00', '2020-10-13 02:04:18', 'voyager.bread.index', NULL),
(10, 1, 'Pengaturan', '', '_self', 'voyager-settings', '#000000', NULL, 4, '2020-10-13 00:47:00', '2020-10-18 23:13:43', NULL, ''),
(14, 1, 'Hooks', '', '_self', 'voyager-hook', NULL, 5, 6, '2020-10-13 00:47:21', '2020-10-13 02:04:18', 'voyager.hooks', NULL),
(15, 1, 'General', 'admin/settings', '_self', 'voyager-settings', '#000000', 10, 1, '2020-10-13 01:16:20', '2020-10-13 01:18:59', NULL, ''),
(16, 1, 'Pertanyaan', '', '_self', 'voyager-question', '#000000', 17, 1, '2020-10-13 02:01:29', '2020-10-18 23:14:57', 'voyager.disc-questions.index', 'null'),
(17, 1, 'D.I.S.C', '', '_self', 'voyager-file-code', '#000000', NULL, 3, '2020-10-13 02:03:11', '2020-10-18 19:11:08', NULL, ''),
(18, 1, 'Master Grades', '', '_self', NULL, '#000000', 19, 1, '2020-10-18 19:07:05', '2020-10-18 19:13:22', 'voyager.kpi-grades.index', 'null'),
(19, 1, 'KPI', '', '_self', 'voyager-trophy', '#000000', NULL, 2, '2020-10-18 19:08:39', '2020-10-18 19:10:23', NULL, ''),
(22, 1, 'Form KPI Departemen', 'admin/kpi/form-department', '_self', NULL, '#000000', 19, 4, '2020-10-19 02:07:36', '2020-10-21 09:11:29', NULL, ''),
(24, 1, 'Master Grade Level', '', '_self', NULL, NULL, 19, 2, '2020-10-21 09:15:10', '2020-10-21 09:18:36', 'voyager.kpi-percentase-levels.index', NULL),
(25, 1, 'Master KPI Departemen', 'admin/kpi-departments', '_self', NULL, '#000000', 19, 3, '2020-10-21 09:18:29', '2020-10-21 09:18:36', NULL, '');

-- --------------------------------------------------------

--
-- Table structure for table `migrations`
--

CREATE TABLE `migrations` (
  `id` int(10) UNSIGNED NOT NULL,
  `migration` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `batch` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `migrations`
--

INSERT INTO `migrations` (`id`, `migration`, `batch`) VALUES
(1, '2014_10_12_000000_create_users_table', 1),
(2, '2014_10_12_100000_create_password_resets_table', 1),
(3, '2016_01_01_000000_add_voyager_user_fields', 1),
(4, '2016_01_01_000000_create_data_types_table', 1),
(5, '2016_05_19_173453_create_menu_table', 1),
(6, '2016_10_21_190000_create_roles_table', 1),
(7, '2016_10_21_190000_create_settings_table', 1),
(8, '2016_11_30_135954_create_permission_table', 1),
(9, '2016_11_30_141208_create_permission_role_table', 1),
(10, '2016_12_26_201236_data_types__add__server_side', 1),
(11, '2017_01_13_000000_add_route_to_menu_items_table', 1),
(12, '2017_01_14_005015_create_translations_table', 1),
(13, '2017_01_15_000000_make_table_name_nullable_in_permissions_table', 1),
(14, '2017_03_06_000000_add_controller_to_data_types_table', 1),
(15, '2017_04_21_000000_add_order_to_data_rows_table', 1),
(16, '2017_07_05_210000_add_policyname_to_data_types_table', 1),
(17, '2017_08_05_000000_add_group_to_settings_table', 1),
(18, '2017_11_26_013050_add_user_role_relationship', 1),
(19, '2017_11_26_015000_create_user_roles_table', 1),
(20, '2018_03_11_000000_add_user_settings', 1),
(21, '2018_03_14_000000_add_details_to_data_types_table', 1),
(22, '2018_03_16_000000_make_settings_value_nullable', 1),
(23, '2016_01_01_000000_create_pages_table', 2),
(24, '2016_01_01_000000_create_posts_table', 2),
(25, '2016_02_15_204651_create_categories_table', 2),
(26, '2017_04_11_000000_alter_post_nullable_fields_table', 2),
(29, '2020_10_13_084813_disc_question', 3),
(30, '2020_10_16_095020_link_user_to_hris', 4),
(32, '2020_10_19_015420_kpi_grade', 5),
(33, '2020_10_19_024551_kpi_grade_level', 6),
(34, '2020_10_19_042807_kpi_department', 6),
(35, '2020_10_19_082610_kpi_trx_department', 7),
(36, '2020_10_19_090132_kpi_trx_department_detail', 8),
(39, '2020_10_21_153159_kpi_percentase_level', 9);

-- --------------------------------------------------------

--
-- Table structure for table `pages`
--

CREATE TABLE `pages` (
  `id` int(10) UNSIGNED NOT NULL,
  `author_id` int(11) NOT NULL,
  `title` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `excerpt` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `body` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `image` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `slug` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `meta_description` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `meta_keywords` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `status` enum('ACTIVE','INACTIVE') COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'INACTIVE',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `password_resets`
--

CREATE TABLE `password_resets` (
  `email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `token` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `permissions`
--

CREATE TABLE `permissions` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `key` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `table_name` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `permissions`
--

INSERT INTO `permissions` (`id`, `key`, `table_name`, `created_at`, `updated_at`) VALUES
(1, 'browse_admin', NULL, '2020-10-13 00:47:00', '2020-10-13 00:47:00'),
(2, 'browse_bread', NULL, '2020-10-13 00:47:00', '2020-10-13 00:47:00'),
(3, 'browse_database', NULL, '2020-10-13 00:47:01', '2020-10-13 00:47:01'),
(4, 'browse_media', NULL, '2020-10-13 00:47:01', '2020-10-13 00:47:01'),
(5, 'browse_compass', NULL, '2020-10-13 00:47:01', '2020-10-13 00:47:01'),
(6, 'browse_menus', 'menus', '2020-10-13 00:47:01', '2020-10-13 00:47:01'),
(7, 'read_menus', 'menus', '2020-10-13 00:47:01', '2020-10-13 00:47:01'),
(8, 'edit_menus', 'menus', '2020-10-13 00:47:01', '2020-10-13 00:47:01'),
(9, 'add_menus', 'menus', '2020-10-13 00:47:01', '2020-10-13 00:47:01'),
(10, 'delete_menus', 'menus', '2020-10-13 00:47:01', '2020-10-13 00:47:01'),
(11, 'browse_roles', 'roles', '2020-10-13 00:47:01', '2020-10-13 00:47:01'),
(12, 'read_roles', 'roles', '2020-10-13 00:47:01', '2020-10-13 00:47:01'),
(13, 'edit_roles', 'roles', '2020-10-13 00:47:01', '2020-10-13 00:47:01'),
(14, 'add_roles', 'roles', '2020-10-13 00:47:01', '2020-10-13 00:47:01'),
(15, 'delete_roles', 'roles', '2020-10-13 00:47:01', '2020-10-13 00:47:01'),
(16, 'browse_users', 'users', '2020-10-13 00:47:02', '2020-10-13 00:47:02'),
(17, 'read_users', 'users', '2020-10-13 00:47:02', '2020-10-13 00:47:02'),
(18, 'edit_users', 'users', '2020-10-13 00:47:02', '2020-10-13 00:47:02'),
(19, 'add_users', 'users', '2020-10-13 00:47:02', '2020-10-13 00:47:02'),
(20, 'delete_users', 'users', '2020-10-13 00:47:02', '2020-10-13 00:47:02'),
(21, 'browse_settings', 'settings', '2020-10-13 00:47:02', '2020-10-13 00:47:02'),
(22, 'read_settings', 'settings', '2020-10-13 00:47:02', '2020-10-13 00:47:02'),
(23, 'edit_settings', 'settings', '2020-10-13 00:47:02', '2020-10-13 00:47:02'),
(24, 'add_settings', 'settings', '2020-10-13 00:47:02', '2020-10-13 00:47:02'),
(25, 'delete_settings', 'settings', '2020-10-13 00:47:02', '2020-10-13 00:47:02'),
(26, 'browse_categories', 'categories', '2020-10-13 00:47:12', '2020-10-13 00:47:12'),
(27, 'read_categories', 'categories', '2020-10-13 00:47:12', '2020-10-13 00:47:12'),
(28, 'edit_categories', 'categories', '2020-10-13 00:47:12', '2020-10-13 00:47:12'),
(29, 'add_categories', 'categories', '2020-10-13 00:47:12', '2020-10-13 00:47:12'),
(30, 'delete_categories', 'categories', '2020-10-13 00:47:13', '2020-10-13 00:47:13'),
(31, 'browse_posts', 'posts', '2020-10-13 00:47:15', '2020-10-13 00:47:15'),
(32, 'read_posts', 'posts', '2020-10-13 00:47:15', '2020-10-13 00:47:15'),
(33, 'edit_posts', 'posts', '2020-10-13 00:47:15', '2020-10-13 00:47:15'),
(34, 'add_posts', 'posts', '2020-10-13 00:47:15', '2020-10-13 00:47:15'),
(35, 'delete_posts', 'posts', '2020-10-13 00:47:15', '2020-10-13 00:47:15'),
(36, 'browse_pages', 'pages', '2020-10-13 00:47:16', '2020-10-13 00:47:16'),
(37, 'read_pages', 'pages', '2020-10-13 00:47:16', '2020-10-13 00:47:16'),
(38, 'edit_pages', 'pages', '2020-10-13 00:47:16', '2020-10-13 00:47:16'),
(39, 'add_pages', 'pages', '2020-10-13 00:47:16', '2020-10-13 00:47:16'),
(40, 'delete_pages', 'pages', '2020-10-13 00:47:17', '2020-10-13 00:47:17'),
(41, 'browse_hooks', NULL, '2020-10-13 00:47:21', '2020-10-13 00:47:21'),
(42, 'browse_disc_questions', 'disc_questions', '2020-10-13 02:01:29', '2020-10-13 02:01:29'),
(43, 'read_disc_questions', 'disc_questions', '2020-10-13 02:01:29', '2020-10-13 02:01:29'),
(44, 'edit_disc_questions', 'disc_questions', '2020-10-13 02:01:29', '2020-10-13 02:01:29'),
(45, 'add_disc_questions', 'disc_questions', '2020-10-13 02:01:29', '2020-10-13 02:01:29'),
(46, 'delete_disc_questions', 'disc_questions', '2020-10-13 02:01:29', '2020-10-13 02:01:29'),
(47, 'browse_kpi_grades', 'kpi_grades', '2020-10-18 19:07:05', '2020-10-18 19:07:05'),
(48, 'read_kpi_grades', 'kpi_grades', '2020-10-18 19:07:05', '2020-10-18 19:07:05'),
(49, 'edit_kpi_grades', 'kpi_grades', '2020-10-18 19:07:05', '2020-10-18 19:07:05'),
(50, 'add_kpi_grades', 'kpi_grades', '2020-10-18 19:07:05', '2020-10-18 19:07:05'),
(51, 'delete_kpi_grades', 'kpi_grades', '2020-10-18 19:07:05', '2020-10-18 19:07:05'),
(52, 'browse_kpi_departments', 'kpi_departments', '2020-10-18 21:42:37', '2020-10-18 21:42:37'),
(53, 'read_kpi_departments', 'kpi_departments', '2020-10-18 21:42:37', '2020-10-18 21:42:37'),
(54, 'edit_kpi_departments', 'kpi_departments', '2020-10-18 21:42:37', '2020-10-18 21:42:37'),
(55, 'add_kpi_departments', 'kpi_departments', '2020-10-18 21:42:37', '2020-10-18 21:42:37'),
(56, 'delete_kpi_departments', 'kpi_departments', '2020-10-18 21:42:37', '2020-10-18 21:42:37'),
(57, 'browse_all_kpi_departments', 'kpi_departments', '2020-10-19 06:48:04', '2020-10-19 06:48:11'),
(58, 'browse', 'kpi_trx_departments', '2020-10-19 09:32:22', '2020-10-19 09:32:22'),
(59, 'browse_all', 'kpi_trx_departments', '2020-10-19 09:32:22', '2020-10-19 09:32:22'),
(60, 'create_kpi_trx_departments', 'kpi_trx_departments', '2020-10-19 09:43:26', '2020-10-19 09:43:26'),
(66, 'browse_kpi_percentase_levels', 'kpi_percentase_levels', '2020-10-21 09:15:10', '2020-10-21 09:15:10'),
(67, 'read_kpi_percentase_levels', 'kpi_percentase_levels', '2020-10-21 09:15:10', '2020-10-21 09:15:10'),
(68, 'edit_kpi_percentase_levels', 'kpi_percentase_levels', '2020-10-21 09:15:10', '2020-10-21 09:15:10'),
(69, 'add_kpi_percentase_levels', 'kpi_percentase_levels', '2020-10-21 09:15:10', '2020-10-21 09:15:10'),
(70, 'delete_kpi_percentase_levels', 'kpi_percentase_levels', '2020-10-21 09:15:10', '2020-10-21 09:15:10');

-- --------------------------------------------------------

--
-- Table structure for table `permission_role`
--

CREATE TABLE `permission_role` (
  `permission_id` bigint(20) UNSIGNED NOT NULL,
  `role_id` bigint(20) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `permission_role`
--

INSERT INTO `permission_role` (`permission_id`, `role_id`) VALUES
(1, 1),
(1, 2),
(1, 3),
(2, 1),
(3, 1),
(4, 1),
(5, 1),
(6, 1),
(7, 1),
(8, 1),
(9, 1),
(10, 1),
(11, 1),
(12, 1),
(13, 1),
(14, 1),
(15, 1),
(16, 1),
(17, 1),
(18, 1),
(19, 1),
(20, 1),
(21, 1),
(22, 1),
(23, 1),
(24, 1),
(25, 1),
(26, 1),
(27, 1),
(28, 1),
(29, 1),
(30, 1),
(31, 1),
(32, 1),
(33, 1),
(34, 1),
(35, 1),
(36, 1),
(37, 1),
(38, 1),
(39, 1),
(40, 1),
(42, 1),
(43, 1),
(44, 1),
(45, 1),
(46, 1),
(47, 1),
(47, 2),
(48, 1),
(48, 2),
(49, 1),
(49, 2),
(50, 1),
(50, 2),
(51, 1),
(51, 2),
(52, 1),
(52, 2),
(52, 3),
(53, 1),
(53, 2),
(53, 3),
(54, 1),
(54, 2),
(54, 3),
(55, 1),
(55, 2),
(55, 3),
(56, 1),
(56, 2),
(56, 3),
(57, 1),
(57, 2),
(58, 1),
(58, 3),
(59, 1),
(59, 3),
(60, 1),
(60, 3),
(66, 1),
(67, 1),
(68, 1),
(69, 1),
(70, 1);

-- --------------------------------------------------------

--
-- Table structure for table `posts`
--

CREATE TABLE `posts` (
  `id` int(10) UNSIGNED NOT NULL,
  `author_id` int(11) NOT NULL,
  `category_id` int(11) DEFAULT NULL,
  `title` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `seo_title` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `excerpt` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `body` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `image` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `slug` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `meta_description` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `meta_keywords` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `status` enum('PUBLISHED','DRAFT','PENDING') COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'DRAFT',
  `featured` tinyint(1) NOT NULL DEFAULT 0,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `roles`
--

CREATE TABLE `roles` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `display_name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `roles`
--

INSERT INTO `roles` (`id`, `name`, `display_name`, `created_at`, `updated_at`) VALUES
(1, 'admin', 'Administrator', '2020-10-13 00:47:00', '2020-10-13 00:47:00'),
(2, 'HR Manager & Sisdur Manager', 'HR Manager & Sisdur Manager', '2020-10-13 00:47:00', '2020-10-19 00:25:54'),
(3, 'Manager', 'Manager / DEPT Head', '2020-10-19 00:21:38', '2020-10-19 00:21:38');

-- --------------------------------------------------------

--
-- Table structure for table `settings`
--

CREATE TABLE `settings` (
  `id` int(10) UNSIGNED NOT NULL,
  `key` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `display_name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `value` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `details` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `type` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `order` int(11) NOT NULL DEFAULT 1,
  `group` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `settings`
--

INSERT INTO `settings` (`id`, `key`, `display_name`, `value`, `details`, `type`, `order`, `group`) VALUES
(1, 'site.title', 'Site Title', 'Chicco Test', '', 'text', 1, 'Site'),
(2, 'site.description', 'Site Description', 'Psychotest Online', '', 'text', 2, 'Site'),
(3, 'site.logo', 'Site Logo', '', '', 'image', 3, 'Site'),
(4, 'site.google_analytics_tracking_id', 'Google Analytics Tracking ID', NULL, '', 'text', 4, 'Site'),
(5, 'admin.bg_image', 'Admin Background Image', '', '', 'image', 5, 'Admin'),
(6, 'admin.title', 'Admin Title', 'Chicco Test', '', 'text', 1, 'Admin'),
(7, 'admin.description', 'Admin Description', 'Welcome to Chicco Test. The application for Pyschotest Online', '', 'text', 2, 'Admin'),
(8, 'admin.loader', 'Admin Loader', '', '', 'image', 3, 'Admin'),
(9, 'admin.icon_image', 'Admin Icon Image', '', '', 'image', 4, 'Admin'),
(10, 'admin.google_analytics_client_id', 'Google Analytics Client ID (used for admin dashboard)', NULL, '', 'text', 1, 'Admin');

-- --------------------------------------------------------

--
-- Table structure for table `translations`
--

CREATE TABLE `translations` (
  `id` int(10) UNSIGNED NOT NULL,
  `table_name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `column_name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `foreign_key` int(10) UNSIGNED NOT NULL,
  `locale` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `value` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `translations`
--

INSERT INTO `translations` (`id`, `table_name`, `column_name`, `foreign_key`, `locale`, `value`, `created_at`, `updated_at`) VALUES
(1, 'data_types', 'display_name_singular', 5, 'pt', 'Post', '2020-10-13 00:47:17', '2020-10-13 00:47:17'),
(2, 'data_types', 'display_name_singular', 6, 'pt', 'Página', '2020-10-13 00:47:17', '2020-10-13 00:47:17'),
(3, 'data_types', 'display_name_singular', 1, 'pt', 'Utilizador', '2020-10-13 00:47:17', '2020-10-13 00:47:17'),
(4, 'data_types', 'display_name_singular', 4, 'pt', 'Categoria', '2020-10-13 00:47:17', '2020-10-13 00:47:17'),
(5, 'data_types', 'display_name_singular', 2, 'pt', 'Menu', '2020-10-13 00:47:17', '2020-10-13 00:47:17'),
(6, 'data_types', 'display_name_singular', 3, 'pt', 'Função', '2020-10-13 00:47:17', '2020-10-13 00:47:17'),
(7, 'data_types', 'display_name_plural', 5, 'pt', 'Posts', '2020-10-13 00:47:17', '2020-10-13 00:47:17'),
(8, 'data_types', 'display_name_plural', 6, 'pt', 'Páginas', '2020-10-13 00:47:17', '2020-10-13 00:47:17'),
(9, 'data_types', 'display_name_plural', 1, 'pt', 'Utilizadores', '2020-10-13 00:47:18', '2020-10-13 00:47:18'),
(10, 'data_types', 'display_name_plural', 4, 'pt', 'Categorias', '2020-10-13 00:47:18', '2020-10-13 00:47:18'),
(11, 'data_types', 'display_name_plural', 2, 'pt', 'Menus', '2020-10-13 00:47:18', '2020-10-13 00:47:18'),
(12, 'data_types', 'display_name_plural', 3, 'pt', 'Funções', '2020-10-13 00:47:18', '2020-10-13 00:47:18'),
(13, 'categories', 'slug', 1, 'pt', 'categoria-1', '2020-10-13 00:47:18', '2020-10-13 00:47:18'),
(14, 'categories', 'name', 1, 'pt', 'Categoria 1', '2020-10-13 00:47:18', '2020-10-13 00:47:18'),
(15, 'categories', 'slug', 2, 'pt', 'categoria-2', '2020-10-13 00:47:18', '2020-10-13 00:47:18'),
(16, 'categories', 'name', 2, 'pt', 'Categoria 2', '2020-10-13 00:47:18', '2020-10-13 00:47:18'),
(17, 'pages', 'title', 1, 'pt', 'Olá Mundo', '2020-10-13 00:47:18', '2020-10-13 00:47:18'),
(18, 'pages', 'slug', 1, 'pt', 'ola-mundo', '2020-10-13 00:47:18', '2020-10-13 00:47:18'),
(19, 'pages', 'body', 1, 'pt', '<p>Olá Mundo. Scallywag grog swab Cat o\'nine tails scuttle rigging hardtack cable nipper Yellow Jack. Handsomely spirits knave lad killick landlubber or just lubber deadlights chantey pinnace crack Jennys tea cup. Provost long clothes black spot Yellow Jack bilged on her anchor league lateen sail case shot lee tackle.</p>\r\n<p>Ballast spirits fluke topmast me quarterdeck schooner landlubber or just lubber gabion belaying pin. Pinnace stern galleon starboard warp carouser to go on account dance the hempen jig jolly boat measured fer yer chains. Man-of-war fire in the hole nipperkin handsomely doubloon barkadeer Brethren of the Coast gibbet driver squiffy.</p>', '2020-10-13 00:47:18', '2020-10-13 00:47:18'),
(20, 'menu_items', 'title', 1, 'pt', 'Painel de Controle', '2020-10-13 00:47:18', '2020-10-13 00:47:18'),
(21, 'menu_items', 'title', 2, 'pt', 'Media', '2020-10-13 00:47:18', '2020-10-13 00:47:18'),
(22, 'menu_items', 'title', 12, 'pt', 'Publicações', '2020-10-13 00:47:19', '2020-10-13 00:47:19'),
(23, 'menu_items', 'title', 3, 'pt', 'Utilizadores', '2020-10-13 00:47:19', '2020-10-13 00:47:19'),
(24, 'menu_items', 'title', 11, 'pt', 'Categorias', '2020-10-13 00:47:19', '2020-10-13 00:47:19'),
(25, 'menu_items', 'title', 13, 'pt', 'Páginas', '2020-10-13 00:47:19', '2020-10-13 00:47:19'),
(26, 'menu_items', 'title', 4, 'pt', 'Funções', '2020-10-13 00:47:19', '2020-10-13 00:47:19'),
(27, 'menu_items', 'title', 5, 'pt', 'Ferramentas', '2020-10-13 00:47:19', '2020-10-13 00:47:19'),
(28, 'menu_items', 'title', 6, 'pt', 'Menus', '2020-10-13 00:47:19', '2020-10-13 00:47:19'),
(29, 'menu_items', 'title', 7, 'pt', 'Base de dados', '2020-10-13 00:47:19', '2020-10-13 00:47:19'),
(30, 'menu_items', 'title', 10, 'pt', 'Configurações', '2020-10-13 00:47:20', '2020-10-13 00:47:20'),
(31, 'menu_items', 'title', 15, 'id', 'Umum', '2020-10-13 01:16:51', '2020-10-13 01:18:19'),
(32, 'menu_items', 'title', 17, 'id', 'D.I.S.C', '2020-10-13 02:03:11', '2020-10-13 02:03:11'),
(33, 'menu_items', 'title', 16, 'id', 'Pertanyaan', '2020-10-13 02:03:43', '2020-10-13 02:03:53'),
(34, 'menu_items', 'title', 3, 'id', 'Pengguna', '2020-10-13 02:04:35', '2020-10-13 02:05:10'),
(35, 'menu_items', 'title', 4, 'id', 'Hak Akses', '2020-10-13 02:05:27', '2020-10-13 02:05:27'),
(36, 'menu_items', 'title', 10, 'id', 'Pengaturan', '2020-10-13 02:05:44', '2020-10-13 02:05:44'),
(37, 'menu_items', 'title', 1, 'id', 'Beranda', '2020-10-13 02:06:02', '2020-10-13 02:06:02'),
(38, 'menu_items', 'title', 5, 'id', 'Alat', '2020-10-13 02:06:11', '2020-10-13 02:06:11'),
(39, 'menu_items', 'title', 7, 'id', 'Basis Data', '2020-10-13 02:06:33', '2020-10-13 02:06:33'),
(48, 'disc_questions', 'question_1', 2, 'en', 'Easier', '2020-10-13 02:11:38', '2020-10-13 02:11:38'),
(49, 'disc_questions', 'question_2', 2, 'en', 'Percaya, mudah percaya pada orang lain', '2020-10-13 02:11:38', '2020-10-13 02:11:38'),
(50, 'disc_questions', 'question_3', 2, 'en', 'Petualangan, mengambil resiko', '2020-10-13 02:11:38', '2020-10-13 02:11:38'),
(51, 'disc_questions', 'question_4', 2, 'en', 'Toleran menghormati', '2020-10-13 02:11:38', '2020-10-13 02:11:38'),
(52, 'data_rows', 'display_name', 56, 'en', 'Id', '2020-10-13 02:13:13', '2020-10-13 02:13:13'),
(53, 'data_rows', 'display_name', 57, 'en', 'Question 1', '2020-10-13 02:13:13', '2020-10-13 02:13:13'),
(54, 'data_rows', 'display_name', 58, 'en', 'Question 2', '2020-10-13 02:13:13', '2020-10-13 02:13:13'),
(55, 'data_rows', 'display_name', 59, 'en', 'Question 3', '2020-10-13 02:13:13', '2020-10-13 02:13:13'),
(56, 'data_rows', 'display_name', 60, 'en', 'Question 4', '2020-10-13 02:13:14', '2020-10-13 02:13:14'),
(57, 'data_rows', 'display_name', 61, 'en', 'Question Order', '2020-10-13 02:13:14', '2020-10-13 02:13:14'),
(58, 'data_rows', 'display_name', 62, 'en', 'Description', '2020-10-13 02:13:14', '2020-10-13 02:13:14'),
(59, 'data_rows', 'display_name', 63, 'en', 'Is Active', '2020-10-13 02:13:14', '2020-10-13 02:13:14'),
(60, 'data_rows', 'display_name', 64, 'en', 'Created At', '2020-10-13 02:13:14', '2020-10-13 02:13:14'),
(61, 'data_rows', 'display_name', 65, 'en', 'Updated At', '2020-10-13 02:13:14', '2020-10-13 02:13:14'),
(62, 'data_types', 'display_name_singular', 8, 'en', 'DISC Question', '2020-10-13 02:13:14', '2020-10-13 02:13:14'),
(63, 'data_types', 'display_name_plural', 8, 'en', 'DISC Questions', '2020-10-13 02:13:14', '2020-10-13 02:13:14'),
(64, 'menu_items', 'title', 17, 'en', 'D.I.S.C', '2020-10-13 21:47:04', '2020-10-13 21:47:04'),
(65, 'menu_items', 'title', 19, 'en', 'KPI', '2020-10-18 19:08:39', '2020-10-18 19:08:39'),
(67, 'menu_items', 'title', 18, 'en', 'Master Grades', '2020-10-18 19:09:25', '2020-10-18 21:26:55'),
(68, 'data_rows', 'display_name', 66, 'en', 'Id', '2020-10-18 19:14:02', '2020-10-18 19:14:02'),
(69, 'data_rows', 'display_name', 67, 'en', 'Grade', '2020-10-18 19:14:02', '2020-10-18 19:14:02'),
(70, 'data_rows', 'display_name', 68, 'en', 'Value From', '2020-10-18 19:14:02', '2020-10-18 19:14:02'),
(71, 'data_rows', 'display_name', 69, 'en', 'Value Until', '2020-10-18 19:14:02', '2020-10-18 19:14:02'),
(72, 'data_rows', 'display_name', 70, 'en', 'Description', '2020-10-18 19:14:02', '2020-10-18 19:14:02'),
(73, 'data_rows', 'display_name', 71, 'en', 'Active', '2020-10-18 19:14:02', '2020-10-18 19:14:02'),
(74, 'data_rows', 'display_name', 72, 'en', 'Order', '2020-10-18 19:14:02', '2020-10-18 19:14:02'),
(75, 'data_rows', 'display_name', 73, 'en', 'Created At', '2020-10-18 19:14:02', '2020-10-18 19:14:02'),
(76, 'data_rows', 'display_name', 74, 'en', 'Updated At', '2020-10-18 19:14:02', '2020-10-18 19:14:02'),
(77, 'data_types', 'display_name_singular', 10, 'en', 'Grade', '2020-10-18 19:14:03', '2020-10-18 21:25:45'),
(78, 'data_types', 'display_name_plural', 10, 'en', 'Grades', '2020-10-18 19:14:03', '2020-10-18 21:25:45'),
(89, 'data_rows', 'display_name', 1, 'en', 'ID', '2020-10-18 19:54:12', '2020-10-18 19:54:12'),
(90, 'data_rows', 'display_name', 21, 'en', 'Role', '2020-10-18 19:54:12', '2020-10-18 19:54:12'),
(91, 'data_rows', 'display_name', 2, 'en', 'Name', '2020-10-18 19:54:12', '2020-10-18 19:54:12'),
(92, 'data_rows', 'display_name', 3, 'en', 'Email', '2020-10-18 19:54:12', '2020-10-18 19:54:12'),
(93, 'data_rows', 'display_name', 8, 'en', 'Avatar', '2020-10-18 19:54:12', '2020-10-18 19:54:12'),
(94, 'data_rows', 'display_name', 4, 'en', 'Password', '2020-10-18 19:54:12', '2020-10-18 19:54:12'),
(95, 'data_rows', 'display_name', 5, 'en', 'Remember Token', '2020-10-18 19:54:12', '2020-10-18 19:54:12'),
(96, 'data_rows', 'display_name', 11, 'en', 'Settings', '2020-10-18 19:54:12', '2020-10-18 19:54:12'),
(97, 'data_rows', 'display_name', 6, 'en', 'Created At', '2020-10-18 19:54:12', '2020-10-18 19:54:12'),
(98, 'data_rows', 'display_name', 7, 'en', 'Updated At', '2020-10-18 19:54:12', '2020-10-18 19:54:12'),
(99, 'data_rows', 'display_name', 9, 'en', 'Role', '2020-10-18 19:54:12', '2020-10-18 19:54:12'),
(100, 'data_rows', 'display_name', 10, 'en', 'Roles', '2020-10-18 19:54:12', '2020-10-18 19:54:12'),
(101, 'data_types', 'display_name_singular', 1, 'en', 'User', '2020-10-18 19:54:12', '2020-10-18 19:54:12'),
(102, 'data_types', 'display_name_plural', 1, 'en', 'Users', '2020-10-18 19:54:12', '2020-10-18 19:54:12'),
(103, 'data_rows', 'display_name', 75, 'en', 'NIK', '2020-10-18 19:55:27', '2020-10-18 19:55:27'),
(104, 'menu_items', 'title', 10, 'en', 'Settings', '2020-10-18 20:27:27', '2020-10-18 20:27:27'),
(106, 'data_rows', 'display_name', 76, 'en', 'Id', '2020-10-18 22:06:22', '2020-10-18 22:06:22'),
(107, 'data_rows', 'display_name', 77, 'en', 'KPI Name', '2020-10-18 22:06:22', '2020-10-18 22:06:22'),
(108, 'data_rows', 'display_name', 78, 'en', 'Division Id', '2020-10-18 22:06:22', '2020-10-18 22:06:22'),
(109, 'data_rows', 'display_name', 79, 'en', 'Department Id', '2020-10-18 22:06:22', '2020-10-18 22:06:22'),
(110, 'data_rows', 'display_name', 80, 'en', 'Section Id', '2020-10-18 22:06:22', '2020-10-18 22:06:22'),
(111, 'data_rows', 'display_name', 81, 'en', 'KPI Percentage', '2020-10-18 22:06:22', '2020-10-18 22:06:22'),
(112, 'data_rows', 'display_name', 82, 'en', 'KPI Target', '2020-10-18 22:06:22', '2020-10-18 22:06:22'),
(113, 'data_rows', 'display_name', 83, 'en', 'Description', '2020-10-18 22:06:22', '2020-10-18 22:06:22'),
(114, 'data_rows', 'display_name', 84, 'en', 'Is Active', '2020-10-18 22:06:22', '2020-10-18 22:06:22'),
(115, 'data_rows', 'display_name', 85, 'en', 'Order', '2020-10-18 22:06:22', '2020-10-18 22:06:22'),
(116, 'data_rows', 'display_name', 86, 'en', 'Created At', '2020-10-18 22:06:22', '2020-10-18 22:06:22'),
(117, 'data_rows', 'display_name', 87, 'en', 'Updated At', '2020-10-18 22:06:22', '2020-10-18 22:06:22'),
(118, 'data_types', 'display_name_singular', 12, 'en', 'KPI Department', '2020-10-18 22:06:22', '2020-10-18 22:06:22'),
(119, 'data_types', 'display_name_plural', 12, 'en', 'KPI Departments', '2020-10-18 22:06:22', '2020-10-18 22:06:22'),
(120, 'menu_items', 'title', 1, 'en', 'Dashboard', '2020-10-18 23:13:32', '2020-10-18 23:13:32'),
(121, 'menu_items', 'title', 3, 'en', 'Users', '2020-10-18 23:13:54', '2020-10-18 23:13:54'),
(122, 'menu_items', 'title', 4, 'en', 'Roles', '2020-10-18 23:14:03', '2020-10-18 23:14:03'),
(123, 'menu_items', 'title', 16, 'en', 'Questions', '2020-10-18 23:14:57', '2020-10-18 23:14:57'),
(124, 'data_rows', 'display_name', 88, 'en', 'Department', '2020-10-19 00:44:24', '2020-10-19 00:52:46'),
(125, 'menu_items', 'title', 22, 'en', 'Form KPI Department', '2020-10-19 02:07:36', '2020-10-19 02:07:36'),
(126, 'data_rows', 'display_name', 89, 'en', 'Id', '2020-10-21 09:16:16', '2020-10-21 09:16:16'),
(127, 'data_rows', 'display_name', 90, 'en', 'Level Id', '2020-10-21 09:16:16', '2020-10-21 09:16:16'),
(128, 'data_rows', 'display_name', 91, 'en', 'Quantitative Value', '2020-10-21 09:16:16', '2020-10-21 09:16:16'),
(129, 'data_rows', 'display_name', 92, 'en', 'Qualitative Value', '2020-10-21 09:16:16', '2020-10-21 09:16:16'),
(130, 'data_rows', 'display_name', 93, 'en', 'Deskripsi', '2020-10-21 09:16:16', '2020-10-21 09:16:16'),
(131, 'data_rows', 'display_name', 94, 'en', 'Aktif', '2020-10-21 09:16:16', '2020-10-21 09:16:16'),
(132, 'data_rows', 'display_name', 95, 'en', 'Created By', '2020-10-21 09:16:16', '2020-10-21 09:16:16'),
(133, 'data_rows', 'display_name', 96, 'en', 'Created At', '2020-10-21 09:16:16', '2020-10-21 09:16:16'),
(134, 'data_rows', 'display_name', 97, 'en', 'Updated At', '2020-10-21 09:16:16', '2020-10-21 09:16:16'),
(135, 'data_types', 'display_name_singular', 15, 'en', 'Master Grade Level', '2020-10-21 09:16:16', '2020-10-21 09:16:16'),
(136, 'data_types', 'display_name_plural', 15, 'en', 'Master Grade Level', '2020-10-21 09:16:16', '2020-10-21 09:16:16'),
(137, 'kpi_departments', 'kpi_name', 21, 'en', 'Tepat dalam perhitungan, pembayaran dan pelaporan pajak sesuai dengan jadwal yang telah ditentukan		\n', '2020-10-21 09:52:15', '2020-10-21 09:52:15');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int(10) UNSIGNED NOT NULL,
  `role_id` bigint(20) UNSIGNED DEFAULT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `avatar` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT 'users/default.png',
  `password` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `remember_token` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `settings` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `nik` varchar(15) COLLATE utf8mb4_unicode_ci DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `role_id`, `name`, `email`, `avatar`, `password`, `remember_token`, `settings`, `created_at`, `updated_at`, `nik`) VALUES
(1, 1, 'Budi Irwan Firmansyah', 'budi@l-essential.com', 'users/default.png', '$2y$10$K0VT56jyjwe/h.jr1m5tzuEJjXeg.xoLucUYwvkNoA9Q2K4NcW6me', 'Zrzhxx5SeMei7KZrmOneV4pxSaHwH7t7ZKS6wAiULlIwfszioOeIC7Lf7kIK', '{\"locale\":\"id\"}', '2020-10-13 00:47:13', '2020-10-19 00:00:33', '2019072843'),
(2, 1, 'Joko Yuana', 'joko@l-essential.com', 'users/default.png', '$2y$10$qRTjsDscWYt28mk9iAlAgea4jT5bX72pZt3Tn49z3fquCDFmegvV2', 'NTRL82doJNWuUgAETjU9xHaCfHlBZiGkwfXTnn8D82f6ssUT4jsfzh9bV8mB', '{\"locale\":\"id\"}', '2020-10-18 20:47:25', '2020-10-18 23:12:02', '2011010489'),
(3, 3, 'Denny Rachmadi', 'denny@l-essential.com', 'users/default.png', '$2y$10$Immf7OQpXuYvyOEA4KrQAOystKqrlrtLr5Je6qqB7XvQNLIndv53q', NULL, '{\"locale\":\"id\"}', '2020-10-19 00:20:52', '2020-10-19 00:22:45', '2019062814'),
(4, 2, 'Chicco Aridondo Azis', 'chicco@l-essential.com', 'users/default.png', '$2y$10$o2mSwtDshNNt4WxDz8tTCez8aQh6sC63C7pFW0qSaWNr0.Snmb/fW', '7qhAJdprT0Dv5T81Nemp534htzf1KZ8hUDDoNmMNpgxhtyWpgpC8T4FSVbrA', '{\"locale\":\"id\"}', '2020-10-19 00:27:37', '2020-10-19 00:27:37', '2020010018'),
(5, 3, 'Purna Rady', 'purna@l-essential.com', 'users/default.png', '$2y$10$q0j61kzVXpbkgjH4aEoyVeYjslMPPKL6vKmBgZa4ESKRodmQxL2pa', 'D4oeaYCy1Bcc2ljGGTo9oSFR2Ov9gernwCIQwiNPZ1iUNUpBBhqDLHwRc16C', '{\"locale\":\"id\"}', '2020-10-21 07:46:03', '2020-10-22 01:37:59', '2018122303'),
(6, 2, 'Triadi', 'triadi@l-essential.com', 'users/default.png', '$2y$10$YsACiXihkRyc3d7t5t1SQ.LKKZ/tfXI6ykLO3PSUtjQpUO.3Vvr9a', NULL, '{\"locale\":\"id\"}', '2020-10-22 01:40:00', '2020-10-22 01:40:00', '2020010067'),
(7, 2, 'Daniel Arisonta Azis', 'daniel@l-essential.com', 'users/default.png', '$2y$10$h9MktG28Ej8MTWTSuEu6.evrzxEvv98lKo2eCN/4fwWTY8C1pD.US', NULL, '{\"locale\":\"id\"}', '2020-10-22 01:40:31', '2020-10-22 01:40:31', '2020090321');

-- --------------------------------------------------------

--
-- Table structure for table `user_roles`
--

CREATE TABLE `user_roles` (
  `user_id` int(10) UNSIGNED NOT NULL,
  `role_id` bigint(20) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Indexes for dumped tables
--

--
-- Indexes for table `categories`
--
ALTER TABLE `categories`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `categories_slug_unique` (`slug`),
  ADD KEY `categories_parent_id_foreign` (`parent_id`);

--
-- Indexes for table `data_rows`
--
ALTER TABLE `data_rows`
  ADD PRIMARY KEY (`id`),
  ADD KEY `data_rows_data_type_id_foreign` (`data_type_id`);

--
-- Indexes for table `data_types`
--
ALTER TABLE `data_types`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `data_types_name_unique` (`name`),
  ADD UNIQUE KEY `data_types_slug_unique` (`slug`);

--
-- Indexes for table `disc_questions`
--
ALTER TABLE `disc_questions`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `kpi_departments`
--
ALTER TABLE `kpi_departments`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `kpi_grades`
--
ALTER TABLE `kpi_grades`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `kpi_grade_levels`
--
ALTER TABLE `kpi_grade_levels`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `kpi_percentase_levels`
--
ALTER TABLE `kpi_percentase_levels`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `kpi_trx_departments`
--
ALTER TABLE `kpi_trx_departments`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `kpi_trx_department_details`
--
ALTER TABLE `kpi_trx_department_details`
  ADD PRIMARY KEY (`id`,`id_detail`);

--
-- Indexes for table `menus`
--
ALTER TABLE `menus`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `menus_name_unique` (`name`);

--
-- Indexes for table `menu_items`
--
ALTER TABLE `menu_items`
  ADD PRIMARY KEY (`id`),
  ADD KEY `menu_items_menu_id_foreign` (`menu_id`);

--
-- Indexes for table `migrations`
--
ALTER TABLE `migrations`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `pages`
--
ALTER TABLE `pages`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `pages_slug_unique` (`slug`);

--
-- Indexes for table `password_resets`
--
ALTER TABLE `password_resets`
  ADD KEY `password_resets_email_index` (`email`);

--
-- Indexes for table `permissions`
--
ALTER TABLE `permissions`
  ADD PRIMARY KEY (`id`),
  ADD KEY `permissions_key_index` (`key`);

--
-- Indexes for table `permission_role`
--
ALTER TABLE `permission_role`
  ADD PRIMARY KEY (`permission_id`,`role_id`),
  ADD KEY `permission_role_permission_id_index` (`permission_id`),
  ADD KEY `permission_role_role_id_index` (`role_id`);

--
-- Indexes for table `posts`
--
ALTER TABLE `posts`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `posts_slug_unique` (`slug`);

--
-- Indexes for table `roles`
--
ALTER TABLE `roles`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `roles_name_unique` (`name`);

--
-- Indexes for table `settings`
--
ALTER TABLE `settings`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `settings_key_unique` (`key`);

--
-- Indexes for table `translations`
--
ALTER TABLE `translations`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `translations_table_name_column_name_foreign_key_locale_unique` (`table_name`,`column_name`,`foreign_key`,`locale`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `users_email_unique` (`email`),
  ADD KEY `users_role_id_foreign` (`role_id`);

--
-- Indexes for table `user_roles`
--
ALTER TABLE `user_roles`
  ADD PRIMARY KEY (`user_id`,`role_id`),
  ADD KEY `user_roles_user_id_index` (`user_id`),
  ADD KEY `user_roles_role_id_index` (`role_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `categories`
--
ALTER TABLE `categories`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `data_rows`
--
ALTER TABLE `data_rows`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=98;

--
-- AUTO_INCREMENT for table `data_types`
--
ALTER TABLE `data_types`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=16;

--
-- AUTO_INCREMENT for table `disc_questions`
--
ALTER TABLE `disc_questions`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `kpi_departments`
--
ALTER TABLE `kpi_departments`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=67;

--
-- AUTO_INCREMENT for table `kpi_grades`
--
ALTER TABLE `kpi_grades`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `kpi_grade_levels`
--
ALTER TABLE `kpi_grade_levels`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `kpi_percentase_levels`
--
ALTER TABLE `kpi_percentase_levels`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `kpi_trx_departments`
--
ALTER TABLE `kpi_trx_departments`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `menus`
--
ALTER TABLE `menus`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `menu_items`
--
ALTER TABLE `menu_items`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=26;

--
-- AUTO_INCREMENT for table `migrations`
--
ALTER TABLE `migrations`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=40;

--
-- AUTO_INCREMENT for table `pages`
--
ALTER TABLE `pages`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `permissions`
--
ALTER TABLE `permissions`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=71;

--
-- AUTO_INCREMENT for table `posts`
--
ALTER TABLE `posts`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `roles`
--
ALTER TABLE `roles`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `settings`
--
ALTER TABLE `settings`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT for table `translations`
--
ALTER TABLE `translations`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=138;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `categories`
--
ALTER TABLE `categories`
  ADD CONSTRAINT `categories_parent_id_foreign` FOREIGN KEY (`parent_id`) REFERENCES `categories` (`id`) ON DELETE SET NULL ON UPDATE CASCADE;

--
-- Constraints for table `data_rows`
--
ALTER TABLE `data_rows`
  ADD CONSTRAINT `data_rows_data_type_id_foreign` FOREIGN KEY (`data_type_id`) REFERENCES `data_types` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `menu_items`
--
ALTER TABLE `menu_items`
  ADD CONSTRAINT `menu_items_menu_id_foreign` FOREIGN KEY (`menu_id`) REFERENCES `menus` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `permission_role`
--
ALTER TABLE `permission_role`
  ADD CONSTRAINT `permission_role_permission_id_foreign` FOREIGN KEY (`permission_id`) REFERENCES `permissions` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `permission_role_role_id_foreign` FOREIGN KEY (`role_id`) REFERENCES `roles` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `users`
--
ALTER TABLE `users`
  ADD CONSTRAINT `users_role_id_foreign` FOREIGN KEY (`role_id`) REFERENCES `roles` (`id`);

--
-- Constraints for table `user_roles`
--
ALTER TABLE `user_roles`
  ADD CONSTRAINT `user_roles_role_id_foreign` FOREIGN KEY (`role_id`) REFERENCES `roles` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `user_roles_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
