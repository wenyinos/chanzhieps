ALTER TABLE `eps_article` CHANGE `original` `source` enum('original','copied','translational') NOT NULL;
ALTER TABLE `eps_category` CHANGE `desc` `desc` text NOT NULL;
