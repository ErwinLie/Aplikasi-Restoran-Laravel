/*
 Navicat Premium Data Transfer

 Source Server         : Erwin
 Source Server Type    : MySQL
 Source Server Version : 100422 (10.4.22-MariaDB)
 Source Host           : localhost:3306
 Source Schema         : restoran

 Target Server Type    : MySQL
 Target Server Version : 100422 (10.4.22-MariaDB)
 File Encoding         : 65001

 Date: 03/02/2025 15:11:57
*/

SET NAMES utf8mb4;
SET FOREIGN_KEY_CHECKS = 0;

-- ----------------------------
-- Table structure for tb_activity
-- ----------------------------
DROP TABLE IF EXISTS `tb_activity`;
CREATE TABLE `tb_activity`  (
  `id_activity` int NOT NULL AUTO_INCREMENT,
  `id_user` int NULL DEFAULT NULL,
  `activity` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NULL DEFAULT NULL,
  `timestamp` datetime NULL DEFAULT NULL,
  `delete_at` datetime NULL DEFAULT NULL,
  `delete_by` int NULL DEFAULT NULL,
  `update_at` datetime NULL DEFAULT NULL,
  `update_by` int NULL DEFAULT NULL,
  PRIMARY KEY (`id_activity`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 1282 CHARACTER SET = utf8mb4 COLLATE = utf8mb4_general_ci ROW_FORMAT = DYNAMIC;

-- ----------------------------
-- Records of tb_activity
-- ----------------------------
INSERT INTO `tb_activity` VALUES (1257, NULL, 'User melakukan Login', '2025-02-03 03:02:12', NULL, NULL, NULL, NULL);
INSERT INTO `tb_activity` VALUES (1258, 1, 'User Membuka Menu Profile', '2025-02-03 03:04:41', NULL, NULL, NULL, NULL);
INSERT INTO `tb_activity` VALUES (1259, 1, 'User Membuka Menu Profile', '2025-02-03 03:06:11', NULL, NULL, NULL, NULL);
INSERT INTO `tb_activity` VALUES (1260, 1, 'User membuka Log Activity', '2025-02-03 03:10:47', NULL, NULL, NULL, NULL);
INSERT INTO `tb_activity` VALUES (1261, 1, 'User Membuka Menu Setting', '2025-02-03 03:10:51', NULL, NULL, NULL, NULL);
INSERT INTO `tb_activity` VALUES (1262, 1, 'User Membuka Menu Setting', '2025-02-03 03:11:17', NULL, NULL, NULL, NULL);
INSERT INTO `tb_activity` VALUES (1263, NULL, 'User melakukan Login', '2025-02-03 06:09:17', NULL, NULL, NULL, NULL);
INSERT INTO `tb_activity` VALUES (1264, 1, 'User Membuka Menu Profile', '2025-02-03 06:10:46', NULL, NULL, NULL, NULL);
INSERT INTO `tb_activity` VALUES (1265, 1, 'User Membuka Menu Profile', '2025-02-03 06:44:26', NULL, NULL, NULL, NULL);
INSERT INTO `tb_activity` VALUES (1266, 1, 'User Membuka Menu Profile', '2025-02-03 06:45:02', NULL, NULL, NULL, NULL);
INSERT INTO `tb_activity` VALUES (1267, 1, 'User Membuka Menu Profile', '2025-02-03 06:45:42', NULL, NULL, NULL, NULL);
INSERT INTO `tb_activity` VALUES (1268, 1, 'User Membuka Menu Profile', '2025-02-03 06:46:34', NULL, NULL, NULL, NULL);
INSERT INTO `tb_activity` VALUES (1269, 1, 'User Membuka Menu Profile', '2025-02-03 06:47:13', NULL, NULL, NULL, NULL);
INSERT INTO `tb_activity` VALUES (1270, 1, 'User Membuka Menu Setting', '2025-02-03 06:51:54', NULL, NULL, NULL, NULL);
INSERT INTO `tb_activity` VALUES (1271, 1, 'User Membuka Menu Setting', '2025-02-03 06:53:01', NULL, NULL, NULL, NULL);
INSERT INTO `tb_activity` VALUES (1272, 1, 'User Melakukan Edit Setting', '2025-02-03 06:53:06', NULL, NULL, NULL, NULL);
INSERT INTO `tb_activity` VALUES (1273, 1, 'User Membuka Menu Setting', '2025-02-03 06:53:06', NULL, NULL, NULL, NULL);
INSERT INTO `tb_activity` VALUES (1274, 1, 'User Membuka Menu Setting', '2025-02-03 06:53:57', NULL, NULL, NULL, NULL);
INSERT INTO `tb_activity` VALUES (1275, 1, 'User Melakukan Edit Setting', '2025-02-03 06:54:02', NULL, NULL, NULL, NULL);
INSERT INTO `tb_activity` VALUES (1276, 1, 'User Membuka Menu Setting', '2025-02-03 06:54:02', NULL, NULL, NULL, NULL);
INSERT INTO `tb_activity` VALUES (1277, NULL, 'User melakukan Login', '2025-02-03 06:54:13', NULL, NULL, NULL, NULL);
INSERT INTO `tb_activity` VALUES (1278, 1, 'User Membuka Menu User', '2025-02-03 08:05:49', NULL, NULL, NULL, NULL);
INSERT INTO `tb_activity` VALUES (1279, 1, 'User Membuka Menu User', '2025-02-03 08:06:09', NULL, NULL, NULL, NULL);
INSERT INTO `tb_activity` VALUES (1280, 1, 'User Membuka Menu User', '2025-02-03 08:06:25', NULL, NULL, NULL, NULL);
INSERT INTO `tb_activity` VALUES (1281, 1, 'User Membuka Menu User', '2025-02-03 08:06:43', NULL, NULL, NULL, NULL);

-- ----------------------------
-- Table structure for tb_member
-- ----------------------------
DROP TABLE IF EXISTS `tb_member`;
CREATE TABLE `tb_member`  (
  `id_member` int NOT NULL AUTO_INCREMENT,
  `nama_member` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NULL DEFAULT NULL,
  `kode_member` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NULL DEFAULT NULL,
  `expired_member` date NULL DEFAULT NULL,
  `delete_at` datetime NULL DEFAULT NULL,
  `delete_by` int NULL DEFAULT NULL,
  `update_at` datetime NULL DEFAULT NULL,
  `update_by` int NULL DEFAULT NULL,
  PRIMARY KEY (`id_member`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 1 CHARACTER SET = utf8mb4 COLLATE = utf8mb4_general_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Records of tb_member
-- ----------------------------

-- ----------------------------
-- Table structure for tb_menu
-- ----------------------------
DROP TABLE IF EXISTS `tb_menu`;
CREATE TABLE `tb_menu`  (
  `id_menu` int NOT NULL AUTO_INCREMENT,
  `nama_menu` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NULL DEFAULT NULL,
  `harga` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NULL DEFAULT NULL,
  `deskripsi` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NULL DEFAULT NULL,
  `kategori` enum('Makanan','Minuman','Dessert','Paket') CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NULL DEFAULT NULL,
  `delete_at` datetime NULL DEFAULT NULL,
  `delete_by` int NULL DEFAULT NULL,
  `update_at` datetime NULL DEFAULT NULL,
  `update_by` int NULL DEFAULT NULL,
  PRIMARY KEY (`id_menu`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 1 CHARACTER SET = utf8mb4 COLLATE = utf8mb4_general_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Records of tb_menu
-- ----------------------------

-- ----------------------------
-- Table structure for tb_setting
-- ----------------------------
DROP TABLE IF EXISTS `tb_setting`;
CREATE TABLE `tb_setting`  (
  `id_setting` int NOT NULL AUTO_INCREMENT,
  `logo_login` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NULL DEFAULT NULL,
  `logo_tab` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NULL DEFAULT NULL,
  `nama_web` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NULL DEFAULT NULL,
  `logo_dashboard` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NULL DEFAULT NULL,
  PRIMARY KEY (`id_setting`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 2 CHARACTER SET = utf8mb4 COLLATE = utf8mb4_general_ci ROW_FORMAT = DYNAMIC;

-- ----------------------------
-- Records of tb_setting
-- ----------------------------
INSERT INTO `tb_setting` VALUES (1, 'logo-sph.png', 'logo-sph.png', 'Restoran', 'logo-sph.png');

-- ----------------------------
-- Table structure for tb_transaksi
-- ----------------------------
DROP TABLE IF EXISTS `tb_transaksi`;
CREATE TABLE `tb_transaksi`  (
  `id_transaksi` int NOT NULL AUTO_INCREMENT,
  `id_member` int NULL DEFAULT NULL,
  `id_voucher` int NULL DEFAULT NULL,
  `id_menu` int NULL DEFAULT NULL,
  `kode_transaksi` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NULL DEFAULT NULL,
  `tanggal` datetime NULL DEFAULT NULL,
  `total` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NULL DEFAULT NULL,
  `diskon` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NULL DEFAULT NULL,
  `total_akhir` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NULL DEFAULT NULL,
  `bayar` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NULL DEFAULT NULL,
  `kembalian` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NULL DEFAULT NULL,
  `delete_at` datetime NULL DEFAULT NULL,
  `delete_by` int NULL DEFAULT NULL,
  `update_at` datetime NULL DEFAULT NULL,
  `update_by` int NULL DEFAULT NULL,
  PRIMARY KEY (`id_transaksi`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 1 CHARACTER SET = utf8mb4 COLLATE = utf8mb4_general_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Records of tb_transaksi
-- ----------------------------

-- ----------------------------
-- Table structure for tb_user
-- ----------------------------
DROP TABLE IF EXISTS `tb_user`;
CREATE TABLE `tb_user`  (
  `id_user` int NOT NULL AUTO_INCREMENT,
  `id_level` enum('1','2','3') CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NULL DEFAULT NULL,
  `username` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NULL DEFAULT NULL,
  `password` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NULL DEFAULT NULL,
  `email` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NULL DEFAULT NULL,
  `foto` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NULL DEFAULT NULL,
  `delete_at` datetime NULL DEFAULT NULL,
  `delete_by` int NULL DEFAULT NULL,
  `update_at` datetime NULL DEFAULT NULL,
  `update_by` int NULL DEFAULT NULL,
  PRIMARY KEY (`id_user`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 2 CHARACTER SET = utf8mb4 COLLATE = utf8mb4_general_ci ROW_FORMAT = DYNAMIC;

-- ----------------------------
-- Records of tb_user
-- ----------------------------
INSERT INTO `tb_user` VALUES (1, '1', 'admin', 'c4ca4238a0b923820dcc509a6f75849b', 'admin@gmail.com', 'avatar-3.png', NULL, NULL, NULL, NULL);

-- ----------------------------
-- Table structure for tb_voucher
-- ----------------------------
DROP TABLE IF EXISTS `tb_voucher`;
CREATE TABLE `tb_voucher`  (
  `id_voucher` int NOT NULL AUTO_INCREMENT,
  `kode_voucher` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NULL DEFAULT NULL,
  `diskon` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NULL DEFAULT NULL,
  `voucher_expired` date NULL DEFAULT NULL,
  `delete_at` datetime NULL DEFAULT NULL,
  `delete_by` int NULL DEFAULT NULL,
  `update_at` datetime NULL DEFAULT NULL,
  `update_by` int NULL DEFAULT NULL,
  PRIMARY KEY (`id_voucher`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 1 CHARACTER SET = utf8mb4 COLLATE = utf8mb4_general_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Records of tb_voucher
-- ----------------------------

SET FOREIGN_KEY_CHECKS = 1;
