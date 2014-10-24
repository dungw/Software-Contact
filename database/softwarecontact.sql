/*
Navicat MySQL Data Transfer

Source Server         : JF
Source Server Version : 50133
Source Host           : localhost:3306
Source Database       : softwarecontact

Target Server Type    : MYSQL
Target Server Version : 50133
File Encoding         : 65001

Date: 2014-10-23 22:43:15
*/

SET FOREIGN_KEY_CHECKS=0;

-- ----------------------------
-- Table structure for `category`
-- ----------------------------
DROP TABLE IF EXISTS `category`;
CREATE TABLE `category` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of category
-- ----------------------------

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
  `cate_id` int(11) NOT NULL COMMENT 'id danh mục phần mềm',
  `name` varchar(255) DEFAULT NULL COMMENT 'tính năng',
  `status` tinyint(2) DEFAULT '1' COMMENT '0:ẩn | 1:hiện',
  PRIMARY KEY (`id`),
  KEY `FkCategory` (`cate_id`) USING BTREE
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of feature
-- ----------------------------

-- ----------------------------
-- Table structure for `manufacture`
-- ----------------------------
DROP TABLE IF EXISTS `manufacture`;
CREATE TABLE `manufacture` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(255) DEFAULT NULL COMMENT 'tên công ty',
  `logo` varchar(255) DEFAULT NULL COMMENT 'logo công ty',
  `description` text COMMENT 'giới thiệu công ty',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COMMENT='Bảng thông tin nhà sản xuất phần mềm';

-- ----------------------------
-- Records of manufacture
-- ----------------------------

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
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of software
-- ----------------------------

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
  CONSTRAINT `FkFeature` FOREIGN KEY (`feature_id`) REFERENCES `feature` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  CONSTRAINT `FkSoftware` FOREIGN KEY (`software_id`) REFERENCES `software` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of software_feature
-- ----------------------------

-- ----------------------------
-- Table structure for `system_user`
-- ----------------------------
DROP TABLE IF EXISTS `system_user`;
CREATE TABLE `system_user` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `username` varchar(255) NOT NULL COMMENT 'tên đăng nhập',
  `password` varchar(255) NOT NULL COMMENT 'mật khẩu',
  `time_create` int(11) DEFAULT '0',
  `time_update` int(11) DEFAULT '0' COMMENT 'Lần cập nhật cuối',
  `fullname` varchar(255) DEFAULT NULL COMMENT 'tên đầy đủ',
  `status` tinyint(1) DEFAULT '1',
  PRIMARY KEY (`id`),
  UNIQUE KEY `adm_loginname` (`username`) USING BTREE,
  KEY `adm_date` (`time_create`) USING BTREE,
  KEY `adm_id` (`id`) USING BTREE,
  KEY `adm_loginname_2` (`username`) USING BTREE
) ENGINE=MyISAM AUTO_INCREMENT=87 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of system_user
-- ----------------------------
