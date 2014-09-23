ALTER TABLE `eps_article` ADD `css` text NOT NULL, ADD `js` text NOT NULL;

ALTER TABLE `eps_product` ADD `css` text NOT NULL, ADD `js` text NOT NULL;

UPDATE eps_product set `order` = `id`;
