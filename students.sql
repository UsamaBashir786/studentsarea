-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1:3306
-- Generation Time: Feb 25, 2026 at 05:08 AM
-- Server version: 9.1.0
-- PHP Version: 8.3.14

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `students`
--

DELIMITER $$
--
-- Procedures
--
DROP PROCEDURE IF EXISTS `sp_cleanup_sessions`$$
CREATE DEFINER=`root`@`localhost` PROCEDURE `sp_cleanup_sessions` ()   BEGIN
    DELETE FROM sessions WHERE session_expires < UNIX_TIMESTAMP();
END$$

DROP PROCEDURE IF EXISTS `sp_expire_old_jobs`$$
CREATE DEFINER=`root`@`localhost` PROCEDURE `sp_expire_old_jobs` ()   BEGIN
    UPDATE job_postings 
    SET status = 'closed' 
    WHERE expires_at IS NOT NULL 
      AND expires_at < NOW() 
      AND status = 'active';
END$$

DROP PROCEDURE IF EXISTS `sp_user_activity_summary`$$
CREATE DEFINER=`root`@`localhost` PROCEDURE `sp_user_activity_summary` (IN `user_id_param` INT)   BEGIN
    SELECT 
        DATE(created_at) as activity_date,
        action,
        COUNT(*) as action_count
    FROM activity_logs
    WHERE user_id = user_id_param
    GROUP BY DATE(created_at), action
    ORDER BY activity_date DESC
    LIMIT 30;
END$$

DELIMITER ;

-- --------------------------------------------------------

--
-- Table structure for table `activity_logs`
--

DROP TABLE IF EXISTS `activity_logs`;
CREATE TABLE IF NOT EXISTS `activity_logs` (
  `id` int NOT NULL AUTO_INCREMENT,
  `user_id` int DEFAULT NULL,
  `action` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
  `ip_address` varchar(45) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `user_agent` text COLLATE utf8mb4_unicode_ci,
  `details` text COLLATE utf8mb4_unicode_ci,
  `created_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`),
  KEY `idx_user_id` (`user_id`),
  KEY `idx_action` (`action`),
  KEY `idx_created_at` (`created_at`),
  KEY `idx_ip_address` (`ip_address`)
) ENGINE=InnoDB AUTO_INCREMENT=20 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `activity_logs`
--

INSERT INTO `activity_logs` (`id`, `user_id`, `action`, `ip_address`, `user_agent`, `details`, `created_at`) VALUES
(1, 2, 'register', '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/145.0.0.0 Safari/537.36', 'New user registered', '2026-02-25 04:17:36'),
(2, 2, 'author_application', '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/145.0.0.0 Safari/537.36', 'Submitted author application', '2026-02-25 04:18:10'),
(3, 2, 'author_application', '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/145.0.0.0 Safari/537.36', 'Submitted author application', '2026-02-25 04:21:08'),
(4, 2, 'author_application', '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/145.0.0.0 Safari/537.36', 'Submitted author application', '2026-02-25 04:23:54'),
(5, 2, 'logout', '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/145.0.0.0 Safari/537.36', 'User logged out', '2026-02-25 04:25:30'),
(6, 2, 'login', '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/145.0.0.0 Safari/537.36', 'User logged in', '2026-02-25 04:25:43'),
(7, 2, 'logout', '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/145.0.0.0 Safari/537.36', 'User logged out', '2026-02-25 04:28:17'),
(8, 2, 'login', '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/145.0.0.0 Safari/537.36', 'User logged in', '2026-02-25 04:28:24'),
(9, 2, 'logout', '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/145.0.0.0 Safari/537.36', 'User logged out', '2026-02-25 04:29:04'),
(10, 2, 'login', '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/145.0.0.0 Safari/537.36', 'User logged in', '2026-02-25 04:29:10'),
(11, 2, 'logout', '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/145.0.0.0 Safari/537.36', 'User logged out', '2026-02-25 04:30:50'),
(12, 2, 'login', '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/145.0.0.0 Safari/537.36', 'User logged in', '2026-02-25 04:30:57'),
(13, 2, 'logout', '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/145.0.0.0 Safari/537.36', 'User logged out', '2026-02-25 04:33:16'),
(14, 2, 'login', '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/145.0.0.0 Safari/537.36', 'User logged in', '2026-02-25 04:33:21'),
(15, 2, 'company_application', '::1', NULL, 'Submitted company application for test', '2026-02-25 05:04:40'),
(16, 2, 'company_application', '::1', NULL, 'Submitted company application for test', '2026-02-25 05:05:00'),
(17, 2, 'company_application', '::1', NULL, 'Submitted company application for test', '2026-02-25 05:05:21'),
(18, 2, 'company_application', '::1', NULL, 'Submitted company application for test', '2026-02-25 05:06:11'),
(19, 2, 'company_application', '::1', NULL, 'Submitted company application for test', '2026-02-25 05:06:57');

-- --------------------------------------------------------

--
-- Table structure for table `author_applications`
--

DROP TABLE IF EXISTS `author_applications`;
CREATE TABLE IF NOT EXISTS `author_applications` (
  `id` int NOT NULL AUTO_INCREMENT,
  `user_id` int NOT NULL,
  `full_name` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
  `expertise` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
  `bio` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `portfolio_url` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `writing_samples` text COLLATE utf8mb4_unicode_ci,
  `status` enum('pending','approved','rejected') COLLATE utf8mb4_unicode_ci DEFAULT 'pending',
  `submitted_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  `reviewed_at` timestamp NULL DEFAULT NULL,
  `reviewed_by` int DEFAULT NULL,
  `admin_notes` text COLLATE utf8mb4_unicode_ci,
  PRIMARY KEY (`id`),
  KEY `reviewed_by` (`reviewed_by`),
  KEY `idx_status` (`status`),
  KEY `idx_user_id` (`user_id`),
  KEY `idx_submitted_at` (`submitted_at`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `author_applications`
--

INSERT INTO `author_applications` (`id`, `user_id`, `full_name`, `expertise`, `bio`, `portfolio_url`, `writing_samples`, `status`, `submitted_at`, `reviewed_at`, `reviewed_by`, `admin_notes`) VALUES
(1, 2, 'test', 'design', 'test', 'https://claude.ai/chat/', 'test', 'approved', '2026-02-25 04:18:10', NULL, NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `categories`
--

DROP TABLE IF EXISTS `categories`;
CREATE TABLE IF NOT EXISTS `categories` (
  `id` int NOT NULL AUTO_INCREMENT,
  `name` varchar(50) COLLATE utf8mb4_unicode_ci NOT NULL,
  `slug` varchar(50) COLLATE utf8mb4_unicode_ci NOT NULL,
  `description` text COLLATE utf8mb4_unicode_ci,
  `icon` varchar(50) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `parent_id` int DEFAULT NULL,
  `sort_order` int DEFAULT '0',
  `is_active` tinyint(1) DEFAULT '1',
  `created_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`),
  UNIQUE KEY `name` (`name`),
  UNIQUE KEY `slug` (`slug`),
  KEY `parent_id` (`parent_id`),
  KEY `idx_slug` (`slug`),
  KEY `idx_is_active` (`is_active`),
  KEY `idx_sort_order` (`sort_order`)
) ENGINE=InnoDB AUTO_INCREMENT=11 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `categories`
--

INSERT INTO `categories` (`id`, `name`, `slug`, `description`, `icon`, `parent_id`, `sort_order`, `is_active`, `created_at`) VALUES
(1, 'Technology', 'technology', 'Jobs in software development, IT, and tech support', 'fas fa-laptop-code', NULL, 1, 1, '2026-02-25 04:17:04'),
(2, 'Design', 'design', 'Graphic design, UI/UX, and creative roles', 'fas fa-paint-brush', NULL, 2, 1, '2026-02-25 04:17:04'),
(3, 'Marketing', 'marketing', 'Digital marketing, SEO, and content creation', 'fas fa-chart-line', NULL, 3, 1, '2026-02-25 04:17:04'),
(4, 'Writing', 'writing', 'Content writing, copywriting, and editorial', 'fas fa-pen', NULL, 4, 1, '2026-02-25 04:17:04'),
(5, 'Business', 'business', 'Business development, sales, and management', 'fas fa-briefcase', NULL, 5, 1, '2026-02-25 04:17:04'),
(6, 'Education', 'education', 'Teaching, tutoring, and academic roles', 'fas fa-graduation-cap', NULL, 6, 1, '2026-02-25 04:17:04'),
(7, 'Finance', 'finance', 'Accounting, banking, and financial services', 'fas fa-coins', NULL, 7, 1, '2026-02-25 04:17:04'),
(8, 'Healthcare', 'healthcare', 'Medical, nursing, and healthcare roles', 'fas fa-heartbeat', NULL, 8, 1, '2026-02-25 04:17:04'),
(9, 'Engineering', 'engineering', 'Civil, mechanical, and electrical engineering', 'fas fa-cogs', NULL, 9, 1, '2026-02-25 04:17:04'),
(10, 'Other', 'other', 'Other job categories', 'fas fa-ellipsis-h', NULL, 10, 1, '2026-02-25 04:17:04');

-- --------------------------------------------------------

--
-- Table structure for table `company_applications`
--

DROP TABLE IF EXISTS `company_applications`;
CREATE TABLE IF NOT EXISTS `company_applications` (
  `id` int NOT NULL AUTO_INCREMENT,
  `user_id` int NOT NULL,
  `company_name` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
  `industry` varchar(50) COLLATE utf8mb4_unicode_ci NOT NULL,
  `website` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `company_size` varchar(50) COLLATE utf8mb4_unicode_ci NOT NULL,
  `description` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `contact_person` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
  `contact_position` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
  `status` enum('pending','approved','rejected') COLLATE utf8mb4_unicode_ci DEFAULT 'pending',
  `submitted_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  `reviewed_at` timestamp NULL DEFAULT NULL,
  `reviewed_by` int DEFAULT NULL,
  `admin_notes` text COLLATE utf8mb4_unicode_ci,
  PRIMARY KEY (`id`),
  KEY `reviewed_by` (`reviewed_by`),
  KEY `idx_status` (`status`),
  KEY `idx_user_id` (`user_id`),
  KEY `idx_company_name` (`company_name`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `company_applications_new`
--

DROP TABLE IF EXISTS `company_applications_new`;
CREATE TABLE IF NOT EXISTS `company_applications_new` (
  `id` int NOT NULL AUTO_INCREMENT,
  `user_id` int NOT NULL,
  `company_name` varchar(100) NOT NULL,
  `company_type` varchar(50) NOT NULL,
  `industry` varchar(50) NOT NULL,
  `company_size` varchar(50) NOT NULL,
  `website` varchar(255) NOT NULL,
  `description` text NOT NULL,
  `address` text,
  `contact_name` varchar(100) NOT NULL,
  `contact_position` varchar(100) NOT NULL,
  `contact_email` varchar(100) NOT NULL,
  `contact_phone` varchar(20) NOT NULL,
  `selected_package` varchar(50) NOT NULL,
  `status` enum('pending','approved','rejected') DEFAULT 'pending',
  `admin_notes` text,
  `submitted_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  `reviewed_at` timestamp NULL DEFAULT NULL,
  `reviewed_by` int DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `user_id` (`user_id`),
  KEY `reviewed_by` (`reviewed_by`),
  KEY `idx_status` (`status`),
  KEY `idx_submitted_at` (`submitted_at`),
  KEY `idx_company_name` (`company_name`)
) ENGINE=MyISAM AUTO_INCREMENT=6 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `company_applications_new`
--

INSERT INTO `company_applications_new` (`id`, `user_id`, `company_name`, `company_type`, `industry`, `company_size`, `website`, `description`, `address`, `contact_name`, `contact_position`, `contact_email`, `contact_phone`, `selected_package`, `status`, `admin_notes`, `submitted_at`, `reviewed_at`, `reviewed_by`) VALUES
(1, 2, 'test', 'Startup', 'Consulting', '1-10', 'https://claude.ai/chat/aced359a-d641-4f6f-9091-ab0c6be65d6e', 'test', 'test', 'test', 'test', 'test@test.com', '03196977218', 'standard', 'pending', NULL, '2026-02-25 05:04:40', NULL, NULL),
(2, 2, 'test', 'Startup', 'Consulting', '1-10', 'https://claude.ai/chat/aced359a-d641-4f6f-9091-ab0c6be65d6e', 'test', 'test', 'test', 'test', 'test@test.com', '03196977218', 'premium', 'pending', NULL, '2026-02-25 05:05:00', NULL, NULL),
(3, 2, 'test', 'Startup', 'Consulting', '1-10', 'https://claude.ai/chat/aced359a-d641-4f6f-9091-ab0c6be65d6e', 'test', 'test', 'test', 'test', 'test@test.com', '03196977218', 'standard', 'pending', NULL, '2026-02-25 05:05:21', NULL, NULL),
(4, 2, 'test', 'Startup', 'Consulting', '1-10', 'https://claude.ai/chat/aced359a-d641-4f6f-9091-ab0c6be65d6e', 'test', 'test', 'test', 'test', 'test@test.com', '03196977218', 'standard', 'pending', NULL, '2026-02-25 05:06:11', NULL, NULL),
(5, 2, 'test', 'Startup', 'Consulting', '1-10', 'https://claude.ai/chat/aced359a-d641-4f6f-9091-ab0c6be65d6e', 'test', 'test', 'test', 'test', 'test@test.com', '03196977218', 'standard', 'pending', NULL, '2026-02-25 05:06:57', NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `company_contacts`
--

DROP TABLE IF EXISTS `company_contacts`;
CREATE TABLE IF NOT EXISTS `company_contacts` (
  `id` int NOT NULL AUTO_INCREMENT,
  `company_id` int NOT NULL,
  `contact_name` varchar(100) NOT NULL,
  `contact_position` varchar(100) NOT NULL,
  `contact_email` varchar(100) NOT NULL,
  `contact_phone` varchar(20) NOT NULL,
  `is_primary` tinyint(1) DEFAULT '1',
  `created_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`),
  KEY `idx_company_id` (`company_id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

-- --------------------------------------------------------

--
-- Table structure for table `company_documents`
--

DROP TABLE IF EXISTS `company_documents`;
CREATE TABLE IF NOT EXISTS `company_documents` (
  `id` int NOT NULL AUTO_INCREMENT,
  `company_id` int NOT NULL,
  `document_type` enum('registration','tax','additional') NOT NULL,
  `document_name` varchar(255) NOT NULL,
  `document_path` varchar(500) NOT NULL,
  `file_size` int DEFAULT NULL,
  `mime_type` varchar(100) DEFAULT NULL,
  `uploaded_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`),
  KEY `idx_company_id` (`company_id`),
  KEY `idx_document_type` (`document_type`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

-- --------------------------------------------------------

--
-- Table structure for table `company_profiles`
--

DROP TABLE IF EXISTS `company_profiles`;
CREATE TABLE IF NOT EXISTS `company_profiles` (
  `id` int NOT NULL AUTO_INCREMENT,
  `user_id` int NOT NULL,
  `company_name` varchar(100) NOT NULL,
  `company_type` varchar(50) NOT NULL,
  `industry` varchar(50) NOT NULL,
  `company_size` varchar(50) NOT NULL,
  `website` varchar(255) NOT NULL,
  `description` text NOT NULL,
  `address` text,
  `verification_status` enum('pending','verified','rejected') DEFAULT 'pending',
  `verified_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`),
  UNIQUE KEY `user_id` (`user_id`),
  KEY `idx_verification_status` (`verification_status`),
  KEY `idx_industry` (`industry`),
  KEY `idx_company_type` (`company_type`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

-- --------------------------------------------------------

--
-- Table structure for table `company_subscriptions`
--

DROP TABLE IF EXISTS `company_subscriptions`;
CREATE TABLE IF NOT EXISTS `company_subscriptions` (
  `id` int NOT NULL AUTO_INCREMENT,
  `company_id` int NOT NULL,
  `package_id` int NOT NULL,
  `job_posts_remaining` int NOT NULL,
  `start_date` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  `end_date` timestamp NULL DEFAULT NULL,
  `status` enum('active','expired','cancelled') DEFAULT 'active',
  `payment_status` enum('pending','paid','failed') DEFAULT 'pending',
  `transaction_id` varchar(100) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`),
  KEY `company_id` (`company_id`),
  KEY `package_id` (`package_id`),
  KEY `idx_status` (`status`),
  KEY `idx_end_date` (`end_date`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

-- --------------------------------------------------------

--
-- Table structure for table `job_applications`
--

DROP TABLE IF EXISTS `job_applications`;
CREATE TABLE IF NOT EXISTS `job_applications` (
  `id` int NOT NULL AUTO_INCREMENT,
  `job_id` int NOT NULL,
  `user_id` int NOT NULL,
  `full_name` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
  `phone` varchar(20) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `resume_path` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `cover_letter` text COLLATE utf8mb4_unicode_ci,
  `status` enum('pending','reviewed','shortlisted','rejected','hired') COLLATE utf8mb4_unicode_ci DEFAULT 'pending',
  `applied_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `notes` text COLLATE utf8mb4_unicode_ci,
  PRIMARY KEY (`id`),
  UNIQUE KEY `unique_application` (`job_id`,`user_id`),
  KEY `user_id` (`user_id`),
  KEY `idx_status` (`status`),
  KEY `idx_applied_at` (`applied_at`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Triggers `job_applications`
--
DROP TRIGGER IF EXISTS `trg_update_job_applications_count`;
DELIMITER $$
CREATE TRIGGER `trg_update_job_applications_count` AFTER INSERT ON `job_applications` FOR EACH ROW BEGIN
    UPDATE job_postings 
    SET applications_count = applications_count + 1 
    WHERE id = NEW.job_id;
END
$$
DELIMITER ;
DROP TRIGGER IF EXISTS `trg_update_job_applications_count_on_delete`;
DELIMITER $$
CREATE TRIGGER `trg_update_job_applications_count_on_delete` AFTER DELETE ON `job_applications` FOR EACH ROW BEGIN
    UPDATE job_postings 
    SET applications_count = applications_count - 1 
    WHERE id = OLD.job_id;
END
$$
DELIMITER ;

-- --------------------------------------------------------

--
-- Table structure for table `job_packages`
--

DROP TABLE IF EXISTS `job_packages`;
CREATE TABLE IF NOT EXISTS `job_packages` (
  `id` int NOT NULL AUTO_INCREMENT,
  `package_name` varchar(50) NOT NULL,
  `price` decimal(10,2) NOT NULL,
  `job_posts` int NOT NULL,
  `listing_days` int NOT NULL,
  `applications_limit` int DEFAULT NULL,
  `has_featured_tag` tinyint(1) DEFAULT '0',
  `has_priority_support` tinyint(1) DEFAULT '0',
  `description` text,
  `is_active` tinyint(1) DEFAULT '1',
  `created_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`),
  UNIQUE KEY `package_name` (`package_name`)
) ENGINE=MyISAM AUTO_INCREMENT=4 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `job_packages`
--

INSERT INTO `job_packages` (`id`, `package_name`, `price`, `job_posts`, `listing_days`, `applications_limit`, `has_featured_tag`, `has_priority_support`, `description`, `is_active`, `created_at`) VALUES
(1, 'basic', 49.00, 1, 30, 50, 0, 0, 'Basic package for small businesses', 1, '2026-02-25 04:44:10'),
(2, 'standard', 99.00, 3, 45, 150, 1, 0, 'Standard package for growing companies', 1, '2026-02-25 04:44:10'),
(3, 'premium', 199.00, 10, 60, NULL, 1, 1, 'Premium package for large enterprises', 1, '2026-02-25 04:44:10');

-- --------------------------------------------------------

--
-- Table structure for table `job_postings`
--

DROP TABLE IF EXISTS `job_postings`;
CREATE TABLE IF NOT EXISTS `job_postings` (
  `id` int NOT NULL AUTO_INCREMENT,
  `user_id` int NOT NULL,
  `company_id` int DEFAULT NULL,
  `title` varchar(200) COLLATE utf8mb4_unicode_ci NOT NULL,
  `job_type` varchar(50) COLLATE utf8mb4_unicode_ci NOT NULL,
  `location` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
  `category` varchar(50) COLLATE utf8mb4_unicode_ci NOT NULL,
  `salary` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `duration` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `description` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `requirements` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `benefits` text COLLATE utf8mb4_unicode_ci,
  `application_email` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
  `status` enum('active','closed','draft') COLLATE utf8mb4_unicode_ci DEFAULT 'active',
  `views` int DEFAULT '0',
  `applications_count` int DEFAULT '0',
  `created_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  `expires_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`),
  KEY `user_id` (`user_id`),
  KEY `idx_status` (`status`),
  KEY `idx_category` (`category`),
  KEY `idx_job_type` (`job_type`),
  KEY `idx_location` (`location`),
  KEY `idx_created_at` (`created_at`),
  KEY `idx_expires_at` (`expires_at`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `job_postings`
--

INSERT INTO `job_postings` (`id`, `user_id`, `company_id`, `title`, `job_type`, `location`, `category`, `salary`, `duration`, `description`, `requirements`, `benefits`, `application_email`, `status`, `views`, `applications_count`, `created_at`, `expires_at`, `updated_at`) VALUES
(1, 1, NULL, 'Frontend Developer Intern', 'internship', 'Remote', 'technology', '$500/month', '3 months', 'We are looking for a passionate frontend developer intern to join our team. You will work on real projects and learn from experienced developers.', 'Basic knowledge of HTML, CSS, JavaScript. Familiarity with React is a plus.', 'Flexible hours, mentorship, potential full-time offer', 'careers@example.com', 'active', 0, 0, '2026-02-25 04:17:04', NULL, '2026-02-25 04:17:04'),
(2, 1, NULL, 'Graphic Design Intern', 'internship', 'New York', 'design', '$600/month', '6 months', 'Seeking a creative graphic design intern to help with various design projects including social media graphics, brochures, and website assets.', 'Proficiency in Adobe Creative Suite. Strong portfolio required.', 'Creative environment, networking opportunities', 'design@example.com', 'active', 0, 0, '2026-02-25 04:17:04', NULL, '2026-02-25 04:17:04'),
(3, 1, NULL, 'Content Writer', 'part-time', 'Remote', 'writing', '$25/hour', 'Ongoing', 'Looking for a talented content writer to create engaging blog posts, articles, and social media content.', 'Excellent writing skills in English. Experience with SEO writing preferred.', 'Flexible schedule, work from anywhere', 'jobs@example.com', 'active', 0, 0, '2026-02-25 04:17:04', NULL, '2026-02-25 04:17:04');

-- --------------------------------------------------------

--
-- Table structure for table `password_resets`
--

DROP TABLE IF EXISTS `password_resets`;
CREATE TABLE IF NOT EXISTS `password_resets` (
  `id` int NOT NULL AUTO_INCREMENT,
  `email` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
  `token` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `expires_at` timestamp NOT NULL,
  `created_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`),
  KEY `idx_email` (`email`),
  KEY `idx_token` (`token`),
  KEY `idx_expires_at` (`expires_at`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `sessions`
--

DROP TABLE IF EXISTS `sessions`;
CREATE TABLE IF NOT EXISTS `sessions` (
  `session_id` varchar(128) COLLATE utf8mb4_unicode_ci NOT NULL,
  `session_data` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `session_expires` int NOT NULL,
  PRIMARY KEY (`session_id`),
  KEY `idx_session_expires` (`session_expires`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

DROP TABLE IF EXISTS `users`;
CREATE TABLE IF NOT EXISTS `users` (
  `id` int NOT NULL AUTO_INCREMENT,
  `first_name` varchar(50) COLLATE utf8mb4_unicode_ci NOT NULL,
  `last_name` varchar(50) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
  `password` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `user_type` enum('student','author','company','freelancer') COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'student',
  `google_id` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `profile_picture` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `remember_token` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`),
  UNIQUE KEY `email` (`email`),
  KEY `idx_email` (`email`),
  KEY `idx_user_type` (`user_type`),
  KEY `idx_google_id` (`google_id`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `first_name`, `last_name`, `email`, `password`, `user_type`, `google_id`, `profile_picture`, `remember_token`, `created_at`, `updated_at`) VALUES
(1, 'Admin', 'User', 'admin@studentsarea.com', '$2y$10$YourHashedPasswordHere', 'company', NULL, NULL, NULL, '2026-02-25 04:17:04', '2026-02-25 04:17:04'),
(2, 'test', 'test', 'test@test.com', '$2y$10$u894fZYS9ntMl8OyHVLCz.77MGEovg4PoGOMvwg6AobFA8cTt9ZJG', 'student', NULL, NULL, '7aedd87b82025c70f0dfe57a082af171648bc81d6a4e83ddfc9e52305b86b6e3', '2026-02-25 04:17:36', '2026-02-25 04:33:21');

-- --------------------------------------------------------

--
-- Stand-in structure for view `vw_active_jobs`
-- (See below for the actual view)
--
DROP VIEW IF EXISTS `vw_active_jobs`;
CREATE TABLE IF NOT EXISTS `vw_active_jobs` (
`id` int
,`user_id` int
,`company_id` int
,`title` varchar(200)
,`job_type` varchar(50)
,`location` varchar(100)
,`category` varchar(50)
,`salary` varchar(100)
,`duration` varchar(100)
,`description` text
,`requirements` text
,`benefits` text
,`application_email` varchar(100)
,`status` enum('active','closed','draft')
,`views` int
,`applications_count` int
,`created_at` timestamp
,`expires_at` timestamp
,`updated_at` timestamp
,`first_name` varchar(50)
,`last_name` varchar(50)
,`user_email` varchar(100)
,`category_name` varchar(50)
);

-- --------------------------------------------------------

--
-- Stand-in structure for view `vw_application_stats`
-- (See below for the actual view)
--
DROP VIEW IF EXISTS `vw_application_stats`;
CREATE TABLE IF NOT EXISTS `vw_application_stats` (
`job_id` int
,`title` varchar(200)
,`total_applications` bigint
,`pending_applications` decimal(23,0)
,`reviewed_applications` decimal(23,0)
,`shortlisted_applications` decimal(23,0)
,`rejected_applications` decimal(23,0)
,`hired_applications` decimal(23,0)
);

-- --------------------------------------------------------

--
-- Structure for view `vw_active_jobs`
--
DROP TABLE IF EXISTS `vw_active_jobs`;

DROP VIEW IF EXISTS `vw_active_jobs`;
CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `vw_active_jobs`  AS SELECT `j`.`id` AS `id`, `j`.`user_id` AS `user_id`, `j`.`company_id` AS `company_id`, `j`.`title` AS `title`, `j`.`job_type` AS `job_type`, `j`.`location` AS `location`, `j`.`category` AS `category`, `j`.`salary` AS `salary`, `j`.`duration` AS `duration`, `j`.`description` AS `description`, `j`.`requirements` AS `requirements`, `j`.`benefits` AS `benefits`, `j`.`application_email` AS `application_email`, `j`.`status` AS `status`, `j`.`views` AS `views`, `j`.`applications_count` AS `applications_count`, `j`.`created_at` AS `created_at`, `j`.`expires_at` AS `expires_at`, `j`.`updated_at` AS `updated_at`, `u`.`first_name` AS `first_name`, `u`.`last_name` AS `last_name`, `u`.`email` AS `user_email`, `c`.`name` AS `category_name` FROM ((`job_postings` `j` left join `users` `u` on((`j`.`user_id` = `u`.`id`))) left join `categories` `c` on((`j`.`category` = `c`.`slug`))) WHERE ((`j`.`status` = 'active') AND ((`j`.`expires_at` is null) OR (`j`.`expires_at` > now()))) ORDER BY `j`.`created_at` DESC ;

-- --------------------------------------------------------

--
-- Structure for view `vw_application_stats`
--
DROP TABLE IF EXISTS `vw_application_stats`;

DROP VIEW IF EXISTS `vw_application_stats`;
CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `vw_application_stats`  AS SELECT `j`.`id` AS `job_id`, `j`.`title` AS `title`, count(`ja`.`id`) AS `total_applications`, sum((case when (`ja`.`status` = 'pending') then 1 else 0 end)) AS `pending_applications`, sum((case when (`ja`.`status` = 'reviewed') then 1 else 0 end)) AS `reviewed_applications`, sum((case when (`ja`.`status` = 'shortlisted') then 1 else 0 end)) AS `shortlisted_applications`, sum((case when (`ja`.`status` = 'rejected') then 1 else 0 end)) AS `rejected_applications`, sum((case when (`ja`.`status` = 'hired') then 1 else 0 end)) AS `hired_applications` FROM (`job_postings` `j` left join `job_applications` `ja` on((`j`.`id` = `ja`.`job_id`))) GROUP BY `j`.`id`, `j`.`title` ;

--
-- Indexes for dumped tables
--

--
-- Indexes for table `job_postings`
--
ALTER TABLE `job_postings` ADD FULLTEXT KEY `idx_search` (`title`,`description`,`requirements`);

--
-- Constraints for dumped tables
--

--
-- Constraints for table `activity_logs`
--
ALTER TABLE `activity_logs`
  ADD CONSTRAINT `activity_logs_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE SET NULL;

--
-- Constraints for table `author_applications`
--
ALTER TABLE `author_applications`
  ADD CONSTRAINT `author_applications_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `author_applications_ibfk_2` FOREIGN KEY (`reviewed_by`) REFERENCES `users` (`id`) ON DELETE SET NULL;

--
-- Constraints for table `categories`
--
ALTER TABLE `categories`
  ADD CONSTRAINT `categories_ibfk_1` FOREIGN KEY (`parent_id`) REFERENCES `categories` (`id`) ON DELETE SET NULL;

--
-- Constraints for table `company_applications`
--
ALTER TABLE `company_applications`
  ADD CONSTRAINT `company_applications_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `company_applications_ibfk_2` FOREIGN KEY (`reviewed_by`) REFERENCES `users` (`id`) ON DELETE SET NULL;

--
-- Constraints for table `job_applications`
--
ALTER TABLE `job_applications`
  ADD CONSTRAINT `job_applications_ibfk_1` FOREIGN KEY (`job_id`) REFERENCES `job_postings` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `job_applications_ibfk_2` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `job_postings`
--
ALTER TABLE `job_postings`
  ADD CONSTRAINT `job_postings_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
