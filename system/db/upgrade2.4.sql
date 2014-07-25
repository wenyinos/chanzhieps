ALTER TABLE `eps_message` ADD `receiveEmail` enum('0','1') NOT NULL DEFAULT '0';
ALTER TABLE `eps_category` ADD `link` varchar(255) NOT NULL;
ALTER TABLE `eps_article` ADD `link` varchar(255) NOT NULL;
ALTER TABLE `eps_thread` ADD `link` varchar(255) NOT NULL;
