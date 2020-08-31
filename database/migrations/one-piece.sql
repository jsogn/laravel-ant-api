/*
 Navicat MySQL Data Transfer

 Source Server         : localhost
 Source Server Type    : MySQL
 Source Server Version : 50726
 Source Host           : 127.0.0.1:3306
 Source Schema         : one-piece

 Target Server Type    : MySQL
 Target Server Version : 50726
 File Encoding         : 65001

 Date: 31/08/2020 14:49:29
*/

SET NAMES utf8mb4;
SET FOREIGN_KEY_CHECKS = 0;

-- ----------------------------
-- Table structure for admins
-- ----------------------------
DROP TABLE IF EXISTS `admins`;
CREATE TABLE `admins` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `account` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL COMMENT '账号',
  `nickname` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT '' COMMENT '昵称',
  `password` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL COMMENT '密码',
  `avatar` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT '' COMMENT '头像',
  `email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT '' COMMENT '邮箱',
  `status` tinyint(1) unsigned NOT NULL DEFAULT '1' COMMENT '1-正常/2-禁用',
  `role_id` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT '' COMMENT '角色ID',
  `last_token` text COLLATE utf8mb4_unicode_ci,
  `updated_at` datetime DEFAULT NULL ON UPDATE CURRENT_TIMESTAMP,
  `created_at` datetime NOT NULL,
  `deleted_at` datetime DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `account` (`account`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci COMMENT='后台管理员表';

-- ----------------------------
-- Records of admins
-- ----------------------------
BEGIN;
INSERT INTO `admins` VALUES (1, 'admin', '野性的猫咪', '$2y$10$wjjhuT/.EKdk08WQh4XLWerKv.UHB4iL8LoRWf.6d00TcLFyJkIAC', 'https://s1.ax1x.com/2020/07/29/aezKyD.jpg', '123@163.com', 1, '', 'eyJ0eXAiOiJKV1QiLCJhbGciOiJIUzI1NiJ9.eyJpc3MiOiJodHRwOlwvXC9sb2NhbGhvc3Q6ODAwMFwvYWRtaW5cL2F1dGhvcml6YXRpb24iLCJpYXQiOjE1OTg3MTAwMTksImV4cCI6MTU5ODc1MzIxOSwibmJmIjoxNTk4NzEwMDE5LCJqdGkiOiI3ckFqNHJJZklqTThWZjdsIiwic3ViIjoxLCJwcnYiOiJmNDc1YWUwYTgzYTY5NDA5MmFlZDVlMjA5N2FjMzg5NGJjMjZlNmJmIn0.eLVADvEQNmJH2qqNxLVdvVJmFoPKVfDVLbcXGBOSwgk', '2020-08-29 14:06:59', '2020-07-30 10:48:44', NULL);
INSERT INTO `admins` VALUES (4, 'test', 'test', '$2y$10$iwV0fFoMBWwop/0WKv7Vzest4wCT3D6W83MXCYa0h.ZLLe0vrlBhq', 'https://s1.ax1x.com/2020/07/29/aezKyD.jpg', '123@163.com', 1, 'admin', 'eyJ0eXAiOiJKV1QiLCJhbGciOiJIUzI1NiJ9.eyJpc3MiOiJodHRwOlwvXC9sb2NhbGhvc3Q6ODAwMFwvYWRtaW5cL2F1dGhvcml6YXRpb24iLCJpYXQiOjE1OTgxNzk4ODMsImV4cCI6MTU5ODIyMzA4MywibmJmIjoxNTk4MTc5ODgzLCJqdGkiOiIyRWNBc2lldktENXlEaGc0Iiwic3ViIjo0LCJwcnYiOiJmNDc1YWUwYTgzYTY5NDA5MmFlZDVlMjA5N2FjMzg5NGJjMjZlNmJmIn0.aEfD63JVwPi5kMYpg_9QSgK8tVpW0szaogwvdlQSvUA', '2020-08-23 10:51:23', '2020-08-14 15:17:12', NULL);
COMMIT;

-- ----------------------------
-- Table structure for google_security
-- ----------------------------
DROP TABLE IF EXISTS `google_security`;
CREATE TABLE `google_security` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `admin_id` int(10) unsigned NOT NULL COMMENT '管理员ID',
  `is_enable` tinyint(1) unsigned NOT NULL COMMENT '是否开启',
  `google_secret` varchar(255) NOT NULL DEFAULT '' COMMENT '谷歌密钥',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- ----------------------------
-- Table structure for handle_logs
-- ----------------------------
DROP TABLE IF EXISTS `handle_logs`;
CREATE TABLE `handle_logs` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `guard_name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL COMMENT '守卫标识',
  `account` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL COMMENT '用户标识',
  `action` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL COMMENT '操作',
  `method` char(10) COLLATE utf8mb4_unicode_ci NOT NULL COMMENT '访问方法',
  `url` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL COMMENT '访问地址',
  `ip` char(15) COLLATE utf8mb4_unicode_ci NOT NULL COMMENT '访问ip',
  `params` json DEFAULT NULL COMMENT '访问参数',
  `agent` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL COMMENT '访问UserAgnet',
  `response` json DEFAULT NULL COMMENT '响应数据',
  `status` int(5) unsigned NOT NULL COMMENT '响应状态',
  `updated_at` datetime NOT NULL ON UPDATE CURRENT_TIMESTAMP,
  `created_at` datetime NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=166 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- ----------------------------
-- Records of handle_logs
-- ----------------------------
BEGIN;
INSERT INTO `handle_logs` VALUES (127, 'admin', 'admin', '系统登录', 'POST', '/admin/authorization', '127.0.0.1', NULL, 'PostmanRuntime/7.26.3', NULL, 200, '2020-08-29 06:51:01', '2020-08-29 06:51:01');
INSERT INTO `handle_logs` VALUES (128, 'admin', 'admin', '系统登录', 'POST', '/admin/authorization', '127.0.0.1', NULL, 'PostmanRuntime/7.26.3', NULL, 200, '2020-08-29 07:07:41', '2020-08-29 07:07:41');
INSERT INTO `handle_logs` VALUES (129, 'admin', 'admin', '系统登录', 'POST', '/admin/authorization', '127.0.0.1', NULL, 'Mozilla/5.0 (Macintosh; Intel Mac OS X 10_15_6) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/84.0.4147.135 Safari/537.36', NULL, 200, '2020-08-29 10:49:03', '2020-08-29 10:49:03');
INSERT INTO `handle_logs` VALUES (130, 'admin', 'admin', '添加权限', 'POST', '/admin/permission', '127.0.0.1', '{\"pid\": \"22\", \"name\": \"HandleLog\", \"path\": \"/my/handle/log\", \"type\": \"menu\", \"title\": \"操作日志\", \"hidden\": 0, \"status\": 1, \"weight\": 0, \"component\": \"HandleLog\", \"keepAlive\": 0, \"permission\": [\"HandleLog\"], \"action_type\": 0, \"hideChildrenInMenu\": 0}', 'Mozilla/5.0 (Macintosh; Intel Mac OS X 10_15_6) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/84.0.4147.135 Safari/537.36', '{\"code\": 200, \"data\": {\"id\": 32, \"pid\": \"22\", \"name\": \"HandleLog\", \"path\": \"/my/handle/log\", \"type\": \"menu\", \"title\": \"操作日志\", \"hidden\": 0, \"status\": 1, \"weight\": 0, \"component\": \"HandleLog\", \"keepAlive\": 0, \"created_at\": \"2020-08-29T11:20:57.000000Z\", \"guard_name\": \"admin\", \"permission\": \"HandleLog\", \"updated_at\": \"2020-08-29T11:20:57.000000Z\", \"action_type\": 0, \"hideChildrenInMenu\": 0}, \"status\": \"success\", \"message\": \"操作成功\"}', 200, '2020-08-29 11:20:57', '2020-08-29 11:20:57');
INSERT INTO `handle_logs` VALUES (153, 'admin', 'admin', '更新角色', 'PUT', 'admin/role/1', '127.0.0.1', NULL, 'Mozilla/5.0 (Macintosh; Intel Mac OS X 10_15_6) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/84.0.4147.135 Safari/537.36', '{\"code\": 200, \"data\": {\"id\": 1, \"name\": \"admin\", \"title\": \"系统管理员\", \"status\": 1, \"created_at\": \"2020-08-06 13:12:28\", \"guard_name\": \"admin\", \"updated_at\": \"2020-08-13 13:35:53\", \"permissions\": [{\"id\": 8, \"pid\": 7, \"icon\": \"\", \"name\": \"addPermission\", \"path\": \"\", \"type\": \"action\", \"pivot\": {\"role_id\": 1, \"permission_id\": 8}, \"title\": \"新增\", \"hidden\": 0, \"status\": 1, \"weight\": 0, \"redirect\": \"\", \"component\": \"\", \"keepAlive\": 0, \"created_at\": \"2020-08-05T21:06:47.000000Z\", \"deleted_at\": null, \"guard_name\": \"admin\", \"permission\": \"\", \"updated_at\": \"2020-08-05T21:06:47.000000Z\", \"action_type\": 1, \"button_type\": \"add\", \"hideChildrenInMenu\": 0}, {\"id\": 9, \"pid\": 7, \"icon\": \"\", \"name\": \"editPermission\", \"path\": \"\", \"type\": \"action\", \"pivot\": {\"role_id\": 1, \"permission_id\": 9}, \"title\": \"修改\", \"hidden\": 0, \"status\": 1, \"weight\": 0, \"redirect\": \"\", \"component\": \"\", \"keepAlive\": 0, \"created_at\": \"2020-08-05T21:06:46.000000Z\", \"deleted_at\": null, \"guard_name\": \"admin\", \"permission\": \"\", \"updated_at\": \"2020-08-05T21:06:46.000000Z\", \"action_type\": 1, \"button_type\": \"edit\", \"hideChildrenInMenu\": 0}, {\"id\": 10, \"pid\": 7, \"icon\": \"\", \"name\": \"deletePermission\", \"path\": \"\", \"type\": \"action\", \"pivot\": {\"role_id\": 1, \"permission_id\": 10}, \"title\": \"删除\", \"hidden\": 0, \"status\": 1, \"weight\": 0, \"redirect\": \"\", \"component\": \"\", \"keepAlive\": 0, \"created_at\": \"2020-08-05T21:06:46.000000Z\", \"deleted_at\": null, \"guard_name\": \"admin\", \"permission\": \"\", \"updated_at\": \"2020-08-05T21:06:46.000000Z\", \"action_type\": 1, \"button_type\": \"delete\", \"hideChildrenInMenu\": 0}, {\"id\": 11, \"pid\": 7, \"icon\": \"\", \"name\": \"queryPermission\", \"path\": \"\", \"type\": \"action\", \"pivot\": {\"role_id\": 1, \"permission_id\": 11}, \"title\": \"查询\", \"hidden\": 0, \"status\": 1, \"weight\": 0, \"redirect\": \"\", \"component\": \"\", \"keepAlive\": 0, \"created_at\": \"2020-08-05T21:06:45.000000Z\", \"deleted_at\": null, \"guard_name\": \"admin\", \"permission\": \"\", \"updated_at\": \"2020-08-05T21:06:45.000000Z\", \"action_type\": 1, \"button_type\": \"query\", \"hideChildrenInMenu\": 0}, {\"id\": 13, \"pid\": 12, \"icon\": \"\", \"name\": \"addRole\", \"path\": \"\", \"type\": \"action\", \"pivot\": {\"role_id\": 1, \"permission_id\": 13}, \"title\": \"新增\", \"hidden\": 0, \"status\": 1, \"weight\": 0, \"redirect\": \"\", \"component\": \"\", \"keepAlive\": 0, \"created_at\": \"2020-08-14T06:13:32.000000Z\", \"deleted_at\": null, \"guard_name\": \"admin\", \"permission\": \"\", \"updated_at\": \"2020-08-14T06:13:32.000000Z\", \"action_type\": 1, \"button_type\": \"add\", \"hideChildrenInMenu\": 0}, {\"id\": 14, \"pid\": 12, \"icon\": \"\", \"name\": \"deleteRole\", \"path\": \"\", \"type\": \"action\", \"pivot\": {\"role_id\": 1, \"permission_id\": 14}, \"title\": \"删除\", \"hidden\": 0, \"status\": 1, \"weight\": 0, \"redirect\": \"\", \"component\": \"\", \"keepAlive\": 0, \"created_at\": \"2020-08-14T06:13:42.000000Z\", \"deleted_at\": null, \"guard_name\": \"admin\", \"permission\": \"\", \"updated_at\": \"2020-08-14T06:13:42.000000Z\", \"action_type\": 1, \"button_type\": \"delete\", \"hideChildrenInMenu\": 0}, {\"id\": 15, \"pid\": 12, \"icon\": \"\", \"name\": \"editRole\", \"path\": \"\", \"type\": \"action\", \"pivot\": {\"role_id\": 1, \"permission_id\": 15}, \"title\": \"修改\", \"hidden\": 0, \"status\": 1, \"weight\": 0, \"redirect\": \"\", \"component\": \"\", \"keepAlive\": 0, \"created_at\": \"2020-08-14T06:13:52.000000Z\", \"deleted_at\": null, \"guard_name\": \"admin\", \"permission\": \"\", \"updated_at\": \"2020-08-14T06:13:52.000000Z\", \"action_type\": 1, \"button_type\": \"edit\", \"hideChildrenInMenu\": 0}, {\"id\": 16, \"pid\": 12, \"icon\": \"\", \"name\": \"queryRole\", \"path\": \"\", \"type\": \"action\", \"pivot\": {\"role_id\": 1, \"permission_id\": 16}, \"title\": \"查询\", \"hidden\": 0, \"status\": 1, \"weight\": 0, \"redirect\": \"\", \"component\": \"\", \"keepAlive\": 0, \"created_at\": \"2020-08-14T06:14:04.000000Z\", \"deleted_at\": null, \"guard_name\": \"admin\", \"permission\": \"\", \"updated_at\": \"2020-08-14T06:14:04.000000Z\", \"action_type\": 1, \"button_type\": \"query\", \"hideChildrenInMenu\": 0}, {\"id\": 18, \"pid\": 17, \"icon\": \"\", \"name\": \"addAdmin\", \"path\": \"\", \"type\": \"action\", \"pivot\": {\"role_id\": 1, \"permission_id\": 18}, \"title\": \"新增\", \"hidden\": 0, \"status\": 1, \"weight\": 0, \"redirect\": \"\", \"component\": \"\", \"keepAlive\": 0, \"created_at\": \"2020-08-19T19:15:27.000000Z\", \"deleted_at\": null, \"guard_name\": \"admin\", \"permission\": \"\", \"updated_at\": \"2020-08-19T19:15:27.000000Z\", \"action_type\": 1, \"button_type\": \"add\", \"hideChildrenInMenu\": 0}, {\"id\": 19, \"pid\": 17, \"icon\": \"\", \"name\": \"deleteAdmin\", \"path\": \"\", \"type\": \"action\", \"pivot\": {\"role_id\": 1, \"permission_id\": 19}, \"title\": \"删除\", \"hidden\": 0, \"status\": 1, \"weight\": 0, \"redirect\": \"\", \"component\": \"\", \"keepAlive\": 0, \"created_at\": \"2020-08-19T19:15:27.000000Z\", \"deleted_at\": null, \"guard_name\": \"admin\", \"permission\": \"\", \"updated_at\": \"2020-08-19T19:15:27.000000Z\", \"action_type\": 1, \"button_type\": \"delete\", \"hideChildrenInMenu\": 0}, {\"id\": 20, \"pid\": 17, \"icon\": \"\", \"name\": \"editAdmin\", \"path\": \"\", \"type\": \"action\", \"pivot\": {\"role_id\": 1, \"permission_id\": 20}, \"title\": \"修改\", \"hidden\": 0, \"status\": 1, \"weight\": 0, \"redirect\": \"\", \"component\": \"\", \"keepAlive\": 0, \"created_at\": \"2020-08-19T19:15:28.000000Z\", \"deleted_at\": null, \"guard_name\": \"admin\", \"permission\": \"\", \"updated_at\": \"2020-08-19T19:15:28.000000Z\", \"action_type\": 1, \"button_type\": \"edit\", \"hideChildrenInMenu\": 0}, {\"id\": 21, \"pid\": 17, \"icon\": \"\", \"name\": \"queryAdmin\", \"path\": \"\", \"type\": \"action\", \"pivot\": {\"role_id\": 1, \"permission_id\": 21}, \"title\": \"查询\", \"hidden\": 0, \"status\": 1, \"weight\": 0, \"redirect\": \"\", \"component\": \"\", \"keepAlive\": 0, \"created_at\": \"2020-08-19T19:15:29.000000Z\", \"deleted_at\": null, \"guard_name\": \"admin\", \"permission\": \"\", \"updated_at\": \"2020-08-19T19:15:29.000000Z\", \"action_type\": 1, \"button_type\": \"query\", \"hideChildrenInMenu\": 0}]}, \"status\": \"success\", \"message\": \"操作成功\"}', 200, '2020-08-29 13:30:14', '2020-08-29 13:30:14');
INSERT INTO `handle_logs` VALUES (154, 'admin', 'admin', '更新角色', 'PUT', 'admin/role/1', '127.0.0.1', '{\"name\": \"admin\", \"rules\": [8, 9, 10, 11, 13, 14, 15, 16, 18, 19, 20, 21], \"title\": \"系统管理员\", \"status\": 1}', 'Mozilla/5.0 (Macintosh; Intel Mac OS X 10_15_6) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/84.0.4147.135 Safari/537.36', '{\"code\": 200, \"data\": {\"id\": 1, \"name\": \"admin\", \"title\": \"系统管理员\", \"status\": 1, \"created_at\": \"2020-08-06 13:12:28\", \"guard_name\": \"admin\", \"updated_at\": \"2020-08-13 13:35:53\", \"permissions\": [{\"id\": 8, \"pid\": 7, \"icon\": \"\", \"name\": \"addPermission\", \"path\": \"\", \"type\": \"action\", \"pivot\": {\"role_id\": 1, \"permission_id\": 8}, \"title\": \"新增\", \"hidden\": 0, \"status\": 1, \"weight\": 0, \"redirect\": \"\", \"component\": \"\", \"keepAlive\": 0, \"created_at\": \"2020-08-05T21:06:47.000000Z\", \"deleted_at\": null, \"guard_name\": \"admin\", \"permission\": \"\", \"updated_at\": \"2020-08-05T21:06:47.000000Z\", \"action_type\": 1, \"button_type\": \"add\", \"hideChildrenInMenu\": 0}, {\"id\": 9, \"pid\": 7, \"icon\": \"\", \"name\": \"editPermission\", \"path\": \"\", \"type\": \"action\", \"pivot\": {\"role_id\": 1, \"permission_id\": 9}, \"title\": \"修改\", \"hidden\": 0, \"status\": 1, \"weight\": 0, \"redirect\": \"\", \"component\": \"\", \"keepAlive\": 0, \"created_at\": \"2020-08-05T21:06:46.000000Z\", \"deleted_at\": null, \"guard_name\": \"admin\", \"permission\": \"\", \"updated_at\": \"2020-08-05T21:06:46.000000Z\", \"action_type\": 1, \"button_type\": \"edit\", \"hideChildrenInMenu\": 0}, {\"id\": 10, \"pid\": 7, \"icon\": \"\", \"name\": \"deletePermission\", \"path\": \"\", \"type\": \"action\", \"pivot\": {\"role_id\": 1, \"permission_id\": 10}, \"title\": \"删除\", \"hidden\": 0, \"status\": 1, \"weight\": 0, \"redirect\": \"\", \"component\": \"\", \"keepAlive\": 0, \"created_at\": \"2020-08-05T21:06:46.000000Z\", \"deleted_at\": null, \"guard_name\": \"admin\", \"permission\": \"\", \"updated_at\": \"2020-08-05T21:06:46.000000Z\", \"action_type\": 1, \"button_type\": \"delete\", \"hideChildrenInMenu\": 0}, {\"id\": 11, \"pid\": 7, \"icon\": \"\", \"name\": \"queryPermission\", \"path\": \"\", \"type\": \"action\", \"pivot\": {\"role_id\": 1, \"permission_id\": 11}, \"title\": \"查询\", \"hidden\": 0, \"status\": 1, \"weight\": 0, \"redirect\": \"\", \"component\": \"\", \"keepAlive\": 0, \"created_at\": \"2020-08-05T21:06:45.000000Z\", \"deleted_at\": null, \"guard_name\": \"admin\", \"permission\": \"\", \"updated_at\": \"2020-08-05T21:06:45.000000Z\", \"action_type\": 1, \"button_type\": \"query\", \"hideChildrenInMenu\": 0}, {\"id\": 13, \"pid\": 12, \"icon\": \"\", \"name\": \"addRole\", \"path\": \"\", \"type\": \"action\", \"pivot\": {\"role_id\": 1, \"permission_id\": 13}, \"title\": \"新增\", \"hidden\": 0, \"status\": 1, \"weight\": 0, \"redirect\": \"\", \"component\": \"\", \"keepAlive\": 0, \"created_at\": \"2020-08-14T06:13:32.000000Z\", \"deleted_at\": null, \"guard_name\": \"admin\", \"permission\": \"\", \"updated_at\": \"2020-08-14T06:13:32.000000Z\", \"action_type\": 1, \"button_type\": \"add\", \"hideChildrenInMenu\": 0}, {\"id\": 14, \"pid\": 12, \"icon\": \"\", \"name\": \"deleteRole\", \"path\": \"\", \"type\": \"action\", \"pivot\": {\"role_id\": 1, \"permission_id\": 14}, \"title\": \"删除\", \"hidden\": 0, \"status\": 1, \"weight\": 0, \"redirect\": \"\", \"component\": \"\", \"keepAlive\": 0, \"created_at\": \"2020-08-14T06:13:42.000000Z\", \"deleted_at\": null, \"guard_name\": \"admin\", \"permission\": \"\", \"updated_at\": \"2020-08-14T06:13:42.000000Z\", \"action_type\": 1, \"button_type\": \"delete\", \"hideChildrenInMenu\": 0}, {\"id\": 15, \"pid\": 12, \"icon\": \"\", \"name\": \"editRole\", \"path\": \"\", \"type\": \"action\", \"pivot\": {\"role_id\": 1, \"permission_id\": 15}, \"title\": \"修改\", \"hidden\": 0, \"status\": 1, \"weight\": 0, \"redirect\": \"\", \"component\": \"\", \"keepAlive\": 0, \"created_at\": \"2020-08-14T06:13:52.000000Z\", \"deleted_at\": null, \"guard_name\": \"admin\", \"permission\": \"\", \"updated_at\": \"2020-08-14T06:13:52.000000Z\", \"action_type\": 1, \"button_type\": \"edit\", \"hideChildrenInMenu\": 0}, {\"id\": 16, \"pid\": 12, \"icon\": \"\", \"name\": \"queryRole\", \"path\": \"\", \"type\": \"action\", \"pivot\": {\"role_id\": 1, \"permission_id\": 16}, \"title\": \"查询\", \"hidden\": 0, \"status\": 1, \"weight\": 0, \"redirect\": \"\", \"component\": \"\", \"keepAlive\": 0, \"created_at\": \"2020-08-14T06:14:04.000000Z\", \"deleted_at\": null, \"guard_name\": \"admin\", \"permission\": \"\", \"updated_at\": \"2020-08-14T06:14:04.000000Z\", \"action_type\": 1, \"button_type\": \"query\", \"hideChildrenInMenu\": 0}, {\"id\": 18, \"pid\": 17, \"icon\": \"\", \"name\": \"addAdmin\", \"path\": \"\", \"type\": \"action\", \"pivot\": {\"role_id\": 1, \"permission_id\": 18}, \"title\": \"新增\", \"hidden\": 0, \"status\": 1, \"weight\": 0, \"redirect\": \"\", \"component\": \"\", \"keepAlive\": 0, \"created_at\": \"2020-08-19T19:15:27.000000Z\", \"deleted_at\": null, \"guard_name\": \"admin\", \"permission\": \"\", \"updated_at\": \"2020-08-19T19:15:27.000000Z\", \"action_type\": 1, \"button_type\": \"add\", \"hideChildrenInMenu\": 0}, {\"id\": 19, \"pid\": 17, \"icon\": \"\", \"name\": \"deleteAdmin\", \"path\": \"\", \"type\": \"action\", \"pivot\": {\"role_id\": 1, \"permission_id\": 19}, \"title\": \"删除\", \"hidden\": 0, \"status\": 1, \"weight\": 0, \"redirect\": \"\", \"component\": \"\", \"keepAlive\": 0, \"created_at\": \"2020-08-19T19:15:27.000000Z\", \"deleted_at\": null, \"guard_name\": \"admin\", \"permission\": \"\", \"updated_at\": \"2020-08-19T19:15:27.000000Z\", \"action_type\": 1, \"button_type\": \"delete\", \"hideChildrenInMenu\": 0}, {\"id\": 20, \"pid\": 17, \"icon\": \"\", \"name\": \"editAdmin\", \"path\": \"\", \"type\": \"action\", \"pivot\": {\"role_id\": 1, \"permission_id\": 20}, \"title\": \"修改\", \"hidden\": 0, \"status\": 1, \"weight\": 0, \"redirect\": \"\", \"component\": \"\", \"keepAlive\": 0, \"created_at\": \"2020-08-19T19:15:28.000000Z\", \"deleted_at\": null, \"guard_name\": \"admin\", \"permission\": \"\", \"updated_at\": \"2020-08-19T19:15:28.000000Z\", \"action_type\": 1, \"button_type\": \"edit\", \"hideChildrenInMenu\": 0}, {\"id\": 21, \"pid\": 17, \"icon\": \"\", \"name\": \"queryAdmin\", \"path\": \"\", \"type\": \"action\", \"pivot\": {\"role_id\": 1, \"permission_id\": 21}, \"title\": \"查询\", \"hidden\": 0, \"status\": 1, \"weight\": 0, \"redirect\": \"\", \"component\": \"\", \"keepAlive\": 0, \"created_at\": \"2020-08-19T19:15:29.000000Z\", \"deleted_at\": null, \"guard_name\": \"admin\", \"permission\": \"\", \"updated_at\": \"2020-08-19T19:15:29.000000Z\", \"action_type\": 1, \"button_type\": \"query\", \"hideChildrenInMenu\": 0}]}, \"status\": \"success\", \"message\": \"操作成功\"}', 200, '2020-08-29 13:33:34', '2020-08-29 13:33:34');
INSERT INTO `handle_logs` VALUES (156, 'admin', 'admin', '系统登录', 'POST', 'admin/authorization', '127.0.0.1', NULL, 'PostmanRuntime/7.26.3', NULL, 200, '2020-08-29 14:06:22', '2020-08-29 14:06:22');
INSERT INTO `handle_logs` VALUES (157, 'admin', 'admin', '系统登录', 'POST', 'admin/authorization', '127.0.0.1', NULL, 'PostmanRuntime/7.26.3', NULL, 200, '2020-08-29 14:06:38', '2020-08-29 14:06:38');
INSERT INTO `handle_logs` VALUES (158, 'admin', 'admin', '系统登录', 'POST', 'admin/authorization', '127.0.0.1', NULL, 'PostmanRuntime/7.26.3', NULL, 200, '2020-08-29 14:06:39', '2020-08-29 14:06:39');
INSERT INTO `handle_logs` VALUES (159, 'admin', 'admin', '系统登录', 'POST', 'admin/authorization', '127.0.0.1', NULL, 'PostmanRuntime/7.26.3', NULL, 200, '2020-08-29 14:06:40', '2020-08-29 14:06:40');
INSERT INTO `handle_logs` VALUES (160, 'admin', 'admin', '系统登录', 'POST', 'admin/authorization', '127.0.0.1', NULL, 'PostmanRuntime/7.26.3', NULL, 200, '2020-08-29 14:06:41', '2020-08-29 14:06:41');
INSERT INTO `handle_logs` VALUES (161, 'admin', 'admin', '系统登录', 'POST', 'admin/authorization', '127.0.0.1', NULL, 'PostmanRuntime/7.26.3', NULL, 200, '2020-08-29 14:06:41', '2020-08-29 14:06:41');
INSERT INTO `handle_logs` VALUES (162, 'admin', 'admin', '系统登录', 'POST', 'admin/authorization', '127.0.0.1', NULL, 'PostmanRuntime/7.26.3', NULL, 200, '2020-08-29 14:06:42', '2020-08-29 14:06:42');
INSERT INTO `handle_logs` VALUES (163, 'admin', 'admin', '系统登录', 'POST', 'admin/authorization', '127.0.0.1', NULL, 'PostmanRuntime/7.26.3', NULL, 200, '2020-08-29 14:06:43', '2020-08-29 14:06:43');
INSERT INTO `handle_logs` VALUES (164, 'admin', 'admin', '系统登录', 'POST', 'admin/authorization', '127.0.0.1', NULL, 'PostmanRuntime/7.26.3', NULL, 200, '2020-08-29 14:06:44', '2020-08-29 14:06:44');
INSERT INTO `handle_logs` VALUES (165, 'admin', 'admin', '系统登录', 'POST', 'admin/authorization', '127.0.0.1', NULL, 'Mozilla/5.0 (Macintosh; Intel Mac OS X 10_15_6) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/84.0.4147.135 Safari/537.36', NULL, 200, '2020-08-29 14:06:59', '2020-08-29 14:06:59');
COMMIT;

-- ----------------------------
-- Table structure for migrations
-- ----------------------------
DROP TABLE IF EXISTS `migrations`;
CREATE TABLE `migrations` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `migration` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `batch` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- ----------------------------
-- Records of migrations
-- ----------------------------
BEGIN;
INSERT INTO `migrations` VALUES (1, '2020_07_31_080223_create_permission_tables', 1);
INSERT INTO `migrations` VALUES (2, '2020_08_28_061140_create_notifications_table', 2);
COMMIT;

-- ----------------------------
-- Table structure for model_has_permissions
-- ----------------------------
DROP TABLE IF EXISTS `model_has_permissions`;
CREATE TABLE `model_has_permissions` (
  `permission_id` bigint(20) unsigned NOT NULL,
  `model_type` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `model_id` bigint(20) unsigned NOT NULL,
  PRIMARY KEY (`permission_id`,`model_id`,`model_type`),
  KEY `model_has_permissions_model_id_model_type_index` (`model_id`,`model_type`),
  CONSTRAINT `model_has_permissions_permission_id_foreign` FOREIGN KEY (`permission_id`) REFERENCES `permissionss` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- ----------------------------
-- Table structure for model_has_roles
-- ----------------------------
DROP TABLE IF EXISTS `model_has_roles`;
CREATE TABLE `model_has_roles` (
  `role_id` bigint(20) unsigned NOT NULL,
  `model_type` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `model_id` bigint(20) unsigned NOT NULL,
  PRIMARY KEY (`role_id`,`model_id`,`model_type`),
  KEY `model_has_roles_model_id_model_type_index` (`model_id`,`model_type`),
  CONSTRAINT `model_has_roles_role_id_foreign` FOREIGN KEY (`role_id`) REFERENCES `roles` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- ----------------------------
-- Table structure for notifications
-- ----------------------------
DROP TABLE IF EXISTS `notifications`;
CREATE TABLE `notifications` (
  `id` char(36) COLLATE utf8mb4_unicode_ci NOT NULL,
  `type` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `notifiable_type` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `notifiable_id` bigint(20) unsigned NOT NULL,
  `data` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `read_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `notifications_notifiable_type_notifiable_id_index` (`notifiable_type`,`notifiable_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- ----------------------------
-- Table structure for permissions
-- ----------------------------
DROP TABLE IF EXISTS `permissions`;
CREATE TABLE `permissions` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `weight` int(10) unsigned NOT NULL DEFAULT '0' COMMENT '排序',
  `guard_name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT '' COMMENT '权限守卫',
  `name` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL COMMENT '规则名称',
  `title` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL COMMENT '名称',
  `pid` int(11) NOT NULL DEFAULT '0' COMMENT '父级标识',
  `type` varchar(6) COLLATE utf8mb4_unicode_ci NOT NULL COMMENT '类别',
  `status` int(11) NOT NULL DEFAULT '0' COMMENT '状态',
  `path` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT '' COMMENT '路径',
  `redirect` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT '' COMMENT '重定向',
  `component` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT '' COMMENT '组件',
  `icon` varchar(30) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT '' COMMENT '图标',
  `permission` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT '' COMMENT '许可',
  `keepAlive` int(11) NOT NULL DEFAULT '0' COMMENT '持久连接',
  `hidden` int(11) NOT NULL DEFAULT '0' COMMENT '隐藏',
  `hideChildrenInMenu` int(11) NOT NULL DEFAULT '0' COMMENT '隐藏子菜单',
  `action_type` int(11) NOT NULL DEFAULT '0' COMMENT '行为类型',
  `button_type` varchar(50) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT '' COMMENT '按钮类型',
  `created_at` datetime NOT NULL ON UPDATE CURRENT_TIMESTAMP,
  `updated_at` datetime NOT NULL ON UPDATE CURRENT_TIMESTAMP,
  `deleted_at` datetime DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `name` (`name`,`deleted_at`) USING BTREE
) ENGINE=InnoDB AUTO_INCREMENT=33 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- ----------------------------
-- Records of permissions
-- ----------------------------
BEGIN;
INSERT INTO `permissions` VALUES (1, 0, 'admin', 'Index', '首页', 0, 'path', 1, '/', '/dashboard/workplace', 'BasicLayout', '', '', 0, 0, 0, 0, '', '2020-08-05 21:06:52', '2020-08-05 21:06:52', NULL);
INSERT INTO `permissions` VALUES (2, 0, 'admin', 'Dashboard', '仪表盘', 1, 'path', 1, '/dashboard', '/dashboard/workplace', 'RouteView', 'dashboard', 'Analysis,Workspace', 0, 0, 0, 0, '', '2020-08-05 21:06:51', '2020-08-05 21:06:51', NULL);
INSERT INTO `permissions` VALUES (3, 0, 'admin', 'Analysis', '分析台', 2, 'menu', 1, '/dashboard/analysis', '', 'Analysis', '', 'Analysis', 0, 0, 0, 0, '', '2020-08-05 21:06:50', '2020-08-05 21:06:50', NULL);
INSERT INTO `permissions` VALUES (4, 0, 'admin', 'InfoAnalysis', '详情', 3, 'action', 1, '', '', '', '', '', 0, 0, 0, 1, 'Info', '2020-08-05 21:06:50', '2020-08-05 21:06:50', NULL);
INSERT INTO `permissions` VALUES (5, 100, 'admin', 'Workspace', '工作台', 2, 'menu', 1, '/dashboard/workplace', '', 'Workplace', '', 'Workspace', 0, 0, 0, 0, '', '2020-08-05 21:06:49', '2020-08-05 21:06:49', NULL);
INSERT INTO `permissions` VALUES (6, 0, 'admin', 'Permission', '权限管理', 1, 'path', 1, '/permission', '/permission/menu', 'RouteView', 'cluster', 'Menu,Role,Admin', 0, 0, 0, 0, '', '2020-08-19 19:15:25', '2020-08-19 19:15:25', NULL);
INSERT INTO `permissions` VALUES (7, 0, 'admin', 'Menu', '菜单管理', 6, 'menu', 1, '/permission/menu', '', 'Menu', '', 'Menu', 0, 0, 0, 0, '', '2020-08-05 21:06:48', '2020-08-05 21:06:48', NULL);
INSERT INTO `permissions` VALUES (8, 0, 'admin', 'addPermission', '新增', 7, 'action', 1, '', '', '', '', '', 0, 0, 0, 1, 'add', '2020-08-05 21:06:47', '2020-08-05 21:06:47', NULL);
INSERT INTO `permissions` VALUES (9, 0, 'admin', 'editPermission', '修改', 7, 'action', 1, '', '', '', '', '', 0, 0, 0, 1, 'edit', '2020-08-05 21:06:46', '2020-08-05 21:06:46', NULL);
INSERT INTO `permissions` VALUES (10, 0, 'admin', 'deletePermission', '删除', 7, 'action', 1, '', '', '', '', '', 0, 0, 0, 1, 'delete', '2020-08-05 21:06:46', '2020-08-05 21:06:46', NULL);
INSERT INTO `permissions` VALUES (11, 0, 'admin', 'queryPermission', '查询', 7, 'action', 1, '', '', '', '', '', 0, 0, 0, 1, 'query', '2020-08-05 21:06:45', '2020-08-05 21:06:45', NULL);
INSERT INTO `permissions` VALUES (12, 0, 'admin', 'Role', '角色管理', 6, 'menu', 1, '/permission/role', '', 'Role', '', 'Role', 0, 0, 0, 0, '', '2020-08-05 21:06:37', '2020-08-05 13:06:37', NULL);
INSERT INTO `permissions` VALUES (13, 0, 'admin', 'addRole', '新增', 12, 'action', 1, '', '', '', '', '', 0, 0, 0, 1, 'add', '2020-08-14 06:13:32', '2020-08-14 06:13:32', NULL);
INSERT INTO `permissions` VALUES (14, 0, 'admin', 'deleteRole', '删除', 12, 'action', 1, '', '', '', '', '', 0, 0, 0, 1, 'delete', '2020-08-14 06:13:42', '2020-08-14 06:13:42', NULL);
INSERT INTO `permissions` VALUES (15, 0, 'admin', 'editRole', '修改', 12, 'action', 1, '', '', '', '', '', 0, 0, 0, 1, 'edit', '2020-08-14 06:13:52', '2020-08-14 06:13:52', NULL);
INSERT INTO `permissions` VALUES (16, 0, 'admin', 'queryRole', '查询', 12, 'action', 1, '', '', '', '', '', 0, 0, 0, 1, 'query', '2020-08-14 06:14:04', '2020-08-14 06:14:04', NULL);
INSERT INTO `permissions` VALUES (17, 0, 'admin', 'Admin', '人员管理', 6, 'menu', 1, '/permission/admin', '', 'Admin', '', 'Admin', 0, 0, 0, 0, '', '2020-08-14 10:53:31', '2020-08-14 10:53:31', NULL);
INSERT INTO `permissions` VALUES (18, 0, 'admin', 'addAdmin', '新增', 17, 'action', 1, '', '', '', '', '', 0, 0, 0, 1, 'add', '2020-08-19 19:15:27', '2020-08-19 19:15:27', NULL);
INSERT INTO `permissions` VALUES (19, 0, 'admin', 'deleteAdmin', '删除', 17, 'action', 1, '', '', '', '', '', 0, 0, 0, 1, 'delete', '2020-08-19 19:15:27', '2020-08-19 19:15:27', NULL);
INSERT INTO `permissions` VALUES (20, 0, 'admin', 'editAdmin', '修改', 17, 'action', 1, '', '', '', '', '', 0, 0, 0, 1, 'edit', '2020-08-19 19:15:28', '2020-08-19 19:15:28', NULL);
INSERT INTO `permissions` VALUES (21, 0, 'admin', 'queryAdmin', '查询', 17, 'action', 1, '', '', '', '', '', 0, 0, 0, 1, 'query', '2020-08-19 19:15:29', '2020-08-19 19:15:29', NULL);
INSERT INTO `permissions` VALUES (22, 0, 'admin', 'My', '个人管理', 1, 'path', 1, '/my', '/my/settings', 'RouteView', 'user', '', 0, 0, 0, 0, '', '2020-08-19 19:15:29', '2020-08-19 19:15:29', NULL);
INSERT INTO `permissions` VALUES (23, 0, 'admin', 'MySettings', '个人设置', 22, 'menu', 1, '/my/settings', '/my/settings/base', 'MySettings', '', 'MySettings', 0, 0, 1, 0, '', '2020-08-19 19:15:30', '2020-08-19 19:15:30', NULL);
INSERT INTO `permissions` VALUES (24, 0, 'admin', 'BaseSettings', '基本设置', 23, 'menu', 1, '/my/settings/base', '', 'BaseSettings', '', 'BaseSettings', 0, 0, 0, 0, '', '2020-08-19 19:15:31', '2020-08-19 19:15:31', NULL);
INSERT INTO `permissions` VALUES (25, 0, 'admin', 'SecuritySettings', '安全设置', 23, 'menu', 1, '/my/settings/security', '', 'SecuritySettings', '', 'SecuritySettings', 0, 0, 0, 0, '', '2020-08-19 19:15:32', '2020-08-19 19:15:32', NULL);
INSERT INTO `permissions` VALUES (31, 0, 'admin', 'editBaseSettings', '修改', 24, 'action', 1, '', '', '', '', '', 0, 0, 0, 1, 'edit', '2020-08-19 19:49:23', '2020-08-19 11:49:23', '2020-08-19 11:49:23');
INSERT INTO `permissions` VALUES (32, 0, 'admin', 'HandleLog', '操作日志', 22, 'menu', 1, '/my/handle/log', '', 'HandleLog', '', 'HandleLog', 0, 0, 0, 0, '', '2020-08-29 11:20:57', '2020-08-29 11:20:57', NULL);
COMMIT;

-- ----------------------------
-- Table structure for role_has_permissions
-- ----------------------------
DROP TABLE IF EXISTS `role_has_permissions`;
CREATE TABLE `role_has_permissions` (
  `permission_id` bigint(20) unsigned NOT NULL,
  `role_id` bigint(20) unsigned NOT NULL,
  PRIMARY KEY (`permission_id`,`role_id`),
  KEY `role_has_permissions_role_id_foreign` (`role_id`),
  CONSTRAINT `role_has_permissions_permission_id_foreign` FOREIGN KEY (`permission_id`) REFERENCES `permissions` (`id`) ON DELETE CASCADE,
  CONSTRAINT `role_has_permissions_role_id_foreign` FOREIGN KEY (`role_id`) REFERENCES `roles` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- ----------------------------
-- Records of role_has_permissions
-- ----------------------------
BEGIN;
INSERT INTO `role_has_permissions` VALUES (8, 1);
INSERT INTO `role_has_permissions` VALUES (9, 1);
INSERT INTO `role_has_permissions` VALUES (10, 1);
INSERT INTO `role_has_permissions` VALUES (11, 1);
INSERT INTO `role_has_permissions` VALUES (13, 1);
INSERT INTO `role_has_permissions` VALUES (14, 1);
INSERT INTO `role_has_permissions` VALUES (15, 1);
INSERT INTO `role_has_permissions` VALUES (16, 1);
INSERT INTO `role_has_permissions` VALUES (18, 1);
INSERT INTO `role_has_permissions` VALUES (19, 1);
INSERT INTO `role_has_permissions` VALUES (20, 1);
INSERT INTO `role_has_permissions` VALUES (21, 1);
COMMIT;

-- ----------------------------
-- Table structure for roles
-- ----------------------------
DROP TABLE IF EXISTS `roles`;
CREATE TABLE `roles` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `guard_name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `title` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `status` tinyint(1) unsigned NOT NULL DEFAULT '1',
  `created_at` datetime NOT NULL,
  `updated_at` datetime NOT NULL ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- ----------------------------
-- Records of roles
-- ----------------------------
BEGIN;
INSERT INTO `roles` VALUES (1, 'admin', 'admin', '系统管理员', 1, '2020-08-06 13:12:28', '2020-08-13 13:35:53');
COMMIT;

-- ----------------------------
-- Table structure for storages
-- ----------------------------
DROP TABLE IF EXISTS `storages`;
CREATE TABLE `storages` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `group_id` int(11) unsigned NOT NULL DEFAULT '0' COMMENT '分组表ID',
  `driver` varchar(255) NOT NULL COMMENT '存储驱动',
  `domain` varchar(255) NOT NULL DEFAULT '' COMMENT '存储域名',
  `original_name` varchar(255) NOT NULL COMMENT '原始名称',
  `path` varchar(255) NOT NULL COMMENT '文件路径',
  `type` varchar(255) NOT NULL COMMENT '文件类型',
  `size` varchar(255) NOT NULL COMMENT '文件大小(字节)',
  `ext` varchar(255) NOT NULL COMMENT '文件扩展',
  `author` varchar(255) NOT NULL COMMENT '上传用户',
  `updated_at` datetime DEFAULT NULL ON UPDATE CURRENT_TIMESTAMP,
  `created_at` datetime NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8mb4;

-- ----------------------------
-- Records of storages
-- ----------------------------
BEGIN;
INSERT INTO `storages` VALUES (1, 0, 'local', '', 'blob', 'images/avatar/TcNHeSHDa683LqaGpTyDPpkt7VTYzwooHSoHZMpx.jpeg', 'image/jpeg', '92815', 'jpeg', 'admin', '2020-08-19 09:37:55', '2020-08-19 09:37:55');
COMMIT;

-- ----------------------------
-- Table structure for storages_group
-- ----------------------------
DROP TABLE IF EXISTS `storages_group`;
CREATE TABLE `storages_group` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(255) NOT NULL,
  `type` varchar(255) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- ----------------------------
-- Table structure for users
-- ----------------------------
DROP TABLE IF EXISTS `users`;
CREATE TABLE `users` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `account` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL COMMENT '账号',
  `nickname` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT '' COMMENT '昵称',
  `phone` char(15) COLLATE utf8mb4_unicode_ci NOT NULL COMMENT '手机号',
  `password` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL COMMENT '密码',
  `safe_password` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT '' COMMENT '安全密码',
  `avatar` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT '' COMMENT '头像',
  `qq` char(11) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT '' COMMENT 'QQ号',
  `status` tinyint(1) unsigned NOT NULL DEFAULT '1' COMMENT '1-正常/2-禁用',
  `last_token` text COLLATE utf8mb4_unicode_ci,
  `updated_at` datetime NOT NULL,
  `created_at` datetime NOT NULL,
  `deleted_at` datetime DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `users_email_unique` (`phone`)
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- ----------------------------
-- Records of users
-- ----------------------------
BEGIN;
INSERT INTO `users` VALUES (4, 'darkness', '正直的夏天', '13884885888', '$2y$10$efTEi/3GRoN7bFDCFruUL.qiVpOtGLk5q3cMCPan1OWE3Hj6RtnoC', '', 'https://s1.ax1x.com/2020/07/29/aezKyD.jpg', '', 1, 'eyJ0eXAiOiJKV1QiLCJhbGciOiJIUzI1NiJ9.eyJpc3MiOiJodHRwOlwvXC9sb2NhbGhvc3Q6ODAwMFwvYXBpXC9hdXRob3JpemF0aW9uIiwiaWF0IjoxNTk2MDMyOTc3LCJleHAiOjE1OTYwMzY1NzcsIm5iZiI6MTU5NjAzMjk3NywianRpIjoiNTgwak9icXRyTU1MWGMweiIsInN1YiI6NCwicHJ2IjoiNzExMDdlZTZhYzhlZGViYTBjODFkNTA1MmU3Mjc2NTVkMTdjNmIxMSJ9.2w0JzR6KKzYkPlLkDs7SEDjQ7Sa6THvv_yZ15p3GZUY', '2020-07-29 14:29:37', '2020-07-29 11:02:42', NULL);
INSERT INTO `users` VALUES (5, 'chaos', '开心的口红', '13885886888', '$2y$10$lHE8OvsrNFrgDvZ8I8Zbv.WeOG.Qzdjo4hU9N/bXDpc3CPnB/bKO2', '', 'https://s1.ax1x.com/2020/07/29/aezKyD.jpg', '', 1, '', '2020-07-29 11:15:48', '2020-07-29 11:15:48', NULL);
COMMIT;

SET FOREIGN_KEY_CHECKS = 1;
