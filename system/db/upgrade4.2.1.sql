ALTER TABLE `eps_user` ADD `emailCertified` enum('0', '1') NOT NULL DEFAULT '0' AFTER `public`;
ALTER TABLE `eps_log` DROP `fingerprint`;
