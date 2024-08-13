/*
 Navicat Premium Data Transfer

 Source Server         : local
 Source Server Type    : MySQL
 Source Server Version : 100427 (10.4.27-MariaDB)
 Source Host           : localhost:3306
 Source Schema         : pemesanan_menutest

 Target Server Type    : MySQL
 Target Server Version : 100427 (10.4.27-MariaDB)
 File Encoding         : 65001

 Date: 13/08/2024 13:47:59
*/

SET NAMES utf8mb4;
SET FOREIGN_KEY_CHECKS = 0;

-- ----------------------------
-- Table structure for activity
-- ----------------------------
DROP TABLE IF EXISTS `activity`;
CREATE TABLE `activity`  (
  `id_activity` int NOT NULL AUTO_INCREMENT,
  `id_user` int NULL DEFAULT NULL,
  `activity` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `timestamp` timestamp NOT NULL DEFAULT current_timestamp,
  `delete` enum('0','1') CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NULL DEFAULT NULL,
  PRIMARY KEY (`id_activity`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 658 CHARACTER SET = utf8mb4 COLLATE = utf8mb4_general_ci ROW_FORMAT = DYNAMIC;

-- ----------------------------
-- Records of activity
-- ----------------------------
INSERT INTO `activity` VALUES (114, 1, 'User membuka view userlog', '2024-08-12 11:32:07', '0');
INSERT INTO `activity` VALUES (115, 1, 'User membuka view userlog', '2024-08-12 11:33:14', '0');
INSERT INTO `activity` VALUES (116, 1, 'User membuka view userlog', '2024-08-12 11:34:50', '0');
INSERT INTO `activity` VALUES (117, 1, 'User membuka view barang', '2024-08-12 11:46:52', '0');
INSERT INTO `activity` VALUES (118, 1, 'User Membuka View rbarang', '2024-08-12 11:46:56', '0');
INSERT INTO `activity` VALUES (119, 1, 'User membuka view barang', '2024-08-12 11:47:05', '0');
INSERT INTO `activity` VALUES (120, 1, 'User Soft Delete Keranjang', '2024-08-12 11:47:17', '0');
INSERT INTO `activity` VALUES (121, 1, 'User membuka view barang', '2024-08-12 11:47:17', '0');
INSERT INTO `activity` VALUES (122, 1, 'User Membuka View rbarang', '2024-08-12 11:47:20', '0');
INSERT INTO `activity` VALUES (123, 1, 'User Restore Data Barang', '2024-08-12 11:47:27', '0');
INSERT INTO `activity` VALUES (124, 1, 'User Membuka View rbarang', '2024-08-12 11:47:27', '0');
INSERT INTO `activity` VALUES (125, 1, 'User membuka view barang', '2024-08-12 11:47:32', '0');
INSERT INTO `activity` VALUES (126, 1, 'User membuka view userlog', '2024-08-12 11:55:49', '0');
INSERT INTO `activity` VALUES (127, 1, 'User membuka view updatelogs', '2024-08-12 11:55:55', '0');
INSERT INTO `activity` VALUES (128, 1, 'User Membuka View setting', '2024-08-12 11:56:00', '0');
INSERT INTO `activity` VALUES (129, 1, 'User membuka view updatelogs', '2024-08-12 11:56:01', '0');
INSERT INTO `activity` VALUES (130, 1, 'User membuka view userlog', '2024-08-12 11:57:52', '0');
INSERT INTO `activity` VALUES (131, 1, 'User membuka view updatelogs', '2024-08-12 11:57:56', '0');
INSERT INTO `activity` VALUES (132, 1, 'User membuka view userlog', '2024-08-12 11:58:26', '0');
INSERT INTO `activity` VALUES (133, 1, 'User Membuka View Pemesanan', '2024-08-12 12:03:24', '0');
INSERT INTO `activity` VALUES (134, 1, 'User Membuka View rbarang', '2024-08-12 12:03:49', '0');
INSERT INTO `activity` VALUES (135, 1, 'User Membuka View datakeranjang', '2024-08-12 12:03:53', '0');
INSERT INTO `activity` VALUES (136, 1, 'User Membuka View transaksi', '2024-08-12 12:03:57', '0');
INSERT INTO `activity` VALUES (137, 1, 'User Membuka View user', '2024-08-12 12:03:58', '0');
INSERT INTO `activity` VALUES (138, 1, 'User Membuka View laporantransaksi', '2024-08-12 12:04:02', '0');
INSERT INTO `activity` VALUES (139, 1, 'User Membuka Laporan Barang Masuk', '2024-08-12 12:04:04', '0');
INSERT INTO `activity` VALUES (140, 1, 'User Membuka Laporan Barang Keluar', '2024-08-12 12:04:06', '0');
INSERT INTO `activity` VALUES (141, 1, 'User Membuka Laporan Barang Masuk', '2024-08-12 12:04:25', '0');
INSERT INTO `activity` VALUES (142, 1, 'User Membuka Laporan Barang Keluar', '2024-08-12 12:04:28', '0');
INSERT INTO `activity` VALUES (143, 1, 'User Membuka View rbarang', '2024-08-12 12:04:43', '0');
INSERT INTO `activity` VALUES (144, 1, 'User membuka Dashboard', '2024-08-12 12:04:48', '0');
INSERT INTO `activity` VALUES (145, 1, 'User Membuka View setting', '2024-08-12 12:04:53', '0');
INSERT INTO `activity` VALUES (146, 1, 'User Membuka View setting', '2024-08-12 12:05:14', '0');
INSERT INTO `activity` VALUES (147, 1, 'User membuka view barang', '2024-08-12 12:05:28', '0');
INSERT INTO `activity` VALUES (148, 1, 'User Membuka View ebarang', '2024-08-12 12:05:30', '0');
INSERT INTO `activity` VALUES (149, 1, 'User Mengupdate Data Barang', '2024-08-12 12:05:35', '0');
INSERT INTO `activity` VALUES (150, 1, 'User membuka view barang', '2024-08-12 12:05:35', '0');
INSERT INTO `activity` VALUES (151, 1, 'User membuka view barang', '2024-08-12 12:05:38', '0');
INSERT INTO `activity` VALUES (152, 1, 'User Membuka View laporantransaksi', '2024-08-12 12:10:46', '0');
INSERT INTO `activity` VALUES (153, 1, 'User Membuka View transaksi', '2024-08-12 12:38:43', '0');
INSERT INTO `activity` VALUES (154, 1, 'User Print Nota', '2024-08-12 12:38:45', '0');
INSERT INTO `activity` VALUES (155, 1, 'User Print Nota', '2024-08-12 12:45:07', '0');
INSERT INTO `activity` VALUES (156, 1, 'User Membuka View transaksi', '2024-08-12 12:45:10', '0');
INSERT INTO `activity` VALUES (157, 1, 'User Membuka View datakeranjang', '2024-08-12 12:45:16', '0');
INSERT INTO `activity` VALUES (158, 1, 'User membuka view barang', '2024-08-12 12:45:18', '0');
INSERT INTO `activity` VALUES (159, 1, 'User Membuka View laporantransaksi', '2024-08-12 12:45:47', '0');
INSERT INTO `activity` VALUES (160, 1, 'User membuka Dashboard', '2024-08-12 12:45:49', '0');
INSERT INTO `activity` VALUES (161, 1, 'User membuka view updatelogs', '2024-08-12 12:47:18', '0');
INSERT INTO `activity` VALUES (162, 1, 'User Membuka View transaksi', '2024-08-12 12:49:54', '0');
INSERT INTO `activity` VALUES (163, 1, 'User Membuka View Pemesanan', '2024-08-12 12:49:57', '0');
INSERT INTO `activity` VALUES (164, 1, 'User membuka Dashboard', '2024-08-12 12:50:29', '0');
INSERT INTO `activity` VALUES (165, 1, 'User membuka view updatelogs', '2024-08-12 12:53:52', '0');
INSERT INTO `activity` VALUES (166, 1, 'User membuka view userlog', '2024-08-12 12:53:54', '0');
INSERT INTO `activity` VALUES (167, 1, 'User membuka view updatelogs', '2024-08-12 12:54:05', '0');
INSERT INTO `activity` VALUES (168, 1, 'User membuka view barang', '2024-08-12 13:00:44', '0');
INSERT INTO `activity` VALUES (169, 1, 'User Membuka View ebarang', '2024-08-12 13:00:46', '0');
INSERT INTO `activity` VALUES (170, 1, 'User Mengupdate Data Barang', '2024-08-12 13:00:50', '0');
INSERT INTO `activity` VALUES (171, 1, 'User membuka view barang', '2024-08-12 13:00:50', '0');
INSERT INTO `activity` VALUES (172, 1, 'User membuka view barang', '2024-08-12 13:01:28', '0');
INSERT INTO `activity` VALUES (173, 1, 'User Logout', '2024-08-12 13:02:26', '0');
INSERT INTO `activity` VALUES (174, 18, 'User Melakukan Login', '2024-08-12 13:02:31', '0');
INSERT INTO `activity` VALUES (175, 18, 'User membuka Dashboard', '2024-08-12 13:02:31', '0');
INSERT INTO `activity` VALUES (176, 18, 'User Membuka profile', '2024-08-12 13:02:40', '0');
INSERT INTO `activity` VALUES (177, 18, 'User membuka Dashboard', '2024-08-12 13:02:43', '0');
INSERT INTO `activity` VALUES (178, 18, 'User Membuka View Pemesanan', '2024-08-12 13:02:48', '0');
INSERT INTO `activity` VALUES (179, 18, 'User Logout', '2024-08-12 13:12:15', '0');
INSERT INTO `activity` VALUES (180, 18, 'User Melakukan Login', '2024-08-12 13:13:54', '0');
INSERT INTO `activity` VALUES (181, 18, 'User membuka Dashboard', '2024-08-12 13:13:54', '0');
INSERT INTO `activity` VALUES (182, 18, 'User Membuka View Pemesanan', '2024-08-12 13:13:59', '0');
INSERT INTO `activity` VALUES (183, 18, 'User Membuka profile', '2024-08-12 13:14:11', '0');
INSERT INTO `activity` VALUES (184, 18, 'User Membuka View Change Password', '2024-08-12 13:14:15', '0');
INSERT INTO `activity` VALUES (185, 18, 'User Logout', '2024-08-12 13:14:19', '0');
INSERT INTO `activity` VALUES (186, 1, 'User Melakukan Login', '2024-08-12 13:14:26', '0');
INSERT INTO `activity` VALUES (187, 1, 'User membuka Dashboard', '2024-08-12 13:14:26', '0');
INSERT INTO `activity` VALUES (188, 1, 'User Membuka View Pemesanan', '2024-08-12 13:14:31', '0');
INSERT INTO `activity` VALUES (189, 1, 'User Menyimpan Data Keranjang', '2024-08-12 13:14:41', '0');
INSERT INTO `activity` VALUES (190, 1, 'User Membuka View bayar', '2024-08-12 13:14:41', '0');
INSERT INTO `activity` VALUES (191, 1, 'User Print Nota', '2024-08-12 13:14:46', '0');
INSERT INTO `activity` VALUES (192, 1, 'User Membuka View Pemesanan', '2024-08-12 13:14:46', '0');
INSERT INTO `activity` VALUES (193, 1, 'User Membuka View transaksi', '2024-08-12 13:15:00', '0');
INSERT INTO `activity` VALUES (194, 1, 'User Print Nota', '2024-08-12 13:15:03', '0');
INSERT INTO `activity` VALUES (195, 1, 'User membuka view barang', '2024-08-12 13:15:07', '0');
INSERT INTO `activity` VALUES (196, 1, 'User Soft Delete Keranjang', '2024-08-12 13:15:13', '0');
INSERT INTO `activity` VALUES (197, 1, 'User membuka view barang', '2024-08-12 13:15:13', '0');
INSERT INTO `activity` VALUES (198, 1, 'User Membuka View rbarang', '2024-08-12 13:15:16', '0');
INSERT INTO `activity` VALUES (199, 1, 'User Restore Data Barang', '2024-08-12 13:15:19', '0');
INSERT INTO `activity` VALUES (200, 1, 'User Membuka View rbarang', '2024-08-12 13:15:20', '0');
INSERT INTO `activity` VALUES (201, 1, 'User membuka view barang', '2024-08-12 13:15:22', '0');
INSERT INTO `activity` VALUES (202, 1, 'User Membuka View ebarang', '2024-08-12 13:15:23', '0');
INSERT INTO `activity` VALUES (203, 1, 'User Mengupdate Data Barang', '2024-08-12 13:15:29', '0');
INSERT INTO `activity` VALUES (204, 1, 'User membuka view barang', '2024-08-12 13:15:29', '0');
INSERT INTO `activity` VALUES (205, 1, 'User membuka view barang', '2024-08-12 13:15:30', '0');
INSERT INTO `activity` VALUES (206, 1, 'User membuka view userlog', '2024-08-12 13:15:36', '0');
INSERT INTO `activity` VALUES (207, 1, 'User membuka view updatelogs', '2024-08-12 13:15:42', '0');
INSERT INTO `activity` VALUES (208, 1, 'User Membuka View laporantransaksi', '2024-08-12 13:15:47', '0');
INSERT INTO `activity` VALUES (209, 1, 'User membuka view updatelogs', '2024-08-12 13:15:57', '0');
INSERT INTO `activity` VALUES (210, 1, 'User membuka view barang', '2024-08-12 13:16:04', '0');
INSERT INTO `activity` VALUES (211, 1, 'User Soft Delete Keranjang', '2024-08-12 13:16:47', '0');
INSERT INTO `activity` VALUES (212, 1, 'User membuka view barang', '2024-08-12 13:16:47', '0');
INSERT INTO `activity` VALUES (213, 1, 'User Membuka View rbarang', '2024-08-12 13:16:49', '0');
INSERT INTO `activity` VALUES (214, 1, 'User Restore Data Barang', '2024-08-12 13:16:54', '0');
INSERT INTO `activity` VALUES (215, 1, 'User Membuka View rbarang', '2024-08-12 13:16:54', '0');
INSERT INTO `activity` VALUES (216, 1, 'User Membuka View user', '2024-08-12 13:17:13', '0');
INSERT INTO `activity` VALUES (217, 1, 'User Membuka View detailuser', '2024-08-12 13:17:26', '0');
INSERT INTO `activity` VALUES (218, 1, 'User Membuka View user', '2024-08-12 13:17:27', '0');
INSERT INTO `activity` VALUES (219, 1, 'User Membuka View setting', '2024-08-12 13:17:31', '0');
INSERT INTO `activity` VALUES (220, 1, 'User Mengupdate setting', '2024-08-12 13:17:40', '0');
INSERT INTO `activity` VALUES (221, 1, 'User Membuka View setting', '2024-08-12 13:17:40', '0');
INSERT INTO `activity` VALUES (222, 1, 'User Membuka View Pemesanan', '2024-08-12 13:18:11', '0');
INSERT INTO `activity` VALUES (223, 1, 'User membuka view barang', '2024-08-12 13:18:23', '0');
INSERT INTO `activity` VALUES (224, 1, 'User Membuka View Pemesanan', '2024-08-12 13:18:31', '0');
INSERT INTO `activity` VALUES (225, 1, 'User membuka view barang', '2024-08-12 13:19:00', '0');
INSERT INTO `activity` VALUES (226, 1, 'User Membuka View Pemesanan', '2024-08-12 13:19:10', '0');
INSERT INTO `activity` VALUES (227, 1, 'User Membuka View barangmasuk', '2024-08-12 13:19:41', '0');
INSERT INTO `activity` VALUES (228, 1, 'User Membuka View tbarangm', '2024-08-12 13:19:42', '0');
INSERT INTO `activity` VALUES (229, 1, 'User Menambah Data Barang Masuk', '2024-08-12 13:19:49', '0');
INSERT INTO `activity` VALUES (230, 1, 'User Membuka View barangmasuk', '2024-08-12 13:19:49', '0');
INSERT INTO `activity` VALUES (231, 1, 'User Membuka View Pemesanan', '2024-08-12 13:19:50', '0');
INSERT INTO `activity` VALUES (232, 1, 'User Membuka View laporantransaksi', '2024-08-12 13:22:05', '0');
INSERT INTO `activity` VALUES (233, 1, 'User Membuka View barangmasuk', '2024-08-12 13:22:10', '0');
INSERT INTO `activity` VALUES (234, 1, 'User Membuka View Pemesanan', '2024-08-12 13:22:15', '0');
INSERT INTO `activity` VALUES (235, 1, 'User membuka view barang', '2024-08-12 13:22:21', '0');
INSERT INTO `activity` VALUES (236, 1, 'User Membuka View laporantransaksi', '2024-08-12 13:22:27', '0');
INSERT INTO `activity` VALUES (237, 1, 'User Membuka View Pemesanan', '2024-08-12 13:23:35', '0');
INSERT INTO `activity` VALUES (238, 1, 'User Membuka View laporantransaksi', '2024-08-12 13:23:49', '0');
INSERT INTO `activity` VALUES (239, 1, 'User Membuka Laporan Barang Masuk', '2024-08-12 13:24:03', '0');
INSERT INTO `activity` VALUES (240, 1, 'User Membuka View Pemesanan', '2024-08-12 13:24:30', '0');
INSERT INTO `activity` VALUES (241, 1, 'User Membuka View transaksi', '2024-08-12 13:24:38', '0');
INSERT INTO `activity` VALUES (242, 1, 'User Membuka View laporantransaksi', '2024-08-12 13:24:51', '0');
INSERT INTO `activity` VALUES (243, 1, 'User Membuka View Pemesanan', '2024-08-12 13:25:02', '0');
INSERT INTO `activity` VALUES (244, 1, 'User Membuka View transaksi', '2024-08-12 13:25:34', '0');
INSERT INTO `activity` VALUES (245, 1, 'User Membuka View Pemesanan', '2024-08-12 13:26:23', '0');
INSERT INTO `activity` VALUES (246, 1, 'User Menyimpan Data Keranjang', '2024-08-12 13:26:31', '0');
INSERT INTO `activity` VALUES (247, 1, 'User Membuka View bayar', '2024-08-12 13:26:31', '0');
INSERT INTO `activity` VALUES (248, 1, 'User Membuka View Pemesanan', '2024-08-12 13:26:40', '0');
INSERT INTO `activity` VALUES (249, 1, 'User Membuka View laporantransaksi', '2024-08-12 13:34:05', '0');
INSERT INTO `activity` VALUES (250, 1, 'User Membuka Laporan Barang Keluar', '2024-08-12 13:34:08', '0');
INSERT INTO `activity` VALUES (251, 1, 'User Filter Barang Keluar', '2024-08-12 13:34:18', '0');
INSERT INTO `activity` VALUES (252, 1, 'User Filter Barang Keluar', '2024-08-12 13:36:11', '0');
INSERT INTO `activity` VALUES (253, 1, 'User Membuka View laporantransaksi', '2024-08-12 13:36:17', '0');
INSERT INTO `activity` VALUES (254, 1, 'User Membuka View laporantransaksi', '2024-08-12 13:36:34', '0');
INSERT INTO `activity` VALUES (255, 1, 'User Membuka Laporan Barang Masuk', '2024-08-12 13:36:52', '0');
INSERT INTO `activity` VALUES (256, 1, 'User Filter Barang Masuk', '2024-08-12 13:37:10', '0');
INSERT INTO `activity` VALUES (257, 1, 'User Membuka Laporan Barang Masuk Pdf', '2024-08-12 13:37:13', '0');
INSERT INTO `activity` VALUES (258, 1, 'User Membuka View laporantransaksi', '2024-08-12 13:37:22', '0');
INSERT INTO `activity` VALUES (259, 1, 'User Membuka View laporantransaksi', '2024-08-12 13:41:01', '0');
INSERT INTO `activity` VALUES (260, 1, 'User Membuka View laporantransaksi', '2024-08-12 13:41:10', '0');
INSERT INTO `activity` VALUES (261, 1, 'User membuka view barang', '2024-08-12 13:47:54', '0');
INSERT INTO `activity` VALUES (262, 1, 'User Soft Delete Keranjang', '2024-08-12 13:48:08', '0');
INSERT INTO `activity` VALUES (263, 1, 'User membuka view barang', '2024-08-12 13:48:08', '0');
INSERT INTO `activity` VALUES (264, 1, 'User Membuka View rbarang', '2024-08-12 13:48:15', '0');
INSERT INTO `activity` VALUES (265, 1, 'User Restore Data Barang', '2024-08-12 13:48:28', '0');
INSERT INTO `activity` VALUES (266, 1, 'User Membuka View rbarang', '2024-08-12 13:48:28', '0');
INSERT INTO `activity` VALUES (267, 1, 'User membuka view barang', '2024-08-12 13:48:33', '0');
INSERT INTO `activity` VALUES (268, 1, 'User membuka Dashboard', '2024-08-12 18:22:00', '0');
INSERT INTO `activity` VALUES (269, 1, 'User membuka Dashboard', '2024-08-12 18:34:47', '0');
INSERT INTO `activity` VALUES (270, 1, 'User membuka Dashboard', '2024-08-12 18:34:52', '0');
INSERT INTO `activity` VALUES (271, 1, 'User membuka Dashboard', '2024-08-12 18:35:07', '0');
INSERT INTO `activity` VALUES (272, 1, 'User membuka Dashboard', '2024-08-12 18:36:25', '0');
INSERT INTO `activity` VALUES (273, 1, 'User membuka Dashboard', '2024-08-12 18:39:07', '0');
INSERT INTO `activity` VALUES (274, 1, 'User membuka Dashboard', '2024-08-12 18:39:08', '0');
INSERT INTO `activity` VALUES (275, 1, 'User membuka Dashboard', '2024-08-12 18:39:30', '0');
INSERT INTO `activity` VALUES (276, 1, 'User membuka Dashboard', '2024-08-12 18:40:32', '0');
INSERT INTO `activity` VALUES (277, 1, 'User membuka Dashboard', '2024-08-12 18:40:33', '0');
INSERT INTO `activity` VALUES (278, 1, 'User membuka Dashboard', '2024-08-12 18:41:09', '0');
INSERT INTO `activity` VALUES (279, 1, 'User membuka Dashboard', '2024-08-12 18:41:39', '0');
INSERT INTO `activity` VALUES (280, 1, 'User membuka view barang', '2024-08-12 18:41:40', '0');
INSERT INTO `activity` VALUES (281, 1, 'User membuka Dashboard', '2024-08-12 18:41:43', '0');
INSERT INTO `activity` VALUES (282, 1, 'User membuka view barang', '2024-08-12 18:41:47', '0');
INSERT INTO `activity` VALUES (283, 1, 'User membuka Dashboard', '2024-08-12 18:41:47', '0');
INSERT INTO `activity` VALUES (284, 1, 'User membuka Dashboard', '2024-08-12 18:43:06', '0');
INSERT INTO `activity` VALUES (285, 1, 'User membuka Dashboard', '2024-08-12 18:45:08', '0');
INSERT INTO `activity` VALUES (286, 1, 'User Membuka View Pemesanan', '2024-08-12 18:45:11', '0');
INSERT INTO `activity` VALUES (287, 1, 'User membuka Dashboard', '2024-08-12 18:45:12', '0');
INSERT INTO `activity` VALUES (288, 1, 'User membuka Dashboard', '2024-08-12 18:45:28', '0');
INSERT INTO `activity` VALUES (289, 1, 'User membuka Dashboard', '2024-08-12 18:46:30', '0');
INSERT INTO `activity` VALUES (290, 1, 'User membuka Dashboard', '2024-08-12 18:47:30', '0');
INSERT INTO `activity` VALUES (291, 1, 'User membuka Dashboard', '2024-08-12 18:47:31', '0');
INSERT INTO `activity` VALUES (292, 1, 'User membuka Dashboard', '2024-08-12 18:47:46', '0');
INSERT INTO `activity` VALUES (293, 1, 'User membuka Dashboard', '2024-08-12 18:48:10', '0');
INSERT INTO `activity` VALUES (294, 1, 'User membuka Dashboard', '2024-08-12 18:50:25', '0');
INSERT INTO `activity` VALUES (295, 1, 'User membuka Dashboard', '2024-08-12 18:51:09', '0');
INSERT INTO `activity` VALUES (296, 1, 'User membuka Dashboard', '2024-08-12 18:51:10', '0');
INSERT INTO `activity` VALUES (297, 1, 'User membuka Dashboard', '2024-08-12 18:51:30', '0');
INSERT INTO `activity` VALUES (298, 1, 'User membuka Dashboard', '2024-08-12 18:52:09', '0');
INSERT INTO `activity` VALUES (299, 1, 'User membuka Dashboard', '2024-08-12 18:52:09', '0');
INSERT INTO `activity` VALUES (300, 1, 'User membuka Dashboard', '2024-08-12 18:52:54', '0');
INSERT INTO `activity` VALUES (301, 1, 'User membuka Dashboard', '2024-08-12 18:55:47', '0');
INSERT INTO `activity` VALUES (302, 1, 'User membuka Dashboard', '2024-08-12 18:55:58', '0');
INSERT INTO `activity` VALUES (303, 1, 'User membuka Dashboard', '2024-08-12 18:58:31', '0');
INSERT INTO `activity` VALUES (304, 1, 'User membuka Dashboard', '2024-08-12 18:58:32', '0');
INSERT INTO `activity` VALUES (305, 1, 'User membuka Dashboard', '2024-08-12 19:00:21', '0');
INSERT INTO `activity` VALUES (306, 1, 'User membuka Dashboard', '2024-08-12 19:01:39', '0');
INSERT INTO `activity` VALUES (307, 1, 'User membuka Dashboard', '2024-08-12 19:01:40', '0');
INSERT INTO `activity` VALUES (308, 1, 'User membuka Dashboard', '2024-08-12 19:02:26', '0');
INSERT INTO `activity` VALUES (309, 1, 'User membuka Dashboard', '2024-08-12 19:02:36', '0');
INSERT INTO `activity` VALUES (310, 1, 'User membuka Dashboard', '2024-08-12 19:02:39', '0');
INSERT INTO `activity` VALUES (311, 1, 'User membuka Dashboard', '2024-08-12 19:02:40', '0');
INSERT INTO `activity` VALUES (312, 1, 'User membuka Dashboard', '2024-08-12 19:02:42', '0');
INSERT INTO `activity` VALUES (313, 1, 'User membuka Dashboard', '2024-08-12 19:02:44', '0');
INSERT INTO `activity` VALUES (314, 1, 'User membuka Dashboard', '2024-08-12 19:03:14', '0');
INSERT INTO `activity` VALUES (315, 1, 'User membuka Dashboard', '2024-08-12 19:03:14', '0');
INSERT INTO `activity` VALUES (316, 1, 'User membuka Dashboard', '2024-08-12 19:03:14', '0');
INSERT INTO `activity` VALUES (317, 1, 'User membuka Dashboard', '2024-08-12 19:03:15', '0');
INSERT INTO `activity` VALUES (318, 1, 'User membuka Dashboard', '2024-08-12 19:03:15', '0');
INSERT INTO `activity` VALUES (319, 1, 'User membuka Dashboard', '2024-08-12 19:04:26', '0');
INSERT INTO `activity` VALUES (320, 1, 'User membuka Dashboard', '2024-08-12 19:04:56', '0');
INSERT INTO `activity` VALUES (321, 1, 'User membuka Dashboard', '2024-08-12 19:05:39', '0');
INSERT INTO `activity` VALUES (322, 1, 'User membuka Dashboard', '2024-08-12 19:05:44', '0');
INSERT INTO `activity` VALUES (323, 1, 'User membuka Dashboard', '2024-08-12 19:05:50', '0');
INSERT INTO `activity` VALUES (324, 1, 'User membuka Dashboard', '2024-08-12 19:05:52', '0');
INSERT INTO `activity` VALUES (325, 1, 'User membuka Dashboard', '2024-08-12 19:05:54', '0');
INSERT INTO `activity` VALUES (326, 1, 'User membuka Dashboard', '2024-08-12 19:05:56', '0');
INSERT INTO `activity` VALUES (327, 1, 'User membuka Dashboard', '2024-08-12 19:06:50', '0');
INSERT INTO `activity` VALUES (328, 1, 'User membuka Dashboard', '2024-08-12 19:06:52', '0');
INSERT INTO `activity` VALUES (329, 1, 'User membuka Dashboard', '2024-08-12 19:08:40', '0');
INSERT INTO `activity` VALUES (330, 1, 'User membuka Dashboard', '2024-08-12 19:08:41', '0');
INSERT INTO `activity` VALUES (331, 1, 'User membuka Dashboard', '2024-08-12 19:08:41', '0');
INSERT INTO `activity` VALUES (332, 1, 'User membuka Dashboard', '2024-08-12 19:10:38', '0');
INSERT INTO `activity` VALUES (333, 1, 'User membuka Dashboard', '2024-08-12 19:10:39', '0');
INSERT INTO `activity` VALUES (334, 1, 'User membuka Dashboard', '2024-08-12 19:10:39', '0');
INSERT INTO `activity` VALUES (335, 1, 'User membuka Dashboard', '2024-08-12 19:10:39', '0');
INSERT INTO `activity` VALUES (336, 1, 'User membuka Dashboard', '2024-08-12 19:10:39', '0');
INSERT INTO `activity` VALUES (337, 1, 'User membuka Dashboard', '2024-08-12 19:10:39', '0');
INSERT INTO `activity` VALUES (338, 1, 'User membuka Dashboard', '2024-08-12 19:11:42', '0');
INSERT INTO `activity` VALUES (339, 1, 'User membuka Dashboard', '2024-08-12 19:11:43', '0');
INSERT INTO `activity` VALUES (340, 1, 'User membuka Dashboard', '2024-08-12 19:12:29', '0');
INSERT INTO `activity` VALUES (341, 1, 'User membuka Dashboard', '2024-08-12 19:12:29', '0');
INSERT INTO `activity` VALUES (342, 1, 'User membuka Dashboard', '2024-08-12 19:12:30', '0');
INSERT INTO `activity` VALUES (343, 1, 'User membuka Dashboard', '2024-08-12 19:12:30', '0');
INSERT INTO `activity` VALUES (344, 1, 'User membuka Dashboard', '2024-08-12 19:12:30', '0');
INSERT INTO `activity` VALUES (345, 1, 'User membuka Dashboard', '2024-08-12 19:12:30', '0');
INSERT INTO `activity` VALUES (346, 1, 'User membuka Dashboard', '2024-08-12 19:12:30', '0');
INSERT INTO `activity` VALUES (347, 1, 'User membuka Dashboard', '2024-08-12 19:13:11', '0');
INSERT INTO `activity` VALUES (348, 1, 'User membuka Dashboard', '2024-08-12 19:13:12', '0');
INSERT INTO `activity` VALUES (349, 1, 'User Membuka View barangkeluar', '2024-08-12 19:13:14', '0');
INSERT INTO `activity` VALUES (350, 1, 'User membuka Dashboard', '2024-08-12 19:13:16', '0');
INSERT INTO `activity` VALUES (351, 1, 'User membuka Dashboard', '2024-08-12 19:13:17', '0');
INSERT INTO `activity` VALUES (352, 1, 'User membuka view barang', '2024-08-12 19:13:18', '0');
INSERT INTO `activity` VALUES (353, 1, 'User membuka Dashboard', '2024-08-12 19:13:24', '0');
INSERT INTO `activity` VALUES (354, 1, 'User membuka Dashboard', '2024-08-12 19:14:06', '0');
INSERT INTO `activity` VALUES (355, 1, 'User membuka Dashboard', '2024-08-12 19:15:12', '0');
INSERT INTO `activity` VALUES (356, 1, 'User membuka Dashboard', '2024-08-12 19:25:21', '0');
INSERT INTO `activity` VALUES (357, 1, 'User membuka Dashboard', '2024-08-12 19:25:23', '0');
INSERT INTO `activity` VALUES (358, 1, 'User membuka Dashboard', '2024-08-12 19:25:24', '0');
INSERT INTO `activity` VALUES (359, 1, 'User membuka Dashboard', '2024-08-12 19:25:25', '0');
INSERT INTO `activity` VALUES (360, 1, 'User membuka Dashboard', '2024-08-12 19:25:25', '0');
INSERT INTO `activity` VALUES (361, 1, 'User membuka Dashboard', '2024-08-12 19:25:26', '0');
INSERT INTO `activity` VALUES (362, 1, 'User membuka Dashboard', '2024-08-12 19:25:27', '0');
INSERT INTO `activity` VALUES (363, 1, 'User membuka Dashboard', '2024-08-12 19:25:27', '0');
INSERT INTO `activity` VALUES (364, 1, 'User membuka Dashboard', '2024-08-12 19:25:27', '0');
INSERT INTO `activity` VALUES (365, 1, 'User membuka Dashboard', '2024-08-12 19:25:28', '0');
INSERT INTO `activity` VALUES (366, 1, 'User membuka Dashboard', '2024-08-12 19:25:28', '0');
INSERT INTO `activity` VALUES (367, 1, 'User membuka Dashboard', '2024-08-12 19:25:53', '0');
INSERT INTO `activity` VALUES (368, 1, 'User membuka Dashboard', '2024-08-12 19:25:57', '0');
INSERT INTO `activity` VALUES (369, 1, 'User membuka Dashboard', '2024-08-12 19:26:10', '0');
INSERT INTO `activity` VALUES (370, 1, 'User membuka Dashboard', '2024-08-12 19:26:11', '0');
INSERT INTO `activity` VALUES (371, 1, 'User membuka Dashboard', '2024-08-12 19:26:11', '0');
INSERT INTO `activity` VALUES (372, 1, 'User membuka Dashboard', '2024-08-12 19:27:14', '0');
INSERT INTO `activity` VALUES (373, 1, 'User membuka Dashboard', '2024-08-12 19:27:15', '0');
INSERT INTO `activity` VALUES (374, 1, 'User membuka Dashboard', '2024-08-12 19:27:15', '0');
INSERT INTO `activity` VALUES (375, 1, 'User membuka Dashboard', '2024-08-12 19:27:19', '0');
INSERT INTO `activity` VALUES (376, 1, 'User membuka view barang', '2024-08-12 19:27:23', '0');
INSERT INTO `activity` VALUES (377, 1, 'User membuka Dashboard', '2024-08-12 19:27:25', '0');
INSERT INTO `activity` VALUES (378, 1, 'User membuka Dashboard', '2024-08-12 19:28:38', '0');
INSERT INTO `activity` VALUES (379, 1, 'User membuka Dashboard', '2024-08-12 19:35:06', '0');
INSERT INTO `activity` VALUES (380, 1, 'User membuka view updatelogs', '2024-08-12 19:35:10', '0');
INSERT INTO `activity` VALUES (381, 1, 'User membuka view updatelogs', '2024-08-12 19:36:17', '0');
INSERT INTO `activity` VALUES (382, 1, 'User membuka view updatelogs', '2024-08-12 19:38:09', '0');
INSERT INTO `activity` VALUES (383, 1, 'User membuka view updatelogs', '2024-08-12 19:38:23', '0');
INSERT INTO `activity` VALUES (384, 1, 'User membuka view updatelogs', '2024-08-12 19:38:39', '0');
INSERT INTO `activity` VALUES (385, 1, 'User Logout', '2024-08-12 19:39:06', '0');
INSERT INTO `activity` VALUES (386, 18, 'User Melakukan Login', '2024-08-12 19:39:11', '0');
INSERT INTO `activity` VALUES (387, 18, 'User membuka Dashboard', '2024-08-12 19:39:11', '0');
INSERT INTO `activity` VALUES (388, 18, 'User membuka Dashboard', '2024-08-12 19:40:11', '0');
INSERT INTO `activity` VALUES (389, 18, 'User membuka Dashboard', '2024-08-12 19:41:31', '0');
INSERT INTO `activity` VALUES (390, 18, 'User Membuka View notfound', '2024-08-12 19:41:35', '0');
INSERT INTO `activity` VALUES (391, 18, 'User membuka Dashboard', '2024-08-12 19:41:38', '0');
INSERT INTO `activity` VALUES (392, 18, 'User Membuka View notfound', '2024-08-12 19:41:43', '0');
INSERT INTO `activity` VALUES (393, 18, 'User membuka Dashboard', '2024-08-12 19:41:54', '0');
INSERT INTO `activity` VALUES (394, 18, 'User Logout', '2024-08-12 19:41:56', '0');
INSERT INTO `activity` VALUES (395, 1, 'User Melakukan Login', '2024-08-12 19:42:03', '0');
INSERT INTO `activity` VALUES (396, 1, 'User membuka Dashboard', '2024-08-12 19:42:03', '0');
INSERT INTO `activity` VALUES (397, 1, 'User membuka view updatelogs', '2024-08-12 19:42:08', '0');
INSERT INTO `activity` VALUES (398, 1, 'User membuka view updatelogs', '2024-08-12 19:42:32', '0');
INSERT INTO `activity` VALUES (399, 1, 'User membuka view updatelogs', '2024-08-12 19:43:17', '0');
INSERT INTO `activity` VALUES (400, 1, 'User membuka view updatelogs', '2024-08-12 19:43:20', '0');
INSERT INTO `activity` VALUES (401, 1, 'User membuka view updatelogs', '2024-08-12 19:45:42', '0');
INSERT INTO `activity` VALUES (402, 1, 'User membuka view updatelogs', '2024-08-12 19:45:44', '0');
INSERT INTO `activity` VALUES (403, 1, 'User membuka view updatelogs', '2024-08-12 19:45:47', '0');
INSERT INTO `activity` VALUES (404, 1, 'User membuka view updatelogs', '2024-08-12 19:46:11', '0');
INSERT INTO `activity` VALUES (405, 1, 'User membuka view updatelogs', '2024-08-12 19:46:13', '0');
INSERT INTO `activity` VALUES (406, 1, 'User membuka view updatelogs', '2024-08-12 19:47:02', '0');
INSERT INTO `activity` VALUES (407, 1, 'User membuka view updatelogs', '2024-08-12 19:47:25', '0');
INSERT INTO `activity` VALUES (408, 1, 'User membuka view updatelogs', '2024-08-12 19:47:27', '0');
INSERT INTO `activity` VALUES (409, 1, 'User membuka view updatelogs', '2024-08-12 19:48:15', '0');
INSERT INTO `activity` VALUES (410, 1, 'User membuka view updatelogs', '2024-08-12 19:48:27', '0');
INSERT INTO `activity` VALUES (411, 1, 'User membuka view updatelogs', '2024-08-12 19:48:28', '0');
INSERT INTO `activity` VALUES (412, 1, 'User membuka view updatelogs', '2024-08-12 19:48:37', '0');
INSERT INTO `activity` VALUES (413, 1, 'User membuka view updatelogs', '2024-08-12 19:48:51', '0');
INSERT INTO `activity` VALUES (414, 1, 'User membuka view updatelogs', '2024-08-12 19:58:22', '0');
INSERT INTO `activity` VALUES (415, 1, 'User membuka view updatelogs', '2024-08-12 20:00:31', '0');
INSERT INTO `activity` VALUES (416, 1, 'User membuka view updatelogs', '2024-08-12 20:02:53', '0');
INSERT INTO `activity` VALUES (417, 1, 'User membuka view updatelogs', '2024-08-12 20:02:58', '0');
INSERT INTO `activity` VALUES (418, 1, 'User membuka view updatelogs', '2024-08-12 20:03:34', '0');
INSERT INTO `activity` VALUES (419, 1, 'User membuka view updatelogs', '2024-08-12 20:03:38', '0');
INSERT INTO `activity` VALUES (420, 1, 'User membuka view updatelogs', '2024-08-12 20:04:23', '0');
INSERT INTO `activity` VALUES (421, 1, 'User membuka view updatelogs', '2024-08-12 20:04:38', '0');
INSERT INTO `activity` VALUES (422, 1, 'User membuka view updatelogs', '2024-08-12 20:04:41', '0');
INSERT INTO `activity` VALUES (423, 1, 'User membuka view updatelogs', '2024-08-12 20:04:41', '0');
INSERT INTO `activity` VALUES (424, 1, 'User membuka view updatelogs', '2024-08-12 20:04:47', '0');
INSERT INTO `activity` VALUES (425, 1, 'User membuka view updatelogs', '2024-08-12 20:04:49', '0');
INSERT INTO `activity` VALUES (426, 1, 'User membuka view updatelogs', '2024-08-12 20:05:28', '0');
INSERT INTO `activity` VALUES (427, 1, 'User membuka view updatelogs', '2024-08-12 20:07:01', '0');
INSERT INTO `activity` VALUES (428, 1, 'User membuka view updatelogs', '2024-08-12 20:07:13', '0');
INSERT INTO `activity` VALUES (429, 1, 'User membuka view updatelogs', '2024-08-12 20:09:24', '0');
INSERT INTO `activity` VALUES (430, 1, 'User Logout', '2024-08-12 20:09:29', '0');
INSERT INTO `activity` VALUES (431, 18, 'User Melakukan Login', '2024-08-12 20:09:34', '0');
INSERT INTO `activity` VALUES (432, 18, 'User membuka Dashboard', '2024-08-12 20:09:34', '0');
INSERT INTO `activity` VALUES (433, 18, 'User Membuka View notfound', '2024-08-12 20:09:44', '0');
INSERT INTO `activity` VALUES (434, 18, 'User membuka Dashboard', '2024-08-12 20:09:47', '0');
INSERT INTO `activity` VALUES (435, 18, 'User Membuka View notfound', '2024-08-12 20:09:48', '0');
INSERT INTO `activity` VALUES (436, 18, 'User membuka Dashboard', '2024-08-12 20:09:49', '0');
INSERT INTO `activity` VALUES (437, 18, 'User Logout', '2024-08-12 20:09:58', '0');
INSERT INTO `activity` VALUES (438, 1, 'User Melakukan Login', '2024-08-12 20:10:03', '0');
INSERT INTO `activity` VALUES (439, 1, 'User membuka Dashboard', '2024-08-12 20:10:03', '0');
INSERT INTO `activity` VALUES (440, 1, 'User membuka view updatelogs', '2024-08-12 20:10:05', '0');
INSERT INTO `activity` VALUES (441, 1, 'User membuka view updatelogs', '2024-08-12 20:10:14', '0');
INSERT INTO `activity` VALUES (442, 1, 'User Logout', '2024-08-12 20:10:16', '0');
INSERT INTO `activity` VALUES (443, 18, 'User Melakukan Login', '2024-08-12 20:10:24', '0');
INSERT INTO `activity` VALUES (444, 18, 'User membuka Dashboard', '2024-08-12 20:10:24', '0');
INSERT INTO `activity` VALUES (445, 18, 'User Logout', '2024-08-12 20:10:27', '0');
INSERT INTO `activity` VALUES (446, 1, 'User Melakukan Login', '2024-08-12 20:10:32', '0');
INSERT INTO `activity` VALUES (447, 1, 'User membuka Dashboard', '2024-08-12 20:10:32', '0');
INSERT INTO `activity` VALUES (448, 1, 'User Membuka View setting', '2024-08-12 20:10:35', '0');
INSERT INTO `activity` VALUES (449, 1, 'User membuka Dashboard', '2024-08-12 20:10:36', '0');
INSERT INTO `activity` VALUES (450, 1, 'User membuka view updatelogs', '2024-08-12 20:10:41', '0');
INSERT INTO `activity` VALUES (451, 1, 'User membuka view updatelogs', '2024-08-12 20:10:47', '0');
INSERT INTO `activity` VALUES (452, 1, 'User Logout', '2024-08-12 20:10:48', '0');
INSERT INTO `activity` VALUES (453, 18, 'User Melakukan Login', '2024-08-12 20:10:54', '0');
INSERT INTO `activity` VALUES (454, 18, 'User membuka Dashboard', '2024-08-12 20:10:54', '0');
INSERT INTO `activity` VALUES (455, 18, 'User Logout', '2024-08-12 20:10:58', '0');
INSERT INTO `activity` VALUES (456, 18, 'User Melakukan Login', '2024-08-12 20:11:06', '0');
INSERT INTO `activity` VALUES (457, 18, 'User membuka Dashboard', '2024-08-12 20:11:07', '0');
INSERT INTO `activity` VALUES (458, 18, 'User Logout', '2024-08-12 20:11:11', '0');
INSERT INTO `activity` VALUES (459, 1, 'User Melakukan Login', '2024-08-12 20:11:17', '0');
INSERT INTO `activity` VALUES (460, 1, 'User membuka Dashboard', '2024-08-12 20:11:17', '0');
INSERT INTO `activity` VALUES (461, 1, 'User membuka view updatelogs', '2024-08-12 20:11:21', '0');
INSERT INTO `activity` VALUES (462, 1, 'User membuka view updatelogs', '2024-08-12 20:11:28', '0');
INSERT INTO `activity` VALUES (463, 1, 'User membuka view updatelogs', '2024-08-12 20:11:34', '0');
INSERT INTO `activity` VALUES (464, 1, 'User Logout', '2024-08-12 20:11:35', '0');
INSERT INTO `activity` VALUES (465, 18, 'User Melakukan Login', '2024-08-12 20:11:45', '0');
INSERT INTO `activity` VALUES (466, 18, 'User membuka Dashboard', '2024-08-12 20:11:45', '0');
INSERT INTO `activity` VALUES (467, 18, 'User membuka Dashboard', '2024-08-12 20:15:02', '0');
INSERT INTO `activity` VALUES (468, 18, 'User membuka Dashboard', '2024-08-12 20:15:52', '0');
INSERT INTO `activity` VALUES (469, 18, 'User Membuka View notfound', '2024-08-12 20:15:57', '0');
INSERT INTO `activity` VALUES (470, 18, 'User membuka Dashboard', '2024-08-12 20:16:04', '0');
INSERT INTO `activity` VALUES (471, 18, 'User membuka Dashboard', '2024-08-12 20:16:14', '0');
INSERT INTO `activity` VALUES (472, 18, 'User membuka view updatelogs', '2024-08-12 20:16:16', '0');
INSERT INTO `activity` VALUES (473, 18, 'User membuka view updatelogs', '2024-08-12 20:16:30', '0');
INSERT INTO `activity` VALUES (474, 18, 'User membuka view updatelogs', '2024-08-12 20:16:32', '0');
INSERT INTO `activity` VALUES (475, 18, 'User Membuka View notfound', '2024-08-12 20:16:40', '0');
INSERT INTO `activity` VALUES (476, 18, 'User Membuka View notfound', '2024-08-12 20:16:47', '0');
INSERT INTO `activity` VALUES (477, 18, 'User membuka Dashboard', '2024-08-12 20:16:48', '0');
INSERT INTO `activity` VALUES (478, 18, 'User membuka Dashboard', '2024-08-12 20:16:49', '0');
INSERT INTO `activity` VALUES (479, 18, 'User membuka view updatelogs', '2024-08-12 20:16:51', '0');
INSERT INTO `activity` VALUES (480, 18, 'User membuka view updatelogs', '2024-08-12 20:16:58', '0');
INSERT INTO `activity` VALUES (481, 18, 'User membuka view updatelogs', '2024-08-12 20:18:24', '0');
INSERT INTO `activity` VALUES (482, 18, 'User membuka view updatelogs', '2024-08-12 20:19:00', '0');
INSERT INTO `activity` VALUES (483, 18, 'User membuka view updatelogs', '2024-08-12 20:19:47', '0');
INSERT INTO `activity` VALUES (484, 18, 'User membuka view updatelogs', '2024-08-12 20:19:53', '0');
INSERT INTO `activity` VALUES (485, 18, 'User membuka Dashboard', '2024-08-12 20:19:54', '0');
INSERT INTO `activity` VALUES (486, 18, 'User membuka view updatelogs', '2024-08-12 20:19:56', '0');
INSERT INTO `activity` VALUES (487, 18, 'User membuka view updatelogs', '2024-08-12 20:19:59', '0');
INSERT INTO `activity` VALUES (488, 18, 'User membuka view updatelogs', '2024-08-12 20:22:44', '0');
INSERT INTO `activity` VALUES (489, 18, 'User membuka view updatelogs', '2024-08-12 20:23:43', '0');
INSERT INTO `activity` VALUES (490, 18, 'User membuka view updatelogs', '2024-08-12 20:24:48', '0');
INSERT INTO `activity` VALUES (491, 18, 'User membuka view updatelogs', '2024-08-12 20:25:27', '0');
INSERT INTO `activity` VALUES (492, 18, 'User membuka view updatelogs', '2024-08-12 20:25:48', '0');
INSERT INTO `activity` VALUES (493, 18, 'User membuka view updatelogs', '2024-08-12 20:26:52', '0');
INSERT INTO `activity` VALUES (494, 18, 'User membuka view updatelogs', '2024-08-12 20:27:29', '0');
INSERT INTO `activity` VALUES (495, 18, 'User membuka view updatelogs', '2024-08-12 20:27:30', '0');
INSERT INTO `activity` VALUES (496, 18, 'User membuka view updatelogs', '2024-08-12 20:27:30', '0');
INSERT INTO `activity` VALUES (497, 18, 'User membuka view updatelogs', '2024-08-12 20:27:36', '0');
INSERT INTO `activity` VALUES (498, 18, 'User membuka Dashboard', '2024-08-12 20:27:39', '0');
INSERT INTO `activity` VALUES (499, 18, 'User membuka view updatelogs', '2024-08-12 20:27:41', '0');
INSERT INTO `activity` VALUES (500, 18, 'User membuka Dashboard', '2024-08-12 20:27:42', '0');
INSERT INTO `activity` VALUES (501, 18, 'User membuka view updatelogs', '2024-08-12 20:27:44', '0');
INSERT INTO `activity` VALUES (502, 18, 'User membuka view updatelogs', '2024-08-12 20:27:50', '0');
INSERT INTO `activity` VALUES (503, 18, 'User Membuka View notfound', '2024-08-12 20:27:55', '0');
INSERT INTO `activity` VALUES (504, 18, 'User membuka view updatelogs', '2024-08-12 20:27:57', '0');
INSERT INTO `activity` VALUES (505, 18, 'User membuka Dashboard', '2024-08-12 20:27:58', '0');
INSERT INTO `activity` VALUES (506, 18, 'User membuka view updatelogs', '2024-08-12 20:28:00', '0');
INSERT INTO `activity` VALUES (507, 18, 'User membuka view updatelogs', '2024-08-12 20:32:20', '0');
INSERT INTO `activity` VALUES (508, 18, 'User membuka view updatelogs', '2024-08-12 20:33:01', '0');
INSERT INTO `activity` VALUES (509, 18, 'User membuka view updatelogs', '2024-08-12 20:33:09', '0');
INSERT INTO `activity` VALUES (510, 18, 'User membuka Dashboard', '2024-08-12 20:33:31', '0');
INSERT INTO `activity` VALUES (511, 18, 'User membuka view updatelogs', '2024-08-12 20:33:36', '0');
INSERT INTO `activity` VALUES (512, 18, 'User membuka Dashboard', '2024-08-12 20:33:37', '0');
INSERT INTO `activity` VALUES (513, 18, 'User membuka view updatelogs', '2024-08-12 20:33:41', '0');
INSERT INTO `activity` VALUES (514, 18, 'User membuka view updatelogs', '2024-08-12 20:34:04', '0');
INSERT INTO `activity` VALUES (515, 18, 'User membuka Dashboard', '2024-08-12 20:34:05', '0');
INSERT INTO `activity` VALUES (516, 18, 'User membuka Dashboard', '2024-08-12 20:34:06', '0');
INSERT INTO `activity` VALUES (517, 18, 'User membuka Dashboard', '2024-08-12 20:34:07', '0');
INSERT INTO `activity` VALUES (518, 18, 'User membuka Dashboard', '2024-08-12 20:34:08', '0');
INSERT INTO `activity` VALUES (519, 18, 'User membuka Dashboard', '2024-08-12 20:34:09', '0');
INSERT INTO `activity` VALUES (520, 18, 'User membuka Dashboard', '2024-08-12 20:38:44', '0');
INSERT INTO `activity` VALUES (521, 18, 'User membuka Dashboard', '2024-08-12 20:38:47', '0');
INSERT INTO `activity` VALUES (522, 18, 'User membuka Dashboard', '2024-08-12 20:38:47', '0');
INSERT INTO `activity` VALUES (523, 18, 'User membuka Dashboard', '2024-08-12 20:38:48', '0');
INSERT INTO `activity` VALUES (524, 18, 'User Logout', '2024-08-12 20:38:51', '0');
INSERT INTO `activity` VALUES (525, 1, 'User Melakukan Login', '2024-08-12 20:38:55', '0');
INSERT INTO `activity` VALUES (526, 1, 'User membuka Dashboard', '2024-08-12 20:38:55', '0');
INSERT INTO `activity` VALUES (527, 1, 'User Logout', '2024-08-12 20:39:18', '0');
INSERT INTO `activity` VALUES (528, 1, 'User Melakukan Login', '2024-08-12 20:39:29', '0');
INSERT INTO `activity` VALUES (529, 1, 'User membuka Dashboard', '2024-08-12 20:39:29', '0');
INSERT INTO `activity` VALUES (530, 1, 'User membuka Dashboard', '2024-08-12 20:39:53', '0');
INSERT INTO `activity` VALUES (531, 1, 'User membuka Dashboard', '2024-08-12 20:39:54', '0');
INSERT INTO `activity` VALUES (532, 1, 'User membuka view updatelogs', '2024-08-12 20:39:57', '0');
INSERT INTO `activity` VALUES (533, 1, 'User membuka view updatelogs', '2024-08-12 20:40:16', '0');
INSERT INTO `activity` VALUES (534, 1, 'User membuka view updatelogs', '2024-08-12 20:41:54', '0');
INSERT INTO `activity` VALUES (535, 1, 'User membuka view updatelogs', '2024-08-12 20:42:35', '0');
INSERT INTO `activity` VALUES (536, 1, 'User membuka view updatelogs', '2024-08-12 20:42:44', '0');
INSERT INTO `activity` VALUES (537, 1, 'User membuka view updatelogs', '2024-08-12 20:43:16', '0');
INSERT INTO `activity` VALUES (538, 1, 'User Logout', '2024-08-12 20:43:19', '0');
INSERT INTO `activity` VALUES (539, 18, 'User Melakukan Login', '2024-08-12 20:43:29', '0');
INSERT INTO `activity` VALUES (540, 18, 'User membuka Dashboard', '2024-08-12 20:43:29', '0');
INSERT INTO `activity` VALUES (541, 18, 'User Logout', '2024-08-12 20:43:31', '0');
INSERT INTO `activity` VALUES (542, 1, 'User Melakukan Login', '2024-08-12 20:43:57', '0');
INSERT INTO `activity` VALUES (543, 1, 'User membuka Dashboard', '2024-08-12 20:43:57', '0');
INSERT INTO `activity` VALUES (544, 1, 'User membuka view updatelogs', '2024-08-12 20:44:00', '0');
INSERT INTO `activity` VALUES (545, 1, 'User membuka view updatelogs', '2024-08-12 20:44:11', '0');
INSERT INTO `activity` VALUES (546, 1, 'User membuka view updatelogs', '2024-08-12 20:44:21', '0');
INSERT INTO `activity` VALUES (547, 1, 'User Logout', '2024-08-12 20:44:24', '0');
INSERT INTO `activity` VALUES (548, 18, 'User Melakukan Login', '2024-08-12 20:44:39', '0');
INSERT INTO `activity` VALUES (549, 18, 'User membuka Dashboard', '2024-08-12 20:44:39', '0');
INSERT INTO `activity` VALUES (550, 18, 'User Logout', '2024-08-12 20:44:50', '0');
INSERT INTO `activity` VALUES (551, 1, 'User Melakukan Login', '2024-08-12 20:44:59', '0');
INSERT INTO `activity` VALUES (552, 1, 'User membuka Dashboard', '2024-08-12 20:44:59', '0');
INSERT INTO `activity` VALUES (553, 1, 'User membuka view updatelogs', '2024-08-12 20:45:02', '0');
INSERT INTO `activity` VALUES (554, 1, 'User membuka view updatelogs', '2024-08-12 20:45:14', '0');
INSERT INTO `activity` VALUES (555, 1, 'User Logout', '2024-08-12 20:45:16', '0');
INSERT INTO `activity` VALUES (556, 18, 'User Melakukan Login', '2024-08-12 20:45:27', '0');
INSERT INTO `activity` VALUES (557, 18, 'User membuka Dashboard', '2024-08-12 20:45:27', '0');
INSERT INTO `activity` VALUES (558, 18, 'User Membuka View Pemesanan', '2024-08-12 20:45:32', '0');
INSERT INTO `activity` VALUES (559, 18, 'User membuka Dashboard', '2024-08-12 20:45:35', '0');
INSERT INTO `activity` VALUES (560, 18, 'User Logout', '2024-08-12 20:45:56', '0');
INSERT INTO `activity` VALUES (561, 1, 'User Melakukan Login', '2024-08-12 20:46:03', '0');
INSERT INTO `activity` VALUES (562, 1, 'User membuka Dashboard', '2024-08-12 20:46:03', '0');
INSERT INTO `activity` VALUES (563, 1, 'User membuka view updatelogs', '2024-08-12 20:46:07', '0');
INSERT INTO `activity` VALUES (564, 1, 'User Melakukan Login', '2024-08-13 10:47:27', '0');
INSERT INTO `activity` VALUES (565, 1, 'User membuka Dashboard', '2024-08-13 10:47:27', '0');
INSERT INTO `activity` VALUES (566, 1, 'User membuka view updatelogs', '2024-08-13 10:47:33', '0');
INSERT INTO `activity` VALUES (567, 1, 'User membuka view updatelogs', '2024-08-13 10:53:26', '0');
INSERT INTO `activity` VALUES (568, 1, 'User Logout', '2024-08-13 10:53:28', '0');
INSERT INTO `activity` VALUES (569, 1, 'User Melakukan Login', '2024-08-13 10:55:25', '0');
INSERT INTO `activity` VALUES (570, 1, 'User membuka Dashboard', '2024-08-13 10:55:25', '0');
INSERT INTO `activity` VALUES (571, 1, 'User Logout', '2024-08-13 10:55:27', '0');
INSERT INTO `activity` VALUES (572, 18, 'User Melakukan Login', '2024-08-13 10:55:33', '0');
INSERT INTO `activity` VALUES (573, 18, 'User membuka Dashboard', '2024-08-13 10:55:33', '0');
INSERT INTO `activity` VALUES (574, 18, 'User membuka Dashboard', '2024-08-13 10:57:08', '0');
INSERT INTO `activity` VALUES (575, 18, 'User membuka Dashboard', '2024-08-13 10:57:09', '0');
INSERT INTO `activity` VALUES (576, 18, 'User membuka Dashboard', '2024-08-13 10:57:31', '0');
INSERT INTO `activity` VALUES (577, 18, 'User membuka Dashboard', '2024-08-13 10:57:39', '0');
INSERT INTO `activity` VALUES (578, 18, 'User Membuka View Pemesanan', '2024-08-13 10:57:41', '0');
INSERT INTO `activity` VALUES (579, 18, 'User Membuka View Pemesanan', '2024-08-13 11:04:41', '0');
INSERT INTO `activity` VALUES (580, 18, 'User Membuka View Pemesanan', '2024-08-13 11:04:46', '0');
INSERT INTO `activity` VALUES (581, 18, 'User Logout', '2024-08-13 11:04:51', '0');
INSERT INTO `activity` VALUES (582, 1, 'User Melakukan Login', '2024-08-13 11:11:04', '0');
INSERT INTO `activity` VALUES (583, 1, 'User membuka Dashboard', '2024-08-13 11:11:04', '0');
INSERT INTO `activity` VALUES (584, 1, 'User membuka view updatelogs', '2024-08-13 11:35:37', '0');
INSERT INTO `activity` VALUES (585, 1, 'User membuka view updatelogs', '2024-08-13 11:40:14', '0');
INSERT INTO `activity` VALUES (586, 1, 'User membuka view updatelogs', '2024-08-13 11:41:33', '0');
INSERT INTO `activity` VALUES (587, 1, 'User Logout', '2024-08-13 11:41:35', '0');
INSERT INTO `activity` VALUES (588, 18, 'User Melakukan Login', '2024-08-13 11:42:06', '0');
INSERT INTO `activity` VALUES (589, 18, 'User membuka Dashboard', '2024-08-13 11:42:06', '0');
INSERT INTO `activity` VALUES (590, 18, 'User Membuka View notfound', '2024-08-13 11:42:16', '0');
INSERT INTO `activity` VALUES (591, 18, 'User membuka Dashboard', '2024-08-13 11:42:36', '0');
INSERT INTO `activity` VALUES (592, 18, 'User Membuka View notfound', '2024-08-13 11:42:42', '0');
INSERT INTO `activity` VALUES (593, 18, 'User membuka Dashboard', '2024-08-13 11:43:05', '0');
INSERT INTO `activity` VALUES (594, 18, 'User Logout', '2024-08-13 11:53:35', '0');
INSERT INTO `activity` VALUES (595, 1, 'User Melakukan Login', '2024-08-13 12:22:42', '0');
INSERT INTO `activity` VALUES (596, 1, 'User membuka Dashboard', '2024-08-13 12:22:42', '0');
INSERT INTO `activity` VALUES (597, 1, 'User Logout', '2024-08-13 12:22:49', '0');
INSERT INTO `activity` VALUES (598, 1, 'User Melakukan Login', '2024-08-13 12:26:45', '0');
INSERT INTO `activity` VALUES (599, 1, 'User membuka Dashboard', '2024-08-13 12:26:45', '0');
INSERT INTO `activity` VALUES (600, 1, 'User Logout', '2024-08-13 12:26:53', '0');
INSERT INTO `activity` VALUES (601, 1, 'User Melakukan Login', '2024-08-13 12:27:29', '0');
INSERT INTO `activity` VALUES (602, 1, 'User membuka Dashboard', '2024-08-13 12:27:30', '0');
INSERT INTO `activity` VALUES (603, 1, 'User membuka view updatelogs', '2024-08-13 12:37:43', '0');
INSERT INTO `activity` VALUES (604, 1, 'User membuka view updatelogs', '2024-08-13 12:39:02', '0');
INSERT INTO `activity` VALUES (605, 1, 'User Logout', '2024-08-13 12:39:04', '0');
INSERT INTO `activity` VALUES (606, 18, 'User Melakukan Login', '2024-08-13 12:39:12', '0');
INSERT INTO `activity` VALUES (607, 18, 'User membuka Dashboard', '2024-08-13 12:39:12', '0');
INSERT INTO `activity` VALUES (608, 18, 'User Membuka View notfound', '2024-08-13 12:39:19', '0');
INSERT INTO `activity` VALUES (609, 18, 'User membuka Dashboard', '2024-08-13 12:40:06', '0');
INSERT INTO `activity` VALUES (610, 18, 'User Membuka View notfound', '2024-08-13 12:40:15', '0');
INSERT INTO `activity` VALUES (611, 18, 'User membuka Dashboard', '2024-08-13 12:40:17', '0');
INSERT INTO `activity` VALUES (612, 18, 'User membuka Dashboard', '2024-08-13 12:43:07', '0');
INSERT INTO `activity` VALUES (613, 18, 'User Membuka View notfound', '2024-08-13 12:43:10', '0');
INSERT INTO `activity` VALUES (614, 18, 'User membuka Dashboard', '2024-08-13 12:43:13', '0');
INSERT INTO `activity` VALUES (615, 18, 'User membuka Dashboard', '2024-08-13 12:43:22', '0');
INSERT INTO `activity` VALUES (616, 18, 'User membuka view barang', '2024-08-13 12:43:23', '0');
INSERT INTO `activity` VALUES (617, 18, 'User membuka Dashboard', '2024-08-13 12:43:47', '0');
INSERT INTO `activity` VALUES (618, 18, 'User membuka Dashboard', '2024-08-13 12:45:30', '0');
INSERT INTO `activity` VALUES (619, 18, 'User membuka Dashboard', '2024-08-13 12:52:54', '0');
INSERT INTO `activity` VALUES (620, 18, 'User membuka Dashboard', '2024-08-13 12:52:56', '0');
INSERT INTO `activity` VALUES (621, 18, 'User membuka view barang', '2024-08-13 12:53:50', '0');
INSERT INTO `activity` VALUES (622, 18, 'User Membuka View notfound', '2024-08-13 12:53:53', '0');
INSERT INTO `activity` VALUES (623, 18, 'User membuka view barang', '2024-08-13 12:53:54', '0');
INSERT INTO `activity` VALUES (624, 18, 'User membuka view barang', '2024-08-13 12:53:58', '0');
INSERT INTO `activity` VALUES (625, 18, 'User Logout', '2024-08-13 12:54:00', '0');
INSERT INTO `activity` VALUES (626, 1, 'User Melakukan Login', '2024-08-13 12:54:22', '0');
INSERT INTO `activity` VALUES (627, 1, 'User membuka Dashboard', '2024-08-13 12:54:22', '0');
INSERT INTO `activity` VALUES (628, 1, 'User membuka view barang', '2024-08-13 12:54:24', '0');
INSERT INTO `activity` VALUES (629, 1, 'User membuka view updatelogs', '2024-08-13 12:54:30', '0');
INSERT INTO `activity` VALUES (630, 1, 'User membuka view updatelogs', '2024-08-13 12:54:41', '0');
INSERT INTO `activity` VALUES (631, 1, 'User Logout', '2024-08-13 12:54:43', '0');
INSERT INTO `activity` VALUES (632, 18, 'User Melakukan Login', '2024-08-13 12:54:47', '0');
INSERT INTO `activity` VALUES (633, 18, 'User membuka Dashboard', '2024-08-13 12:54:47', '0');
INSERT INTO `activity` VALUES (634, 18, 'User Membuka View notfound', '2024-08-13 12:54:50', '0');
INSERT INTO `activity` VALUES (635, 18, 'User membuka Dashboard', '2024-08-13 12:54:51', '0');
INSERT INTO `activity` VALUES (636, 18, 'User membuka view barang', '2024-08-13 12:54:54', '0');
INSERT INTO `activity` VALUES (637, 18, 'User membuka view barang', '2024-08-13 12:55:47', '0');
INSERT INTO `activity` VALUES (638, 18, 'User membuka Dashboard', '2024-08-13 12:55:49', '0');
INSERT INTO `activity` VALUES (639, 18, 'User membuka view barang', '2024-08-13 12:55:52', '0');
INSERT INTO `activity` VALUES (640, 18, 'User membuka view barang', '2024-08-13 13:17:58', '0');
INSERT INTO `activity` VALUES (641, 18, 'User membuka view barang', '2024-08-13 13:18:12', '0');
INSERT INTO `activity` VALUES (642, 18, 'User membuka view updatelogs', '2024-08-13 13:18:16', '0');
INSERT INTO `activity` VALUES (643, 18, 'User membuka view updatelogs', '2024-08-13 13:19:20', '0');
INSERT INTO `activity` VALUES (644, 18, 'User membuka view updatelogs', '2024-08-13 13:23:50', '0');
INSERT INTO `activity` VALUES (645, 18, 'User membuka view updatelogs', '2024-08-13 13:30:11', '0');
INSERT INTO `activity` VALUES (646, 18, 'User membuka view updatelogs', '2024-08-13 13:30:54', '0');
INSERT INTO `activity` VALUES (647, 18, 'User membuka view updatelogs', '2024-08-13 13:30:59', '0');
INSERT INTO `activity` VALUES (648, 18, 'User membuka view barang', '2024-08-13 13:31:05', '0');
INSERT INTO `activity` VALUES (649, 18, 'User membuka view updatelogs', '2024-08-13 13:31:07', '0');
INSERT INTO `activity` VALUES (650, 18, 'User membuka view updatelogs', '2024-08-13 13:32:38', '0');
INSERT INTO `activity` VALUES (651, 18, 'User membuka view updatelogs', '2024-08-13 13:32:48', '0');
INSERT INTO `activity` VALUES (652, 18, 'User Membuka View notfound', '2024-08-13 13:32:54', '0');
INSERT INTO `activity` VALUES (653, 18, 'User membuka view updatelogs', '2024-08-13 13:32:56', '0');
INSERT INTO `activity` VALUES (654, 18, 'User membuka view updatelogs', '2024-08-13 13:32:59', '0');
INSERT INTO `activity` VALUES (655, 18, 'User Membuka View notfound', '2024-08-13 13:33:01', '0');
INSERT INTO `activity` VALUES (656, 18, 'User membuka view updatelogs', '2024-08-13 13:33:03', '0');
INSERT INTO `activity` VALUES (657, 18, 'User membuka view updatelogs', '2024-08-13 13:33:37', '0');

-- ----------------------------
-- Table structure for barang
-- ----------------------------
DROP TABLE IF EXISTS `barang`;
CREATE TABLE `barang`  (
  `id_barang` int NOT NULL AUTO_INCREMENT,
  `kode_barang` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NULL DEFAULT NULL,
  `nama_barang` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NULL DEFAULT NULL,
  `harga_jual` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NULL DEFAULT NULL,
  `harga_beli` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NULL DEFAULT NULL,
  `stok` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NULL DEFAULT NULL,
  `foto` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NULL DEFAULT NULL,
  `status` enum('tidak tersedia','tersedia') CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NULL DEFAULT NULL,
  `delete` enum('0','1') CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NULL DEFAULT NULL,
  `create_at` datetime NULL DEFAULT NULL,
  `create_by` int NULL DEFAULT NULL,
  `update_at` datetime NULL DEFAULT NULL,
  `update_by` int NULL DEFAULT NULL,
  PRIMARY KEY (`id_barang`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 24 CHARACTER SET = utf8mb4 COLLATE = utf8mb4_general_ci ROW_FORMAT = DYNAMIC;

-- ----------------------------
-- Records of barang
-- ----------------------------
INSERT INTO `barang` VALUES (17, 'p-01', 'Paku', '700', '500', '1103', 'paku payung.png', 'tersedia', '0', '2024-08-01 11:02:54', 1, '2024-08-01 13:15:22', 1);
INSERT INTO `barang` VALUES (18, 'p-02', 'Lem Tikus', '11000', '9000', '1527', 'Lem Tikus.png', 'tersedia', '0', '2024-08-01 11:03:47', 1, '2024-08-01 13:15:41', 1);
INSERT INTO `barang` VALUES (19, 'p-03', 'Nippon Paint Putih', '100000', '95000', '99', 'nippon paint putih.png', 'tersedia', '0', '2024-08-01 11:06:56', 1, NULL, NULL);
INSERT INTO `barang` VALUES (20, 'p-04', 'Stella Jeruk', '14000', '11000', '152', 'stella jeruk_1.png', 'tersedia', '0', '2024-08-01 11:07:49', 1, NULL, NULL);
INSERT INTO `barang` VALUES (21, 'p-0123', 'Paku  Payung 1 Kg', '32000', '30000', '29', 'download (2).jfif', 'tersedia', '0', '2024-08-04 18:56:35', 1, NULL, NULL);
INSERT INTO `barang` VALUES (22, 'p-0124', 'helm proyek', '55000', '50000', '35', 'no_brand_helm_proyek_safety_helmet_kuning_standar_sni_msa_lokal_-_inner_putar_fastrack_full05_bmdrleqf.webp', 'tersedia', '0', '2024-08-05 21:01:34', 1, NULL, NULL);
INSERT INTO `barang` VALUES (23, 'p-0125', 'waw', '1200', '1000', '1', 'download (2).jfif', 'tersedia', '0', '2024-08-08 21:22:15', 1, NULL, NULL);

-- ----------------------------
-- Table structure for barang_backup
-- ----------------------------
DROP TABLE IF EXISTS `barang_backup`;
CREATE TABLE `barang_backup`  (
  `id_barang` int NOT NULL AUTO_INCREMENT,
  `kode_barang` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NULL DEFAULT NULL,
  `nama_barang` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NULL DEFAULT NULL,
  `harga_jual` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NULL DEFAULT NULL,
  `harga_beli` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NULL DEFAULT NULL,
  `stok` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NULL DEFAULT NULL,
  `foto` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NULL DEFAULT NULL,
  `status` enum('tidak tersedia','tersedia') CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NULL DEFAULT NULL,
  `delete` enum('0','1') CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NULL DEFAULT NULL,
  `create_at` datetime NULL DEFAULT NULL,
  `create_by` int NULL DEFAULT NULL,
  `update_at` datetime NULL DEFAULT NULL,
  `update_by` int NULL DEFAULT NULL,
  PRIMARY KEY (`id_barang`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 24 CHARACTER SET = utf8mb4 COLLATE = utf8mb4_general_ci ROW_FORMAT = DYNAMIC;

-- ----------------------------
-- Records of barang_backup
-- ----------------------------
INSERT INTO `barang_backup` VALUES (17, 'p-01', 'Paku', '700', '500', '1083', 'paku payung.png', 'tersedia', '0', '2024-08-01 11:02:54', 1, '2024-08-01 13:15:22', 1);
INSERT INTO `barang_backup` VALUES (18, 'p-02', 'Lem Tikus', '11000', '9000', '1530', 'Lem Tikus.png', 'tersedia', '0', '2024-08-01 11:03:47', 1, '2024-08-01 13:15:41', 1);
INSERT INTO `barang_backup` VALUES (19, 'p-03', 'Nippon Paint Putih', '100000', '95000', '100', 'nippon paint putih.png', 'tersedia', '0', '2024-08-01 11:06:56', 1, NULL, NULL);
INSERT INTO `barang_backup` VALUES (20, 'p-04', 'Stella Jeruk', '14000', '11000', '152', 'stella jeruk_1.png', 'tersedia', '0', '2024-08-01 11:07:49', 1, NULL, NULL);
INSERT INTO `barang_backup` VALUES (21, 'p-0123', 'Paku  Payung 1 Kg', '32000', '30000', '29', 'download (2).jfif', 'tersedia', '0', '2024-08-04 18:56:35', 1, NULL, NULL);
INSERT INTO `barang_backup` VALUES (22, 'p-0124', 'helm proyek', '55000', '50000', '35', 'no_brand_helm_proyek_safety_helmet_kuning_standar_sni_msa_lokal_-_inner_putar_fastrack_full05_bmdrleqf.webp', 'tersedia', '0', '2024-08-05 21:01:34', 1, NULL, NULL);
INSERT INTO `barang_backup` VALUES (23, 'p-0125', 'waw', '1200', '1000', '1', 'download (2).jfif', 'tersedia', '0', '2024-08-08 21:22:15', 1, NULL, NULL);

-- ----------------------------
-- Table structure for barangkeluar
-- ----------------------------
DROP TABLE IF EXISTS `barangkeluar`;
CREATE TABLE `barangkeluar`  (
  `id_bkeluar` int NOT NULL AUTO_INCREMENT,
  `id_barang` int NULL DEFAULT NULL,
  `jumlah` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NULL DEFAULT NULL,
  `kode_keranjang` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NULL DEFAULT NULL,
  `delete` enum('0','1') CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NULL DEFAULT NULL,
  `tanggal` date NULL DEFAULT NULL,
  `create_at` datetime NULL DEFAULT NULL,
  `create_by` int NULL DEFAULT NULL,
  `update_at` datetime NULL DEFAULT NULL,
  `update_by` int NULL DEFAULT NULL,
  PRIMARY KEY (`id_bkeluar`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 320 CHARACTER SET = utf8mb4 COLLATE = utf8mb4_general_ci ROW_FORMAT = DYNAMIC;

-- ----------------------------
-- Records of barangkeluar
-- ----------------------------
INSERT INTO `barangkeluar` VALUES (295, 17, '1', 'CPP-0001', '0', '2024-08-04', '2024-08-04 21:34:50', 1, NULL, NULL);
INSERT INTO `barangkeluar` VALUES (296, 18, '1', 'CPP-0001', '0', '2024-08-04', '2024-08-04 21:34:50', 1, NULL, NULL);
INSERT INTO `barangkeluar` VALUES (297, 18, '1', 'CPP-0002', '0', '2024-08-04', '2024-08-04 21:35:48', 1, NULL, NULL);
INSERT INTO `barangkeluar` VALUES (298, 20, '1', 'CPP-0002', '0', '2024-08-04', '2024-08-04 21:35:48', 1, NULL, NULL);
INSERT INTO `barangkeluar` VALUES (299, 21, '1', 'CPP-0002', '0', '2024-08-04', '2024-08-04 21:35:48', 1, NULL, NULL);
INSERT INTO `barangkeluar` VALUES (300, 17, '1', 'CPP-0003', '0', '2024-08-05', '2024-08-05 11:02:29', 1, NULL, NULL);
INSERT INTO `barangkeluar` VALUES (301, 18, '2', 'CPP-0003', '0', '2024-08-05', '2024-08-05 11:02:29', 1, '2024-08-05 11:03:52', 1);
INSERT INTO `barangkeluar` VALUES (305, 17, '2', 'CPP-0004', '0', '2024-08-05', '2024-08-05 11:23:50', 1, '2024-08-05 12:45:01', 1);
INSERT INTO `barangkeluar` VALUES (306, 18, '2', 'CPP-0004', '0', '2024-08-05', '2024-08-05 11:23:50', 1, '2024-08-05 12:36:13', 1);
INSERT INTO `barangkeluar` VALUES (307, 17, '5', NULL, '0', '2024-08-05', '2024-08-05 21:02:46', 1, NULL, NULL);
INSERT INTO `barangkeluar` VALUES (308, 22, '5', NULL, '0', '2024-08-05', '2024-08-05 21:03:05', 1, NULL, NULL);
INSERT INTO `barangkeluar` VALUES (309, 17, '5', 'CPP-0005', '0', '2024-08-06', '2024-08-06 13:09:23', 1, NULL, NULL);
INSERT INTO `barangkeluar` VALUES (310, 18, '5', 'CPP-0005', '0', '2024-08-06', '2024-08-06 13:09:23', 1, NULL, NULL);
INSERT INTO `barangkeluar` VALUES (311, 17, '1', 'CPP-0006', '0', '2024-08-06', '2024-08-06 13:41:28', 1, NULL, NULL);
INSERT INTO `barangkeluar` VALUES (312, 18, '1', 'CPP-0006', '0', '2024-08-06', '2024-08-06 13:41:28', 1, NULL, NULL);
INSERT INTO `barangkeluar` VALUES (313, 17, '1', 'CPP-0001', '0', '2024-08-08', '2024-08-08 10:57:08', 1, NULL, NULL);
INSERT INTO `barangkeluar` VALUES (314, 18, '1', 'CPP-0001', '0', '2024-08-08', '2024-08-08 10:57:08', 1, NULL, NULL);
INSERT INTO `barangkeluar` VALUES (315, 17, '1', 'CPP-0001', '0', '2024-08-08', '2024-08-08 13:37:22', 1, NULL, NULL);
INSERT INTO `barangkeluar` VALUES (316, 18, '1', 'CPP-0001', '0', '2024-08-08', '2024-08-08 13:37:22', 1, NULL, NULL);
INSERT INTO `barangkeluar` VALUES (317, 17, '2', 'CPP-0001', '0', '2024-08-12', '2024-08-12 13:14:46', 1, NULL, NULL);
INSERT INTO `barangkeluar` VALUES (318, 18, '3', 'CPP-0001', '0', '2024-08-12', '2024-08-12 13:14:46', 1, NULL, NULL);
INSERT INTO `barangkeluar` VALUES (319, 19, '1', 'CPP-0001', '0', '2024-08-12', '2024-08-12 13:14:46', 1, NULL, NULL);

-- ----------------------------
-- Table structure for barangkeluar_backup
-- ----------------------------
DROP TABLE IF EXISTS `barangkeluar_backup`;
CREATE TABLE `barangkeluar_backup`  (
  `id_bkeluar` int NOT NULL AUTO_INCREMENT,
  `id_barang` int NULL DEFAULT NULL,
  `jumlah` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NULL DEFAULT NULL,
  `kode_keranjang` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NULL DEFAULT NULL,
  `delete` enum('0','1') CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NULL DEFAULT NULL,
  `tanggal` date NULL DEFAULT NULL,
  `create_at` datetime NULL DEFAULT NULL,
  `create_by` int NULL DEFAULT NULL,
  `update_at` datetime NULL DEFAULT NULL,
  `update_by` int NULL DEFAULT NULL,
  PRIMARY KEY (`id_bkeluar`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 317 CHARACTER SET = utf8mb4 COLLATE = utf8mb4_general_ci ROW_FORMAT = DYNAMIC;

-- ----------------------------
-- Records of barangkeluar_backup
-- ----------------------------
INSERT INTO `barangkeluar_backup` VALUES (295, 17, '1', 'CPP-0001', '0', '2024-08-04', '2024-08-04 21:34:50', 1, NULL, NULL);
INSERT INTO `barangkeluar_backup` VALUES (296, 18, '1', 'CPP-0001', '0', '2024-08-04', '2024-08-04 21:34:50', 1, NULL, NULL);
INSERT INTO `barangkeluar_backup` VALUES (297, 18, '1', 'CPP-0002', '0', '2024-08-04', '2024-08-04 21:35:48', 1, NULL, NULL);
INSERT INTO `barangkeluar_backup` VALUES (298, 20, '1', 'CPP-0002', '0', '2024-08-04', '2024-08-04 21:35:48', 1, NULL, NULL);
INSERT INTO `barangkeluar_backup` VALUES (299, 21, '1', 'CPP-0002', '0', '2024-08-04', '2024-08-04 21:35:48', 1, NULL, NULL);
INSERT INTO `barangkeluar_backup` VALUES (300, 17, '1', 'CPP-0003', '0', '2024-08-05', '2024-08-05 11:02:29', 1, NULL, NULL);
INSERT INTO `barangkeluar_backup` VALUES (301, 18, '2', 'CPP-0003', '0', '2024-08-05', '2024-08-05 11:02:29', 1, '2024-08-05 11:03:52', 1);
INSERT INTO `barangkeluar_backup` VALUES (305, 17, '2', 'CPP-0004', '0', '2024-08-05', '2024-08-05 11:23:50', 1, '2024-08-05 12:45:01', 1);
INSERT INTO `barangkeluar_backup` VALUES (306, 18, '2', 'CPP-0004', '0', '2024-08-05', '2024-08-05 11:23:50', 1, '2024-08-05 12:36:13', 1);
INSERT INTO `barangkeluar_backup` VALUES (307, 17, '5', NULL, '0', '2024-08-05', '2024-08-05 21:02:46', 1, NULL, NULL);
INSERT INTO `barangkeluar_backup` VALUES (308, 22, '5', NULL, '0', '2024-08-05', '2024-08-05 21:03:05', 1, NULL, NULL);
INSERT INTO `barangkeluar_backup` VALUES (309, 17, '5', 'CPP-0005', '0', '2024-08-06', '2024-08-06 13:09:23', 1, NULL, NULL);
INSERT INTO `barangkeluar_backup` VALUES (310, 18, '5', 'CPP-0005', '0', '2024-08-06', '2024-08-06 13:09:23', 1, NULL, NULL);
INSERT INTO `barangkeluar_backup` VALUES (311, 17, '1', 'CPP-0006', '0', '2024-08-06', '2024-08-06 13:41:28', 1, NULL, NULL);
INSERT INTO `barangkeluar_backup` VALUES (312, 18, '1', 'CPP-0006', '0', '2024-08-06', '2024-08-06 13:41:28', 1, NULL, NULL);
INSERT INTO `barangkeluar_backup` VALUES (313, 17, '1', 'CPP-0001', '0', '2024-08-08', '2024-08-08 10:57:08', 1, NULL, NULL);
INSERT INTO `barangkeluar_backup` VALUES (314, 18, '1', 'CPP-0001', '0', '2024-08-08', '2024-08-08 10:57:08', 1, NULL, NULL);
INSERT INTO `barangkeluar_backup` VALUES (315, 17, '1', 'CPP-0001', '0', '2024-08-08', '2024-08-08 13:37:22', 1, NULL, NULL);
INSERT INTO `barangkeluar_backup` VALUES (316, 18, '1', 'CPP-0001', '0', '2024-08-08', '2024-08-08 13:37:22', 1, NULL, NULL);

-- ----------------------------
-- Table structure for barangmasuk
-- ----------------------------
DROP TABLE IF EXISTS `barangmasuk`;
CREATE TABLE `barangmasuk`  (
  `id_bmasuk` int NOT NULL AUTO_INCREMENT,
  `id_barang` int NULL DEFAULT NULL,
  `quantity` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NULL DEFAULT NULL,
  `delete` enum('0','1') CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NULL DEFAULT NULL,
  `tanggal` date NULL DEFAULT NULL,
  `create_at` datetime NULL DEFAULT NULL,
  `create_by` int NULL DEFAULT NULL,
  `update_at` datetime NULL DEFAULT NULL,
  `update_by` int NULL DEFAULT NULL,
  PRIMARY KEY (`id_bmasuk`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 23 CHARACTER SET = utf8mb4 COLLATE = utf8mb4_general_ci ROW_FORMAT = DYNAMIC;

-- ----------------------------
-- Records of barangmasuk
-- ----------------------------
INSERT INTO `barangmasuk` VALUES (17, 18, '100', '0', '2024-08-01', '2024-08-01 13:14:26', 1, '2024-08-01 13:51:46', 1);
INSERT INTO `barangmasuk` VALUES (18, 20, '100', '0', '2024-08-04', '2024-08-04 17:47:58', 1, NULL, NULL);
INSERT INTO `barangmasuk` VALUES (19, 21, '10', '0', '2024-08-04', '2024-08-04 18:57:14', 1, NULL, NULL);
INSERT INTO `barangmasuk` VALUES (20, 18, '12', '0', '2024-08-05', '2024-08-05 21:02:25', 1, NULL, NULL);
INSERT INTO `barangmasuk` VALUES (21, 22, '20', '0', '2024-08-05', '2024-08-05 21:02:35', 1, NULL, NULL);
INSERT INTO `barangmasuk` VALUES (22, 17, '10', '0', '2024-08-12', '2024-08-12 13:19:49', 1, NULL, NULL);

-- ----------------------------
-- Table structure for barangmasuk_backup
-- ----------------------------
DROP TABLE IF EXISTS `barangmasuk_backup`;
CREATE TABLE `barangmasuk_backup`  (
  `id_bmasuk` int NOT NULL AUTO_INCREMENT,
  `id_barang` int NULL DEFAULT NULL,
  `quantity` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NULL DEFAULT NULL,
  `delete` enum('0','1') CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NULL DEFAULT NULL,
  `tanggal` date NULL DEFAULT NULL,
  `create_at` datetime NULL DEFAULT NULL,
  `create_by` int NULL DEFAULT NULL,
  `update_at` datetime NULL DEFAULT NULL,
  `update_by` int NULL DEFAULT NULL,
  PRIMARY KEY (`id_bmasuk`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 23 CHARACTER SET = utf8mb4 COLLATE = utf8mb4_general_ci ROW_FORMAT = DYNAMIC;

-- ----------------------------
-- Records of barangmasuk_backup
-- ----------------------------
INSERT INTO `barangmasuk_backup` VALUES (17, 18, '100', '0', '2024-08-01', '2024-08-01 13:14:26', 1, '2024-08-01 13:51:46', 1);
INSERT INTO `barangmasuk_backup` VALUES (18, 20, '100', '0', '2024-08-04', '2024-08-04 17:47:58', 1, NULL, NULL);
INSERT INTO `barangmasuk_backup` VALUES (19, 21, '10', '0', '2024-08-04', '2024-08-04 18:57:14', 1, NULL, NULL);
INSERT INTO `barangmasuk_backup` VALUES (20, 18, '12', '0', '2024-08-05', '2024-08-05 21:02:25', 1, NULL, NULL);
INSERT INTO `barangmasuk_backup` VALUES (21, 22, '20', '0', '2024-08-05', '2024-08-05 21:02:35', 1, NULL, NULL);
INSERT INTO `barangmasuk_backup` VALUES (22, 17, '10', '0', '2024-08-12', '2024-08-12 13:19:49', 1, NULL, NULL);

-- ----------------------------
-- Table structure for keranjang
-- ----------------------------
DROP TABLE IF EXISTS `keranjang`;
CREATE TABLE `keranjang`  (
  `id_Keranjang` int NOT NULL AUTO_INCREMENT,
  `id_user` int NULL DEFAULT NULL,
  `id_barang` int NULL DEFAULT NULL,
  `quantity` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NULL DEFAULT NULL,
  `kode_keranjang` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NULL DEFAULT NULL,
  `create_at` datetime NULL DEFAULT NULL,
  `create_by` int NULL DEFAULT NULL,
  `update_at` datetime NULL DEFAULT NULL,
  `update_by` int NULL DEFAULT NULL,
  `status` enum('pending','checkout') CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NULL DEFAULT NULL,
  `deletek` enum('0','1') CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NULL DEFAULT NULL,
  PRIMARY KEY (`id_Keranjang`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 440 CHARACTER SET = utf8mb4 COLLATE = utf8mb4_general_ci ROW_FORMAT = DYNAMIC;

-- ----------------------------
-- Records of keranjang
-- ----------------------------
INSERT INTO `keranjang` VALUES (436, 1, 17, '2', 'CPP-0001', '2024-08-12 13:14:41', 1, NULL, NULL, 'checkout', '0');
INSERT INTO `keranjang` VALUES (437, 1, 18, '3', 'CPP-0001', '2024-08-12 13:14:41', 1, NULL, NULL, 'checkout', '0');
INSERT INTO `keranjang` VALUES (438, 1, 19, '1', 'CPP-0001', '2024-08-12 13:14:41', 1, NULL, NULL, 'checkout', '0');
INSERT INTO `keranjang` VALUES (439, 1, 17, '1', 'CPP-0002', '2024-08-12 13:26:31', 1, NULL, NULL, 'pending', '0');

-- ----------------------------
-- Table structure for menus
-- ----------------------------
DROP TABLE IF EXISTS `menus`;
CREATE TABLE `menus`  (
  `id` int NOT NULL AUTO_INCREMENT,
  `parent_id` int NULL DEFAULT 0,
  `title` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `url` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NULL DEFAULT NULL,
  `icon` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NULL DEFAULT NULL,
  `level` int NOT NULL,
  `sort_order` int NULL DEFAULT 0,
  `show_for_level_3` tinyint(1) NULL DEFAULT 0,
  `tipe_menu` enum('Main Menu','Sub Menu') CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NULL DEFAULT NULL,
  PRIMARY KEY (`id`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 27 CHARACTER SET = utf8mb4 COLLATE = utf8mb4_general_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Records of menus
-- ----------------------------
INSERT INTO `menus` VALUES (1, 0, 'Dashboard', 'home/index', 'fa fa-laptop', 1, 1, 1, 'Sub Menu');
INSERT INTO `menus` VALUES (2, 0, 'Data', '#', 'fa fa-database', 1, 2, 1, 'Main Menu');
INSERT INTO `menus` VALUES (3, 0, 'Restore Data', '#', 'fa fa-undo', 1, 3, 1, 'Main Menu');
INSERT INTO `menus` VALUES (4, 0, 'Laporan', '#', 'fa fa-file-text', 1, 4, 1, 'Main Menu');
INSERT INTO `menus` VALUES (5, 0, 'Barang', '#', 'fa fa-shopping-bag', 3, 5, 1, 'Main Menu');
INSERT INTO `menus` VALUES (6, 0, 'Website', '#', 'fa fa-cogs', 1, 6, 1, 'Main Menu');
INSERT INTO `menus` VALUES (7, 2, 'Barang', 'home/barang', 'fa fa-table', 1, 1, 0, 'Sub Menu');
INSERT INTO `menus` VALUES (8, 2, 'Barang Masuk', 'home/barangmasuk', 'fa fa-table', 1, 2, 1, 'Sub Menu');
INSERT INTO `menus` VALUES (9, 2, 'Barang Keluar', 'home/barangkeluar', 'fa fa-table', 1, 3, 1, 'Sub Menu');
INSERT INTO `menus` VALUES (10, 2, 'User', 'home/user', 'fa fa-table', 1, 4, 1, 'Sub Menu');
INSERT INTO `menus` VALUES (11, 2, 'Keranjang', 'home/datakeranjang', 'fa fa-table', 1, 5, 1, 'Sub Menu');
INSERT INTO `menus` VALUES (12, 2, 'Transaksi', 'home/transaksi', 'fa fa-table', 1, 6, 1, 'Sub Menu');
INSERT INTO `menus` VALUES (13, 3, 'Barang', 'home/rbarang', 'fa fa-table', 1, 1, 1, 'Sub Menu');
INSERT INTO `menus` VALUES (14, 3, 'Barang Masuk', 'home/rbarangmasuk', 'fa fa-table', 1, 2, 1, 'Sub Menu');
INSERT INTO `menus` VALUES (15, 3, 'Barang Keluar', 'home/rbarangkeluar', 'fa fa-table', 1, 3, 1, 'Sub Menu');
INSERT INTO `menus` VALUES (16, 3, 'User', 'home/ruser', 'fa fa-table', 1, 4, 1, 'Sub Menu');
INSERT INTO `menus` VALUES (17, 3, 'Keranjang', 'home/rkeranjang', 'fa fa-table', 1, 5, 1, 'Sub Menu');
INSERT INTO `menus` VALUES (18, 3, 'Transaksi', 'home/rtransaksi', 'fa fa-table', 1, 6, 1, 'Sub Menu');
INSERT INTO `menus` VALUES (19, 4, 'Transaksi', 'home/laporantransaksi', 'fa fa-file-word-o', 1, 1, 1, 'Sub Menu');
INSERT INTO `menus` VALUES (20, 4, 'Barang Masuk', 'home/laporanbarangmasuk', 'fa fa-file-word-o', 1, 2, 1, 'Sub Menu');
INSERT INTO `menus` VALUES (21, 4, 'Barang Keluar', 'home/laporanbarangkeluar', 'fa fa-file-word-o', 1, 3, 1, 'Sub Menu');
INSERT INTO `menus` VALUES (22, 5, 'Barang Material', 'home/Pemesanan', 'fa fa-shopping-bag', 1, 1, 1, 'Sub Menu');
INSERT INTO `menus` VALUES (23, 6, 'UserLog', 'home/userlog', 'fa fa-user', 1, 1, 1, 'Sub Menu');
INSERT INTO `menus` VALUES (24, 6, 'UpdateLog', 'home/updatelogs', 'fa fa-edit', 1, 2, 1, 'Sub Menu');
INSERT INTO `menus` VALUES (25, 6, 'Setting', 'home/setting', 'fa fa-gear', 1, 3, 1, 'Sub Menu');
INSERT INTO `menus` VALUES (26, 6, 'Menu Manage', 'home/managemenu', 'fa fa-gear', 1, 4, 1, 'Sub Menu');

-- ----------------------------
-- Table structure for nota
-- ----------------------------
DROP TABLE IF EXISTS `nota`;
CREATE TABLE `nota`  (
  `id_nota` int NOT NULL AUTO_INCREMENT,
  `nomor_transaksi` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NULL DEFAULT NULL,
  `tanggal_transaksi` date NULL DEFAULT NULL,
  `jumlah_transaksi` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NULL DEFAULT NULL,
  `create_at` datetime NULL DEFAULT NULL,
  `create_by` int NULL DEFAULT NULL,
  `update_at` datetime NULL DEFAULT NULL,
  `update_by` int NULL DEFAULT NULL,
  `delete` enum('0','1') CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NULL DEFAULT NULL,
  PRIMARY KEY (`id_nota`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 73 CHARACTER SET = utf8mb4 COLLATE = utf8mb4_general_ci ROW_FORMAT = DYNAMIC;

-- ----------------------------
-- Records of nota
-- ----------------------------
INSERT INTO `nota` VALUES (72, 'CTP-1', '2024-08-12', '134400', '2024-08-12 13:14:46', 1, NULL, NULL, '0');

-- ----------------------------
-- Table structure for setting
-- ----------------------------
DROP TABLE IF EXISTS `setting`;
CREATE TABLE `setting`  (
  `id_setting` int NOT NULL AUTO_INCREMENT,
  `judul_website` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NULL DEFAULT NULL,
  `tab_icon` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NULL DEFAULT NULL,
  `menu_icon` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NULL DEFAULT NULL,
  `login_icon` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NULL DEFAULT NULL,
  PRIMARY KEY (`id_setting`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 2 CHARACTER SET = utf8mb4 COLLATE = utf8mb4_general_ci ROW_FORMAT = DYNAMIC;

-- ----------------------------
-- Records of setting
-- ----------------------------
INSERT INTO `setting` VALUES (1, 'Cipta Puri Power', 'cipta puri-01.png', 'cipta puri-02.png', 'cipta puri-01.png');

-- ----------------------------
-- Table structure for token
-- ----------------------------
DROP TABLE IF EXISTS `token`;
CREATE TABLE `token`  (
  `id_token` int NOT NULL AUTO_INCREMENT,
  `email` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NULL DEFAULT NULL,
  `token` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NULL DEFAULT NULL,
  `create_at` datetime NULL DEFAULT NULL,
  PRIMARY KEY (`id_token`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 22 CHARACTER SET = utf8mb4 COLLATE = utf8mb4_general_ci ROW_FORMAT = DYNAMIC;

-- ----------------------------
-- Records of token
-- ----------------------------
INSERT INTO `token` VALUES (19, 'vanyogachua@gmail.com', 'NA3N1I', '2024-07-23 00:37:41');
INSERT INTO `token` VALUES (20, 'vanyogachua@gmail.com', 'PEO3A5', '2024-07-23 00:38:12');

-- ----------------------------
-- Table structure for transaksi
-- ----------------------------
DROP TABLE IF EXISTS `transaksi`;
CREATE TABLE `transaksi`  (
  `id_transaksi` int NOT NULL AUTO_INCREMENT,
  `no_transaksi` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NULL DEFAULT NULL,
  `kode_keranjang` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NULL DEFAULT NULL,
  `tanggal` date NULL DEFAULT NULL,
  `deletet` enum('0','1') CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NULL DEFAULT NULL,
  `create_at` datetime NULL DEFAULT NULL,
  `create_by` int NULL DEFAULT NULL,
  `update_at` datetime NULL DEFAULT NULL,
  `update_by` int NULL DEFAULT NULL,
  PRIMARY KEY (`id_transaksi`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 120 CHARACTER SET = utf8mb4 COLLATE = utf8mb4_general_ci ROW_FORMAT = DYNAMIC;

-- ----------------------------
-- Records of transaksi
-- ----------------------------
INSERT INTO `transaksi` VALUES (119, 'CTP-1', 'CPP-0001', '2024-08-12', '0', '2024-08-12 13:14:46', 1, NULL, NULL);

-- ----------------------------
-- Table structure for updatelog
-- ----------------------------
DROP TABLE IF EXISTS `updatelog`;
CREATE TABLE `updatelog`  (
  `id_updatelog` int NOT NULL AUTO_INCREMENT,
  `id_user` int NULL DEFAULT NULL,
  `updated` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NULL DEFAULT NULL,
  `timestamp` datetime NULL DEFAULT NULL,
  `delete` enum('0','1') CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NULL DEFAULT NULL,
  `id_barang` int NULL DEFAULT NULL,
  PRIMARY KEY (`id_updatelog`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 12 CHARACTER SET = utf8mb4 COLLATE = utf8mb4_general_ci ROW_FORMAT = DYNAMIC;

-- ----------------------------
-- Records of updatelog
-- ----------------------------
INSERT INTO `updatelog` VALUES (1, 1, 'User Restore Updated Data Barang', '2024-08-11 18:35:39', '0', NULL);
INSERT INTO `updatelog` VALUES (2, 1, 'User Updated Data Barang', '2024-08-11 18:37:03', '0', NULL);
INSERT INTO `updatelog` VALUES (3, 1, 'User Restore Updated Data Barang', '2024-08-11 18:37:47', '0', NULL);
INSERT INTO `updatelog` VALUES (4, 1, 'User Updated Data Barang', '2024-08-12 11:04:18', '0', NULL);
INSERT INTO `updatelog` VALUES (5, 1, 'User Restore Updated Data Barang', '2024-08-12 11:04:20', '0', NULL);
INSERT INTO `updatelog` VALUES (6, 1, 'User Updated Data Barang', '2024-08-12 12:05:35', '0', NULL);
INSERT INTO `updatelog` VALUES (7, 1, 'User Restore Updated Data Barang', '2024-08-12 12:05:37', '0', NULL);
INSERT INTO `updatelog` VALUES (8, 1, 'User Updated Data Barang', '2024-08-12 13:00:50', '0', 17);
INSERT INTO `updatelog` VALUES (9, 1, 'User Restore Updated Data Barang', '2024-08-12 13:01:28', '0', NULL);
INSERT INTO `updatelog` VALUES (10, 1, 'User Updated Data Barang', '2024-08-12 13:15:29', '0', NULL);
INSERT INTO `updatelog` VALUES (11, 1, 'User Restore Updated Data Barang', '2024-08-12 13:15:30', '0', NULL);

-- ----------------------------
-- Table structure for user
-- ----------------------------
DROP TABLE IF EXISTS `user`;
CREATE TABLE `user`  (
  `id_user` int NOT NULL AUTO_INCREMENT,
  `level` enum('1','2','3') CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NULL DEFAULT NULL,
  `username` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NULL DEFAULT NULL,
  `password` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NULL DEFAULT NULL,
  `no_telp` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NULL DEFAULT NULL,
  `email` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NULL DEFAULT NULL,
  `foto` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NULL DEFAULT NULL,
  `status` enum('unverified','verified') CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NULL DEFAULT NULL,
  `delete` enum('0','1') CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NULL DEFAULT NULL,
  `update_by` int NULL DEFAULT NULL,
  `update_at` datetime NULL DEFAULT NULL,
  `create_at` datetime NULL DEFAULT NULL,
  PRIMARY KEY (`id_user`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 33 CHARACTER SET = utf8mb4 COLLATE = utf8mb4_general_ci ROW_FORMAT = DYNAMIC;

-- ----------------------------
-- Records of user
-- ----------------------------
INSERT INTO `user` VALUES (1, '1', 'admin', 'c4ca4238a0b923820dcc509a6f75849b', '088', 'vanyogachua@gmail.com', 'admin.jpg', 'verified', '0', 1, '2024-08-04 18:57:47', NULL);
INSERT INTO `user` VALUES (18, '3', 'Pelanggan', 'c4ca4238a0b923820dcc509a6f75849b', NULL, 'vanyogachua@gmail.com', 'flowmap.webp', 'verified', '0', 1, '2024-08-04 18:53:42', NULL);
INSERT INTO `user` VALUES (22, '1', 'manager', 'dc5cd6abc14b49191a31d73f576e846a', NULL, 'leonardo@gmail.com', 'cipta puri-02.png', 'verified', '0', NULL, NULL, NULL);
INSERT INTO `user` VALUES (23, '3', 'guru', 'dc5cd6abc14b49191a31d73f576e846a', NULL, 'leonardojaylenson28@gmail.com', 'admin.jpg', 'verified', '0', NULL, NULL, NULL);

-- ----------------------------
-- Triggers structure for table barang
-- ----------------------------
DROP TRIGGER IF EXISTS `updatestatus`;
delimiter ;;
CREATE TRIGGER `updatestatus` BEFORE UPDATE ON `barang` FOR EACH ROW BEGIN
    IF NEW.stok = 0 THEN
        SET NEW.status = 'tidak tersedia';
    ELSE
        SET NEW.status = 'tersedia';
    END IF;
END
;;
delimiter ;

-- ----------------------------
-- Triggers structure for table barang_backup
-- ----------------------------
DROP TRIGGER IF EXISTS `updatestatus_copy1`;
delimiter ;;
CREATE TRIGGER `updatestatus_copy1` BEFORE UPDATE ON `barang_backup` FOR EACH ROW BEGIN
    IF NEW.stok = 0 THEN
        SET NEW.status = 'tidak tersedia';
    ELSE
        SET NEW.status = 'tersedia';
    END IF;
END
;;
delimiter ;

-- ----------------------------
-- Triggers structure for table barangkeluar
-- ----------------------------
DROP TRIGGER IF EXISTS `update_stock_after_barangkeluar`;
delimiter ;;
CREATE TRIGGER `update_stock_after_barangkeluar` AFTER INSERT ON `barangkeluar` FOR EACH ROW BEGIN
    -- Decrease the stock in barang table based on the quantity in barangkeluar
    UPDATE barang
    SET stok = stok - NEW.jumlah
    WHERE id_barang = NEW.id_barang;
END
;;
delimiter ;

-- ----------------------------
-- Triggers structure for table barangkeluar
-- ----------------------------
DROP TRIGGER IF EXISTS `update_stock_after_barangkeluar_update`;
delimiter ;;
CREATE TRIGGER `update_stock_after_barangkeluar_update` AFTER UPDATE ON `barangkeluar` FOR EACH ROW BEGIN
    -- Restore the previous stock quantity (if needed)
    UPDATE barang
    SET stok = stok + OLD.jumlah
    WHERE id_barang = OLD.id_barang;

    -- Decrease the stock in barang table based on the new quantity
    UPDATE barang
    SET stok = stok - NEW.jumlah
    WHERE id_barang = NEW.id_barang;
END
;;
delimiter ;

-- ----------------------------
-- Triggers structure for table barangkeluar
-- ----------------------------
DROP TRIGGER IF EXISTS `update_stock_after_barangkeluar_delete`;
delimiter ;;
CREATE TRIGGER `update_stock_after_barangkeluar_delete` AFTER DELETE ON `barangkeluar` FOR EACH ROW BEGIN
    -- Increase the stock in barang table based on the quantity of the deleted record
    UPDATE barang
    SET stok = stok + OLD.jumlah
    WHERE id_barang = OLD.id_barang;
END
;;
delimiter ;

-- ----------------------------
-- Triggers structure for table barangkeluar_backup
-- ----------------------------
DROP TRIGGER IF EXISTS `update_stock_after_barangkeluar_copy1`;
delimiter ;;
CREATE TRIGGER `update_stock_after_barangkeluar_copy1` AFTER INSERT ON `barangkeluar_backup` FOR EACH ROW BEGIN
    -- Decrease the stock in barang table based on the quantity in barangkeluar
    UPDATE barang
    SET stok = stok - NEW.jumlah
    WHERE id_barang = NEW.id_barang;
END
;;
delimiter ;

-- ----------------------------
-- Triggers structure for table barangkeluar_backup
-- ----------------------------
DROP TRIGGER IF EXISTS `update_stock_after_barangkeluar_update_copy1`;
delimiter ;;
CREATE TRIGGER `update_stock_after_barangkeluar_update_copy1` AFTER UPDATE ON `barangkeluar_backup` FOR EACH ROW BEGIN
    -- Restore the previous stock quantity (if needed)
    UPDATE barang
    SET stok = stok + OLD.jumlah
    WHERE id_barang = OLD.id_barang;

    -- Decrease the stock in barang table based on the new quantity
    UPDATE barang
    SET stok = stok - NEW.jumlah
    WHERE id_barang = NEW.id_barang;
END
;;
delimiter ;

-- ----------------------------
-- Triggers structure for table barangkeluar_backup
-- ----------------------------
DROP TRIGGER IF EXISTS `update_stock_after_barangkeluar_delete_copy1`;
delimiter ;;
CREATE TRIGGER `update_stock_after_barangkeluar_delete_copy1` AFTER DELETE ON `barangkeluar_backup` FOR EACH ROW BEGIN
    -- Increase the stock in barang table based on the quantity of the deleted record
    UPDATE barang
    SET stok = stok + OLD.jumlah
    WHERE id_barang = OLD.id_barang;
END
;;
delimiter ;

-- ----------------------------
-- Triggers structure for table barangmasuk
-- ----------------------------
DROP TRIGGER IF EXISTS `updatastok`;
delimiter ;;
CREATE TRIGGER `updatastok` AFTER INSERT ON `barangmasuk` FOR EACH ROW BEGIN
    -- Update the stock in the barang table
    UPDATE barang
    SET stok = stok + NEW.quantity
    WHERE id_barang = NEW.id_barang;
END
;;
delimiter ;

-- ----------------------------
-- Triggers structure for table barangmasuk
-- ----------------------------
DROP TRIGGER IF EXISTS `updatedelete`;
delimiter ;;
CREATE TRIGGER `updatedelete` AFTER DELETE ON `barangmasuk` FOR EACH ROW BEGIN
    -- Update the stock in the barang table
    UPDATE barang
    SET stok = stok - OLD.quantity
    WHERE id_barang = OLD.id_barang;
END
;;
delimiter ;

-- ----------------------------
-- Triggers structure for table barangmasuk_backup
-- ----------------------------
DROP TRIGGER IF EXISTS `updatastok_copy1`;
delimiter ;;
CREATE TRIGGER `updatastok_copy1` AFTER INSERT ON `barangmasuk_backup` FOR EACH ROW BEGIN
    -- Update the stock in the barang table
    UPDATE barang
    SET stok = stok + NEW.quantity
    WHERE id_barang = NEW.id_barang;
END
;;
delimiter ;

-- ----------------------------
-- Triggers structure for table barangmasuk_backup
-- ----------------------------
DROP TRIGGER IF EXISTS `updatedelete_copy1`;
delimiter ;;
CREATE TRIGGER `updatedelete_copy1` AFTER DELETE ON `barangmasuk_backup` FOR EACH ROW BEGIN
    -- Update the stock in the barang table
    UPDATE barang
    SET stok = stok - OLD.quantity
    WHERE id_barang = OLD.id_barang;
END
;;
delimiter ;

SET FOREIGN_KEY_CHECKS = 1;
