ALTER TABLE `eps_article` ADD `addedBy` varchar(60) NOT NULL;
ALTER TABLE `eps_article` ADD `contribution` int(1) NOT NULL DEFAULT '0';

ALTER table eps_thread ADD `status` char(10) NOT NULL; 
ALTER table eps_thread ADD `ip` char(15) NOT NULL;

CREATE TABLE IF NOT EXISTS  `eps_blacklist` (
  `type` varchar(30) NOT NULL,
  `identity` varchar(100) NOT NULL,
  `reason` varchar(100) NOT NULL,
  `expiredDate` datetime NOT NULL,
  `lang` char(30) NOT NULL,
  UNIQUE KEY `identity` (`type`, `identity`, `lang`),
  KEY `expiredDate` (`expiredDate`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8;

CREATE TABLE IF NOT EXISTS  `eps_operationlog` (
  `id` mediumint(8) NOT NULL AUTO_INCREMENT,
  `type` varchar(30) NOT NULL,
  `identity` varchar(100) NOT NULL,
  `operation` varchar(200) NOT NULL,
  `count` smallint(5) unsigned not null default 0,
  `createdTime` datetime NOT NULL,
  `lang` char(30) NOT NULL,
  primary key (`id`),
  KEY operation (`type`, `identity`, `operation`, `createdTime`),
  KEY `lang` (`lang`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8;
