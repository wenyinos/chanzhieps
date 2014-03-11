CREATE TABLE IF NOT EXISTS `eps_wx_public` (
  `id` smallint(5) unsigned NOT NULL AUTO_INCREMENT,
  `account` varchar(20) NOT NULL,
  `name` varchar(60) NOT NULL,
  `appID` char(30) NOT NULL,
  `appSecret` char(32) NOT NULL,
  `url` varchar(100) NOT NULL,
  `token` varchar(100) NOT NULL,
  `type` enum('subscribe', 'service') NOT NULL,
  `addedDate` datetime NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

CREATE TABLE IF NOT EXISTS `eps_wx_response` (
  `id` smallint(5) unsigned NOT NULL AUTO_INCREMENT,
  `public` smallint(3) NOT NULL,
  `key` varchar(100) NOT NULL,
  `group` varchar(100) NOT NULL,
  `type` enum('text', 'rich', 'link') NOT NULL, 
  `source` enum('system', 'manual') NOT NULL,
  `content` text NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

CREATE TABLE IF NOT EXISTS `eps_wx_message` (
  `id` mediumint(10) unsigned NOT NULL AUTO_INCREMENT,
  `public` smallint(3) NOT NULL,
  `wid`      char(64) NOT NULL, 
  `rid`      char(64) NOT NULL, 
  `replyer`  varchar(30) NOT NULL,
  `to`       varchar(50) NOT NULL,
  `from`     varchar(50) NOT NULL,
  `response` smallint(5) NOT NULL,
  `content`  text NOT NULL,
  `type`     char(30) NOT NULL,
  `status`   enum('wait', 'replied'),
  `time`     datetime NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;
