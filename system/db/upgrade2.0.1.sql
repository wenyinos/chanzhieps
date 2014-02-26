ALTER TABLE `eps_file` ADD `width` smallint unsigned NOT NULL AFTER `size`,
ADD `height` smallint unsigned NOT NULL AFTER `width`;
