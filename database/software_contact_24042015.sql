/*
Navicat MySQL Data Transfer

Source Server         : JF
Source Server Version : 50539
Source Host           : localhost:3306
Source Database       : software_contact

Target Server Type    : MYSQL
Target Server Version : 50539
File Encoding         : 65001

Date: 2015-04-24 14:39:51
*/

SET FOREIGN_KEY_CHECKS=0;

-- ----------------------------
-- Table structure for `category`
-- ----------------------------
DROP TABLE IF EXISTS `category`;
CREATE TABLE `category` (
  `cat_id` int(11) NOT NULL AUTO_INCREMENT,
  `cat_name` varchar(255) NOT NULL,
  `cat_description` tinytext,
  `status` int(3) DEFAULT '1',
  PRIMARY KEY (`cat_id`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of category
-- ----------------------------
INSERT INTO `category` VALUES ('1', 'Phần mềm quản lý khách hàng', '', '1');
INSERT INTO `category` VALUES ('2', 'Phần mềm quản lý nhân viên', '', '1');

-- ----------------------------
-- Table structure for `category_feature`
-- ----------------------------
DROP TABLE IF EXISTS `category_feature`;
CREATE TABLE `category_feature` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `feature_id` int(11) DEFAULT NULL,
  `category_id` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `FKCategoryId` (`category_id`),
  KEY `FKFeatureId` (`feature_id`),
  CONSTRAINT `FKCategoryId` FOREIGN KEY (`category_id`) REFERENCES `category` (`cat_id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  CONSTRAINT `FKFeatureId` FOREIGN KEY (`feature_id`) REFERENCES `feature` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB AUTO_INCREMENT=9 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of category_feature
-- ----------------------------
INSERT INTO `category_feature` VALUES ('3', '2', '2');
INSERT INTO `category_feature` VALUES ('8', '2', '1');

-- ----------------------------
-- Table structure for `category_guide`
-- ----------------------------
DROP TABLE IF EXISTS `category_guide`;
CREATE TABLE `category_guide` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of category_guide
-- ----------------------------

-- ----------------------------
-- Table structure for `category_guide_detail`
-- ----------------------------
DROP TABLE IF EXISTS `category_guide_detail`;
CREATE TABLE `category_guide_detail` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of category_guide_detail
-- ----------------------------

-- ----------------------------
-- Table structure for `feature`
-- ----------------------------
DROP TABLE IF EXISTS `feature`;
CREATE TABLE `feature` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(255) DEFAULT NULL COMMENT 'tính năng',
  `description` tinytext,
  `status` tinyint(2) DEFAULT '1' COMMENT '0:ẩn | 1:hiện',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of feature
-- ----------------------------
INSERT INTO `feature` VALUES ('1', 'Quản lý công việc', 'Quản lý tất cả công việc trong dự án', '1');
INSERT INTO `feature` VALUES ('2', 'Quản lý nhân viên', 'Quản lý tất cả nhân viên trong công ty', '1');
INSERT INTO `feature` VALUES ('3', 'Quản lý khách hàng', 'Quản lý danh sách khách hàng của công ty', '1');

-- ----------------------------
-- Table structure for `manufacture`
-- ----------------------------
DROP TABLE IF EXISTS `manufacture`;
CREATE TABLE `manufacture` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(255) DEFAULT NULL COMMENT 'tên công ty',
  `logo` varchar(255) DEFAULT NULL COMMENT 'logo công ty',
  `introduction` text COMMENT 'giới thiệu công ty',
  `address` varchar(255) DEFAULT NULL,
  `phone` varchar(15) DEFAULT NULL,
  `website` varchar(50) DEFAULT NULL,
  `email` varchar(50) DEFAULT NULL,
  `established` varchar(30) DEFAULT NULL,
  `status` int(3) DEFAULT '1',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8 COMMENT='Bảng thông tin nhà sản xuất phần mềm';

-- ----------------------------
-- Records of manufacture
-- ----------------------------
INSERT INTO `manufacture` VALUES ('1', 'Misa', 'logo/misa-logo_1425487015.jpg', '', '', '', 'http://www.misa.com.vn/', 'contact@misa.com.vn', '2006', '1');

-- ----------------------------
-- Table structure for `migration`
-- ----------------------------
DROP TABLE IF EXISTS `migration`;
CREATE TABLE `migration` (
  `version` varchar(180) NOT NULL,
  `apply_time` int(11) DEFAULT NULL,
  PRIMARY KEY (`version`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of migration
-- ----------------------------
INSERT INTO `migration` VALUES ('m000000_000000_base', '1422642960');
INSERT INTO `migration` VALUES ('m130524_201442_init', '1422642969');

-- ----------------------------
-- Table structure for `reviewer`
-- ----------------------------
DROP TABLE IF EXISTS `reviewer`;
CREATE TABLE `reviewer` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `fullname` varchar(255) NOT NULL COMMENT 'tên người review',
  `email` varchar(150) NOT NULL COMMENT 'email người review',
  `company_name` varchar(255) NOT NULL COMMENT 'tên công ty',
  `company_industry` varchar(255) NOT NULL COMMENT 'lĩnh vực hoạt động',
  `company_number_employee` int(11) NOT NULL COMMENT 'số lượng nhân viên của công ty',
  `company_number_user` int(11) NOT NULL COMMENT 'số lượng người sử dụng phần mềm',
  `status` tinyint(2) DEFAULT '1' COMMENT '0:ko kích hoạt | 1:kích hoạt',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of reviewer
-- ----------------------------

-- ----------------------------
-- Table structure for `review_group`
-- ----------------------------
DROP TABLE IF EXISTS `review_group`;
CREATE TABLE `review_group` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(255) NOT NULL COMMENT 'tên nhóm tiêu chí',
  `parent_id` int(11) DEFAULT '0' COMMENT 'nhóm cha',
  `status` tinyint(2) DEFAULT '1' COMMENT '0:ẩn | 1:hiện',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of review_group
-- ----------------------------

-- ----------------------------
-- Table structure for `review_group_item`
-- ----------------------------
DROP TABLE IF EXISTS `review_group_item`;
CREATE TABLE `review_group_item` (
  `group_id` int(11) NOT NULL COMMENT 'id nhóm tiêu chí',
  `item_id` int(11) NOT NULL COMMENT 'id tiêu chí',
  PRIMARY KEY (`group_id`,`item_id`),
  KEY `FkItem` (`item_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of review_group_item
-- ----------------------------

-- ----------------------------
-- Table structure for `review_item`
-- ----------------------------
DROP TABLE IF EXISTS `review_item`;
CREATE TABLE `review_item` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `question` varchar(255) NOT NULL COMMENT 'câu hỏi',
  `type` tinyint(2) DEFAULT '1' COMMENT '1:text | 2:rate | 3:text&rate | 4:radio | 5:select | 6:money',
  `lbl_worse` varchar(50) DEFAULT NULL COMMENT 'trường hợp tệ nhất',
  `lbl_best` varchar(50) DEFAULT NULL COMMENT 'tốt nhất',
  `status` tinyint(2) DEFAULT '1' COMMENT '0:ẩn | 1:hiện',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COMMENT='Bảng chứa các tiêu chí để review';

-- ----------------------------
-- Records of review_item
-- ----------------------------

-- ----------------------------
-- Table structure for `review_item_choise`
-- ----------------------------
DROP TABLE IF EXISTS `review_item_choise`;
CREATE TABLE `review_item_choise` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `review_item_id` int(11) NOT NULL COMMENT 'id review_item',
  `name` varchar(255) NOT NULL COMMENT 'nội dung lựa chọn',
  PRIMARY KEY (`id`),
  KEY `FkReviewItem` (`review_item_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COMMENT='Bảng chứa các lựa chọn của review item';

-- ----------------------------
-- Records of review_item_choise
-- ----------------------------

-- ----------------------------
-- Table structure for `review_result`
-- ----------------------------
DROP TABLE IF EXISTS `review_result`;
CREATE TABLE `review_result` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `reviewer_id` int(11) NOT NULL COMMENT 'id người review',
  `software_id` int(11) NOT NULL COMMENT 'id phần mềm',
  `time_create` int(11) DEFAULT '0' COMMENT 'thời gian review',
  `time_update` int(11) DEFAULT NULL COMMENT 'thời gian chỉnh sửa',
  PRIMARY KEY (`id`),
  KEY `reviewer_id` (`reviewer_id`),
  KEY `software_id` (`software_id`),
  CONSTRAINT `review_result_ibfk_1` FOREIGN KEY (`reviewer_id`) REFERENCES `reviewer` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  CONSTRAINT `review_result_ibfk_2` FOREIGN KEY (`software_id`) REFERENCES `software` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB DEFAULT CHARSET=utf8 ROW_FORMAT=COMPACT;

-- ----------------------------
-- Records of review_result
-- ----------------------------

-- ----------------------------
-- Table structure for `review_result_item`
-- ----------------------------
DROP TABLE IF EXISTS `review_result_item`;
CREATE TABLE `review_result_item` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `result_id` int(11) NOT NULL COMMENT 'id result',
  `item_id` int(11) NOT NULL COMMENT 'id item review',
  PRIMARY KEY (`id`),
  KEY `FkResult` (`result_id`),
  KEY `FkItem` (`item_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of review_result_item
-- ----------------------------

-- ----------------------------
-- Table structure for `software`
-- ----------------------------
DROP TABLE IF EXISTS `software`;
CREATE TABLE `software` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(255) DEFAULT NULL,
  `cate_id` int(11) DEFAULT NULL,
  `manufacture_id` int(11) DEFAULT '0' COMMENT 'id công ty sản xuất phần mềm',
  `picture` varchar(255) DEFAULT NULL COMMENT 'ảnh phần mềm',
  `description` tinytext,
  `user_rating` tinyint(2) DEFAULT '0' COMMENT 'số điểm người dùng đánh giá',
  `price_range` tinyint(2) DEFAULT '0' COMMENT 'đánh giá của hệ thống về chi phí sản phẩm',
  `os_support` varchar(255) DEFAULT NULL COMMENT 'hệ điều hành được hỗ trợ',
  `status` tinyint(2) DEFAULT '1' COMMENT '1:mới,2:cũ,3:hỏng',
  PRIMARY KEY (`id`),
  UNIQUE KEY `id` (`id`) USING BTREE,
  KEY `FkCategory` (`cate_id`) USING BTREE,
  KEY `FkManufacture` (`manufacture_id`),
  CONSTRAINT `FkManufacture` FOREIGN KEY (`manufacture_id`) REFERENCES `manufacture` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of software
-- ----------------------------
INSERT INTO `software` VALUES ('1', 'Sugar CRM', '1', '1', null, '', null, null, '', '1');

-- ----------------------------
-- Table structure for `software_feature`
-- ----------------------------
DROP TABLE IF EXISTS `software_feature`;
CREATE TABLE `software_feature` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `feature_id` int(11) NOT NULL COMMENT 'id tính năng',
  `software_id` int(11) NOT NULL COMMENT 'id phần mềm',
  PRIMARY KEY (`id`),
  KEY `FkFeature` (`feature_id`),
  KEY `FkSoftware` (`software_id`),
  CONSTRAINT `FkSoftware` FOREIGN KEY (`software_id`) REFERENCES `software` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of software_feature
-- ----------------------------
INSERT INTO `software_feature` VALUES ('3', '2', '1');

-- ----------------------------
-- Table structure for `software_picture`
-- ----------------------------
DROP TABLE IF EXISTS `software_picture`;
CREATE TABLE `software_picture` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `software_id` int(11) NOT NULL,
  `path` varchar(255) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=12 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of software_picture
-- ----------------------------
INSERT INTO `software_picture` VALUES ('11', '1', 'slide/IMG_0785_1425668840.jpg');

-- ----------------------------
-- Table structure for `user`
-- ----------------------------
DROP TABLE IF EXISTS `user`;
CREATE TABLE `user` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `username` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `auth_key` varchar(32) COLLATE utf8_unicode_ci NOT NULL,
  `password_hash` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `password_reset_token` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `email` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `status` smallint(6) NOT NULL DEFAULT '10',
  `created_at` int(11) NOT NULL,
  `updated_at` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- ----------------------------
-- Records of user
-- ----------------------------
INSERT INTO `user` VALUES ('2', 'admin', 'jeBxBMGrgkdyPGDQlflewk0-bOfpIdn3', '$2y$13$BkQWiW7C0jg3OfRaDV4r1uxehk3dazAi8Ygo.4uQP4N6dbqA84UxO', null, 'vvdung88@gmail.com', '10', '1423155342', '1423155342');
