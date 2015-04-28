CREATE TABLE IF NOT EXISTS `eps_group` (
  `id` mediumint(8) unsigned NOT NULL auto_increment,
  `name` char(30) NOT NULL,
  `role` char(30) NOT NULL default '',
  `desc` char(255) NOT NULL default '',
  `lang` char(30) NOT NULL,
  PRIMARY KEY  (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8;
CREATE TABLE IF NOT EXISTS `eps_grouppriv` (
  `group` mediumint(8) unsigned NOT NULL default '0', 
  `module` char(30) NOT NULL default '',
  `method` char(30) NOT NULL default '',
  `lang` char(30) NOT NULL,
  UNIQUE KEY `group` (`group`,`module`,`method`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;
CREATE TABLE IF NOT EXISTS `eps_usergroup` (
  `account` char(30) NOT NULL default '',
  `group` mediumint(8) unsigned NOT NULL default '0',
  `lang` char(30) NOT NULL,
  UNIQUE KEY `account` (`account`,`group`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

ALTER TABLE `eps_category` CHANGE `name` `name` varchar(100) NOT NULL;
ALTER TABLE `eps_user` ADD `realnames` varchar(100) NOT NULL default '';
ALTER TABLE `eps_thread` ADD `color` char(10) NOT NULL AFTER `title`;
