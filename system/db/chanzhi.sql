-- DROP TABLE IF EXISTS `eps_article`;
CREATE TABLE IF NOT EXISTS `eps_article` (
  `id` mediumint(8) unsigned NOT NULL AUTO_INCREMENT,
  `title` varchar(150) NOT NULL,
  `alias` varchar(100) NOT NULL,
  `keywords` varchar(150) NOT NULL,
  `summary` text NOT NULL,
  `content` text NOT NULL,
  `source` enum('original','copied','translational') NOT NULL,
  `copySite` varchar(60) NOT NULL,
  `copyURL` varchar(255) NOT NULL,
  `author` varchar(60) NOT NULL,
  `editor` varchar(60) NOT NULL,
  `addedDate` datetime NOT NULL,
  `editedDate` datetime NOT NULL,
  `status` varchar(20) NOT NULL DEFAULT 'normal',
  `type` varchar(30) NOT NULL,
  `views` mediumint(5) unsigned NOT NULL DEFAULT '0',
  `sticky` enum('0','1','2','3') NOT NULL DEFAULT '0',
  `order` smallint(5) unsigned NOT NULL,
  `link` varchar(255) NOT NULL,
  `css` text NOT NULL,
  `js` text NOT NULL,
  `lang` char(30) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `order` (`order`),
  KEY `lang` (`lang`),
  KEY `views` (`views`),
  KEY `sticky` (`sticky`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

-- DROP TABLE IF EXISTS `eps_block`;
CREATE TABLE IF NOT EXISTS `eps_block` (
  `id` smallint(5) unsigned NOT NULL AUTO_INCREMENT,
  `template` varchar(30) NOT NULL DEFAULT 'default',
  `type` varchar(20) NOT NULL,
  `title` varchar(60) NOT NULL,
  `content` text NOT NULL,
  `lang` char(30) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `lang` (`lang`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8;

-- DROP TABLE IF EXISTS `eps_book`;
CREATE TABLE IF NOT EXISTS `eps_book` (
  `id` smallint(5) unsigned NOT NULL AUTO_INCREMENT,
  `title` varchar(150) NOT NULL,
  `alias` varchar(100) NOT NULL,
  `keywords` varchar(150) NOT NULL,
  `summary` text NOT NULL,
  `content` text NOT NULL,
  `type` enum('book','chapter','article') NOT NULL,
  `parent` smallint(5) unsigned NOT NULL DEFAULT '0',
  `path` char(255) NOT NULL DEFAULT '',
  `grade` tinyint(3) unsigned NOT NULL DEFAULT '0',
  `author` varchar(60) NOT NULL,
  `editor` varchar(60) NOT NULL,
  `addedDate` datetime NOT NULL,
  `editedDate` datetime NOT NULL,
  `views` mediumint(5) unsigned NOT NULL DEFAULT '0',
  `order` smallint(5) unsigned NOT NULL DEFAULT '0',
  `lang` char(30) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `lang` (`lang`),
  KEY `order` (`order`),
  KEY `parent` (`parent`),
  KEY `path` (`path`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

-- DROP TABLE IF EXISTS `eps_category`;
CREATE TABLE IF NOT EXISTS `eps_category` (
  `id` smallint(5) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(100) NOT NULL DEFAULT '',
  `alias` varchar(100) NOT NULL,
  `desc` text NOT NULL,
  `keywords` varchar(150) NOT NULL,
  `parent` smallint(5) unsigned NOT NULL DEFAULT '0',
  `path` char(255) NOT NULL DEFAULT '',
  `grade` tinyint(3) unsigned NOT NULL DEFAULT '0',
  `order` smallint(5) unsigned NOT NULL DEFAULT '0',
  `type` char(30) NOT NULL,
  `readonly` enum('0','1') NOT NULL DEFAULT '0',
  `moderators` varchar(255) NOT NULL,
  `threads` smallint(5) NOT NULL,
  `posts` smallint(5) NOT NULL,
  `postedBy` varchar(30) NOT NULL,
  `postedDate` datetime NOT NULL,
  `postID` mediumint(9) NOT NULL,
  `replyID` mediumint(8) unsigned NOT NULL,
  `link` varchar(255) NOT NULL,
  `lang` char(30) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `lang` (`lang`),
  KEY `tree` (`type`),
  KEY `order` (`order`),
  KEY `parent` (`parent`),
  KEY `path` (`path`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

-- DROP TABLE IF EXISTS `eps_config`;
CREATE TABLE IF NOT EXISTS `eps_config` (
  `id` mediumint(8) unsigned NOT NULL AUTO_INCREMENT,
  `owner` char(30) NOT NULL DEFAULT '',
  `module` varchar(30) NOT NULL,
  `section` char(30) NOT NULL DEFAULT '',
  `key` char(30) DEFAULT NULL,
  `value` text NOT NULL,
  `lang` char(30) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `lang` (`lang`),
  UNIQUE KEY `unique` (`owner`,`module`,`section`,`key`,`lang`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8;

-- DROP TABLE IF EXISTS `eps_package`;
CREATE TABLE IF NOT EXISTS `eps_package` (
  `id` mediumint(8) unsigned NOT NULL auto_increment,
  `name` varchar(150) NOT NULL,
  `code` varchar(30) NOT NULL,
  `version` varchar(50) NOT NULL,
  `author` varchar(100) NOT NULL,
  `desc` text NOT NULL,
  `license` text NOT NULL,
  `type` varchar(20) NOT NULL default 'extension',
  `site` varchar(150) NOT NULL,
  `chanzhiCompatible` varchar(100) NOT NULL,
  `templateCompatible` varchar(100) NOT NULL,
  `installedTime` datetime NOT NULL,
  `depends` varchar(100) NOT NULL,
  `dirs` text NOT NULL,
  `files` text NOT NULL,
  `status` varchar(20) NOT NULL,
  `lang` char(30) NOT NULL,
  PRIMARY KEY  (`id`),
  KEY `lang` (`lang`),
  UNIQUE KEY `code` (`code`),
  KEY `name` (`name`),
  KEY `addedTime` (`installedTime`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

-- DROP TABLE IF EXISTS `eps_down`;
CREATE TABLE IF NOT EXISTS `eps_down` (
  `id` int(10) NOT NULL AUTO_INCREMENT,
  `account` char(30) DEFAULT NULL,
  `file` mediumint(5) DEFAULT NULL,
  `ip` char(15) NOT NULL,
  `time` datetime NOT NULL,
  `referer` varchar(200) NOT NULL,
  `lang` char(30) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `lang` (`lang`),
  KEY `fileID` (`file`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

-- DROP TABLE IF EXISTS `eps_file`;
CREATE TABLE IF NOT EXISTS `eps_file` (
  `id` mediumint(8) unsigned NOT NULL AUTO_INCREMENT,
  `pathname` char(50) NOT NULL,
  `title` char(90) NOT NULL,
  `extension` char(30) NOT NULL,
  `size` mediumint(8) unsigned NOT NULL DEFAULT '0',
  `width` smallint(5) unsigned NOT NULL DEFAULT '0',
  `height` smallint(5) unsigned NOT NULL DEFAULT '0',
  `objectType` char(20) NOT NULL,
  `objectID` mediumint(9) NOT NULL,
  `addedBy` char(30) NOT NULL DEFAULT '',
  `addedDate` datetime NOT NULL,
  `public` enum('1','0') NOT NULL DEFAULT '1',
  `downloads` mediumint(8) unsigned NOT NULL DEFAULT '0',
  `extra` varchar(255) NOT NULL,
  `primary` enum('1','0') DEFAULT '0',
  `editor` enum('1','0') NOT NULL DEFAULT '0',
  `lang` char(30) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `lang` (`lang`),
  KEY `object` (`objectType`,`objectID`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

-- DROP TABLE IF EXISTS `eps_group`;
CREATE TABLE IF NOT EXISTS `eps_group` (
  `id` mediumint(8) unsigned NOT NULL auto_increment,
  `name` char(30) NOT NULL,
  `role` char(30) NOT NULL default '',
  `desc` char(255) NOT NULL default '',
  `lang` char(30) NOT NULL,
  PRIMARY KEY  (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8;

-- DROP TABLE IF EXISTS `eps_grouppriv`;
CREATE TABLE IF NOT EXISTS `eps_grouppriv` (
  `group` mediumint(8) unsigned NOT NULL default '0', 
  `module` char(30) NOT NULL default '',
  `method` char(30) NOT NULL default '',
  `lang` char(30) NOT NULL,
  UNIQUE KEY `group` (`group`,`module`,`method`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

-- DROP TABLE IF EXISTS `eps_layout`;
CREATE TABLE IF NOT EXISTS `eps_layout` (
  `template` varchar(30) NOT NULL DEFAULT 'default',
  `page` varchar(30) NOT NULL,
  `region` varchar(30) NOT NULL,
  `blocks` text NOT NULL,
  `lang` char(30) NOT NULL,
  UNIQUE KEY `layout` (`template`,`page`,`region`,`lang`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

-- DROP TABLE IF EXISTS `eps_message`;
CREATE TABLE IF NOT EXISTS `eps_message` (
  `id` mediumint(8) unsigned NOT NULL AUTO_INCREMENT,
  `type` char(20) NOT NULL,
  `objectType` varchar(30) NOT NULL DEFAULT '',
  `objectID` mediumint(8) unsigned NOT NULL DEFAULT '0',
  `account` char(30) DEFAULT NULL,
  `from` char(30) NOT NULL,
  `to` char(30) NOT NULL,
  `phone` char(30) NOT NULL,
  `email` varchar(90) NOT NULL,
  `qq` char(30) NOT NULL,
  `date` datetime NOT NULL,
  `content` text NOT NULL,
  `link` varchar(100) NOT NULL,
  `ip` varchar(15) NOT NULL,
  `status` char(20) NOT NULL,
  `public` enum('0','1') NOT NULL DEFAULT '1',
  `readed` enum('0','1') NOT NULL,
  `receiveEmail` enum('0','1') NOT NULL DEFAULT '0',
  `lang` char(30) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `lang` (`lang`),
  KEY `status` (`status`),
  KEY `object` (`objectType`,`objectID`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

-- DROP TABLE IF EXISTS `eps_oauth`;
CREATE TABLE IF NOT EXISTS `eps_oauth` (
  `account` varchar(30) NOT NULL,
  `provider` varchar(30) NOT NULL,
  `openID` varchar(60) NOT NULL,
  `lang` char(30) NOT NULL,
  UNIQUE KEY `account` (`account`,`provider`,`openID`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

-- DROP TABLE IF EXISTS `eps_product`;
CREATE TABLE IF NOT EXISTS `eps_product` (
  `id` mediumint(8) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(150) NOT NULL,
  `alias` varchar(100) NOT NULL,
  `mall` varchar(255) NOT NULL,
  `brand` varchar(100) DEFAULT NULL,
  `model` char(30) DEFAULT NULL,
  `color` char(20) NOT NULL,
  `origin` varchar(50) NOT NULL,
  `unit` char(20) NOT NULL,
  `price` float(8,2) NOT NULL,
  `promotion` float(8,2) NOT NULL,
  `amount` mediumint(8) unsigned DEFAULT NULL,
  `keywords` varchar(150) NOT NULL,
  `desc` text NOT NULL,
  `content` text NOT NULL,
  `author` varchar(60) NOT NULL,
  `editor` varchar(60) NOT NULL,
  `addedDate` datetime NOT NULL,
  `editedDate` datetime NOT NULL,
  `status` varchar(20) NOT NULL DEFAULT 'normal',
  `views` mediumint(5) unsigned NOT NULL DEFAULT '0',
  `sticky` enum('0','1','2','3') NOT NULL DEFAULT '0',
  `order` smallint(5) unsigned NOT NULL,
  `css` text NOT NULL,
  `js` text NOT NULL,
  `lang` char(30) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `lang` (`lang`),
  KEY `order` (`order`),
  KEY `views` (`views`),
  KEY `sticky` (`sticky`),
  KEY `model` (`model`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

-- DROP TABLE IF EXISTS `eps_relation`;
CREATE TABLE IF NOT EXISTS `eps_relation` (
  `type` char(20) NOT NULL,
  `id` mediumint(9) NOT NULL,
  `category` smallint(5) NOT NULL,
  `lang` char(30) NOT NULL,
  UNIQUE KEY `relation` (`type`,`id`,`category`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

-- DROP TABLE IF EXISTS `eps_reply`;
CREATE TABLE IF NOT EXISTS `eps_reply` (
  `id` mediumint(8) unsigned NOT NULL AUTO_INCREMENT,
  `thread` mediumint(8) unsigned NOT NULL,
  `content` text NOT NULL,
  `author` char(30) NOT NULL,
  `editor` char(30) NOT NULL,
  `addedDate` datetime NOT NULL,
  `editedDate` datetime NOT NULL,
  `hidden` enum('0','1') NOT NULL DEFAULT '0',
  `lang` char(30) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `lang` (`lang`),
  KEY `thread` (`thread`),
  KEY `author` (`author`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

CREATE TABLE IF NOT EXISTS `eps_product_custom` (
  `id` mediumint(8) unsigned NOT NULL AUTO_INCREMENT,
  `product` mediumint(8) unsigned NOT NULL DEFAULT '0',
  `label` varchar(100) NOT NULL,
  `value` varchar(200) NOT NULL,
  `order` smallint(5) unsigned NOT NULL,
  `lang` char(30) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `lang` (`lang`),
  UNIQUE KEY `label` (`product`,`label`),
  KEY `product` (`product`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

-- DROP TABLE IF EXISTS `eps_tag`;
CREATE TABLE IF NOT EXISTS `eps_tag` (
  `id` smallint(5) unsigned NOT NULL AUTO_INCREMENT,
  `tag` varchar(50) NOT NULL,
  `link` varchar(100) NOT NULL,
  `rank` smallint(5) unsigned NOT NULL,
  `lang` char(30) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `lang` (`lang`),
  KEY `tag` (`tag`),
  KEY `rank` (`rank`),
  KEY `link` (`link`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

-- DROP TABLE IF EXISTS `eps_thread`;
CREATE TABLE IF NOT EXISTS `eps_thread` (
  `id` mediumint(8) unsigned NOT NULL AUTO_INCREMENT,
  `board` mediumint(9) NOT NULL,
  `title` varchar(255) NOT NULL,
  `content` text NOT NULL,
  `author` varchar(60) NOT NULL,
  `editor` varchar(60) NOT NULL,
  `addedDate` datetime NOT NULL,
  `editedDate` datetime NOT NULL,
  `readonly` tinyint(1) NOT NULL DEFAULT '0',
  `views` smallint(5) unsigned NOT NULL DEFAULT '0',
  `stick` enum('0','1','2','3') NOT NULL DEFAULT '0',
  `replies` smallint(6) NOT NULL,
  `repliedBy` varchar(30) NOT NULL,
  `repliedDate` datetime NOT NULL,
  `replyID` mediumint(8) unsigned NOT NULL,
  `hidden` enum('0','1') NOT NULL DEFAULT '0',
  `link` varchar(255) NOT NULL,
  `lang` char(30) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `lang` (`lang`),
  KEY `category` (`board`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

-- DROP TABLE IF EXISTS `eps_user`;
CREATE TABLE IF NOT EXISTS `eps_user` (
  `id` mediumint(8) unsigned NOT NULL AUTO_INCREMENT,
  `account` char(30) NOT NULL DEFAULT '',
  `password` char(32) NOT NULL DEFAULT '',
  `realname` char(30) NOT NULL DEFAULT '',
  `nickname` char(60) NOT NULL DEFAULT '',
  `admin` enum('no','common','super') NOT NULL DEFAULT 'no',
  `avatar` char(30) NOT NULL DEFAULT '',
  `birthday` date NOT NULL,
  `gender` enum('f','m','u') NOT NULL DEFAULT 'u',
  `email` char(90) NOT NULL DEFAULT '',
  `skype` char(90) NOT NULL,
  `qq` char(20) NOT NULL DEFAULT '',
  `yahoo` char(90) NOT NULL DEFAULT '',
  `gtalk` char(90) NOT NULL DEFAULT '',
  `wangwang` char(90) NOT NULL DEFAULT '',
  `site` varchar(100) NOT NULL,
  `mobile` char(11) NOT NULL DEFAULT '',
  `phone` char(20) NOT NULL DEFAULT '',
  `company` varchar(255) NOT NULL,
  `address` char(120) NOT NULL DEFAULT '',
  `zipcode` char(10) NOT NULL DEFAULT '',
  `visits` mediumint(8) unsigned NOT NULL DEFAULT '0',
  `ip` char(15) NOT NULL DEFAULT '',
  `last` datetime NOT NULL,
  `fails` tinyint(3) unsigned NOT NULL DEFAULT '0',
  `referer` varchar(255) NOT NULL,
  `join` datetime NOT NULL,
  `reset` char(64) NOT NULL,
  `locked` datetime NOT NULL,
  `public` varchar(30) NOT NULL DEFAULT '0',
  `lang` char(30) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `lang` (`lang`),
  KEY `admin` (`admin`),
  KEY `account` (`account`,`password`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8;

-- DROP TABLE IF EXISTS `eps_usergroup`;
CREATE TABLE IF NOT EXISTS `eps_usergroup` (
  `account` char(30) NOT NULL default '',
  `group` mediumint(8) unsigned NOT NULL default '0',
  `lang` char(30) NOT NULL,
  UNIQUE KEY `account` (`account`,`group`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

-- DROP TABLE IF EXISTS `eps_wx_public`;
CREATE TABLE IF NOT EXISTS `eps_wx_public` (
  `id`        smallint(5) unsigned NOT NULL AUTO_INCREMENT,
  `account`   varchar(30) NOT NULL,
  `name`      varchar(60) NOT NULL,
  `appID`     char(30) NOT NULL,
  `appSecret` char(32) NOT NULL,
  `url`       varchar(100) NOT NULL,
  `token`     varchar(100) NOT NULL,
  `qrcode`    varchar(100) NOT NULL,
  `primary`   tinyint(3) NOT NULL DEFAULT 0,
  `type`      enum('subscribe', 'service') NOT NULL,
  `status`    enum('wait', 'normal') NOT NULL,
  `certified` enum('1', '0') NOT NULL DEFAULT '0',
  `addedDate` datetime NOT NULL,
  `lang` char(30) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `lang` (`lang`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

-- DROP TABLE IF EXISTS `eps_wx_response`;
CREATE TABLE IF NOT EXISTS `eps_wx_response` (
  `id` smallint(5) unsigned NOT NULL AUTO_INCREMENT,
  `public` smallint(3) NOT NULL,
  `key` varchar(100) NOT NULL,
  `group` varchar(100) NOT NULL,
  `type` enum('text','news','link') NOT NULL DEFAULT 'text',
  `source` varchar(100) NOT NULL,
  `content` text NOT NULL,
  `lang` char(30) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `lang` (`lang`),
  UNIQUE KEY `key` (`public`,`key`,`lang`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

-- DROP TABLE IF EXISTS `eps_wx_message`;
CREATE TABLE IF NOT EXISTS `eps_wx_message` (
  `id` mediumint(10) unsigned NOT NULL AUTO_INCREMENT,
  `public` smallint(3) NOT NULL,
  `wid` char(64) NOT NULL,
  `to` varchar(50) NOT NULL,
  `from` varchar(50) NOT NULL,
  `response` mediumint(8) unsigned NOT NULL,
  `content` text NOT NULL,
  `type` char(30) NOT NULL,
  `replied` tinyint(3) NOT NULL DEFAULT '0',
  `time` datetime NOT NULL,
  `lang` char(30) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `lang` (`lang`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

-- Insert data into `eps_layout`;
INSERT INTO `eps_layout` (`page`, `region`, `blocks`, `template`,`lang`) VALUES
('all', 'top', '[{"id":"12","grid":"","titleless":0,"borderless":0}]', 'default','zh-cn'),
('index_index', 'top', '[{"id":"5","grid":"","titleless":0,"borderless":0}]', 'default','zh-cn'),
('index_index', 'middle', '[{"id":"3","grid":12,"titleless":0,"borderless":0},{"id":"10","grid":4,"titleless":0,"borderless":0},{"id":"1","grid":4,"titleless":0,"borderless":0},{"id":"9","grid":4,"titleless":0,"borderless":0}]', 'default','zh-cn'),
('index_index', 'bottom', '[{"id":"11","grid":"","titleless":0,"borderless":0}]', 'default','zh-cn'),
('company_index', 'side', '[{"id":"9","grid":"","titleless":0,"borderless":0},{"id":"13","grid":"","titleless":0,"borderless":0}]', 'default','zh-cn'),
('article_browse', 'side', '[{"id":"6","grid":"","titleless":0,"borderless":0},{"id":"9","grid":"","titleless":0,"borderless":0}]', 'default','zh-cn'),
('article_view', 'side', '[{"id":"6","grid":"","titleless":0,"borderless":0},{"id":"9","grid":"","titleless":0,"borderless":0}]', 'default','zh-cn'),
('product_browse', 'side', '[{"id":"4","grid":"","titleless":0,"borderless":0},{"id":"7","grid":"","titleless":0,"borderless":0},{"id":"9","grid":"","titleless":0,"borderless":0}]', 'default','zh-cn'),
('product_view', 'side', '[{"id":"4","grid":"","titleless":0,"borderless":0},{"id":"7","grid":"","titleless":0,"borderless":0},{"id":"9","grid":"","titleless":0,"borderless":0}]', 'default','zh-cn'),
('message_index', 'side', '[{"id":"9","grid":"","titleless":0,"borderless":0}]', 'default','zh-cn'),
('blog_index', 'side', '[{"id":"8","grid":"","titleless":0,"borderless":0}]', 'default','zh-cn'),
('blog_view', 'side', '[{"id":"8","grid":"","titleless":0,"borderless":0}]', 'default','zh-cn'),
('page_index', 'side', '[{"id":"2","grid":"","titleless":0,"borderless":0},{"id":"9","grid":"","titleless":0,"borderless":0}]', 'default','zh-cn'),
('page_view', 'side', '[{"id":"2","grid":"","titleless":0,"borderless":0},{"id":"9","grid":"","titleless":0,"borderless":0}]', 'default','zh-cn'),
('all', 'top', '[{"id":"112","grid":"","titleless":0,"borderless":0}]', 'default','en'),
('index_index', 'top', '[{"id":"105","grid":"","titleless":0,"borderless":0}]', 'default','en'),
('index_index', 'middle', '[{"id":"103","grid":12,"titleless":0,"borderless":0},{"id":"110","grid":4,"titleless":0,"borderless":0},{"id":"101","grid":4,"titleless":0,"borderless":0},{"id":"109","grid":4,"titleless":0,"borderless":0}]', 'default','en'),
('index_index', 'bottom', '[{"id":"111","grid":"","titleless":0,"borderless":0}]', 'default','en'),
('company_index', 'side', '[{"id":"109","grid":"","titleless":0,"borderless":0},{"id":"113","grid":"","titleless":0,"borderless":0}]', 'default','en'),
('article_browse', 'side', '[{"id":"106","grid":"","titleless":0,"borderless":0},{"id":"109","grid":"","titleless":0,"borderless":0}]', 'default','en'),
('article_view', 'side', '[{"id":"106","grid":"","titleless":0,"borderless":0},{"id":"109","grid":"","titleless":0,"borderless":0}]', 'default','en'),
('product_browse', 'side', '[{"id":"104","grid":"","titleless":0,"borderless":0},{"id":"107","grid":"","titleless":0,"borderless":0},{"id":"109","grid":"","titleless":0,"borderless":0}]', 'default','en'),
('product_view', 'side', '[{"id":"104","grid":"","titleless":0,"borderless":0},{"id":"107","grid":"","titleless":0,"borderless":0},{"id":"109","grid":"","titleless":0,"borderless":0}]', 'default','en'),
('message_index', 'side', '[{"id":"109","grid":"","titleless":0,"borderless":0}]', 'default','en'),
('blog_index', 'side', '[{"id":"108","grid":"","titleless":0,"borderless":0}]', 'default','en'),
('blog_view', 'side', '[{"id":"108","grid":"","titleless":0,"borderless":0}]', 'default','en'),
('page_index', 'side', '[{"id":"102","grid":"","titleless":0,"borderless":0},{"id":"109","grid":"","titleless":0,"borderless":0}]', 'default','en'),
('page_view', 'side', '[{"id":"102","grid":"","titleless":0,"borderless":0},{"id":"109","grid":"","titleless":0,"borderless":0}]', 'default','en'),
('all', 'top', '[{"id":"212","grid":"","titleless":0,"borderless":0}]', 'default','zh-tw'),
('index_index', 'top', '[{"id":"205","grid":"","titleless":0,"borderless":0}]', 'default','zh-tw'),
('index_index', 'middle', '[{"id":"203","grid":12,"titleless":0,"borderless":0},{"id":"210","grid":4,"titleless":0,"borderless":0},{"id":"201","grid":4,"titleless":0,"borderless":0},{"id":"209","grid":4,"titleless":0,"borderless":0}]', 'default','zh-tw'),
('index_index', 'bottom', '[{"id":"211","grid":"","titleless":0,"borderless":0}]', 'default','zh-tw'),
('company_index', 'side', '[{"id":"209","grid":"","titleless":0,"borderless":0},{"id":"213","grid":"","titleless":0,"borderless":0}]', 'default','zh-tw'),
('article_browse', 'side', '[{"id":"206","grid":"","titleless":0,"borderless":0},{"id":"209","grid":"","titleless":0,"borderless":0}]', 'default','zh-tw'),
('article_view', 'side', '[{"id":"206","grid":"","titleless":0,"borderless":0},{"id":"209","grid":"","titleless":0,"borderless":0}]', 'default','zh-tw'),
('product_browse', 'side', '[{"id":"204","grid":"","titleless":0,"borderless":0},{"id":"207","grid":"","titleless":0,"borderless":0},{"id":"209","grid":"","titleless":0,"borderless":0}]', 'default','zh-tw'),
('product_view', 'side', '[{"id":"204","grid":"","titleless":0,"borderless":0},{"id":"207","grid":"","titleless":0,"borderless":0},{"id":"209","grid":"","titleless":0,"borderless":0}]', 'default','zh-tw'),
('message_index', 'side', '[{"id":"209","grid":"","titleless":0,"borderless":0}]', 'default','zh-tw'),
('blog_index', 'side', '[{"id":"208","grid":"","titleless":0,"borderless":0}]', 'default','zh-tw'),
('blog_view', 'side', '[{"id":"208","grid":"","titleless":0,"borderless":0}]', 'default','zh-tw'),
('page_index', 'side', '[{"id":"202","grid":"","titleless":0,"borderless":0},{"id":"209","grid":"","titleless":0,"borderless":0}]', 'default','zh-tw'),
('page_view', 'side', '[{"id":"202","grid":"","titleless":0,"borderless":0},{"id":"209","grid":"","titleless":0,"borderless":0}]', 'default','zh-tw');

-- Insert data into `eps_block`;
INSERT INTO `eps_block` (`id`, `type`, `title`, `content`, `template`, `lang`) VALUES
(1, 'latestArticle', '最新文章', '{"category":"0","limit":"7"}', 'default','zh-cn'),
(2, 'hotArticle', '热门文章', '{"category":"0","limit":"7"}', 'default','zh-cn'),
(3, 'latestProduct', '最新产品', '{"category":"0","limit":"3","image":"show"}', 'default','zh-cn'),
(4, 'hotProduct', '热门产品', '{"category":"0","limit":"3","image":"show"}', 'default','zh-cn'),
(5, 'slide', '幻灯片', '', 'default','zh-cn'),
(6, 'articleTree', '文章分类', '{"showChildren":"0"}', 'default','zh-cn'),
(7, 'productTree', '产品分类', '{"showChildren":"0"}', 'default','zh-cn'),
(8, 'blogTree', '博客分类', '{"showChildren":"1"}', 'default','zh-cn'),
(9, 'contact', '联系我们', '', 'default','zh-cn'),
(10, 'about', '公司简介', '', 'default','zh-cn'),
(11, 'links', '友情链接', '', 'default','zh-cn'),
(12, 'header', '网站头部', '', 'default','zh-cn'),
(13, 'followUs', '关注我们', '', 'default','zh-cn');
INSERT INTO `eps_block` (`id`, `type`, `title`, `content`, `template`, `lang`) VALUES
(101, 'latestArticle', 'Latest Article', '{"category":"0","limit":"7"}', 'default','en'),
(102, 'hotArticle', 'Hot Article', '{"category":"0","limit":"7"}', 'default','en'),
(103, 'latestProduct', 'Latest Product', '{"category":"0","limit":"3","image":"show"}', 'default','en'),
(104, 'hotProduct', 'Hot Product', '{"category":"0","limit":"3","image":"show"}', 'default','en'),
(105, 'slide', 'Slide', '', 'default','en'),
(106, 'articleTree', 'Article Category', '{"showChildren":"0"}', 'default','en'),
(107, 'productTree', 'Product Category', '{"showChildren":"0"}', 'default','en'),
(108, 'blogTree', 'Blog Category', '{"showChildren":"1"}', 'default','en'),
(109, 'contact', 'Contact Us', '', 'default','en'),
(110, 'about', 'About Us', '', 'default','en'),
(111, 'links', 'Link', '', 'default','en'),
(112, 'header', 'Header', '', 'default','en'),
(113, 'followUs', 'Follow Us', '', 'default','en');
INSERT INTO `eps_block` (`id`, `type`, `title`, `content`, `template`, `lang`) VALUES
(201, 'latestArticle', '最新文章', '{"category":"0","limit":"7"}', 'default','zh-tw'),
(202, 'hotArticle', '熱門文章', '{"category":"0","limit":"7"}', 'default','zh-tw'),
(203, 'latestProduct', '最新產品', '{"category":"0","limit":"3","image":"show"}', 'default','zh-tw'),
(204, 'hotProduct', '熱門產品', '{"category":"0","limit":"3","image":"show"}', 'default','zh-tw'),
(205, 'slide', '幻燈片', '', 'default','zh-tw'),
(206, 'articleTree', '文章分類', '{"showChildren":"0"}', 'default','zh-tw'),
(207, 'productTree', '產品分類', '{"showChildren":"0"}', 'default','zh-tw'),
(208, 'blogTree', '博客分類', '{"showChildren":"1"}', 'default','zh-tw'),
(209, 'contact', '聯繫我們', '', 'default','zh-tw'),
(210, 'about', '公司簡介', '', 'default','zh-tw'),
(211, 'links', '友情鏈接', '', 'default','zh-tw'),
(212, 'header', '網站頭部', '', 'default','zh-tw'),
(213, 'followUs', '關注我們', '', 'default','zh-tw');
