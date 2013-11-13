ALTER TABLE `eps_user` ADD `fails` tinyint unsigned NOT NULL DEFAULT '0' AFTER `last`,
ADD `locked` int(10) unsigned NOT NULL DEFAULT '0' AFTER `fails`;
ALTER TABLE `eps_product` ADD `buyLink` VARCHAR( 300 ) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL AFTER `alias` 
