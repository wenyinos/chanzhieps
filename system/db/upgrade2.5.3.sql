ALTER TABLE `eps_article` ADD `css` text NOT NULL, ADD `js` text NOT NULL;

ALTER TABLE `eps_product` ADD `css` text NOT NULL, ADD `js` text NOT NULL;

UPDATE eps_product set `order` = `id`;

INSERT INTO eps_config (`owner`, `module`, `section`, `key`, `value`) SELECT 'system', 'common', 'site', 'allowUpload', count(*) as value 
FROM eps_config where module = 'common' and `section` = 'site' and `key` = 'moduleEnabled' and value like '%upload%';

update eps_config set value = replace(value, ',upload', '') where module = 'common' and `section` = 'site' and `key` = 'moduleEnabled';
update eps_config set value = replace(value, 'upload,', '') where module = 'common' and `section` = 'site' and `key` = 'moduleEnabled';


