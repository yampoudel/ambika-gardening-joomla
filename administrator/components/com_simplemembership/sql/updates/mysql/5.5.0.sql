CREATE TABLE IF NOT EXISTS `#__simplemembership_messages` (
  `msg_id` int(11) NOT NULL AUTO_INCREMENT,
  `sender_id` int(11),
  `sender_name` varchar(255),
  `sender_email` varchar(255),
  `recipient_id` int(11),
  `recipient_name` varchar(255),
  `recipient_email` varchar(255),
  `message` text,
  `msg_date` datetime NOT NULL,
  `read` tinyint(4),
PRIMARY KEY (`msg_id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;