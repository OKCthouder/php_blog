/*
Navicat MySQL Data Transfer

Source Server         : localhost
Source Server Version : 50528
Source Host           : localhost:3306
Source Database       : tndb

Target Server Type    : MYSQL
Target Server Version : 50528
File Encoding         : 65001

Date: 2019-05-15 21:38:27
*/

SET FOREIGN_KEY_CHECKS=0;

-- ----------------------------
-- Table structure for tn_article
-- ----------------------------
DROP TABLE IF EXISTS `tn_article`;
CREATE TABLE `tn_article` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT COMMENT '����id',
  `title` varchar(64) NOT NULL DEFAULT '' COMMENT '���±���',
  `content` text NOT NULL COMMENT '��������',
  `user_id` int(10) unsigned NOT NULL DEFAULT '1' COMMENT '�û�id',
  `create_ad` int(10) unsigned NOT NULL DEFAULT '0' COMMENT '����ʱ��',
  `summary` varchar(256) NOT NULL DEFAULT '' COMMENT '���¼��',
  `category_id` int(10) unsigned NOT NULL DEFAULT '1' COMMENT '����id',
  `cover` varchar(256) NOT NULL DEFAULT '' COMMENT '����ͼƬ',
  `state` enum('publish','save') NOT NULL COMMENT '״̬',
  `is_delete` tinyint(3) unsigned NOT NULL DEFAULT '0' COMMENT '�Ƿ�ɾ��',
  `tags` varchar(256) NOT NULL DEFAULT '' COMMENT '��ǩ',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of tn_article
-- ----------------------------
INSERT INTO `tn_article` VALUES ('2', '泰牛博客2标题', '泰牛博客2内容', '1', '1554431499', '泰牛博客2简介', '1', 'blog-single-2.jpg', 'publish', '0', '');
INSERT INTO `tn_article` VALUES ('3', '泰牛博客3标题', '泰牛博客3内容', '1', '1554431509', '泰牛博客2简介', '1', 'blog-single-4.jpg', 'publish', '0', '');
INSERT INTO `tn_article` VALUES ('4', '泰牛博客4标题', '泰牛博客4内容', '1', '1554431515', '泰牛博客4简介', '3', 'blog-single-2.jpg', 'publish', '0', '');
INSERT INTO `tn_article` VALUES ('5', 'php的session技术分享', 'php的session技术分享 内容', '1', '1554478625', 'php的session技术分享 概述', '1', 'blog-single.jpg', 'publish', '0', '');

-- ----------------------------
-- Table structure for tn_category
-- ----------------------------
DROP TABLE IF EXISTS `tn_category`;
CREATE TABLE `tn_category` (
  `id` smallint(5) unsigned NOT NULL AUTO_INCREMENT COMMENT '分类id',
  `title` varchar(64) NOT NULL DEFAULT '' COMMENT '分类名称',
  `order_number` int(10) unsigned NOT NULL DEFAULT '100',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=6 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of tn_category
-- ----------------------------
INSERT INTO `tn_category` VALUES ('1', 'php技术类', '123');
INSERT INTO `tn_category` VALUES ('3', '数据算法类', '103');
INSERT INTO `tn_category` VALUES ('4', 'java技术类', '111');
INSERT INTO `tn_category` VALUES ('5', 'C程序设计', '150');

-- ----------------------------
-- Table structure for tn_user
-- ----------------------------
DROP TABLE IF EXISTS `tn_user`;
CREATE TABLE `tn_user` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT COMMENT '用户id',
  `username` varchar(64) NOT NULL DEFAULT '' COMMENT '用户名',
  `password` char(32) NOT NULL DEFAULT '' COMMENT '用户密码',
  `nickname` varchar(64) NOT NULL DEFAULT '' COMMENT '用户昵称',
  `logo` varchar(255) NOT NULL DEFAULT 'default.jpg' COMMENT '用户头像',
  `create_at` int(10) unsigned NOT NULL DEFAULT '0' COMMENT '用户创建时间',
  `status` enum('online','offline','busy','hidden') NOT NULL COMMENT '用户的状态',
  PRIMARY KEY (`id`),
  UNIQUE KEY `username` (`username`)
) ENGINE=MyISAM AUTO_INCREMENT=2 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of tn_user
-- ----------------------------
INSERT INTO `tn_user` VALUES ('1', 'admin', '21232f297a57a5a743894a0e4a801fc3', '泰牛小圆子', 'avatar.png', '1554446589', 'online');
