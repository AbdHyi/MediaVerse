-- --------------------------------------------------------
-- Host:                         127.0.0.1
-- Server version:               8.0.30 - MySQL Community Server - GPL
-- Server OS:                    Win64
-- HeidiSQL Version:             12.1.0.6537
-- --------------------------------------------------------

/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET NAMES utf8 */;
/*!50503 SET NAMES utf8mb4 */;
/*!40103 SET @OLD_TIME_ZONE=@@TIME_ZONE */;
/*!40103 SET TIME_ZONE='+00:00' */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;


-- Dumping database structure for mediaverse
CREATE DATABASE IF NOT EXISTS `mediaverse` /*!40100 DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci */ /*!80016 DEFAULT ENCRYPTION='N' */;
USE `mediaverse`;

-- Dumping structure for table mediaverse.cache
CREATE TABLE IF NOT EXISTS `cache` (
  `key` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `value` mediumtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `expiration` bigint NOT NULL,
  PRIMARY KEY (`key`),
  KEY `cache_expiration_index` (`expiration`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Dumping data for table mediaverse.cache: ~0 rows (approximately)

-- Dumping structure for table mediaverse.cache_locks
CREATE TABLE IF NOT EXISTS `cache_locks` (
  `key` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `owner` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `expiration` bigint NOT NULL,
  PRIMARY KEY (`key`),
  KEY `cache_locks_expiration_index` (`expiration`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Dumping data for table mediaverse.cache_locks: ~0 rows (approximately)

-- Dumping structure for table mediaverse.failed_jobs
CREATE TABLE IF NOT EXISTS `failed_jobs` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `uuid` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `connection` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `queue` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `payload` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `exception` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `failed_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`),
  UNIQUE KEY `failed_jobs_uuid_unique` (`uuid`),
  KEY `failed_jobs_connection_queue_failed_at_index` (`connection`,`queue`,`failed_at`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Dumping data for table mediaverse.failed_jobs: ~0 rows (approximately)

-- Dumping structure for table mediaverse.favorites
CREATE TABLE IF NOT EXISTS `favorites` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `user_id` bigint unsigned NOT NULL,
  `media_id` bigint unsigned NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `favorites_user_id_media_id_unique` (`user_id`,`media_id`),
  KEY `favorites_media_id_foreign` (`media_id`),
  CONSTRAINT `favorites_media_id_foreign` FOREIGN KEY (`media_id`) REFERENCES `media` (`id`) ON DELETE CASCADE,
  CONSTRAINT `favorites_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=12 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Dumping data for table mediaverse.favorites: ~6 rows (approximately)
INSERT INTO `favorites` (`id`, `user_id`, `media_id`, `created_at`, `updated_at`) VALUES
	(1, 4, 19, '2026-07-16 18:23:22', '2026-07-16 18:23:22'),
	(2, 2, 19, '2026-07-17 10:16:03', '2026-07-17 10:16:03'),
	(3, 4, 10, '2026-07-17 10:30:50', '2026-07-17 10:30:50'),
	(4, 2, 22, '2026-07-17 19:55:57', '2026-07-17 19:55:57'),
	(5, 4, 22, '2026-07-17 23:30:17', '2026-07-17 23:30:17'),
	(6, 4, 12, '2026-07-17 23:31:14', '2026-07-17 23:31:14'),
	(7, 1, 10, '2026-07-17 23:52:18', '2026-07-17 23:52:18'),
	(8, 2, 10, '2026-07-18 02:07:57', '2026-07-18 02:07:57'),
	(9, 2, 3, '2026-07-18 08:24:50', '2026-07-18 08:24:50'),
	(10, 2, 7, '2026-07-18 21:46:34', '2026-07-18 21:46:34'),
	(11, 2, 23, '2026-07-20 04:36:47', '2026-07-20 04:36:47');

-- Dumping structure for table mediaverse.genres
CREATE TABLE IF NOT EXISTS `genres` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `genres_name_unique` (`name`)
) ENGINE=InnoDB AUTO_INCREMENT=30 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Dumping data for table mediaverse.genres: ~26 rows (approximately)
INSERT INTO `genres` (`id`, `name`, `created_at`, `updated_at`) VALUES
	(1, 'Action', '2026-07-14 08:08:35', '2026-07-14 08:08:35'),
	(2, 'Adventure', '2026-07-14 08:08:35', '2026-07-14 08:08:35'),
	(3, 'Drama', '2026-07-14 08:08:35', '2026-07-14 08:08:35'),
	(4, 'Comedy', '2026-07-14 08:08:35', '2026-07-14 08:08:35'),
	(6, 'Sci-Fi', '2026-07-14 22:46:58', '2026-07-14 22:46:58'),
	(7, 'Thriller', '2026-07-14 22:46:58', '2026-07-14 22:46:58'),
	(8, 'Romance', '2026-07-14 22:46:58', '2026-07-14 22:46:58'),
	(11, 'Fantasy', '2026-07-16 18:54:28', '2026-07-16 18:54:28'),
	(12, 'Space', '2026-07-17 10:33:05', '2026-07-17 10:33:05'),
	(13, 'Mystery', '2026-07-20 04:29:29', '2026-07-20 04:29:29'),
	(14, 'Slice of Life', '2026-07-20 04:29:36', '2026-07-20 04:29:36'),
	(15, 'Sports', '2026-07-20 04:29:48', '2026-07-20 04:29:48'),
	(16, 'Suspense', '2026-07-20 04:29:53', '2026-07-20 04:29:53'),
	(17, 'Martial Arts', '2026-07-20 04:30:14', '2026-07-20 04:30:14'),
	(18, 'Mecha', '2026-07-20 04:30:21', '2026-07-20 04:30:21'),
	(19, 'Shounen', '2026-07-20 04:30:27', '2026-07-20 04:30:27'),
	(20, 'Seinen', '2026-07-20 04:30:33', '2026-07-20 04:30:33'),
	(21, 'Parody', '2026-07-20 04:30:41', '2026-07-20 04:30:41'),
	(22, 'Military', '2026-07-20 04:30:54', '2026-07-20 04:30:54'),
	(23, 'Psychological', '2026-07-20 04:31:09', '2026-07-20 04:31:09'),
	(24, 'Samurai', '2026-07-20 04:31:19', '2026-07-20 04:31:19'),
	(25, 'School', '2026-07-20 04:31:26', '2026-07-20 04:31:26'),
	(26, 'Time Travel', '2026-07-20 04:31:46', '2026-07-20 04:31:46'),
	(27, 'Josei', '2026-07-20 04:31:54', '2026-07-20 04:31:54'),
	(28, 'Shoujo', '2026-07-20 04:31:59', '2026-07-20 04:31:59'),
	(29, 'Avant Garde', '2026-07-20 04:32:51', '2026-07-20 04:32:51');

-- Dumping structure for table mediaverse.jobs
CREATE TABLE IF NOT EXISTS `jobs` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `queue` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `payload` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `attempts` smallint unsigned NOT NULL,
  `reserved_at` int unsigned DEFAULT NULL,
  `available_at` int unsigned NOT NULL,
  `created_at` int unsigned NOT NULL,
  PRIMARY KEY (`id`),
  KEY `jobs_queue_index` (`queue`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Dumping data for table mediaverse.jobs: ~0 rows (approximately)

-- Dumping structure for table mediaverse.job_batches
CREATE TABLE IF NOT EXISTS `job_batches` (
  `id` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `total_jobs` int NOT NULL,
  `pending_jobs` int NOT NULL,
  `failed_jobs` int NOT NULL,
  `failed_job_ids` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `options` mediumtext COLLATE utf8mb4_unicode_ci,
  `cancelled_at` int DEFAULT NULL,
  `created_at` int NOT NULL,
  `finished_at` int DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Dumping data for table mediaverse.job_batches: ~0 rows (approximately)

-- Dumping structure for table mediaverse.media
CREATE TABLE IF NOT EXISTS `media` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `studio_id` bigint unsigned DEFAULT NULL,
  `title` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `slug` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `type` enum('film','series','anime') COLLATE utf8mb4_unicode_ci NOT NULL,
  `synopsis` text COLLATE utf8mb4_unicode_ci,
  `release_year` smallint DEFAULT NULL,
  `poster_path` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `media_slug_unique` (`slug`),
  KEY `media_studio_id_foreign` (`studio_id`),
  KEY `media_title_index` (`title`),
  KEY `media_type_index` (`type`),
  KEY `media_release_year_index` (`release_year`),
  CONSTRAINT `media_studio_id_foreign` FOREIGN KEY (`studio_id`) REFERENCES `studios` (`id`) ON DELETE SET NULL
) ENGINE=InnoDB AUTO_INCREMENT=24 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Dumping data for table mediaverse.media: ~15 rows (approximately)
INSERT INTO `media` (`id`, `studio_id`, `title`, `slug`, `type`, `synopsis`, `release_year`, `poster_path`, `created_at`, `updated_at`) VALUES
	(1, 1, 'Spirited Away', 'spirited-away', 'anime', 'Sinopsis dummy untuk Spirited Away.', 2001, 'posters/zfgH0IJHomrvC04dIfTXOlWcoXk1eC8EbAE6Z1QC.jpg', '2026-07-14 08:08:35', '2026-07-17 10:28:53'),
	(2, 1, 'Inception', 'inception', 'film', 'Sinopsis dummy untuk Inception.', 2010, 'posters/N8o3n67KSf5CC1zi6w10uUduCQcitpZ3UAiHTB8B.jpg', '2026-07-14 08:08:36', '2026-07-17 19:54:25'),
	(3, 1, 'Breaking Bad', 'breaking-bad', 'series', 'Sinopsis dummy untuk Breaking Bad.', 2008, 'posters/hHt3SK5DSo5fXTg7LdWzTMDArmAEY9YAOoa4lYm6.jpg', '2026-07-14 08:08:36', '2026-07-17 19:54:38'),
	(4, 1, 'Princess Mononoke', 'princess-mononoke', 'anime', 'Sinopsis dummy untuk Princess Mononoke. Konten ini akan diganti dengan sinopsis asli.', 1997, 'posters/GJ6QFerRn8dR5BkCW0E7WbfnuM7nPpg6joNKRo9F.jpg', '2026-07-14 22:46:58', '2026-07-17 18:00:17'),
	(5, 2, 'Avengers: Endgame', 'avengers-endgame', 'film', 'Sinopsis dummy untuk Avengers: Endgame. Konten ini akan diganti dengan sinopsis asli.', 2019, 'posters/PchM3h0fy6A9YVhLXrE8zgoujboWrCR8spjWMfT7.jpg', '2026-07-14 22:46:58', '2026-07-17 19:53:42'),
	(6, 3, 'Everything Everywhere All at Once', 'everything-everywhere-all-at-once', 'film', 'Sinopsis dummy untuk Everything Everywhere All at Once. Konten ini akan diganti dengan sinopsis asli.', 2022, 'posters/IEqEjCRw3m1cTQO2bDiofaMNKLiQypyFuLGU1sTH.jpg', '2026-07-14 22:46:58', '2026-07-17 19:53:55'),
	(7, 3, 'Midsommar', 'midsommar', 'film', 'Sinopsis dummy untuk Midsommar. Konten ini akan diganti dengan sinopsis asli.', 2019, 'posters/9fQqJgdDZKHUVhrM4SJh8Vqnk8lcwKchwvvBZs7i.jpg', '2026-07-14 22:46:58', '2026-07-17 19:54:11'),
	(8, 4, 'Stranger Things', 'stranger-things', 'series', 'Sinopsis dummy untuk Stranger Things. Konten ini akan diganti dengan sinopsis asli.', 2016, 'posters/p8RUqCZ34vYkU4DbbCMRDGVvJ4RvQwUWFWUqek5q.jpg', '2026-07-14 22:46:59', '2026-07-17 19:52:46'),
	(9, 4, 'The Crown', 'the-crown', 'series', 'Sinopsis dummy untuk The Crown. Konten ini akan diganti dengan sinopsis asli.', 2016, 'posters/IdG0MiNY65QNU9NwzIb3ki5OHMoq2nZAVjW2eyCD.jpg', '2026-07-14 22:46:59', '2026-07-17 19:53:08'),
	(10, 5, 'Violet Evergarden', 'violet-evergarden', 'anime', 'Sinopsis dummy untuk Violet Evergarden. Konten ini akan diganti dengan sinopsis asli.', 2018, 'posters/hzw3EhoexOm7t1Zd8TQFdE3aXtdcbVLgODuMuLRu.jpg', '2026-07-14 22:46:59', '2026-07-17 10:26:57'),
	(11, 5, 'K-On!', 'k-on', 'anime', 'Sinopsis dummy untuk K-On!. Konten ini akan diganti dengan sinopsis asli.', 2009, 'posters/KUQ9PlOpf1gQt8wT7RxWzDYfSueSmGbREkbR4JJi.jpg', '2026-07-14 22:46:59', '2026-07-17 19:53:25'),
	(12, 5, 'A Silent Voice', 'a-silent-voice', 'anime', 'Sinopsis dummy untuk A Silent Voice. Konten ini akan diganti dengan sinopsis asli.', 2016, 'posters/Jc9nzkH3JYlgh68cC9EE1IjvjlMjxTLwhBLYy0rp.jpg', '2026-07-14 22:46:59', '2026-07-17 10:23:55'),
	(19, 1, 'Kaze Tachinu', 'kaze-tachinu', 'anime', 'Meskipun rabun jauh Jirou Horikoshi mencegahnya untuk menjadi pilot, ia meninggalkan kota kelahirannya untuk belajar teknik penerbangan di Universitas Kekaisaran Tokyo dengan satu tujuan sederhana: untuk merancang dan membangun pesawat seperti pahlawannya, pelopor pesawat terbang Italia Giovanni Battista Caproni.Kedatangannya di ibu kota bertepatan dengan Gempa Besar Kanto tahun 1923, di mana ia menyelamatkan seorang pelayan yang bekerja untuk keluarga seorang gadis muda bernama Naoko Satomi; peristiwa mengerikan ini menandai awal dari lebih dari dua dekade keresahan dan keresahan sosial yang berujung pada penyerahan Jepang dalam Perang Dunia II.\r\n\r\nBagi Jirou, tahun-tahun menjelang produksi pesawat tempur Mitsubishi A6M Zero yang terkenal itu akan menguji setiap serat dalam dirinya. Banyak perjalanan dan pengalaman hidupnya hanya mendorongnya maju—bahkan ketika ia menyadari peran ciptaannya dalam perang dan kenyataan pahit kehidupan pribadinya. Seiring berjalannya waktu, ia harus menghadapi pertanyaan yang mustahil: dengan harga berapa ia mengejar mimpinya yang indah?', 2013, 'posters/J6ocOx6ekhRGVYDhq1GNonOGxcdQYGbTX9q0S5po.jpg', '2026-07-15 08:29:46', '2026-07-15 08:29:46'),
	(22, 8, 'Samurai Champloo', 'samurai-champloo', 'anime', 'Petualangan tiga orang asing di era Edo: Fuu (pelayan kedai teh), Mugen (penjahat jalanan yang liar), dan Jin (seorang ronin tenang). Setelah diselamatkan dari hukuman mati, mereka terikat dalam perjalanan melintasi Jepang untuk mencari "samurai yang berbau bunga matahari"', 2004, 'posters/9Xl93aM6Tyl79lO6DL7MfuldkOeUuYG6YXjfuxQX.jpg', '2026-07-17 19:34:20', '2026-07-20 04:35:50'),
	(23, 9, 'Steins; Gate', 'steins-gate', 'anime', 'Rintarou Okabe, ilmuwan eksentrik yang haus akan penemuan, bersama Mayuri Shiina dan Itaru Hashida mendirikan Future Gadget Laboratory untuk menciptakan teknologi yang mengejutkan dunia. Meski hasil terbaik mereka hanyalah microwave yang bisa mengubah pisang menjadi bubur hijau, semuanya berubah saat Okabe tanpa sengaja menemukan bahwa alat itu dapat mengirim pesan teks ke masa lalu. Penemuan ini menyeretnya ke dalam bahaya, membuatnya berhadapan dengan organisasi misterius SERN sekaligus memaksa dirinya berjuang menyelamatkan orang-orang terdekat dan menjaga kewarasan saat garis waktu mulai kacau.', 2011, 'posters/oZjWTLR0WjvDWSUPcLJzYAfrrPfV2lf8wBG954qK.jpg', '2026-07-20 04:26:38', '2026-07-20 04:33:41');

-- Dumping structure for table mediaverse.media_genres
CREATE TABLE IF NOT EXISTS `media_genres` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `media_id` bigint unsigned NOT NULL,
  `genre_id` bigint unsigned NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `media_genres_media_id_genre_id_unique` (`media_id`,`genre_id`),
  KEY `media_genres_genre_id_foreign` (`genre_id`),
  CONSTRAINT `media_genres_genre_id_foreign` FOREIGN KEY (`genre_id`) REFERENCES `genres` (`id`) ON DELETE CASCADE,
  CONSTRAINT `media_genres_media_id_foreign` FOREIGN KEY (`media_id`) REFERENCES `media` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=58 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Dumping data for table mediaverse.media_genres: ~42 rows (approximately)
INSERT INTO `media_genres` (`id`, `media_id`, `genre_id`) VALUES
	(1, 1, 1),
	(9, 1, 2),
	(7, 1, 4),
	(10, 1, 7),
	(3, 2, 1),
	(8, 2, 3),
	(14, 2, 7),
	(5, 3, 1),
	(24, 3, 2),
	(6, 3, 3),
	(25, 3, 4),
	(11, 4, 1),
	(43, 4, 3),
	(15, 5, 1),
	(16, 5, 2),
	(17, 5, 6),
	(19, 6, 6),
	(20, 6, 8),
	(21, 7, 1),
	(23, 7, 8),
	(26, 8, 2),
	(27, 8, 3),
	(29, 9, 1),
	(30, 9, 3),
	(31, 9, 6),
	(32, 10, 1),
	(33, 10, 4),
	(34, 10, 6),
	(35, 11, 3),
	(36, 11, 6),
	(37, 11, 8),
	(38, 12, 3),
	(40, 19, 3),
	(47, 22, 1),
	(48, 22, 2),
	(49, 22, 4),
	(56, 22, 17),
	(57, 22, 24),
	(50, 23, 3),
	(51, 23, 6),
	(52, 23, 7),
	(54, 23, 16),
	(53, 23, 23),
	(55, 23, 26);

-- Dumping structure for table mediaverse.migrations
CREATE TABLE IF NOT EXISTS `migrations` (
  `id` int unsigned NOT NULL AUTO_INCREMENT,
  `migration` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `batch` int NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=15 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Dumping data for table mediaverse.migrations: ~13 rows (approximately)
INSERT INTO `migrations` (`id`, `migration`, `batch`) VALUES
	(1, '0001_01_01_000000_create_users_table', 1),
	(2, '0001_01_01_000001_create_cache_table', 1),
	(3, '0001_01_01_000002_create_jobs_table', 1),
	(5, '2026_07_11_164027_add_role_and_status_to_users_table', 2),
	(6, '2026_07_14_093354_create_studios_table', 3),
	(7, '2026_07_14_093434_create_genres_table', 3),
	(8, '2026_07_14_093456_create_media_table', 3),
	(9, '2026_07_14_093510_create_media_genres_table', 3),
	(10, '2026_07_14_093526_create_reviews_table', 3),
	(11, '2026_07_14_093531_create_watchlists_table', 3),
	(12, '2026_07_14_093549_create_favorites_table', 3),
	(13, '2026_07_18_093230_add_avatar_path_to_users_table', 4),
	(14, '2026_07_18_093245_create_profile_comments_table', 4);

-- Dumping structure for table mediaverse.password_reset_tokens
CREATE TABLE IF NOT EXISTS `password_reset_tokens` (
  `email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `token` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`email`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Dumping data for table mediaverse.password_reset_tokens: ~0 rows (approximately)

-- Dumping structure for table mediaverse.profile_comments
CREATE TABLE IF NOT EXISTS `profile_comments` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `profile_user_id` bigint unsigned NOT NULL,
  `commenter_id` bigint unsigned NOT NULL,
  `body` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `profile_comments_profile_user_id_foreign` (`profile_user_id`),
  KEY `profile_comments_commenter_id_foreign` (`commenter_id`),
  CONSTRAINT `profile_comments_commenter_id_foreign` FOREIGN KEY (`commenter_id`) REFERENCES `users` (`id`) ON DELETE CASCADE,
  CONSTRAINT `profile_comments_profile_user_id_foreign` FOREIGN KEY (`profile_user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Dumping data for table mediaverse.profile_comments: ~0 rows (approximately)

-- Dumping structure for table mediaverse.reviews
CREATE TABLE IF NOT EXISTS `reviews` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `user_id` bigint unsigned NOT NULL,
  `media_id` bigint unsigned NOT NULL,
  `rating` tinyint unsigned NOT NULL,
  `review_text` text COLLATE utf8mb4_unicode_ci,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `reviews_user_id_media_id_unique` (`user_id`,`media_id`),
  KEY `reviews_media_id_foreign` (`media_id`),
  CONSTRAINT `reviews_media_id_foreign` FOREIGN KEY (`media_id`) REFERENCES `media` (`id`) ON DELETE CASCADE,
  CONSTRAINT `reviews_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=21 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Dumping data for table mediaverse.reviews: ~13 rows (approximately)
INSERT INTO `reviews` (`id`, `user_id`, `media_id`, `rating`, `review_text`, `created_at`, `updated_at`) VALUES
	(1, 1, 1, 9, 'OG anime 2nd', '2026-07-14 22:02:51', '2026-07-14 22:03:07'),
	(2, 2, 1, 7, 'Review dummy dari admin untuk keperluan testing tampilan rating.', '2026-07-14 22:46:59', '2026-07-14 22:46:59'),
	(3, 2, 4, 10, 'Review dummy dari admin untuk keperluan testing tampilan rating.', '2026-07-14 22:46:59', '2026-07-14 22:46:59'),
	(4, 2, 2, 7, 'Review dummy dari admin untuk keperluan testing tampilan rating.', '2026-07-14 22:46:59', '2026-07-14 22:46:59'),
	(5, 2, 5, 7, 'Review dummy dari admin untuk keperluan testing tampilan rating.', '2026-07-14 22:46:59', '2026-07-14 22:46:59'),
	(6, 2, 6, 10, 'Review dummy dari admin untuk keperluan testing tampilan rating.', '2026-07-14 22:46:59', '2026-07-14 22:46:59'),
	(7, 2, 7, 10, 'Review dummy dari admin untuk keperluan testing tampilan rating. update', '2026-07-14 22:46:59', '2026-07-18 21:46:58'),
	(8, 2, 3, 7, 'Review dummy dari admin untuk keperluan testing tampilan rating.', '2026-07-14 22:46:59', '2026-07-14 22:46:59'),
	(9, 2, 8, 10, 'Review dummy dari admin untuk keperluan testing tampilan rating.', '2026-07-14 22:46:59', '2026-07-14 22:46:59'),
	(10, 2, 9, 9, 'Review dummy dari admin untuk keperluan testing tampilan rating.', '2026-07-14 22:46:59', '2026-07-14 22:46:59'),
	(11, 2, 10, 6, 'Review dummy dari admin untuk keperluan testing tampilan rating.', '2026-07-14 22:46:59', '2026-07-14 22:46:59'),
	(12, 2, 11, 8, 'Review dummy dari admin untuk keperluan testing tampilan rating.', '2026-07-14 22:46:59', '2026-07-14 22:46:59'),
	(13, 2, 12, 6, 'Review dummy dari admin untuk keperluan testing tampilan rating.', '2026-07-14 22:46:59', '2026-07-14 22:46:59'),
	(14, 4, 19, 8, 'Ghibli? lit as always', '2026-07-16 18:24:10', '2026-07-16 18:24:10'),
	(15, 3, 3, 9, 'testing review', '2026-07-17 03:33:30', '2026-07-17 03:33:30'),
	(16, 2, 19, 10, 'Engineer??? I\'m in', '2026-07-17 10:16:26', '2026-07-17 10:16:26'),
	(17, 4, 10, 9, 'Beautiful', '2026-07-17 10:31:04', '2026-07-17 10:31:04'),
	(18, 2, 22, 10, 'In the name of Samurai! ..... "Son of battlecry"', '2026-07-17 19:56:48', '2026-07-17 19:56:48'),
	(19, 1, 10, 10, '"What\'s is love" god damn, broo', '2026-07-17 23:52:44', '2026-07-17 23:52:44'),
	(20, 2, 23, 10, 'Peak; Gate , plot twist at its PEAK', '2026-07-20 04:37:17', '2026-07-20 04:37:17');

-- Dumping structure for table mediaverse.sessions
CREATE TABLE IF NOT EXISTS `sessions` (
  `id` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `user_id` bigint unsigned DEFAULT NULL,
  `ip_address` varchar(45) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `user_agent` text COLLATE utf8mb4_unicode_ci,
  `payload` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `last_activity` int NOT NULL,
  PRIMARY KEY (`id`),
  KEY `sessions_user_id_index` (`user_id`),
  KEY `sessions_last_activity_index` (`last_activity`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Dumping data for table mediaverse.sessions: ~3 rows (approximately)
INSERT INTO `sessions` (`id`, `user_id`, `ip_address`, `user_agent`, `payload`, `last_activity`) VALUES
	('T6WlleQkEpH5ZRtP9Xso2rJbJEWxfg5ExIHD2Jng', NULL, '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/150.0.0.0 Safari/537.36', 'eyJfdG9rZW4iOiJNSTJWM2FsRWRyZXM4cWpJa2l3VXlkeFRDUU8yR1lac2RTdXllbHJkIiwiX3ByZXZpb3VzIjp7InVybCI6Imh0dHA6XC9cL21lZGlhdmVyc2UudGVzdCIsInJvdXRlIjoiaG9tZSJ9LCJfZmxhc2giOnsib2xkIjpbXSwibmV3IjpbXX19', 1784549014),
	('WrhCBjQoCajnyJuRjY7H8n5e2nNeJVR7xwlCMjAf', 2, '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/150.0.0.0 Safari/537.36', 'eyJfdG9rZW4iOiJjMkVNaEtNU1JvQW80bUtuZDdRUXAzQ2poZ1Jlc05SVUlPWFo2cmpCIiwiX3ByZXZpb3VzIjp7InVybCI6Imh0dHA6XC9cL21lZGlhdmVyc2UudGVzdFwvbWVkaWFcL3ByaW5jZXNzLW1vbm9ub2tlIiwicm91dGUiOiJtZWRpYS5zaG93In0sIl9mbGFzaCI6eyJvbGQiOltdLCJuZXciOltdfSwibG9naW5fd2ViXzU5YmEzNmFkZGMyYjJmOTQwMTU4MGYwMTRjN2Y1OGVhNGUzMDk4OWQiOjJ9', 1784551300),
	('zv6emaS3oTeEE17aH3ArBeNFCwIfZX9uamIoCB9y', NULL, '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/150.0.0.0 Safari/537.36', 'eyJfdG9rZW4iOiJ4Z2xUSzI0WEZGQWVEV0Q1YzYwbUpXOHNxOERUZmljZ0MxRDJ4cEpjIiwiX3ByZXZpb3VzIjp7InVybCI6Imh0dHA6XC9cL21lZGlhdmVyc2UudGVzdCIsInJvdXRlIjoiaG9tZSJ9LCJfZmxhc2giOnsib2xkIjpbXSwibmV3IjpbXX19', 1784549014);

-- Dumping structure for table mediaverse.studios
CREATE TABLE IF NOT EXISTS `studios` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(150) COLLATE utf8mb4_unicode_ci NOT NULL,
  `description` text COLLATE utf8mb4_unicode_ci,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `studios_name_unique` (`name`)
) ENGINE=InnoDB AUTO_INCREMENT=10 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Dumping data for table mediaverse.studios: ~9 rows (approximately)
INSERT INTO `studios` (`id`, `name`, `description`, `created_at`, `updated_at`) VALUES
	(1, 'Studio Ghibli', NULL, '2026-07-14 08:08:35', '2026-07-14 08:08:35'),
	(2, 'Marvel Studios', NULL, '2026-07-14 22:46:58', '2026-07-14 22:46:58'),
	(3, 'A24', NULL, '2026-07-14 22:46:58', '2026-07-14 22:46:58'),
	(4, 'Netflix Originals', NULL, '2026-07-14 22:46:58', '2026-07-14 22:46:58'),
	(5, 'Kyoto Animation', NULL, '2026-07-14 22:46:58', '2026-07-14 22:46:58'),
	(6, 'MAPPA', 'Pecahan studio dari Madhouse', '2026-07-18 02:17:38', '2026-07-18 02:17:38'),
	(7, 'Madhouse', NULL, '2026-07-18 02:19:18', '2026-07-18 02:19:18'),
	(8, 'Manglobe', NULL, '2026-07-20 04:28:17', '2026-07-20 04:28:17'),
	(9, 'White Fox', NULL, '2026-07-20 04:28:33', '2026-07-20 04:28:33');

-- Dumping structure for table mediaverse.users
CREATE TABLE IF NOT EXISTS `users` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email_verified_at` timestamp NULL DEFAULT NULL,
  `password` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `role` enum('user','admin','absolute_admin') COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'user',
  `is_active` tinyint(1) NOT NULL DEFAULT '1',
  `avatar_path` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `remember_token` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `users_email_unique` (`email`)
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Dumping data for table mediaverse.users: ~4 rows (approximately)
INSERT INTO `users` (`id`, `name`, `email`, `email_verified_at`, `password`, `role`, `is_active`, `avatar_path`, `remember_token`, `created_at`, `updated_at`) VALUES
	(1, 'Ane Pro', 'aneproplayer@gmail.com', NULL, '$2y$12$K3DGY6hTsM4jLvWRADWNLO.ZY9FayjiKbPgeJ6P8NeFcChv7lc6EW', 'user', 1, NULL, 'jKv6sCL673fkRHooLB9uwVYUrMP4oWuR1BpqsnJ17rbgm4pffIoMY2gzBTH4', '2026-07-11 23:12:05', '2026-07-16 05:56:01'),
	(2, 'MediaVerse Super Admin', 'admin@mediaverse.test', '2026-07-12 23:33:17', '$2y$12$cm81vFp22JDNdxQ2vNR0eetXIEYNGxykMqACVz1BQykOk5Ca1vNce', 'absolute_admin', 1, 'avatars/BM4zGFD9pNNnViOhFnzsT9e84Ej2SzfmOCPAU4GR.jpg', NULL, '2026-07-12 23:33:18', '2026-07-18 02:37:45'),
	(3, 'Test Admin', 'testadmin@mediaverse.test', NULL, '$2y$12$hOfjpELQPLUcB9l7ZXrgIunuccyiA2x.qRv9esRg.KouCYQReto4.', 'admin', 1, NULL, NULL, '2026-07-13 19:15:54', '2026-07-15 23:18:05'),
	(4, 'Ane Gege', 'anegegelurr@gmail.com', NULL, '$2y$12$pRBT07DeP7eucoh2/Qn3vOgMYp/BWxKzwZBk1QZS6A/bvzCvls1NW', 'user', 1, 'avatars/mSFGpmR5hNb7H3L0IjtvGKMWvhJdJIQil4j1FPXp.jpg', NULL, '2026-07-16 05:23:38', '2026-07-18 02:45:29');

-- Dumping structure for table mediaverse.watchlists
CREATE TABLE IF NOT EXISTS `watchlists` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `user_id` bigint unsigned NOT NULL,
  `media_id` bigint unsigned NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `watchlists_user_id_media_id_unique` (`user_id`,`media_id`),
  KEY `watchlists_media_id_foreign` (`media_id`),
  CONSTRAINT `watchlists_media_id_foreign` FOREIGN KEY (`media_id`) REFERENCES `media` (`id`) ON DELETE CASCADE,
  CONSTRAINT `watchlists_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=13 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Dumping data for table mediaverse.watchlists: ~5 rows (approximately)
INSERT INTO `watchlists` (`id`, `user_id`, `media_id`, `created_at`, `updated_at`) VALUES
	(1, 1, 2, '2026-07-14 22:04:20', '2026-07-14 22:04:20'),
	(2, 4, 19, '2026-07-17 03:16:55', '2026-07-17 03:16:55'),
	(3, 4, 10, '2026-07-17 03:17:19', '2026-07-17 03:17:19'),
	(4, 3, 4, '2026-07-17 03:32:41', '2026-07-17 03:32:41'),
	(5, 3, 3, '2026-07-17 03:33:09', '2026-07-17 03:33:09'),
	(6, 2, 22, '2026-07-17 19:56:53', '2026-07-17 19:56:53'),
	(7, 4, 22, '2026-07-18 00:40:54', '2026-07-18 00:40:54'),
	(8, 2, 10, '2026-07-18 02:08:05', '2026-07-18 02:08:05'),
	(9, 2, 1, '2026-07-18 07:49:14', '2026-07-18 07:49:14'),
	(10, 2, 3, '2026-07-18 08:25:05', '2026-07-18 08:25:05'),
	(11, 2, 7, '2026-07-18 21:46:17', '2026-07-18 21:46:17'),
	(12, 2, 23, '2026-07-20 04:36:52', '2026-07-20 04:36:52');

/*!40103 SET TIME_ZONE=IFNULL(@OLD_TIME_ZONE, 'system') */;
/*!40101 SET SQL_MODE=IFNULL(@OLD_SQL_MODE, '') */;
/*!40014 SET FOREIGN_KEY_CHECKS=IFNULL(@OLD_FOREIGN_KEY_CHECKS, 1) */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40111 SET SQL_NOTES=IFNULL(@OLD_SQL_NOTES, 1) */;
