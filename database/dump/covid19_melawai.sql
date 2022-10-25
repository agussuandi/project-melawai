/*
 Navicat Premium Data Transfer

 Source Server         : localhost
 Source Server Type    : MySQL
 Source Server Version : 100424
 Source Host           : localhost:3306
 Source Schema         : covid19_melawai

 Target Server Type    : MySQL
 Target Server Version : 100424
 File Encoding         : 65001

 Date: 21/10/2022 18:15:26
*/

SET NAMES utf8mb4;
SET FOREIGN_KEY_CHECKS = 0;

-- ----------------------------
-- Table structure for failed_jobs
-- ----------------------------
DROP TABLE IF EXISTS `failed_jobs`;
CREATE TABLE `failed_jobs`  (
  `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT,
  `uuid` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `connection` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `queue` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `payload` longtext CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `exception` longtext CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `failed_at` timestamp(0) NOT NULL DEFAULT current_timestamp(0),
  PRIMARY KEY (`id`) USING BTREE,
  UNIQUE INDEX `failed_jobs_uuid_unique`(`uuid`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 1 CHARACTER SET = utf8mb4 COLLATE = utf8mb4_unicode_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Table structure for his_karyawan_covid19
-- ----------------------------
DROP TABLE IF EXISTS `his_karyawan_covid19`;
CREATE TABLE `his_karyawan_covid19`  (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `karyawan_id` int(11) NOT NULL,
  `positive_date` date NOT NULL,
  `note` text CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `created_by` int(11) NOT NULL,
  `created_at` datetime(0) NOT NULL,
  PRIMARY KEY (`id`) USING BTREE,
  INDEX `fk_m_karyawan_his_covid19`(`karyawan_id`) USING BTREE,
  CONSTRAINT `fk_m_karyawan_his_covid19` FOREIGN KEY (`karyawan_id`) REFERENCES `m_karyawan` (`id`) ON DELETE RESTRICT ON UPDATE RESTRICT
) ENGINE = InnoDB AUTO_INCREMENT = 13 CHARACTER SET = utf8mb4 COLLATE = utf8mb4_general_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Records of his_karyawan_covid19
-- ----------------------------
INSERT INTO `his_karyawan_covid19` VALUES (1, 6, '2022-10-20', 'Gejala flu ringan & indra penciuman tidak berfungsi, karyawan melakukan isolasi mandiri dirumah kediaman', 1, '2022-10-21 09:26:02');
INSERT INTO `his_karyawan_covid19` VALUES (8, 6, '2022-10-20', 'Karyawan dinyatakan sudah negatif/sembuh dari Covid19', 1, '2022-10-21 10:35:17');
INSERT INTO `his_karyawan_covid19` VALUES (11, 4, '2022-10-15', 'Gejala ringan dan isoman', 1, '2022-10-21 10:43:19');
INSERT INTO `his_karyawan_covid19` VALUES (12, 4, '2022-10-15', 'Karyawan sudah melakukan swap PCR dengan nilai rendah', 1, '2022-10-21 10:58:02');

-- ----------------------------
-- Table structure for m_karyawan
-- ----------------------------
DROP TABLE IF EXISTS `m_karyawan`;
CREATE TABLE `m_karyawan`  (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(200) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `birth_date` date NOT NULL,
  `address` text CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `jabatan` varchar(50) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `flag_covid19` tinyint(1) NOT NULL DEFAULT 0,
  `created_by` int(11) NOT NULL,
  `created_at` datetime(0) NOT NULL,
  `updated_by` int(11) NULL DEFAULT NULL,
  `updated_at` datetime(0) NULL DEFAULT NULL,
  PRIMARY KEY (`id`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 14 CHARACTER SET = utf8mb4 COLLATE = utf8mb4_general_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Records of m_karyawan
-- ----------------------------
INSERT INTO `m_karyawan` VALUES (1, 'Ika Noviyanti', '2022-10-19', 'Jl Demila Blok 4 No 17', 'Manager', 0, 1, '2022-10-21 10:29:49', 1, '2022-10-21 10:33:56');
INSERT INTO `m_karyawan` VALUES (2, 'Umar', '1995-10-21', 'Jl Rawa Pasung Kota Bekasi', 'Staff IT', 0, 1, '2022-10-21 08:36:45', NULL, NULL);
INSERT INTO `m_karyawan` VALUES (3, 'Ibrahim', '1990-10-10', 'Jl Gunung Kelud Kota Bekasi', 'Staff IT', 0, 1, '2022-10-21 08:37:13', NULL, NULL);
INSERT INTO `m_karyawan` VALUES (4, 'Amir', '1999-02-01', 'Jl Delima Raya Blok C', 'Staff Keuangan', 1, 1, '2022-10-21 08:38:04', 1, '2022-10-21 10:43:19');
INSERT INTO `m_karyawan` VALUES (5, 'Aisyah', '2001-02-07', 'Jl Simatupang', 'Staff Keuangan', 0, 1, '2022-10-21 08:38:30', NULL, NULL);
INSERT INTO `m_karyawan` VALUES (6, 'Kurniawati', '1998-02-24', 'Jl Kebun Raya Bogor Kota Bogor', 'Staff Keuangan', 0, 1, '2022-10-21 08:39:41', 1, '2022-10-21 10:35:17');
INSERT INTO `m_karyawan` VALUES (7, 'Bilqis', '1994-02-20', 'Jl Harapan Baru Kota Bekasi', 'Staff HR', 0, 1, '2022-10-21 08:40:24', NULL, NULL);
INSERT INTO `m_karyawan` VALUES (8, 'Alfatih', '1996-09-28', 'Jl Kemakmuran Kota Bandung', 'Staff HR', 0, 1, '2022-10-21 08:41:10', NULL, NULL);
INSERT INTO `m_karyawan` VALUES (9, 'Arthur', '1992-07-19', 'Jl Kebangkitan Kabupeten Bekasi', 'Super Visor', 0, 1, '2022-10-21 08:41:44', NULL, NULL);
INSERT INTO `m_karyawan` VALUES (10, 'Raven', '1993-04-28', 'Jl Harapan Indah Blok A Kota Bekasi', 'Super Visor', 0, 1, '2022-10-21 08:42:25', NULL, NULL);
INSERT INTO `m_karyawan` VALUES (11, 'Zubair', '1998-04-01', 'Jl Gunung Pangrango Tambun', 'Super Visor', 0, 1, '2022-10-21 08:43:06', NULL, NULL);
INSERT INTO `m_karyawan` VALUES (12, 'Ahmad', '1999-09-09', 'Jl Semeru Kota Bintang', 'Staff HR', 0, 1, '2022-10-21 08:45:15', NULL, NULL);
INSERT INTO `m_karyawan` VALUES (13, 'Debian', '1999-04-08', 'Jl Raya Siliwangi Kota Bekasi', 'Staff IT', 0, 1, '2022-10-21 08:45:43', NULL, NULL);

-- ----------------------------
-- Table structure for migrations
-- ----------------------------
DROP TABLE IF EXISTS `migrations`;
CREATE TABLE `migrations`  (
  `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT,
  `migration` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `batch` int(11) NOT NULL,
  PRIMARY KEY (`id`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 5 CHARACTER SET = utf8mb4 COLLATE = utf8mb4_unicode_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Records of migrations
-- ----------------------------
INSERT INTO `migrations` VALUES (1, '2014_10_12_000000_create_users_table', 1);
INSERT INTO `migrations` VALUES (2, '2014_10_12_100000_create_password_resets_table', 1);
INSERT INTO `migrations` VALUES (3, '2019_08_19_000000_create_failed_jobs_table', 1);
INSERT INTO `migrations` VALUES (4, '2019_12_14_000001_create_personal_access_tokens_table', 1);

-- ----------------------------
-- Table structure for password_resets
-- ----------------------------
DROP TABLE IF EXISTS `password_resets`;
CREATE TABLE `password_resets`  (
  `email` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `token` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp(0) NULL DEFAULT NULL,
  INDEX `password_resets_email_index`(`email`) USING BTREE
) ENGINE = InnoDB CHARACTER SET = utf8mb4 COLLATE = utf8mb4_unicode_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Table structure for personal_access_tokens
-- ----------------------------
DROP TABLE IF EXISTS `personal_access_tokens`;
CREATE TABLE `personal_access_tokens`  (
  `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT,
  `tokenable_type` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `tokenable_id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `token` varchar(64) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `abilities` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NULL,
  `last_used_at` timestamp(0) NULL DEFAULT NULL,
  `expires_at` timestamp(0) NULL DEFAULT NULL,
  `created_at` timestamp(0) NULL DEFAULT NULL,
  `updated_at` timestamp(0) NULL DEFAULT NULL,
  PRIMARY KEY (`id`) USING BTREE,
  UNIQUE INDEX `personal_access_tokens_token_unique`(`token`) USING BTREE,
  INDEX `personal_access_tokens_tokenable_type_tokenable_id_index`(`tokenable_type`, `tokenable_id`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 1 CHARACTER SET = utf8mb4 COLLATE = utf8mb4_unicode_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Table structure for rel_karyawan_keluarga_vaksin
-- ----------------------------
DROP TABLE IF EXISTS `rel_karyawan_keluarga_vaksin`;
CREATE TABLE `rel_karyawan_keluarga_vaksin`  (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `karyawan_id` int(11) NOT NULL,
  `created_by` int(11) NOT NULL,
  `created_at` datetime(0) NOT NULL,
  `updated_by` int(11) NULL DEFAULT NULL,
  `updated_at` datetime(0) NULL DEFAULT NULL,
  PRIMARY KEY (`id`) USING BTREE,
  INDEX `fk_m_karyawan_rel_karyawan_keluarga_vaksin`(`karyawan_id`) USING BTREE,
  CONSTRAINT `fk_m_karyawan_rel_karyawan_keluarga_vaksin` FOREIGN KEY (`karyawan_id`) REFERENCES `m_karyawan` (`id`) ON DELETE RESTRICT ON UPDATE RESTRICT
) ENGINE = InnoDB AUTO_INCREMENT = 7 CHARACTER SET = utf8mb4 COLLATE = utf8mb4_general_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Records of rel_karyawan_keluarga_vaksin
-- ----------------------------
INSERT INTO `rel_karyawan_keluarga_vaksin` VALUES (5, 1, 1, '2022-10-21 06:31:46', NULL, NULL);

-- ----------------------------
-- Table structure for rel_karyawan_keluarga_vaksin_sertifikat
-- ----------------------------
DROP TABLE IF EXISTS `rel_karyawan_keluarga_vaksin_sertifikat`;
CREATE TABLE `rel_karyawan_keluarga_vaksin_sertifikat`  (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `karyawan_keluarga_vaksin_id` int(11) NOT NULL,
  `name` varchar(200) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `relation` varchar(50) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `vaksin` varchar(50) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `sertifikat_vaksin` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `created_by` int(11) NOT NULL,
  `created_at` datetime(0) NOT NULL,
  `updated_by` int(11) NULL DEFAULT NULL,
  `updated_at` datetime(0) NULL DEFAULT NULL,
  PRIMARY KEY (`id`) USING BTREE,
  INDEX `fk_rel_karyawan`(`karyawan_keluarga_vaksin_id`) USING BTREE,
  CONSTRAINT `fk_rel_karyawan` FOREIGN KEY (`karyawan_keluarga_vaksin_id`) REFERENCES `rel_karyawan_keluarga_vaksin` (`id`) ON DELETE RESTRICT ON UPDATE RESTRICT
) ENGINE = InnoDB AUTO_INCREMENT = 4 CHARACTER SET = utf8mb4 COLLATE = utf8mb4_general_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Records of rel_karyawan_keluarga_vaksin_sertifikat
-- ----------------------------
INSERT INTO `rel_karyawan_keluarga_vaksin_sertifikat` VALUES (1, 5, 'Agus Suandi', 'Suami', 'Vaksin 1', 'storage/vaksin/1/vaksin-1_karyawan-1-keluarga-Agus Suandi-pdf', 1, '2022-10-21 06:31:46', NULL, NULL);
INSERT INTO `rel_karyawan_keluarga_vaksin_sertifikat` VALUES (2, 5, 'Agus Suandi', 'Suami', 'Vaksin 2', 'storage/vaksin/1/vaksin-2_karyawan-1-keluarga-Agus Suandi-png', 1, '2022-10-21 06:31:46', NULL, NULL);
INSERT INTO `rel_karyawan_keluarga_vaksin_sertifikat` VALUES (3, 5, 'Agus Suandi', 'Suami', 'Vaksin Booster 1', 'storage/vaksin/1/vaksin-booster-1_karyawan-1-keluarga-Agus Suandi.jpg', 1, '2022-10-21 06:31:46', 1, '2022-10-21 07:11:24');

-- ----------------------------
-- Table structure for rel_karyawan_vaksin
-- ----------------------------
DROP TABLE IF EXISTS `rel_karyawan_vaksin`;
CREATE TABLE `rel_karyawan_vaksin`  (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `karyawan_id` int(11) NOT NULL,
  `vaksin` varchar(50) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `sertifikat_vaksin` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `created_by` int(11) NOT NULL,
  `created_at` datetime(0) NOT NULL,
  `updated_by` int(11) NULL DEFAULT NULL,
  `updated_at` datetime(0) NULL DEFAULT NULL,
  PRIMARY KEY (`id`) USING BTREE,
  INDEX `fk_m_karyawan_rel_karyawan_vaksin`(`karyawan_id`) USING BTREE,
  CONSTRAINT `fk_m_karyawan_rel_karyawan_vaksin` FOREIGN KEY (`karyawan_id`) REFERENCES `m_karyawan` (`id`) ON DELETE RESTRICT ON UPDATE RESTRICT
) ENGINE = InnoDB AUTO_INCREMENT = 2 CHARACTER SET = utf8mb4 COLLATE = utf8mb4_general_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Records of rel_karyawan_vaksin
-- ----------------------------
INSERT INTO `rel_karyawan_vaksin` VALUES (1, 1, 'Vaksin 1', 'storage/vaksin//vaksin-1_karyawan--pdf', 1, '2022-10-20 05:22:11', NULL, NULL);

-- ----------------------------
-- Table structure for users
-- ----------------------------
DROP TABLE IF EXISTS `users`;
CREATE TABLE `users`  (
  `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT,
  `name` varchar(200) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `username` varchar(60) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `email` varchar(150) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `email_verified_at` timestamp(0) NULL DEFAULT NULL,
  `password` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `remember_token` varchar(100) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NULL DEFAULT NULL,
  `created_at` timestamp(0) NULL DEFAULT NULL,
  `updated_at` timestamp(0) NULL DEFAULT NULL,
  PRIMARY KEY (`id`) USING BTREE,
  UNIQUE INDEX `users_email_unique`(`email`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 2 CHARACTER SET = utf8mb4 COLLATE = utf8mb4_unicode_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Records of users
-- ----------------------------
INSERT INTO `users` VALUES (1, 'Agus Suandi', 'agus.suandi', 'agussuandi48@gmail.com', NULL, '$2a$12$iU9V23YbMFailPq49GLKp.3PpAlpum94Q7HDfLKD9c6R5dYiv5bKG', NULL, '2022-10-19 17:21:22', NULL);

SET FOREIGN_KEY_CHECKS = 1;
