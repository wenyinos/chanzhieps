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
