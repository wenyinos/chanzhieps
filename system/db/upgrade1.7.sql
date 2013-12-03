ALTER TABLE `eps_thread` CHANGE `readonly` `readonly` tinyint(1) NOT NULL DEFAULT '0' AFTER `editedDate`;
ALTER TABLE `eps_product` ADD `status` varchar(20) COLLATE 'utf8_general_ci' NOT NULL DEFAULT 'normal' AFTER `editedDate`;

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
  PRIMARY KEY (`id`),
  KEY `order` (`order`),
  KEY `parent` (`parent`),
  KEY `path` (`path`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8;
ALTER TABLE `eps_article` ADD `status` varchar(20) COLLATE 'utf8_general_ci' NOT NULL DEFAULT 'normal' AFTER `editedDate`;
