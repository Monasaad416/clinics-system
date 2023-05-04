-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: localhost:3306
-- Generation Time: Apr 13, 2023 at 10:24 PM
-- Server version: 8.0.30
-- PHP Version: 8.1.10

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `clinic`
--

-- --------------------------------------------------------

--
-- Table structure for table `appointments`
--

CREATE TABLE `appointments` (
  `id` bigint UNSIGNED NOT NULL,
  `doctor_id` bigint UNSIGNED NOT NULL,
  `day_id` bigint UNSIGNED NOT NULL,
  `from` time NOT NULL,
  `to` time NOT NULL,
  `no_of_reservations` tinyint NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `appointments`
--

INSERT INTO `appointments` (`id`, `doctor_id`, `day_id`, `from`, `to`, `no_of_reservations`, `created_at`, `updated_at`) VALUES
(26, 2, 1, '21:39:00', '22:39:00', 2, '2023-04-13 15:39:51', '2023-04-13 15:39:51'),
(27, 2, 2, '23:39:00', '21:41:00', 2, '2023-04-13 15:39:51', '2023-04-13 15:39:51'),
(28, 2, 2, '21:42:00', '21:41:00', 2, '2023-04-13 15:39:51', '2023-04-13 15:39:51'),
(29, 1, 3, '22:40:00', '22:40:00', 2, '2023-04-13 15:40:11', '2023-04-13 15:40:11');

-- --------------------------------------------------------

--
-- Table structure for table `branches`
--

CREATE TABLE `branches` (
  `id` bigint UNSIGNED NOT NULL,
  `name_en` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `name_ar` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `slug` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `address_en` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `address_ar` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `lattitude` decimal(10,8) NOT NULL,
  `longitude` decimal(10,8) NOT NULL,
  `phones` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `description_en` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci,
  `description_ar` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `branches`
--

INSERT INTO `branches` (`id`, `name_en`, `name_ar`, `slug`, `address_en`, `address_ar`, `lattitude`, `longitude`, `phones`, `description_en`, `description_ar`, `created_at`, `updated_at`) VALUES
(1, 'Sheikh Zayed', 'الشيخ زايد', 'sheikh-zayed', 'Charles Mall, located in the Sheikh Zayed area, in the seventh district in particular', 'شالز مول، المتواجد في منطقة الشيخ زايد، بالحي السابع ', '30.85437200', '29.53184000', '234565777', 'Lorem Ipsum is simply dummy text of the printing and typesetting industry', 'لوريم ايبسوم هو نموذج افتراضي يوضع في التصاميم لتعرض على العميل ليتصور طريقه وضع النصوص بالتصاميم سواء كانت تصاميم مطبوعه ... بروشور او فلاير على سبيل المثال ... او نماذج مواقع انترنت ...', '2023-04-13 05:49:03', '2023-04-13 05:49:03'),
(2, 'Nasr City', 'مدينة نصر', 'nasr-city', 'nars ciry ,abc street', 'مدينة نصر شارع ا', '30.85437200', '29.53184000', '234565777', 'Lorem Ipsum is simply dummy text of the printing and typesetting industry', 'لوريم ايبسوم هو نموذج افتراضي يوضع في التصاميم لتعرض على العميل ليتصور طريقه وضع النصوص بالتصاميم سواء كانت تصاميم مطبوعه ... بروشور او فلاير على سبيل المثال ... او نماذج مواقع انترنت ...', '2023-04-13 05:49:03', '2023-04-13 05:49:03'),
(3, 'New Cairo ', 'القاهرة الجديد', 'new-cairo', 'new cairo abc streetr', 'القاهرة الجديدة شارع ا ', '30.85437200', '29.53184000', '234565777', 'Lorem Ipsum is simply dummy text of the printing and typesetting industry', 'لوريم ايبسوم هو نموذج افتراضي يوضع في التصاميم لتعرض على العميل ليتصور طريقه وضع النصوص بالتصاميم سواء كانت تصاميم مطبوعه ... بروشور او فلاير على سبيل المثال ... او نماذج مواقع انترنت ...', '2023-04-13 05:49:03', '2023-04-13 05:49:03');

-- --------------------------------------------------------

--
-- Table structure for table `clients`
--

CREATE TABLE `clients` (
  `id` bigint UNSIGNED NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `phone` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `date_of_birth` date DEFAULT NULL,
  `address` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `how_know_us` tinyint DEFAULT NULL,
  `file_no` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `branch_id` bigint UNSIGNED DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `clients`
--

INSERT INTO `clients` (`id`, `name`, `phone`, `email`, `date_of_birth`, `address`, `how_know_us`, `file_no`, `branch_id`, `created_at`, `updated_at`) VALUES
(2, 'Farrah Rivera', '+1 (824) 483-1697', 'woragyn@mailinator.com', '2009-08-02', 'Architecto quia vita', 1, '#00000001', 1, '2023-04-13 17:58:48', '2023-04-13 17:58:48');

-- --------------------------------------------------------

--
-- Table structure for table `days`
--

CREATE TABLE `days` (
  `id` bigint UNSIGNED NOT NULL,
  `day_en` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `day_ar` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `days`
--

INSERT INTO `days` (`id`, `day_en`, `day_ar`, `created_at`, `updated_at`) VALUES
(1, 'Saturday', ' السبت', '2023-04-13 05:50:29', '2023-04-13 05:50:29'),
(2, 'Sunday', 'الأحد', '2023-04-13 05:50:29', '2023-04-13 05:50:29'),
(3, 'Monday', 'الإثنين', '2023-04-13 05:50:29', '2023-04-13 05:50:29'),
(4, 'Tuesday', 'الثلاثاء', '2023-04-13 05:50:29', '2023-04-13 05:50:29'),
(5, 'Wednesday', 'الأربعاء', '2023-04-13 05:50:29', '2023-04-13 05:50:29'),
(6, 'Thursday', 'الخميس ', '2023-04-13 05:50:29', '2023-04-13 05:50:29');

-- --------------------------------------------------------

--
-- Table structure for table `departments`
--

CREATE TABLE `departments` (
  `id` bigint UNSIGNED NOT NULL,
  `name_en` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `name_ar` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `slug` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `branch_id` bigint UNSIGNED DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `departments`
--

INSERT INTO `departments` (`id`, `name_en`, `name_ar`, `slug`, `branch_id`, `created_at`, `updated_at`) VALUES
(2, 'Reception-1', 'الاستقبال-1', 'reception-1', 1, '2023-04-13 05:49:06', '2023-04-13 05:49:06'),
(3, 'Customer Service-1', ' خدمة العملاء-1', 'customer-service-1', 1, '2023-04-13 05:49:06', '2023-04-13 05:49:06'),
(4, 'Marketing-1', 'التسويق-1', 'marketing-1', 1, '2023-04-13 05:49:06', '2023-04-13 05:49:06'),
(5, 'Financial-1', 'الحسابات-1 ', 'financial-1', 1, '2023-04-13 05:49:06', '2023-04-13 05:49:06'),
(6, 'Nursing-1', 'التمريض-1', 'nursing-1', 1, '2023-04-13 05:49:06', '2023-04-13 05:49:06'),
(7, 'Doctors-1', 'الأطباء-1', 'doctors-1', 1, '2023-04-13 05:49:06', '2023-04-13 05:49:06'),
(8, 'administration-1', 'الإدارة-1', 'administration-1', 1, '2023-04-13 05:49:06', '2023-04-13 05:49:06'),
(9, 'Reception-2', 'الإستقبال-2', 'reception-2', 2, '2023-04-13 05:49:06', '2023-04-13 05:49:06'),
(10, 'Customer Service-2', ' خدمة العملاء-2', 'customer-service-2', 2, '2023-04-13 05:49:06', '2023-04-13 05:49:06'),
(11, 'Marketing=2', 'التسويق-2', 'marketing2', 2, '2023-04-13 05:49:06', '2023-04-13 05:49:06'),
(12, 'Financial=2', 'الحسابات-2 ', 'financial2', 2, '2023-04-13 05:49:06', '2023-04-13 05:49:06'),
(13, 'Nursing-2', 'التمريض-2', 'nursing-2', 2, '2023-04-13 05:49:06', '2023-04-13 05:49:06'),
(14, 'Doctors-2', 'الأطباء-2', 'doctors-2', 2, '2023-04-13 05:49:06', '2023-04-13 05:49:06'),
(15, 'administration-2', 'الإدارة-2', 'administration-2', 2, '2023-04-13 05:49:06', '2023-04-13 05:49:06'),
(16, 'Reception-3', 'الإستقبال-3', 'reception-3', 3, '2023-04-13 05:49:06', '2023-04-13 05:49:06'),
(17, 'Customer Service-3', ' خدمة العملاء-3', 'customer-service-3', 3, '2023-04-13 05:49:06', '2023-04-13 05:49:06'),
(18, 'Marketing=3', 'التسويق-3', 'marketing3', 3, '2023-04-13 05:49:06', '2023-04-13 05:49:06'),
(19, 'Financial-3', 'الحسابات-3 ', 'financial-3', 3, '2023-04-13 05:49:06', '2023-04-13 05:49:06'),
(20, 'Nursing-3', 'التمريض-3', 'nursing-3', 3, '2023-04-13 05:49:06', '2023-04-13 05:49:06'),
(21, 'Doctors-3', 'الأطباء-3', 'doctors-3', 3, '2023-04-13 05:49:06', '2023-04-13 05:49:06'),
(22, 'administration-3', 'الإدارة-3', 'administration-3', 3, '2023-04-13 05:49:06', '2023-04-13 05:49:06'),
(23, 'Cassady Gallegos', 'Randall Griffin', 'cassady-gallegos', 3, '2023-04-13 18:46:13', '2023-04-13 18:46:13');

-- --------------------------------------------------------

--
-- Table structure for table `doctors`
--

CREATE TABLE `doctors` (
  `id` bigint UNSIGNED NOT NULL,
  `name_en` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `name_ar` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `phone` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `gender` tinyint NOT NULL,
  `image` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `about_en` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `about_ar` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `professional_image` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `title_image` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `branch_id` bigint UNSIGNED DEFAULT NULL,
  `specialist_id` bigint UNSIGNED DEFAULT NULL,
  `professional_title_id` bigint UNSIGNED DEFAULT NULL,
  `doctor_title_id` bigint UNSIGNED DEFAULT NULL,
  `fees` decimal(8,2) NOT NULL,
  `discount_fees` decimal(8,2) DEFAULT NULL,
  `first_come` enum('yes','no') COLLATE utf8mb4_unicode_ci NOT NULL,
  `stop_reservations` enum('yes','no') COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `doctors`
--

INSERT INTO `doctors` (`id`, `name_en`, `name_ar`, `phone`, `email`, `gender`, `image`, `about_en`, `about_ar`, `professional_image`, `title_image`, `branch_id`, `specialist_id`, `professional_title_id`, `doctor_title_id`, `fees`, `discount_fees`, `first_come`, `stop_reservations`, `created_at`, `updated_at`) VALUES
(1, 'Blaine Nicholson', 'Hunter Mcconnell', '+1 (862) 663-1889', 'jelode@mailinator.com', 1, '1681408629.png', 'Eu aut dolor sint u', 'Aspernatur fugit su', '1681408629.png', '1681408629_.png', 1, 4, 4, 1, '17.00', '41.00', 'yes', 'yes', '2023-04-13 14:57:10', '2023-04-13 14:57:10'),
(2, 'Guy Brown', 'Quynn Powers', '+1 (358) 783-1451', 'tajuwi@mailinator.com', 1, '1681408738.png', 'Laboriosam laborum', 'Molestiae debitis at', '1681408738.png', '1681408738_.png', 1, 5, 2, 2, '67.00', '37.00', 'yes', 'yes', '2023-04-13 14:58:58', '2023-04-13 14:58:58');

-- --------------------------------------------------------

--
-- Table structure for table `doctor_day`
--

CREATE TABLE `doctor_day` (
  `id` bigint UNSIGNED NOT NULL,
  `doctor_id` bigint UNSIGNED NOT NULL,
  `day_id` bigint UNSIGNED NOT NULL,
  `from` time NOT NULL,
  `to` time NOT NULL,
  `no_of_reservations` tinyint NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `doctor_offer`
--

CREATE TABLE `doctor_offer` (
  `id` bigint UNSIGNED NOT NULL,
  `doctor_id` bigint UNSIGNED NOT NULL,
  `offer_id` bigint UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `doctor_sub_specialist`
--

CREATE TABLE `doctor_sub_specialist` (
  `id` bigint UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `doctor_id` bigint UNSIGNED NOT NULL,
  `sub_specialist_id` bigint UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `doctor_sub_specialist`
--

INSERT INTO `doctor_sub_specialist` (`id`, `created_at`, `updated_at`, `doctor_id`, `sub_specialist_id`) VALUES
(1, '2023-04-13 14:57:10', '2023-04-13 14:57:10', 1, 7),
(2, '2023-04-13 14:58:58', '2023-04-13 14:58:58', 2, 9);

-- --------------------------------------------------------

--
-- Table structure for table `doctor_titles`
--

CREATE TABLE `doctor_titles` (
  `id` bigint UNSIGNED NOT NULL,
  `name_en` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `name_ar` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `slug` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `doctor_titles`
--

INSERT INTO `doctor_titles` (`id`, `name_en`, `name_ar`, `slug`, `created_at`, `updated_at`) VALUES
(1, 'Doctor', 'دكتور', 'dktor', '2023-04-13 05:49:58', '2023-04-13 05:49:58'),
(2, 'Specialist', ' أخصائي', 'akhsayy', '2023-04-13 05:49:58', '2023-04-13 05:49:58'),
(3, 'Prof. Doctor', 'أستاذ دكتور', 'astath-dktor', '2023-04-13 05:49:59', '2023-04-13 05:49:59');

-- --------------------------------------------------------

--
-- Table structure for table `failed_jobs`
--

CREATE TABLE `failed_jobs` (
  `id` bigint UNSIGNED NOT NULL,
  `uuid` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `connection` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `queue` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `payload` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `exception` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `failed_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `images`
--

CREATE TABLE `images` (
  `id` bigint UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `imagable_type` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `imagable_id` bigint UNSIGNED NOT NULL,
  `uploads` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `invoices`
--

CREATE TABLE `invoices` (
  `id` bigint UNSIGNED NOT NULL,
  `invoice_no` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `reservation_id` bigint UNSIGNED NOT NULL,
  `price` decimal(8,2) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `migrations`
--

CREATE TABLE `migrations` (
  `id` int UNSIGNED NOT NULL,
  `migration` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `batch` int NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `migrations`
--

INSERT INTO `migrations` (`id`, `migration`, `batch`) VALUES
(1, '2014_02_06_081759_create_branches_table', 1),
(2, '2014_03_06_081759_create_departments_table', 1),
(3, '2014_10_12_000000_create_users_table', 1),
(4, '2014_10_12_100000_create_password_reset_tokens_table', 1),
(5, '2015_03_15_052552_create_available_days_table', 1),
(6, '2019_08_19_000000_create_failed_jobs_table', 1),
(7, '2019_12_14_000001_create_personal_access_tokens_table', 1),
(8, '2023_02_06_081759_create_doctor_titles_table', 1),
(9, '2023_02_06_081759_create_offers_table', 1),
(10, '2023_02_06_081759_create_professional_titles_table', 1),
(11, '2023_02_06_081759_create_specialists_table', 1),
(12, '2023_02_06_081759_create_sub_specialists_table', 1),
(13, '2023_02_07_081759_create_doctors_table', 1),
(14, '2023_03_06_081759_create_clients_table', 1),
(15, '2023_03_06_081759_create_doctor_day_table', 1),
(16, '2023_03_06_081759_create_doctor_offer_table', 1),
(17, '2023_03_06_081759_create_doctor_sub_specialist_table', 1),
(18, '2023_03_06_081759_create_images_table', 1),
(19, '2023_03_06_081759_create_payment_methods_table', 1),
(20, '2023_03_06_081759_create_services_table', 1),
(21, '2023_03_06_081759_create_settings_table', 1),
(22, '2023_03_06_081759_create_sub_service_table', 1),
(23, '2023_03_07_071335_create_salaries_table', 1),
(24, '2023_03_11_070217_create_permission_tables', 1),
(25, '2023_04_06_081759_create_reservations_table', 1),
(26, '2023_04_11_205331_create_appointments_table', 1),
(27, '2023_04_12_130042_create_notifications_table', 1),
(28, '2023_05_06_081759_create_invoices_table', 1),
(29, '2023_06_04_071049_create_reservation_service_table', 1);

-- --------------------------------------------------------

--
-- Table structure for table `model_has_permissions`
--

CREATE TABLE `model_has_permissions` (
  `permission_id` bigint UNSIGNED NOT NULL,
  `model_type` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `model_id` bigint UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `model_has_roles`
--

CREATE TABLE `model_has_roles` (
  `role_id` bigint UNSIGNED NOT NULL,
  `model_type` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `model_id` bigint UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `model_has_roles`
--

INSERT INTO `model_has_roles` (`role_id`, `model_type`, `model_id`) VALUES
(1, 'App\\Models\\User', 1),
(3, 'App\\Models\\User', 5),
(2, 'App\\Models\\User', 6),
(3, 'App\\Models\\User', 7),
(6, 'App\\Models\\User', 8);

-- --------------------------------------------------------

--
-- Table structure for table `notifications`
--

CREATE TABLE `notifications` (
  `id` char(36) COLLATE utf8mb4_unicode_ci NOT NULL,
  `type` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `notifiable_type` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `notifiable_id` bigint UNSIGNED NOT NULL,
  `data` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `read_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `offers`
--

CREATE TABLE `offers` (
  `id` bigint UNSIGNED NOT NULL,
  `title_en` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `title_ar` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `slug` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `description_en` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `description_ar` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `image` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `from_date` date NOT NULL,
  `to_date` date NOT NULL,
  `price` decimal(8,2) NOT NULL,
  `discount_price` decimal(8,2) NOT NULL DEFAULT '0.00',
  `discount_percentage` int NOT NULL DEFAULT '0',
  `branch_id` bigint UNSIGNED DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `offers`
--

INSERT INTO `offers` (`id`, `title_en`, `title_ar`, `slug`, `description_en`, `description_ar`, `image`, `from_date`, `to_date`, `price`, `discount_price`, `discount_percentage`, `branch_id`, `created_at`, `updated_at`) VALUES
(1, 'Vel possimus natus', 'Aliquip dolorem eum', '', 'Sit iure alias magn', 'Eos consequatur It', '1681419506.png', '2021-12-06', '1974-07-08', '871.00', '257.00', 43, 1, '2023-04-13 17:58:26', '2023-04-13 17:58:26');

-- --------------------------------------------------------

--
-- Table structure for table `password_reset_tokens`
--

CREATE TABLE `password_reset_tokens` (
  `email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `token` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `payment_methods`
--

CREATE TABLE `payment_methods` (
  `id` bigint UNSIGNED NOT NULL,
  `name_en` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `name_ar` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `slug` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `payment_methods`
--

INSERT INTO `payment_methods` (`id`, `name_en`, `name_ar`, `slug`, `created_at`, `updated_at`) VALUES
(1, ' Cash', 'كاش', 'cash', '2023-04-13 05:50:18', '2023-04-13 05:50:18'),
(2, 'Visa', 'فيزا', 'visa', '2023-04-13 05:50:18', '2023-04-13 05:50:18');

-- --------------------------------------------------------

--
-- Table structure for table `permissions`
--

CREATE TABLE `permissions` (
  `id` bigint UNSIGNED NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `guard_name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `routes` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `permissions`
--

INSERT INTO `permissions` (`id`, `name`, `guard_name`, `created_at`, `updated_at`, `routes`) VALUES
(1, 'dashboard', 'web', '2023-04-13 05:49:22', '2023-04-13 05:49:22', ''),
(2, 'dashboard-1', 'web', '2023-04-13 05:49:22', '2023-04-13 05:49:22', ''),
(3, 'dashboard-2', 'web', '2023-04-13 05:49:22', '2023-04-13 05:49:22', ''),
(4, 'dashboard-3', 'web', '2023-04-13 05:49:22', '2023-04-13 05:49:22', ''),
(5, 'roles-list', 'web', '2023-04-13 05:49:22', '2023-04-13 05:49:22', 'admin.roles.index'),
(6, 'roles-create', 'web', '2023-04-13 05:49:22', '2023-04-13 05:49:22', 'admin.roles.create,admin.roles.store'),
(7, 'roles-edit', 'web', '2023-04-13 05:49:22', '2023-04-13 05:49:22', 'admin.roles.edit,admin.roles.update'),
(8, 'roles-delete', 'web', '2023-04-13 05:49:22', '2023-04-13 05:49:22', 'admin.roles.destroy'),
(9, 'roles-show', 'web', '2023-04-13 05:49:22', '2023-04-13 05:49:22', 'admin.roles.show'),
(10, 'settings-edit', 'web', '2023-04-13 05:49:22', '2023-04-13 05:49:22', 'admin.settings.edit'),
(11, 'branches-list', 'web', '2023-04-13 05:49:22', '2023-04-13 05:49:22', 'admin.settings.update'),
(12, 'branches-create', 'web', '2023-04-13 05:49:22', '2023-04-13 05:49:22', 'admin.branches.index'),
(13, 'branches-edit', 'web', '2023-04-13 05:49:22', '2023-04-13 05:49:22', 'admin.branches.create,admin.branches.store'),
(14, 'branches-delete', 'web', '2023-04-13 05:49:22', '2023-04-13 05:49:22', 'admin.branches.edit,admin.branches.update'),
(15, 'branches-show', 'web', '2023-04-13 05:49:22', '2023-04-13 05:49:22', 'admin.branches.destroy'),
(16, 'employees-list', 'web', '2023-04-13 05:49:22', '2023-04-13 05:49:22', 'admin.employees.index'),
(17, 'employees-create', 'web', '2023-04-13 05:49:22', '2023-04-13 05:49:22', 'admin.employees.create,admin.employees.store'),
(18, 'employees-edit', 'web', '2023-04-13 05:49:22', '2023-04-13 05:49:22', 'admin.employees.edit,admin.employees.update'),
(19, 'employees-delete', 'web', '2023-04-13 05:49:22', '2023-04-13 05:49:22', 'admin.employees.destroy'),
(20, 'employees-delete-permanent', 'web', '2023-04-13 05:49:22', '2023-04-13 05:49:22', ''),
(21, 'doctors-list', 'web', '2023-04-13 05:49:22', '2023-04-13 05:49:22', 'admin.doctors.index'),
(22, 'doctors-create', 'web', '2023-04-13 05:49:22', '2023-04-13 05:49:22', 'admin.doctors.create,admin.doctors.store'),
(23, 'doctors-edit', 'web', '2023-04-13 05:49:22', '2023-04-13 05:49:22', 'admin.doctors.edit,admin.doctors.update'),
(24, 'doctors-delete', 'web', '2023-04-13 05:49:22', '2023-04-13 05:49:22', 'admin.doctors.destroy'),
(25, 'clients-list', 'web', '2023-04-13 05:49:22', '2023-04-13 05:49:22', 'admin.clients.list'),
(26, 'clients-create', 'web', '2023-04-13 05:49:22', '2023-04-13 05:49:22', 'admin.clients.create,admin.clients.store'),
(27, 'clients-edit', 'web', '2023-04-13 05:49:22', '2023-04-13 05:49:22', 'admin.clients.edit,admin.clients.update'),
(28, 'clients-delete', 'web', '2023-04-13 05:49:22', '2023-04-13 05:49:22', 'admin.clients.destroy'),
(29, 'departments-list', 'web', '2023-04-13 05:49:22', '2023-04-13 05:49:22', 'admin.departments.index'),
(30, 'departments-create', 'web', '2023-04-13 05:49:22', '2023-04-13 05:49:22', 'admin.departments.create,admin.departments.store'),
(31, 'departments-edit', 'web', '2023-04-13 05:49:22', '2023-04-13 05:49:22', 'admin.departments.edit,admin.departments.update'),
(32, 'departments-delete', 'web', '2023-04-13 05:49:22', '2023-04-13 05:49:22', 'admin.departments.destroy'),
(33, 'specialists-list', 'web', '2023-04-13 05:49:22', '2023-04-13 05:49:22', 'admin.specialists.index'),
(34, 'specialists-create', 'web', '2023-04-13 05:49:23', '2023-04-13 05:49:23', 'admin.specialists.create,admin.specialists.store'),
(35, 'specialists-edit', 'web', '2023-04-13 05:49:23', '2023-04-13 05:49:23', 'admin.specialists.edit,admin.specialists.update'),
(36, 'specialists-delete', 'web', '2023-04-13 05:49:23', '2023-04-13 05:49:23', 'admin.specialists.destroy'),
(37, 'specialists-show', 'web', '2023-04-13 05:49:23', '2023-04-13 05:49:23', 'admin.specialists.show'),
(38, 'sub-pecialists-list', 'web', '2023-04-13 05:49:23', '2023-04-13 05:49:23', ''),
(39, 'sub-pecialists-create', 'web', '2023-04-13 05:49:23', '2023-04-13 05:49:23', ''),
(40, 'sub-pecialists-edit', 'web', '2023-04-13 05:49:23', '2023-04-13 05:49:23', ''),
(41, 'sub-pecialists-delete', 'web', '2023-04-13 05:49:23', '2023-04-13 05:49:23', ''),
(42, 'sub-pecialists-show', 'web', '2023-04-13 05:49:23', '2023-04-13 05:49:23', ''),
(43, 'payments-list', 'web', '2023-04-13 05:49:23', '2023-04-13 05:49:23', ''),
(44, 'payments-create', 'web', '2023-04-13 05:49:23', '2023-04-13 05:49:23', ''),
(45, 'payments-edit', 'web', '2023-04-13 05:49:23', '2023-04-13 05:49:23', ''),
(46, 'payments-delete', 'web', '2023-04-13 05:49:23', '2023-04-13 05:49:23', ''),
(47, 'payments-show', 'web', '2023-04-13 05:49:23', '2023-04-13 05:49:23', ''),
(48, 'financila-list', 'web', '2023-04-13 05:49:23', '2023-04-13 05:49:23', ''),
(49, 'offers-list', 'web', '2023-04-13 05:49:23', '2023-04-13 05:49:23', 'admin.offers.index'),
(50, 'offers-create', 'web', '2023-04-13 05:49:23', '2023-04-13 05:49:23', 'admin.offers.create,admin.offers.store'),
(51, 'offers-edit', 'web', '2023-04-13 05:49:23', '2023-04-13 05:49:23', 'admin.offers.edit,admin.offers.update'),
(52, 'offers-delete', 'web', '2023-04-13 05:49:23', '2023-04-13 05:49:23', 'admin.offers.destroy'),
(53, 'offers-show', 'web', '2023-04-13 05:49:23', '2023-04-13 05:49:23', 'admin.offers.show'),
(54, 'invoices-list', 'web', '2023-04-13 05:49:23', '2023-04-13 05:49:23', ''),
(55, 'invoices-create', 'web', '2023-04-13 05:49:23', '2023-04-13 05:49:23', ''),
(56, 'invoices-edit', 'web', '2023-04-13 05:49:23', '2023-04-13 05:49:23', ''),
(57, 'invoices-delete', 'web', '2023-04-13 05:49:23', '2023-04-13 05:49:23', ''),
(58, 'invoices-show', 'web', '2023-04-13 05:49:23', '2023-04-13 05:49:23', ''),
(59, 'services-list', 'web', '2023-04-13 05:49:23', '2023-04-13 05:49:23', 'admin.services.index'),
(60, 'services-create', 'web', '2023-04-13 05:49:23', '2023-04-13 05:49:23', 'admin.services.create,admin.services.store'),
(61, 'services-edit', 'web', '2023-04-13 05:49:23', '2023-04-13 05:49:23', 'admin.services.edit,admin.services.update'),
(62, 'services-delete', 'web', '2023-04-13 05:49:23', '2023-04-13 05:49:23', 'admin.services.destroy'),
(63, 'services-show', 'web', '2023-04-13 05:49:23', '2023-04-13 05:49:23', 'admin.services.show'),
(64, 'reservations-list', 'web', '2023-04-13 05:49:23', '2023-04-13 05:49:23', 'admin.reservations.index'),
(65, 'reservations-create', 'web', '2023-04-13 05:49:23', '2023-04-13 05:49:23', 'admin.reservations.create,admin.reservations.store'),
(66, 'reservations-edit', 'web', '2023-04-13 05:49:23', '2023-04-13 05:49:23', 'admin.reservations.edit,admin.reservations.update'),
(67, 'reservations-delete', 'web', '2023-04-13 05:49:23', '2023-04-13 05:49:23', 'admin.reservations.destroy'),
(68, 'reservations-show', 'web', '2023-04-13 05:49:23', '2023-04-13 05:49:23', 'admin.reservations.show');

-- --------------------------------------------------------

--
-- Table structure for table `personal_access_tokens`
--

CREATE TABLE `personal_access_tokens` (
  `id` bigint UNSIGNED NOT NULL,
  `tokenable_type` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `tokenable_id` bigint UNSIGNED NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `token` varchar(64) COLLATE utf8mb4_unicode_ci NOT NULL,
  `abilities` text COLLATE utf8mb4_unicode_ci,
  `last_used_at` timestamp NULL DEFAULT NULL,
  `expires_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `professional_titles`
--

CREATE TABLE `professional_titles` (
  `id` bigint UNSIGNED NOT NULL,
  `name_en` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `name_ar` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `slug` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `professional_titles`
--

INSERT INTO `professional_titles` (`id`, `name_en`, `name_ar`, `slug`, `created_at`, `updated_at`) VALUES
(1, 'Specialist', ' أخصائي', 'akhsayy', '2023-04-13 05:50:07', '2023-04-13 05:50:07'),
(2, 'Consultant', 'إستشاري', 'astshary', '2023-04-13 05:50:07', '2023-04-13 05:50:07'),
(3, 'Professor Assistant', 'مدرس مساعد ', 'mdrs-msaaad', '2023-04-13 05:50:07', '2023-04-13 05:50:07'),
(4, 'Professor', 'أستاذ', 'astath', '2023-04-13 05:50:07', '2023-04-13 05:50:07'),
(5, 'General Practitioner', 'طبيب عام', 'tbyb-aaam', '2023-04-13 05:50:07', '2023-04-13 05:50:07');

-- --------------------------------------------------------

--
-- Table structure for table `reservations`
--

CREATE TABLE `reservations` (
  `id` bigint UNSIGNED NOT NULL,
  `branch_id` bigint UNSIGNED NOT NULL,
  `number` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `client_id` bigint UNSIGNED NOT NULL,
  `time` time DEFAULT NULL,
  `date` date DEFAULT NULL,
  `doctor_id` bigint UNSIGNED NOT NULL,
  `sub_specialist_id` bigint UNSIGNED NOT NULL,
  `specialist_id` bigint UNSIGNED NOT NULL,
  `status` enum('pending','completed','canceled','absent') COLLATE utf8mb4_unicode_ci NOT NULL,
  `type` enum('first_visit','sec_visit') COLLATE utf8mb4_unicode_ci NOT NULL,
  `notes` text COLLATE utf8mb4_unicode_ci,
  `payment_method_id` bigint UNSIGNED DEFAULT NULL,
  `insurance` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `insurance_discount` decimal(8,2) DEFAULT '0.00',
  `insurance_percentage` decimal(8,2) DEFAULT '0.00',
  `final_price` decimal(8,2) DEFAULT '0.00',
  `appointment_notes` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `reservation_service`
--

CREATE TABLE `reservation_service` (
  `id` bigint UNSIGNED NOT NULL,
  `reservation_id` bigint UNSIGNED DEFAULT NULL,
  `service_id` bigint UNSIGNED DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `roles`
--

CREATE TABLE `roles` (
  `id` bigint UNSIGNED NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `guard_name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `roles`
--

INSERT INTO `roles` (`id`, `name`, `guard_name`, `created_at`, `updated_at`) VALUES
(1, 'superadmin', 'web', '2023-04-13 05:49:31', '2023-04-13 05:49:31'),
(2, 'admin', 'web', '2023-04-13 05:59:59', '2023-04-13 05:59:59'),
(3, 'reception', 'web', '2023-04-13 06:03:00', '2023-04-13 06:03:00'),
(4, 'marketing', 'web', '2023-04-13 18:35:05', '2023-04-13 18:35:05'),
(5, 'customer-service', 'web', '2023-04-13 18:36:07', '2023-04-13 18:36:07'),
(6, 'financial', 'web', '2023-04-13 18:37:49', '2023-04-13 18:37:49');

-- --------------------------------------------------------

--
-- Table structure for table `role_has_permissions`
--

CREATE TABLE `role_has_permissions` (
  `permission_id` bigint UNSIGNED NOT NULL,
  `role_id` bigint UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `role_has_permissions`
--

INSERT INTO `role_has_permissions` (`permission_id`, `role_id`) VALUES
(1, 1),
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
(41, 1),
(42, 1),
(43, 1),
(44, 1),
(45, 1),
(46, 1),
(47, 1),
(48, 1),
(49, 1),
(50, 1),
(51, 1),
(52, 1),
(53, 1),
(54, 1),
(55, 1),
(56, 1),
(57, 1),
(58, 1),
(59, 1),
(60, 1),
(61, 1),
(62, 1),
(63, 1),
(64, 1),
(65, 1),
(66, 1),
(67, 1),
(68, 1),
(2, 2),
(16, 2),
(17, 2),
(18, 2),
(19, 2),
(20, 2),
(21, 2),
(22, 2),
(23, 2),
(24, 2),
(25, 2),
(26, 2),
(27, 2),
(28, 2),
(29, 2),
(30, 2),
(31, 2),
(32, 2),
(33, 2),
(34, 2),
(35, 2),
(36, 2),
(37, 2),
(38, 2),
(39, 2),
(40, 2),
(41, 2),
(42, 2),
(43, 2),
(44, 2),
(45, 2),
(46, 2),
(47, 2),
(48, 2),
(49, 2),
(50, 2),
(51, 2),
(52, 2),
(53, 2),
(54, 2),
(55, 2),
(56, 2),
(57, 2),
(58, 2),
(59, 2),
(60, 2),
(61, 2),
(62, 2),
(63, 2),
(64, 2),
(65, 2),
(66, 2),
(67, 2),
(68, 2),
(21, 3),
(25, 3),
(26, 3),
(27, 3),
(28, 3),
(33, 3),
(38, 3),
(49, 3),
(54, 3),
(55, 3),
(56, 3),
(57, 3),
(58, 3),
(59, 3),
(64, 3),
(65, 3),
(66, 3),
(67, 3),
(68, 3),
(21, 4),
(25, 4),
(33, 4),
(38, 4),
(49, 4),
(50, 4),
(51, 4),
(52, 4),
(53, 4),
(59, 4),
(21, 5),
(25, 5),
(33, 5),
(38, 5),
(49, 5),
(59, 5),
(16, 6),
(21, 6),
(25, 6),
(48, 6),
(49, 6),
(54, 6),
(55, 6),
(56, 6),
(57, 6),
(58, 6),
(59, 6),
(64, 6);

-- --------------------------------------------------------

--
-- Table structure for table `salaries`
--

CREATE TABLE `salaries` (
  `id` bigint UNSIGNED NOT NULL,
  `salariable_type` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `salariable_id` bigint UNSIGNED NOT NULL,
  `amount` decimal(8,2) NOT NULL,
  `details` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `branch_id` bigint UNSIGNED DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `salaries`
--

INSERT INTO `salaries` (`id`, `salariable_type`, `salariable_id`, `amount`, `details`, `branch_id`, `created_at`, `updated_at`) VALUES
(1, 'App\\Models\\User', 1, '1000.00', 'راتب', 1, '2023-04-13 05:49:31', '2023-04-13 05:49:31'),
(2, 'App\\Models\\User', 2, '55.00', 'الراتب', 1, '2023-04-13 06:04:20', '2023-04-13 06:04:20'),
(4, 'App\\Models\\User', 4, '66.00', 'الراتب', 2, '2023-04-13 08:24:57', '2023-04-13 08:24:57'),
(5, 'App\\Models\\User', 5, '55.00', 'الراتب', 1, '2023-04-13 09:49:28', '2023-04-13 09:49:28'),
(6, 'App\\Models\\User', 6, '55.00', 'الراتب', 1, '2023-04-13 14:27:25', '2023-04-13 14:27:25'),
(7, 'App\\Models\\User', 7, '9.00', 'الراتب', 1, '2023-04-13 14:52:32', '2023-04-13 14:52:32'),
(8, 'App\\Models\\Doctor', 1, '57.00', 'الراتب', 1, '2023-04-13 14:57:10', '2023-04-13 15:40:11'),
(9, 'App\\Models\\Doctor', 2, '76.00', 'الراتب', 1, '2023-04-13 14:58:58', '2023-04-13 15:39:51'),
(11, 'App\\Models\\User', 8, '99.00', 'الراتب', 3, '2023-04-13 18:38:55', '2023-04-13 18:38:55');

-- --------------------------------------------------------

--
-- Table structure for table `services`
--

CREATE TABLE `services` (
  `id` bigint UNSIGNED NOT NULL,
  `name_en` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `name_ar` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `slug` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `description_en` text COLLATE utf8mb4_unicode_ci,
  `description_ar` text COLLATE utf8mb4_unicode_ci,
  `image` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `price` decimal(8,2) NOT NULL,
  `branch_id` bigint UNSIGNED DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `services`
--

INSERT INTO `services` (`id`, `name_en`, `name_ar`, `slug`, `description_en`, `description_ar`, `image`, `price`, `branch_id`, `created_at`, `updated_at`) VALUES
(1, 'test', 'تحليل1', 'test', 'Lorem Ipsum is simply dummy text of the printing and typesetting industry.', 'وريم ايبسوم هو نموذج افتراضي يوضع في التصاميم لتعرض على العميل ليتصور طريقه وضع النصوص بالتصاميم سواء كانت تصاميم مطبوعه ... بروشور او فلاير على سبيل المثال ... او نماذج مواقع انترنت ', 'download.jpg', '300.00', 1, '2023-04-13 05:50:52', '2023-04-13 16:25:27'),
(2, 'CAT Scan', 'اشعة مقطعية ', 'cat-scan', 'Lorem Ipsum is simply dummy text of the printing and typesetting industry.', 'وريم ايبسوم هو نموذج افتراضي يوضع في التصاميم لتعرض على العميل ليتصور طريقه وضع النصوص بالتصاميم سواء كانت تصاميم مطبوعه ... بروشور او فلاير على سبيل المثال ... او نماذج مواقع انترنت', 'download.jpg', '1000.00', 1, '2023-04-13 05:50:52', '2023-04-13 05:50:52'),
(3, 'MRI Scan ', 'اشعة رنين ', 'mri-scan', 'Lorem Ipsum is simply dummy text of the printing and typesetting industry.', ' وريم ايبسوم هو نموذج افتراضي يوضع في التصاميم لتعرض على العميل ليتصور طريقه وضع النصوص بالتصاميم سواء كانت تصاميم مطبوعه ... بروشور او فلاير على سبيل المثال ... او نماذج مواقع انترنت ', 'download.jpg', '1000.00', 1, '2023-04-13 05:50:52', '2023-04-13 05:50:52'),
(4, 'test', ' تحليل', 'test', 'Lorem Ipsum is simply dummy text of the printing and typesetting industry.', 'وريم ايبسوم هو نموذج افتراضي يوضع في التصاميم لتعرض على العميل ليتصور طريقه وضع النصوص بالتصاميم سواء كانت تصاميم مطبوعه ... بروشور او فلاير على سبيل المثال ... او نماذج مواقع انترنت ', 'download.jpg', '300.00', 2, '2023-04-13 05:50:52', '2023-04-13 05:50:52'),
(5, 'CAT Scan', 'اشعة مقطعية ', 'cat-scan', 'Lorem Ipsum is simply dummy text of the printing and typesetting industry.', 'وريم ايبسوم هو نموذج افتراضي يوضع في التصاميم لتعرض على العميل ليتصور طريقه وضع النصوص بالتصاميم سواء كانت تصاميم مطبوعه ... بروشور او فلاير على سبيل المثال ... او نماذج مواقع انترنت', 'download.jpg', '1000.00', 2, '2023-04-13 05:50:52', '2023-04-13 05:50:52'),
(6, 'MRI Scan ', 'اشعة رنين ', 'mri-scan', 'Lorem Ipsum is simply dummy text of the printing and typesetting industry.', ' وريم ايبسوم هو نموذج افتراضي يوضع في التصاميم لتعرض على العميل ليتصور طريقه وضع النصوص بالتصاميم سواء كانت تصاميم مطبوعه ... بروشور او فلاير على سبيل المثال ... او نماذج مواقع انترنت ', 'download.jpg', '1000.00', 2, '2023-04-13 05:50:52', '2023-04-13 05:50:52'),
(7, 'test', ' تحليل', 'test', 'Lorem Ipsum is simply dummy text of the printing and typesetting industry.', 'وريم ايبسوم هو نموذج افتراضي يوضع في التصاميم لتعرض على العميل ليتصور طريقه وضع النصوص بالتصاميم سواء كانت تصاميم مطبوعه ... بروشور او فلاير على سبيل المثال ... او نماذج مواقع انترنت ', 'download.jpg', '300.00', 3, '2023-04-13 05:50:52', '2023-04-13 05:50:52'),
(8, 'CAT Scan', 'اشعة مقطعية ', 'cat-scan', 'Lorem Ipsum is simply dummy text of the printing and typesetting industry.', 'وريم ايبسوم هو نموذج افتراضي يوضع في التصاميم لتعرض على العميل ليتصور طريقه وضع النصوص بالتصاميم سواء كانت تصاميم مطبوعه ... بروشور او فلاير على سبيل المثال ... او نماذج مواقع انترنت', 'download.jpg', '1000.00', 3, '2023-04-13 05:50:52', '2023-04-13 05:50:52'),
(9, 'MRI Scan ', 'اشعة رنين ', 'mri-scan', 'Lorem Ipsum is simply dummy text of the printing and typesetting industry.', ' وريم ايبسوم هو نموذج افتراضي يوضع في التصاميم لتعرض على العميل ليتصور طريقه وضع النصوص بالتصاميم سواء كانت تصاميم مطبوعه ... بروشور او فلاير على سبيل المثال ... او نماذج مواقع انترنت ', 'download.jpg', '1000.00', 3, '2023-04-13 05:50:52', '2023-04-13 05:50:52'),
(10, 'Madeson Ramos', 'Portia Spence', 'madeson-ramos', 'Ut optio consequat', 'Sit veniam quasi di', '1681414303.png', '975.00', 1, '2023-04-13 16:31:43', '2023-04-13 16:31:43'),
(11, 'Clarke Carlson', 'Mufutau Salinas', 'clarke-carlson', 'Qui modi eligendi mo', 'Voluptas placeat in', '1681414521.png', '807.00', 2, '2023-04-13 16:35:21', '2023-04-13 16:35:21'),
(12, 'Uriah Haley', 'Macy Jordan', 'uriah-haley', 'Elit aspernatur et', 'Asperiores deleniti', '1681414599.png', '327.00', 3, '2023-04-13 16:36:39', '2023-04-13 16:36:39'),
(13, 'Montana Buchanan', 'Charity Carey', 'montana-buchanan', 'Sunt aliquip commod', 'Ullamco ut accusamus', '1681414702.png', '77.00', 1, '2023-04-13 16:38:22', '2023-04-13 16:48:23');

-- --------------------------------------------------------

--
-- Table structure for table `settings`
--

CREATE TABLE `settings` (
  `id` bigint UNSIGNED NOT NULL,
  `logo` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `favicon` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `phones` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `email` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `facebook` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `instagram` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `linkedin` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `twitter` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `title_en` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `title_ar` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `address_en` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci,
  `address_ar` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `settings`
--

INSERT INTO `settings` (`id`, `logo`, `favicon`, `phones`, `email`, `facebook`, `instagram`, `linkedin`, `twitter`, `title_en`, `title_ar`, `address_en`, `address_ar`, `created_at`, `updated_at`) VALUES
(1, '1681420525.png', '1681420525.png', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2023-04-13 18:11:10', '2023-04-13 18:15:25');

-- --------------------------------------------------------

--
-- Table structure for table `specialists`
--

CREATE TABLE `specialists` (
  `id` bigint UNSIGNED NOT NULL,
  `name_en` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `name_ar` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `slug` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `image` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `specialists`
--

INSERT INTO `specialists` (`id`, `name_en`, `name_ar`, `slug`, `image`, `created_at`, `updated_at`) VALUES
(1, ' Gynecology ', 'النساء والتوليد ', 'gynecology', 'fas fa-heartbeat', '2023-04-13 05:51:34', '2023-04-13 05:51:34'),
(2, 'pediatrics.', 'طب الأطفال', 'pediatrics', 'fas fa-pills', '2023-04-13 05:51:34', '2023-04-13 05:51:34'),
(3, 'Internal Medicine ', 'الباطنة العامة', 'internal-medicine', 'fas fa-hospital-user', '2023-04-13 05:51:34', '2023-04-13 05:51:34'),
(4, 'Orthopedics  ', 'العظام', 'orthopedics', 'fas fa-dna', '2023-04-13 05:51:34', '2023-04-13 05:51:34'),
(5, 'oral surgery ', 'جراحة الفم والأسنان ', 'oral-surgery', 'fas fa-wheelchair', '2023-04-13 05:51:34', '2023-04-13 05:51:34'),
(6, 'ENT', 'fas fa-notes-medical', 'ent', 'fas fa-heartbeat', '2023-04-13 05:51:34', '2023-04-13 05:51:34');

-- --------------------------------------------------------

--
-- Table structure for table `sub_service`
--

CREATE TABLE `sub_service` (
  `id` bigint UNSIGNED NOT NULL,
  `service_id` bigint UNSIGNED NOT NULL,
  `name_en` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `name_ar` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `slug` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `description_en` text COLLATE utf8mb4_unicode_ci,
  `description_ar` text COLLATE utf8mb4_unicode_ci,
  `price` decimal(8,2) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `sub_specialists`
--

CREATE TABLE `sub_specialists` (
  `id` bigint UNSIGNED NOT NULL,
  `name_en` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `name_ar` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `slug` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `specialist_id` bigint UNSIGNED NOT NULL,
  `image` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `sub_specialists`
--

INSERT INTO `sub_specialists` (`id`, `name_en`, `name_ar`, `slug`, `specialist_id`, `image`, `created_at`, `updated_at`) VALUES
(1, ' Gynecology-1 ', '-1النساء والتوليد ', 'gynecology-1', 1, NULL, '2023-04-13 05:51:56', '2023-04-13 05:51:56'),
(2, ' Gynecology-2 ', '-2النساء والتوليد ', 'gynecology-2', 1, NULL, '2023-04-13 05:51:56', '2023-04-13 05:51:56'),
(3, 'pediatrics-1', '-1طب الأطفال', 'pediatrics-1', 2, NULL, '2023-04-13 05:51:56', '2023-04-13 05:51:56'),
(4, 'pediatrics-2', '-2طب الأطفال', 'pediatrics-2', 2, NULL, '2023-04-13 05:51:56', '2023-04-13 05:51:56'),
(5, 'Internal Medicine-1 ', '-1الباطنة العامة', 'internal-medicine-1', 3, NULL, '2023-04-13 05:51:56', '2023-04-13 05:51:56'),
(6, 'Internal Medicine-2 ', '-2الباطنة العامة', 'internal-medicine-2', 3, NULL, '2023-04-13 05:51:56', '2023-04-13 05:51:56'),
(7, 'Orthopedics-1  ', '-1العظام', 'orthopedics-1', 4, NULL, '2023-04-13 05:51:56', '2023-04-13 05:51:56'),
(8, 'Orthopedics-1  ', '-1العظام', 'orthopedics-1', 4, NULL, '2023-04-13 05:51:56', '2023-04-13 05:51:56'),
(9, ', oral surgery-1', '-1جراحة الفم والأسنان ', 'oral-surgery-1', 5, NULL, '2023-04-13 05:51:56', '2023-04-13 05:51:56'),
(10, ', oral surgery-2', '-2جراحة الفم والأسنان ', 'oral-surgery-2', 5, NULL, '2023-04-13 05:51:56', '2023-04-13 05:51:56'),
(11, 'ENT-1', '-1الأنف والأذن والحنجرة', 'ent-1', 6, NULL, '2023-04-13 05:51:56', '2023-04-13 05:51:56'),
(12, 'ENT-2', '-2الأنف والأذن والحنجرة', 'ent-2', 6, NULL, '2023-04-13 05:51:56', '2023-04-13 05:51:56'),
(13, ' Gynecology-1 ', '-1النساء والتوليد ', 'gynecology-1', 1, NULL, '2023-04-13 05:53:48', '2023-04-13 05:53:48'),
(14, ' Gynecology-2 ', '-2النساء والتوليد ', 'gynecology-2', 1, NULL, '2023-04-13 05:53:48', '2023-04-13 05:53:48'),
(15, 'pediatrics-1', '-1طب الأطفال', 'pediatrics-1', 2, NULL, '2023-04-13 05:53:48', '2023-04-13 05:53:48'),
(16, 'pediatrics-2', '-2طب الأطفال', 'pediatrics-2', 2, NULL, '2023-04-13 05:53:48', '2023-04-13 05:53:48'),
(17, 'Internal Medicine-1 ', '-1الباطنة العامة', 'internal-medicine-1', 3, NULL, '2023-04-13 05:53:48', '2023-04-13 05:53:48'),
(18, 'Internal Medicine-2 ', '-2الباطنة العامة', 'internal-medicine-2', 3, NULL, '2023-04-13 05:53:48', '2023-04-13 05:53:48'),
(19, 'Orthopedics-1  ', '-1العظام', 'orthopedics-1', 4, NULL, '2023-04-13 05:53:48', '2023-04-13 05:53:48'),
(20, 'Orthopedics-1  ', '-1العظام', 'orthopedics-1', 4, NULL, '2023-04-13 05:53:48', '2023-04-13 05:53:48'),
(21, ', oral surgery-1', '-1جراحة الفم والأسنان ', 'oral-surgery-1', 5, NULL, '2023-04-13 05:53:48', '2023-04-13 05:53:48'),
(22, ', oral surgery-2', '-2جراحة الفم والأسنان ', 'oral-surgery-2', 5, NULL, '2023-04-13 05:53:48', '2023-04-13 05:53:48'),
(23, 'ENT-1', '-1الأنف والأذن والحنجرة', 'ent-1', 6, NULL, '2023-04-13 05:53:48', '2023-04-13 05:53:48'),
(24, 'ENT-2', '-2الأنف والأذن والحنجرة', 'ent-2', 6, NULL, '2023-04-13 05:53:48', '2023-04-13 05:53:48'),
(25, 'Yen Garza', 'Roanna Simmons', 'yen-garza', 4, '1681413616.png', '2023-04-13 16:20:16', '2023-04-13 16:20:16');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` bigint UNSIGNED NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `phone` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `email_verified_at` timestamp NULL DEFAULT NULL,
  `password` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `remember_token` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `image` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `department_id` bigint UNSIGNED DEFAULT NULL,
  `branch_id` bigint UNSIGNED DEFAULT NULL,
  `roles_name` text COLLATE utf8mb4_unicode_ci,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `name`, `email`, `phone`, `email_verified_at`, `password`, `remember_token`, `image`, `department_id`, `branch_id`, `roles_name`, `created_at`, `updated_at`, `deleted_at`) VALUES
(1, 'admin', 'admin@gmail.com', '+123456', NULL, '$2y$10$soe4sT3lIal2X.m3wmV3/uHri02wSWSlFDflrxFuh6r3aIi.XuQuW', NULL, NULL, 7, 1, '[\"superadmin\"]', '2023-04-13 05:49:31', '2023-04-13 05:49:31', NULL),
(2, 'reception', 'reception@gmail.com', '1234', NULL, '$2y$10$f284tonMEOFxqD/HMm25euFIRzqMo7kAC0nf4RanhhBmdCulunRl.', NULL, NULL, 2, 1, '[\"reception\"]', '2023-04-13 06:04:20', '2023-04-13 10:34:22', NULL),
(4, 'admin2', 'admin2@gmail.com', '876543', NULL, '$2y$10$ZibKob5OwNgtMmEz/mW41ekKb0mk7Wr2lTDuwuZyO/iDL09mjnpMa', NULL, NULL, 15, 2, '[\"admin\"]', '2023-04-13 08:24:57', '2023-04-13 08:24:57', NULL),
(5, 'reception11', 'reception11@gmail.com', '123456', NULL, '$2y$10$yKPPhXuvTxyJAoilREpIUe36RpF5hN5lk9HXDL11UZbsTtRhwSCwm', NULL, NULL, 2, 1, '[\"reception\"]', '2023-04-13 09:49:28', '2023-04-13 09:49:28', NULL),
(6, 'admin1', 'admin1@gmail.com', '2345678', NULL, '$2y$10$BHyLeDJ4JhODlETyAK8Tz.nXd9AYlncPTxw1wgv1ZTR2ZeiMfnMKO', NULL, '1681406845.png', 8, 1, '[\"admin\"]', '2023-04-13 14:27:25', '2023-04-13 14:27:25', NULL),
(7, 'Mark Mcconnell', 'somek@mailinator.com', '+1 (981) 456-2038', NULL, '$2y$10$YfFhjxMtiNQ5KPH3qrM4xOgCi8V4wLb49fgSKVnbL/jFxD4VIkK8u', NULL, NULL, 4, 1, '[\"reception\"]', '2023-04-13 14:52:32', '2023-04-13 14:52:32', NULL),
(8, 'financial', 'financial3@gmail.com', '432', NULL, '$2y$10$MyAXAGlp9VC82yXK6mvOcOCCAX2H4rKpj3aBCkK5tt/zsqVjv2ZnC', NULL, NULL, 19, 3, '[\"financial\"]', '2023-04-13 18:38:55', '2023-04-13 18:38:55', NULL);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `appointments`
--
ALTER TABLE `appointments`
  ADD PRIMARY KEY (`id`),
  ADD KEY `appointments_doctor_id_foreign` (`doctor_id`),
  ADD KEY `appointments_day_id_foreign` (`day_id`);

--
-- Indexes for table `branches`
--
ALTER TABLE `branches`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `branches_slug_unique` (`slug`);

--
-- Indexes for table `clients`
--
ALTER TABLE `clients`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `clients_email_unique` (`email`),
  ADD KEY `clients_branch_id_foreign` (`branch_id`);

--
-- Indexes for table `days`
--
ALTER TABLE `days`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `departments`
--
ALTER TABLE `departments`
  ADD PRIMARY KEY (`id`),
  ADD KEY `departments_branch_id_foreign` (`branch_id`);

--
-- Indexes for table `doctors`
--
ALTER TABLE `doctors`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `doctors_email_unique` (`email`),
  ADD KEY `doctors_branch_id_foreign` (`branch_id`),
  ADD KEY `doctors_specialist_id_foreign` (`specialist_id`),
  ADD KEY `doctors_professional_title_id_foreign` (`professional_title_id`),
  ADD KEY `doctors_doctor_title_id_foreign` (`doctor_title_id`);

--
-- Indexes for table `doctor_day`
--
ALTER TABLE `doctor_day`
  ADD PRIMARY KEY (`id`),
  ADD KEY `doctor_day_doctor_id_foreign` (`doctor_id`),
  ADD KEY `doctor_day_day_id_foreign` (`day_id`);

--
-- Indexes for table `doctor_offer`
--
ALTER TABLE `doctor_offer`
  ADD PRIMARY KEY (`id`),
  ADD KEY `doctor_offer_doctor_id_foreign` (`doctor_id`),
  ADD KEY `doctor_offer_offer_id_foreign` (`offer_id`);

--
-- Indexes for table `doctor_sub_specialist`
--
ALTER TABLE `doctor_sub_specialist`
  ADD PRIMARY KEY (`id`),
  ADD KEY `doctor_sub_specialist_doctor_id_foreign` (`doctor_id`),
  ADD KEY `doctor_sub_specialist_sub_specialist_id_foreign` (`sub_specialist_id`);

--
-- Indexes for table `doctor_titles`
--
ALTER TABLE `doctor_titles`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `failed_jobs`
--
ALTER TABLE `failed_jobs`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `failed_jobs_uuid_unique` (`uuid`);

--
-- Indexes for table `images`
--
ALTER TABLE `images`
  ADD PRIMARY KEY (`id`),
  ADD KEY `images_imagable_type_imagable_id_index` (`imagable_type`,`imagable_id`);

--
-- Indexes for table `invoices`
--
ALTER TABLE `invoices`
  ADD PRIMARY KEY (`id`),
  ADD KEY `invoices_reservation_id_foreign` (`reservation_id`);

--
-- Indexes for table `migrations`
--
ALTER TABLE `migrations`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `model_has_permissions`
--
ALTER TABLE `model_has_permissions`
  ADD PRIMARY KEY (`permission_id`,`model_id`,`model_type`),
  ADD KEY `model_has_permissions_model_id_model_type_index` (`model_id`,`model_type`);

--
-- Indexes for table `model_has_roles`
--
ALTER TABLE `model_has_roles`
  ADD PRIMARY KEY (`role_id`,`model_id`,`model_type`),
  ADD KEY `model_has_roles_model_id_model_type_index` (`model_id`,`model_type`);

--
-- Indexes for table `notifications`
--
ALTER TABLE `notifications`
  ADD PRIMARY KEY (`id`),
  ADD KEY `notifications_notifiable_type_notifiable_id_index` (`notifiable_type`,`notifiable_id`);

--
-- Indexes for table `offers`
--
ALTER TABLE `offers`
  ADD PRIMARY KEY (`id`),
  ADD KEY `offers_branch_id_foreign` (`branch_id`);

--
-- Indexes for table `password_reset_tokens`
--
ALTER TABLE `password_reset_tokens`
  ADD PRIMARY KEY (`email`);

--
-- Indexes for table `payment_methods`
--
ALTER TABLE `payment_methods`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `permissions`
--
ALTER TABLE `permissions`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `permissions_name_guard_name_unique` (`name`,`guard_name`);

--
-- Indexes for table `personal_access_tokens`
--
ALTER TABLE `personal_access_tokens`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `personal_access_tokens_token_unique` (`token`),
  ADD KEY `personal_access_tokens_tokenable_type_tokenable_id_index` (`tokenable_type`,`tokenable_id`);

--
-- Indexes for table `professional_titles`
--
ALTER TABLE `professional_titles`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `reservations`
--
ALTER TABLE `reservations`
  ADD PRIMARY KEY (`id`),
  ADD KEY `reservations_branch_id_foreign` (`branch_id`),
  ADD KEY `reservations_client_id_foreign` (`client_id`),
  ADD KEY `reservations_doctor_id_foreign` (`doctor_id`),
  ADD KEY `reservations_sub_specialist_id_foreign` (`sub_specialist_id`),
  ADD KEY `reservations_specialist_id_foreign` (`specialist_id`),
  ADD KEY `reservations_payment_method_id_foreign` (`payment_method_id`);

--
-- Indexes for table `reservation_service`
--
ALTER TABLE `reservation_service`
  ADD PRIMARY KEY (`id`),
  ADD KEY `reservation_service_reservation_id_foreign` (`reservation_id`),
  ADD KEY `reservation_service_service_id_foreign` (`service_id`);

--
-- Indexes for table `roles`
--
ALTER TABLE `roles`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `roles_name_guard_name_unique` (`name`,`guard_name`);

--
-- Indexes for table `role_has_permissions`
--
ALTER TABLE `role_has_permissions`
  ADD PRIMARY KEY (`permission_id`,`role_id`),
  ADD KEY `role_has_permissions_role_id_foreign` (`role_id`);

--
-- Indexes for table `salaries`
--
ALTER TABLE `salaries`
  ADD PRIMARY KEY (`id`),
  ADD KEY `salaries_salariable_type_salariable_id_index` (`salariable_type`,`salariable_id`),
  ADD KEY `salaries_branch_id_foreign` (`branch_id`);

--
-- Indexes for table `services`
--
ALTER TABLE `services`
  ADD PRIMARY KEY (`id`),
  ADD KEY `services_branch_id_foreign` (`branch_id`);

--
-- Indexes for table `settings`
--
ALTER TABLE `settings`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `specialists`
--
ALTER TABLE `specialists`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `sub_service`
--
ALTER TABLE `sub_service`
  ADD PRIMARY KEY (`id`),
  ADD KEY `sub_service_service_id_foreign` (`service_id`);

--
-- Indexes for table `sub_specialists`
--
ALTER TABLE `sub_specialists`
  ADD PRIMARY KEY (`id`),
  ADD KEY `sub_specialists_specialist_id_foreign` (`specialist_id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `users_email_unique` (`email`),
  ADD KEY `users_department_id_foreign` (`department_id`),
  ADD KEY `users_branch_id_foreign` (`branch_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `appointments`
--
ALTER TABLE `appointments`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=41;

--
-- AUTO_INCREMENT for table `branches`
--
ALTER TABLE `branches`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `clients`
--
ALTER TABLE `clients`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `days`
--
ALTER TABLE `days`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `departments`
--
ALTER TABLE `departments`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=25;

--
-- AUTO_INCREMENT for table `doctors`
--
ALTER TABLE `doctors`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `doctor_day`
--
ALTER TABLE `doctor_day`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `doctor_offer`
--
ALTER TABLE `doctor_offer`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `doctor_sub_specialist`
--
ALTER TABLE `doctor_sub_specialist`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `doctor_titles`
--
ALTER TABLE `doctor_titles`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `failed_jobs`
--
ALTER TABLE `failed_jobs`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `images`
--
ALTER TABLE `images`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `invoices`
--
ALTER TABLE `invoices`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `migrations`
--
ALTER TABLE `migrations`
  MODIFY `id` int UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=30;

--
-- AUTO_INCREMENT for table `offers`
--
ALTER TABLE `offers`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `payment_methods`
--
ALTER TABLE `payment_methods`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `permissions`
--
ALTER TABLE `permissions`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=69;

--
-- AUTO_INCREMENT for table `personal_access_tokens`
--
ALTER TABLE `personal_access_tokens`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `professional_titles`
--
ALTER TABLE `professional_titles`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `reservations`
--
ALTER TABLE `reservations`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `reservation_service`
--
ALTER TABLE `reservation_service`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `roles`
--
ALTER TABLE `roles`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `salaries`
--
ALTER TABLE `salaries`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT for table `services`
--
ALTER TABLE `services`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;

--
-- AUTO_INCREMENT for table `settings`
--
ALTER TABLE `settings`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `specialists`
--
ALTER TABLE `specialists`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `sub_service`
--
ALTER TABLE `sub_service`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `sub_specialists`
--
ALTER TABLE `sub_specialists`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=26;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `appointments`
--
ALTER TABLE `appointments`
  ADD CONSTRAINT `appointments_day_id_foreign` FOREIGN KEY (`day_id`) REFERENCES `days` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `appointments_doctor_id_foreign` FOREIGN KEY (`doctor_id`) REFERENCES `doctors` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `clients`
--
ALTER TABLE `clients`
  ADD CONSTRAINT `clients_branch_id_foreign` FOREIGN KEY (`branch_id`) REFERENCES `branches` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `departments`
--
ALTER TABLE `departments`
  ADD CONSTRAINT `departments_branch_id_foreign` FOREIGN KEY (`branch_id`) REFERENCES `branches` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `doctors`
--
ALTER TABLE `doctors`
  ADD CONSTRAINT `doctors_branch_id_foreign` FOREIGN KEY (`branch_id`) REFERENCES `branches` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `doctors_doctor_title_id_foreign` FOREIGN KEY (`doctor_title_id`) REFERENCES `doctor_titles` (`id`) ON DELETE SET NULL ON UPDATE SET NULL,
  ADD CONSTRAINT `doctors_professional_title_id_foreign` FOREIGN KEY (`professional_title_id`) REFERENCES `professional_titles` (`id`) ON DELETE SET NULL ON UPDATE SET NULL,
  ADD CONSTRAINT `doctors_specialist_id_foreign` FOREIGN KEY (`specialist_id`) REFERENCES `specialists` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `doctor_day`
--
ALTER TABLE `doctor_day`
  ADD CONSTRAINT `doctor_day_day_id_foreign` FOREIGN KEY (`day_id`) REFERENCES `days` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `doctor_day_doctor_id_foreign` FOREIGN KEY (`doctor_id`) REFERENCES `doctors` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `doctor_offer`
--
ALTER TABLE `doctor_offer`
  ADD CONSTRAINT `doctor_offer_doctor_id_foreign` FOREIGN KEY (`doctor_id`) REFERENCES `doctors` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `doctor_offer_offer_id_foreign` FOREIGN KEY (`offer_id`) REFERENCES `offers` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `doctor_sub_specialist`
--
ALTER TABLE `doctor_sub_specialist`
  ADD CONSTRAINT `doctor_sub_specialist_doctor_id_foreign` FOREIGN KEY (`doctor_id`) REFERENCES `doctors` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `doctor_sub_specialist_sub_specialist_id_foreign` FOREIGN KEY (`sub_specialist_id`) REFERENCES `sub_specialists` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `invoices`
--
ALTER TABLE `invoices`
  ADD CONSTRAINT `invoices_reservation_id_foreign` FOREIGN KEY (`reservation_id`) REFERENCES `reservations` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `model_has_permissions`
--
ALTER TABLE `model_has_permissions`
  ADD CONSTRAINT `model_has_permissions_permission_id_foreign` FOREIGN KEY (`permission_id`) REFERENCES `permissions` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `model_has_roles`
--
ALTER TABLE `model_has_roles`
  ADD CONSTRAINT `model_has_roles_role_id_foreign` FOREIGN KEY (`role_id`) REFERENCES `roles` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `offers`
--
ALTER TABLE `offers`
  ADD CONSTRAINT `offers_branch_id_foreign` FOREIGN KEY (`branch_id`) REFERENCES `branches` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `reservations`
--
ALTER TABLE `reservations`
  ADD CONSTRAINT `reservations_branch_id_foreign` FOREIGN KEY (`branch_id`) REFERENCES `branches` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `reservations_client_id_foreign` FOREIGN KEY (`client_id`) REFERENCES `clients` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `reservations_doctor_id_foreign` FOREIGN KEY (`doctor_id`) REFERENCES `doctors` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `reservations_payment_method_id_foreign` FOREIGN KEY (`payment_method_id`) REFERENCES `payment_methods` (`id`) ON DELETE SET NULL ON UPDATE SET NULL,
  ADD CONSTRAINT `reservations_specialist_id_foreign` FOREIGN KEY (`specialist_id`) REFERENCES `specialists` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `reservations_sub_specialist_id_foreign` FOREIGN KEY (`sub_specialist_id`) REFERENCES `sub_specialists` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `reservation_service`
--
ALTER TABLE `reservation_service`
  ADD CONSTRAINT `reservation_service_reservation_id_foreign` FOREIGN KEY (`reservation_id`) REFERENCES `reservations` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `reservation_service_service_id_foreign` FOREIGN KEY (`service_id`) REFERENCES `services` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `role_has_permissions`
--
ALTER TABLE `role_has_permissions`
  ADD CONSTRAINT `role_has_permissions_permission_id_foreign` FOREIGN KEY (`permission_id`) REFERENCES `permissions` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `role_has_permissions_role_id_foreign` FOREIGN KEY (`role_id`) REFERENCES `roles` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `salaries`
--
ALTER TABLE `salaries`
  ADD CONSTRAINT `salaries_branch_id_foreign` FOREIGN KEY (`branch_id`) REFERENCES `branches` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `services`
--
ALTER TABLE `services`
  ADD CONSTRAINT `services_branch_id_foreign` FOREIGN KEY (`branch_id`) REFERENCES `branches` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `sub_service`
--
ALTER TABLE `sub_service`
  ADD CONSTRAINT `sub_service_service_id_foreign` FOREIGN KEY (`service_id`) REFERENCES `services` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `sub_specialists`
--
ALTER TABLE `sub_specialists`
  ADD CONSTRAINT `sub_specialists_specialist_id_foreign` FOREIGN KEY (`specialist_id`) REFERENCES `specialists` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `users`
--
ALTER TABLE `users`
  ADD CONSTRAINT `users_branch_id_foreign` FOREIGN KEY (`branch_id`) REFERENCES `branches` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `users_department_id_foreign` FOREIGN KEY (`department_id`) REFERENCES `departments` (`id`) ON DELETE SET NULL ON UPDATE SET NULL;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
