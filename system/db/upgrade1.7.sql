ALTER TABLE `eps_thread` CHANGE `readonly` `readonly` tinyint(1) NOT NULL DEFAULT '0' AFTER `editedDate`;
ALTER TABLE `eps_product` ADD `status` varchar(20) COLLATE 'utf8_general_ci' NOT NULL DEFAULT 'normal' AFTER `editedDate`;
