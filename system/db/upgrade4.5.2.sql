ALTER TABLE `eps_thread` ADD `status` enum('wait','normal','fail') NOT NULL DEFAULT 'wait';
ALTER TABLE `eps_article` ADD `addedBy` varchar(60) NOT NULL;
ALTER TABLE `eps_article` ADD `contribution` int(1) NOT NULL DEFAULT '0';

CREATE TABLE IF NOT EXISTS  `eps_blacklist` (
  `type` varchar(30) NOT NULL,
  `value` varchar(200) NOT NULL,
  `resion` varchar(100) NOT NULL,
  `expiredDate` datetime NOT NULL,
  `lang` char(30) NOT NULL,
  UNIQUE KEY `value` (`type`, `value`, `lang`),
  KEY `expired` (`expired`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8;

CREATE TABLE IF NOT EXISTS  `eps_operationlog` (
  `id` mediumint(8) NOT NULL AUTO_INCREMENT,
  `type` varchar(30) NOT NULL,
  `operation` varchar(200) NOT NULL,
  `createDtime` datetime NOT NULL,
  `lang` char(30) NOT NULL,
  primary key (`id`),
  KEY operation (`type`, `operation`, `operateTime`),
  KEY `lang` (`lang`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8;

alter table eps_thread add `status` char(10) NOT NULL;
