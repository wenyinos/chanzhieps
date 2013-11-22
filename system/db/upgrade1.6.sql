ALTER TABLE `eps_user` ADD `fails` tinyint unsigned NOT NULL DEFAULT '0' AFTER `last`,
ADD `locked` int(10) unsigned NOT NULL DEFAULT '0' AFTER `fails`;
ALTER TABLE `eps_product` ADD `mall` VARCHAR( 255 ) NOT NULL AFTER `alias`;
ALTER TABLE `eps_file` ADD `editor` ENUM( '0', '1' ) NOT NULL DEFAULT '0' AFTER `primary`;
ALTER TABLE `eps_block` CHANGE `type` `type` VARCHAR( 20 ) NOT NULL;
