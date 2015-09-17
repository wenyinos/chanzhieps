RENAME TABLE `eps_orderProduct` TO `eps_order_product`;

ALTER TABLE `eps_article` MODIFY COLUMN `source` enum('original','copied','translational','article') NOT NULL; 

CREATE TABLE IF NOT EXISTS `eps_score` (
  `id` mediumint(8) unsigned NOT NULL AUTO_INCREMENT,
  `account` varchar(30) NOT NULL,
  `method` varchar(30) NOT NULL,
  `type` varchar(10) NOT NULL,
  `count` smallint(5) unsigned NOT NULL,
  `before` mediumint(5) NOT NULL,
  `after` mediumint(5) NOT NULL,
  `objectType` varchar(30) NOT NULL,
  `objectID` mediumint(9) NOT NULL,
  `actor` varchar(30) NOT NULL,
  `note` varchar(255) NOT NULL,
  `time` datetime NOT NULL,
  `lang` char(30) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `account` (`account`),
  KEY `method` (`method`),
  KEY `objectType` (`objectType`),
  KEY `objectID` (`objectID`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8;

ALTER TABLE `eps_user`
ADD `score` mediumint NOT NULL AFTER `last`,
ADD `rank` mediumint NOT NULL AFTER `score`,
ADD `maxLogin` tinyint(4) NOT NULL DEFAULT '10' AFTER `rank`;

ALTER TABLE `eps_file` ADD `score` smallint unsigned NOT NULL DEFAULT 0 AFTER `public`;

-- DROP TABLE IF EXISTS `eps_statvisitor`
CREATE TABLE IF NOT EXISTS `eps_statvisitor`(
  `id` int(9) unsigned NOT NULL auto_increment,
  `osName` varchar(100) NOT NULL,
  `osVersion` varchar(100) NOT NULL,
  `browserName` varchar(100) NOT NULL,
  `browserVersion` varchar(100) NOT NULL,
  `browserLanguage` varchar(100) NOT NULL,
  `device` varchar(100) NOT NULL,
  `resolution` varchar(100) NOT NULL,
  `createdTime` datetime not null,
  primary key (`id`),
  KEY `osName` (`osName`),
  KEY `browsername` (`browsername`),
  KEY `device` (`device`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

-- DROP TABLE IF EXISTS `eps_statreferer`
CREATE TABLE IF NOT EXISTS `eps_statreferer`(
  `id` int(9) unsigned NOT NULL auto_increment,
  `url` text NOT NULL,
  `domain` varchar(200) NOT NULL,
  primary key (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

-- DROP TABLE IF EXISTS `eps_statlog`;
CREATE TABLE IF NOT EXISTS `eps_statlog`(
  `id` int(9) unsigned NOT NULL auto_increment,
  `referer` int(8) NOT NULL,
  `visitor` int(8) NOT NULL,
  `ip` char(15) NOT NULL,
  `country` varchar(100) NOT NULL,
  `province` varchar(100) NOT NULL,
  `city` varchar(100) NOT NULL,
  `account` char(30) NOT NULL,
  `year` char(4) NOT NULL,
  `month` char(6) NOT NULL,
  `day` char(8) NOT NULL,
  `hour` char(2) NOT NULL,
  `new` tinyint(3) unsigned NOT NULL default 1,
  `mobile` tinyint(3) unsigned NOT NULL default 0,
  PRIMARY KEY (`id`),
  KEY `ip` (`ip`),
  KEY `referer` (`referer`),
  KEY `time` (`year`, `month`, `day`, `hour`),
  KEY `location` (`country`, `province`, `city`),
  KEY `mobile` (`mobile`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

-- DROP TABLE IF EXISTS `eps_statreport`;
CREATE TABLE IF NOT EXISTS `eps_statreport`(
  `id` int(9) unsigned NOT NULL auto_increment,
  `type` char(30) not null,
  `item` char(100) NOT NULL default 0,
  `extral` varchar(200) NOT NULL default 0,
  `timeType` enum('year', 'month', 'date', 'hour') NOT NULL default 'hour',
  `timeValue` char(10) NOT NULL default 0,
  `pv` mediumint(9) unsigned NOT NULL default 0,
  `uv` mediumint(9) unsigned NOT NULL default 0,
  `ip` mediumint(9) unsigned NOT NULL default 0,
  PRIMARY KEY (`id`),
  KEY `time` (`timeType`, `timeValue`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

-- DROP TABLE IF EXISTS `eps_statregion`;
CREATE TABLE IF NOT EXISTS `eps_statregion`(
  `id` int(9) unsigned NOT NULL auto_increment,
  `timeType` enum('year', 'month', 'date', 'hour') NOT NULL default 'hour',
  `timeValue` char(10) NOT NULL default 0,
  `country` varchar(100) NOT NULL,
  `province` varchar(100) NOT NULL,
  `city` varchar(100) NOT NULL,
  `pv` mediumint(9) unsigned NOT NULL default 0,
  `uv` mediumint(9) unsigned NOT NULL default 0,
  `ip` mediumint(9) unsigned NOT NULL default 0,
  PRIMARY KEY (`id`),
  KEY `region` (`country`, `province`, `city`),
  KEY `time` (`timeType`, `timeValue`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

ALTER TABLE `eps_order` ADD `type` varchar(30) NOT NULL AFTER `status`; 
