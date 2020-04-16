ALTER TABLE `#__simplemembership_users`
ADD `registration_type` varchar(255) COLLATE 'utf8_general_ci' NOT NULL,
ADD `social_id` varchar(255) COLLATE 'utf8_general_ci' NOT NULL AFTER `registration_type`;