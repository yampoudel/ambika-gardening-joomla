CREATE TABLE IF NOT EXISTS  `#__simplemembership_api` (
    `id` int(11) NOT NULL AUTO_INCREMENT,
    `service` varchar(255) NOT NULL,
    `key` text NOT NULL,
    PRIMARY KEY  (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;