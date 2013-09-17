CREATE TABLE IF NOT EXISTS `zt_openID` (
  `account` varchar(30) character set utf8 NOT NULL,
  `provider` varchar(30) character set utf8 NOT NULL,
  `openID` varchar(60) character set utf8 NOT NULL,
  UNIQUE KEY `account` (`account`,`provider`,`openID`)
  ) ENGINE=MyISAM DEFAULT CHARSET=utf8;
