ALTER TABLE `eps_user` ADD `fails` tinyint unsigned NOT NULL DEFAULT '0' AFTER `last`,
ADD `locked` char(10) COLLATE 'utf8_general_ci' NOT NULL DEFAULT '' AFTER `fails`;
