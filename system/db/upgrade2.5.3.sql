ALTER TABLE `eps_article` ADD `css` text NOT NULL,
ADD `js` text NOT NULL;

UPDATE eps_product set `order` = `id`;
