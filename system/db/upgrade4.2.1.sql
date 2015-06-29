ALTER TABLE `eps_user` ADD `emailCertified` enum('0', '1') NOT NULL DEFAULT '0' AFTER `public`;
ALTER TABLE `eps_product` CHANGE `mall` `mall` text NOT NULL;
ALTER TABLE `eps_log` DROP `fingerprint`;

CREATE TABLE IF NOT EXISTS `eps_slide` (
  `id` smallint(5) unsigned NOT NULL AUTO_INCREMENT,
  `title` varchar(60) NOT NULL,
  `titleColor` char(10) NOT NULL,
  `mainLink` varchar(255) NOT NULL,
  `backgroundType` char(20) NOT NULL,
  `backgroundColor` char(10) NOT NULL,
  `height` smallint(5) unsigned NOT NULL DEFAULT '0',
  `image` char(60) NOT NULL,
  `label` varchar(255) NOT NULL,
  `buttonClass` varchar(255) NOT NULL,
  `buttonUrl` varchar(255) NOT NULL,
  `buttonTarget` varchar(30) NOT NULL,
  `summary` text NOT NULL,
  `createdDate` datetime NOT NULL,
  `createdBy` char(30) NOT NULL,
  `editedDate` datetime NOT NULL,
  `editedBy` char(30) NOT NULL,
  `order` smallint(5) unsigned NOT NULL DEFAULT '0',
  `lang` char(30) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `lang` (`lang`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8;

ALTER TABLE `eps_log` CHANGE `position` `location` char(100) NOT NULL;
