ALTER TABLE `eps_order` CHANGE `address` `address` text NOT NULL;
ALTER TABLE `eps_user`
ADD `os` char(30) NOT NULL,
ADD `browser` char(30) NOT NULL,
ADD `browserVersion` char(30) NOT NULL;
