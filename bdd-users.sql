-- Adminer 4.8.1 MySQL 5.5.5-10.6.9-MariaDB-1:10.6.9+maria~ubu2004 dump

SET NAMES utf8;
SET time_zone = '+00:00';
SET foreign_key_checks = 0;
SET sql_mode = 'NO_AUTO_VALUE_ON_ZERO';

SET NAMES utf8mb4;

DROP TABLE IF EXISTS `users`;
CREATE TABLE `users` (
  `id` int(5) NOT NULL AUTO_INCREMENT,
  `username` varchar(255) NOT NULL,
  `password` text NOT NULL,
  `mail` text NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

INSERT INTO `users` (`id`, `username`, `password`, `mail`) VALUES
(1,	'Mathieu',	'a94a8fe5ccb19ba61c4c0873d391e987982fbbd3',	'mathieu@ecv-mail.fr'),
(3,	'toto',	'a94a8fe5ccb19ba61c4c0873d391e987982fbbd3',	'toto@mail.fr');

-- 2023-02-28 17:21:46