-- ----------------------------
-- Table structure for admin
-- ----------------------------
DROP TABLE IF EXISTS `xwx_admin`;
CREATE TABLE `xwx_admin` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `username` varchar(12) NOT NULL,
  `password` varchar(100) NOT NULL,
  `create_time` int(11) NULL,
  `update_time` int(11) NULL,
  `last_login_time` int(11) NULL,
  `last_login_ip` varchar(100) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 ROW_FORMAT=DYNAMIC;

-- ----------------------------
-- Table structure for author
-- ----------------------------
DROP TABLE IF EXISTS `xwx_author`;
CREATE TABLE `xwx_author` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `author_name` varchar(50) NOT NULL,
   `create_time` int(11) NULL,
  `update_time` int(11) NULL,
  PRIMARY KEY (`id`) USING BTREE,
  UNIQUE KEY `author_name` (`author_name`) USING BTREE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 ROW_FORMAT=DYNAMIC;

-- ----------------------------
-- Table structure for banner
-- ----------------------------
DROP TABLE IF EXISTS `xwx_banner`;
CREATE TABLE `xwx_banner` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `pic_name` varchar(50) NOT NULL,
  `create_time` int(11) NULL,
  `update_time` int(11) NULL,
  `book_id` int(11) NOT NULL,
  `title` varchar(50) NOT NULL,
  PRIMARY KEY (`id`) USING BTREE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 ROW_FORMAT=DYNAMIC;

-- ----------------------------
-- Table structure for book
-- ----------------------------
DROP TABLE IF EXISTS `xwx_book`;
CREATE TABLE `xwx_book` (
  `id` bigint(20) NOT NULL AUTO_INCREMENT,
  `book_name` varchar(50) NOT NULL,
  `nick_name` varchar(100),
  `create_time` int(11) NULL,
  `update_time` int(11) NULL,
  `tags` varchar(100) DEFAULT NULL,
  `summary` text DEFAULT NULL,
  `end` tinyint(4) DEFAULT NULL,
  `author_id` int(11) NOT NULL,
  `click` bigint(20) DEFAULT NULL,
  `src` varchar(50) DEFAULT NULL,
  `cover_url` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`id`) USING BTREE,
  KEY `tags` (`tags`) USING BTREE,
  KEY `end` (`end`) USING HASH,
  KEY `author_id` (`author_id`) USING HASH,
  FULLTEXT KEY `fidx` (`book_name`,`summary`) with parser ngram
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 ROW_FORMAT=DYNAMIC;

-- ----------------------------
-- Table structure for chapter
-- ----------------------------
DROP TABLE IF EXISTS `xwx_chapter`;
CREATE TABLE `xwx_chapter` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `chapter_name` varchar(255) NOT NULL,
  `create_time` int(11) NULL,
  `update_time` int(11) NULL,
  `book_id` bigint(20) NOT NULL,
  `isvip` tinyint(4) DEFAULT NULL,
  `order` decimal(10,2) NOT NULL,
  PRIMARY KEY (`id`) USING BTREE,
  KEY `chapter_name` (`chapter_name`(250)) USING BTREE,
  KEY `book_id` (`book_id`) USING HASH,
  KEY `order` (`order`) USING HASH
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 ROW_FORMAT=DYNAMIC;

-- ----------------------------
-- Table structure for photo
-- ----------------------------
DROP TABLE IF EXISTS `xwx_photo`;
CREATE TABLE `xwx_photo` (
  `id` bigint(20) NOT NULL AUTO_INCREMENT,
  `chapter_id` int(11) NOT NULL,
  `create_time` int(11) NULL,
  `update_time` int(11) NULL,
  `order` decimal(10,2) NOT NULL,
  `img_url` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`id`) USING BTREE,
  KEY `chapter_id` (`chapter_id`) USING HASH,
  KEY `order` (`order`) USING HASH
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- ----------------------------
-- Table structure for tags
-- ----------------------------
DROP TABLE IF EXISTS `xwx_tags`;
CREATE TABLE `xwx_tags` (
  `id` bigint(20) NOT NULL AUTO_INCREMENT,
  `tag_name` varchar(20) NOT NULL,
  `create_time` int(11) NULL,
  `update_time` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`) USING BTREE,
  UNIQUE KEY `tag_name` (`tag_name`) USING BTREE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 ROW_FORMAT=DYNAMIC;

-- ----------------------------
-- Table structure for xwx_friendship_link
-- ----------------------------
DROP TABLE IF EXISTS `xwx_friendship_link`;
CREATE TABLE `xwx_friendship_link` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(100) NOT NULL,
  `url` varchar(255) NOT NULL,
  `create_time` int(11) NULL,
  `update_time` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 ROW_FORMAT=DYNAMIC;
