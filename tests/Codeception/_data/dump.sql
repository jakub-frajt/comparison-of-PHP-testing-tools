CREATE TABLE `users` (
  `id` int NOT NULL AUTO_INCREMENT PRIMARY KEY,
  `first_name` varchar(128) COLLATE 'utf8_general_ci' NOT NULL,
  `last_name` varchar(128) COLLATE 'utf8_general_ci' NOT NULL,
  `email` varchar(128) COLLATE 'utf8_general_ci' NOT NULL,
  `active` tinyint(1) NOT NULL,
  `created` date NOT NULL
);
