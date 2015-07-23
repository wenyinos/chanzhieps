ALTER TABLE `eps_product` ADD `unsaleable` enum('0', '1') NOT NULL DEFAULT '0' AFTER `alias`;
ALTER TABLE `eps_category` ADD `unsaleable` enum('0', '1') NOT NULL DEFAULT '0' AFTER `link`;
