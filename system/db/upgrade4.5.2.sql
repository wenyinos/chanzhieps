alter table eps_thread add `status` enum('wait','normal','fail') NOT NULL DEFAULT 'wait';
