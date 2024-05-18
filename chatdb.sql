-- --------------------------------------------------------
-- Máy chủ:                      127.0.0.1
-- Server version:               8.0.30 - MySQL Community Server - GPL
-- Server OS:                    Win64
-- HeidiSQL Phiên bản:           12.1.0.6537
-- --------------------------------------------------------

/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET NAMES utf8 */;
/*!50503 SET NAMES utf8mb4 */;
/*!40103 SET @OLD_TIME_ZONE=@@TIME_ZONE */;
/*!40103 SET TIME_ZONE='+00:00' */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;


-- Dumping database structure for chat
CREATE DATABASE IF NOT EXISTS `chat` /*!40100 DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci */ /*!80016 DEFAULT ENCRYPTION='N' */;
USE `chat`;

-- Dumping structure for table chat.failed_jobs
CREATE TABLE IF NOT EXISTS `failed_jobs` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `uuid` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `connection` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `queue` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `payload` longtext CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `exception` longtext CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `failed_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`),
  UNIQUE KEY `failed_jobs_uuid_unique` (`uuid`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Dumping data for table chat.failed_jobs: ~0 rows (approximately)

-- Dumping structure for table chat.messages
CREATE TABLE IF NOT EXISTS `messages` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `chatRoomId` bigint unsigned NOT NULL,
  `userId` bigint unsigned NOT NULL,
  `content` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `type` enum('image','text') COLLATE utf8mb4_unicode_ci NOT NULL,
  `parent_id` bigint unsigned DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=182 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Dumping data for table chat.messages: ~12 rows (approximately)
REPLACE INTO `messages` (`id`, `chatRoomId`, `userId`, `content`, `type`, `parent_id`, `created_at`, `updated_at`) VALUES
	(170, 3, 2, 'asfdsfsdfs', 'text', NULL, '2024-04-15 09:07:56', '2024-04-15 09:07:56'),
	(171, 3, 2, 'storage/images/1713182882_doremon.jpg', 'image', NULL, '2024-04-15 09:08:02', '2024-04-15 09:08:02'),
	(172, 5, 2, 'zjvnbjkzdxhgkjds', 'text', NULL, '2024-04-15 09:16:47', '2024-04-15 09:16:47'),
	(173, 5, 2, 'dxfdsfsfd', 'text', NULL, '2024-04-15 09:16:50', '2024-04-15 09:16:50'),
	(174, 5, 2, 'a', 'text', NULL, '2024-04-15 09:16:51', '2024-04-15 09:16:51'),
	(175, 5, 2, 'a', 'text', NULL, '2024-04-15 09:16:53', '2024-04-15 09:16:53'),
	(176, 5, 2, 'cvxfvfdgdfdf', 'text', NULL, '2024-04-15 09:16:55', '2024-04-15 09:16:55'),
	(177, 5, 2, 'ádasdasda', 'text', NULL, '2024-04-15 09:16:57', '2024-04-15 09:16:57'),
	(178, 5, 2, 'ádasdasda', 'text', NULL, '2024-04-15 09:16:59', '2024-04-15 09:16:59'),
	(179, 5, 2, 'ádasdsaasd', 'text', NULL, '2024-04-15 09:17:01', '2024-04-15 09:17:01'),
	(180, 5, 2, 'ádasdasdasd', 'text', NULL, '2024-04-15 09:17:03', '2024-04-15 09:17:03'),
	(181, 5, 2, 'adasdasdwa', 'text', NULL, '2024-04-15 09:17:16', '2024-04-15 09:17:16');

-- Dumping structure for table chat.migrations
CREATE TABLE IF NOT EXISTS `migrations` (
  `id` int unsigned NOT NULL AUTO_INCREMENT,
  `migration` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `batch` int NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=15 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Dumping data for table chat.migrations: ~12 rows (approximately)
REPLACE INTO `migrations` (`id`, `migration`, `batch`) VALUES
	(1, '2014_10_12_000000_create_users_table', 1),
	(2, '2014_10_12_100000_create_password_reset_tokens_table', 1),
	(3, '2014_10_12_100000_create_password_resets_table', 1),
	(4, '2019_08_19_000000_create_failed_jobs_table', 1),
	(5, '2019_12_14_000001_create_personal_access_tokens_table', 1),
	(6, '2024_01_31_125912_create_rooms_table', 2),
	(8, '2024_03_22_080223_create_messages_table', 4),
	(10, '2024_04_10_075059_create_userqueue_table', 6),
	(11, '2024_01_31_130432_create_roomables_table', 7),
	(12, '2024_04_10_050018_create_notifications_table', 7),
	(13, '2024_04_15_082046_create_notification_user_table', 7),
	(14, '2024_05_18_124633_add_provider_fields_to_users_table', 8);

-- Dumping structure for table chat.notifications
CREATE TABLE IF NOT EXISTS `notifications` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `user_id` bigint unsigned NOT NULL,
  `type` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `data` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `read_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `notifications_user_id_foreign` (`user_id`),
  CONSTRAINT `notifications_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=24 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Dumping data for table chat.notifications: ~11 rows (approximately)
REPLACE INTO `notifications` (`id`, `user_id`, `type`, `data`, `read_at`, `created_at`, `updated_at`) VALUES
	(13, 2, 'new_message', '{"roomName":"room 3","from":2}', NULL, '2024-04-15 09:07:56', '2024-04-15 09:07:56'),
	(14, 2, 'new_message', '{"roomName":"room 6","from":2}', NULL, '2024-04-15 09:16:47', '2024-04-15 09:16:47'),
	(15, 2, 'new_message', '{"roomName":"room 6","from":2}', NULL, '2024-04-15 09:16:50', '2024-04-15 09:16:50'),
	(16, 2, 'new_message', '{"roomName":"room 6","from":2}', NULL, '2024-04-15 09:16:51', '2024-04-15 09:16:51'),
	(17, 2, 'new_message', '{"roomName":"room 6","from":2}', NULL, '2024-04-15 09:16:53', '2024-04-15 09:16:53'),
	(18, 2, 'new_message', '{"roomName":"room 6","from":2}', NULL, '2024-04-15 09:16:55', '2024-04-15 09:16:55'),
	(19, 2, 'new_message', '{"roomName":"room 6","from":2}', NULL, '2024-04-15 09:16:57', '2024-04-15 09:16:57'),
	(20, 2, 'new_message', '{"roomName":"room 6","from":2}', NULL, '2024-04-15 09:16:59', '2024-04-15 09:16:59'),
	(21, 2, 'new_message', '{"roomName":"room 6","from":2}', NULL, '2024-04-15 09:17:01', '2024-04-15 09:17:01'),
	(22, 2, 'new_message', '{"roomName":"room 6","from":2}', NULL, '2024-04-15 09:17:03', '2024-04-15 09:17:03'),
	(23, 2, 'new_message', '{"roomName":"room 6","from":2}', NULL, '2024-04-15 09:17:16', '2024-04-15 09:17:16');

-- Dumping structure for table chat.notification_user
CREATE TABLE IF NOT EXISTS `notification_user` (
  `notification_id` bigint unsigned NOT NULL,
  `user_id` bigint unsigned NOT NULL,
  `read_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  KEY `notification_user_notification_id_foreign` (`notification_id`),
  KEY `notification_user_user_id_foreign` (`user_id`),
  CONSTRAINT `notification_user_notification_id_foreign` FOREIGN KEY (`notification_id`) REFERENCES `notifications` (`id`) ON DELETE CASCADE,
  CONSTRAINT `notification_user_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Dumping data for table chat.notification_user: ~22 rows (approximately)
REPLACE INTO `notification_user` (`notification_id`, `user_id`, `read_at`, `created_at`, `updated_at`) VALUES
	(13, 4, NULL, '2024-04-15 09:07:56', '2024-04-15 09:07:56'),
	(13, 3, NULL, '2024-04-15 09:07:56', '2024-04-15 09:07:56'),
	(14, 3, NULL, '2024-04-15 09:16:47', '2024-04-15 09:16:47'),
	(14, 4, NULL, '2024-04-15 09:16:47', '2024-04-15 09:16:47'),
	(15, 3, NULL, '2024-04-15 09:16:50', '2024-04-15 09:16:50'),
	(15, 4, NULL, '2024-04-15 09:16:50', '2024-04-15 09:16:50'),
	(16, 3, NULL, '2024-04-15 09:16:51', '2024-04-15 09:16:51'),
	(16, 4, NULL, '2024-04-15 09:16:51', '2024-04-15 09:16:51'),
	(17, 3, NULL, '2024-04-15 09:16:53', '2024-04-15 09:16:53'),
	(17, 4, NULL, '2024-04-15 09:16:53', '2024-04-15 09:16:53'),
	(18, 3, NULL, '2024-04-15 09:16:55', '2024-04-15 09:16:55'),
	(18, 4, NULL, '2024-04-15 09:16:55', '2024-04-15 09:16:55'),
	(19, 3, NULL, '2024-04-15 09:16:57', '2024-04-15 09:16:57'),
	(19, 4, NULL, '2024-04-15 09:16:57', '2024-04-15 09:16:57'),
	(20, 3, NULL, '2024-04-15 09:16:59', '2024-04-15 09:16:59'),
	(20, 4, NULL, '2024-04-15 09:16:59', '2024-04-15 09:16:59'),
	(21, 3, NULL, '2024-04-15 09:17:01', '2024-04-15 09:17:01'),
	(21, 4, NULL, '2024-04-15 09:17:01', '2024-04-15 09:17:01'),
	(22, 3, NULL, '2024-04-15 09:17:03', '2024-04-15 09:17:03'),
	(22, 4, NULL, '2024-04-15 09:17:03', '2024-04-15 09:17:03'),
	(23, 3, NULL, '2024-04-15 09:17:16', '2024-04-15 09:17:16'),
	(23, 4, NULL, '2024-04-15 09:17:16', '2024-04-15 09:17:16');

-- Dumping structure for table chat.password_resets
CREATE TABLE IF NOT EXISTS `password_resets` (
  `email` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `token` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  KEY `password_resets_email_index` (`email`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Dumping data for table chat.password_resets: ~0 rows (approximately)

-- Dumping structure for table chat.password_reset_tokens
CREATE TABLE IF NOT EXISTS `password_reset_tokens` (
  `email` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `token` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`email`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Dumping data for table chat.password_reset_tokens: ~0 rows (approximately)

-- Dumping structure for table chat.personal_access_tokens
CREATE TABLE IF NOT EXISTS `personal_access_tokens` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `tokenable_type` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `tokenable_id` bigint unsigned NOT NULL,
  `name` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `token` varchar(64) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `abilities` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci,
  `last_used_at` timestamp NULL DEFAULT NULL,
  `expires_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `personal_access_tokens_token_unique` (`token`),
  KEY `personal_access_tokens_tokenable_type_tokenable_id_index` (`tokenable_type`,`tokenable_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Dumping data for table chat.personal_access_tokens: ~0 rows (approximately)

-- Dumping structure for table chat.rooms
CREATE TABLE IF NOT EXISTS `rooms` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `icon` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `owner_id` bigint unsigned NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `description` text COLLATE utf8mb4_unicode_ci,
  PRIMARY KEY (`id`),
  KEY `rooms_owner_id_foreign` (`owner_id`),
  CONSTRAINT `rooms_owner_id_foreign` FOREIGN KEY (`owner_id`) REFERENCES `users` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=8 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Dumping data for table chat.rooms: ~7 rows (approximately)
REPLACE INTO `rooms` (`id`, `name`, `icon`, `owner_id`, `created_at`, `updated_at`, `description`) VALUES
	(1, 'room 1', NULL, 2, '2024-02-26 09:32:41', '2024-02-26 09:32:41', NULL),
	(2, 'room 2', NULL, 2, '2024-02-26 09:32:50', '2024-02-26 09:32:50', NULL),
	(3, 'room 3', NULL, 3, '2024-02-26 09:32:58', '2024-02-26 09:32:58', NULL),
	(4, 'abc', 'sáasasa', 4, '2024-02-26 10:47:40', '2024-02-26 10:47:40', 'âsasasa'),
	(5, 'room 6', NULL, 4, NULL, NULL, NULL),
	(6, 'adadadada', NULL, 4, NULL, NULL, NULL),
	(7, 'nmcbznmxbczx', 'sáasasa', 3, '2024-04-10 05:28:01', '2024-04-10 05:28:01', 'zczxczczcz');

-- Dumping structure for table chat.room_user
CREATE TABLE IF NOT EXISTS `room_user` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `room_id` bigint unsigned NOT NULL,
  `user_id` bigint unsigned NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `room_user_room_id_foreign` (`room_id`),
  KEY `room_user_user_id_foreign` (`user_id`),
  CONSTRAINT `room_user_room_id_foreign` FOREIGN KEY (`room_id`) REFERENCES `rooms` (`id`) ON DELETE CASCADE,
  CONSTRAINT `room_user_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=47 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Dumping data for table chat.room_user: ~8 rows (approximately)
REPLACE INTO `room_user` (`id`, `room_id`, `user_id`, `created_at`, `updated_at`) VALUES
	(1, 3, 4, NULL, NULL),
	(2, 6, 3, NULL, NULL),
	(3, 3, 2, NULL, NULL),
	(41, 5, 2, NULL, NULL),
	(42, 5, 3, NULL, NULL),
	(43, 4, 3, NULL, NULL),
	(45, 1, 3, NULL, NULL),
	(46, 7, 4, NULL, NULL);

-- Dumping structure for table chat.userqueue
CREATE TABLE IF NOT EXISTS `userqueue` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `roomId` bigint unsigned NOT NULL,
  `userId` bigint unsigned NOT NULL,
  `status` enum('0','1') COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `ownerId` bigint DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Dumping data for table chat.userqueue: ~1 rows (approximately)
REPLACE INTO `userqueue` (`id`, `roomId`, `userId`, `status`, `created_at`, `updated_at`, `ownerId`) VALUES
	(1, 7, 4, '1', '2024-04-10 05:28:23', '2024-04-10 06:14:34', 3);

-- Dumping structure for table chat.users
CREATE TABLE IF NOT EXISTS `users` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `email` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `email_verified_at` timestamp NULL DEFAULT NULL,
  `password` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `remember_token` varchar(100) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `provider` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `provider_id` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `users_email_unique` (`email`),
  UNIQUE KEY `users_provider_id_unique` (`provider_id`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Dumping data for table chat.users: ~3 rows (approximately)
REPLACE INTO `users` (`id`, `name`, `email`, `email_verified_at`, `password`, `remember_token`, `created_at`, `updated_at`, `provider`, `provider_id`) VALUES
	(2, 'nguyen dat', 'nguyendat8b2k3@gmail.com', NULL, '$2y$12$3JIp0wz0tuiGy3bp5x1dGuH55wvPgB7bplrLvgheNARNknPkUPmrS', 'rl2yns6rZjYsmDVdFkHxitOLZxKojO7h2Tuf4SzaTkk0f9Dy4ocfpLHtBpyE', '2024-02-26 09:29:40', '2024-02-26 09:29:40', NULL, NULL),
	(3, '7576874', 'ntd1753@gmail.com', NULL, '$2y$12$DJyCwRMuke9cTmeDT2JBteE8GfFrWF6bSon4GfERoWdVoFNAsBU0q', 'BjHyy8fP8UpcosSKvINn0J1KDNQLiwhlil6zpC9hwypfrJuUwAPFtStkNYZT', '2024-02-26 09:33:31', '2024-02-26 09:33:31', NULL, NULL),
	(4, 'Nguyễn Thành Đạt', 'Dat.NT215027@sis.hust.edu.vn', NULL, '$2y$12$pUYW.TXmiEbfuq5hqb7kouDz2R.NrT9brEXTlrN3r81fvhCHFqLl2', NULL, '2024-02-26 09:33:56', '2024-02-26 09:33:56', NULL, NULL);

/*!40103 SET TIME_ZONE=IFNULL(@OLD_TIME_ZONE, 'system') */;
/*!40101 SET SQL_MODE=IFNULL(@OLD_SQL_MODE, '') */;
/*!40014 SET FOREIGN_KEY_CHECKS=IFNULL(@OLD_FOREIGN_KEY_CHECKS, 1) */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40111 SET SQL_NOTES=IFNULL(@OLD_SQL_NOTES, 1) */;
