ALTER TABLE `eps_user` CHANGE `public` `public` varchar(30) NOT NULL DEFAULT '0';
ALTER TABLE `eps_article` CHANGE `original` `original` enum('0','1','2') NOT NULL;
