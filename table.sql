
DROP TABLE IF EXISTS `cities`;
CREATE TABLE `cities` (
  `city` varchar(30) DEFAULT NULL,
  `lat` float DEFAULT NULL,
  `lng` float DEFAULT NULL,
  `country` varchar(25) DEFAULT NULL,
  `iso2` varchar(10) DEFAULT NULL,
  `iso3` varchar(10) DEFAULT NULL,
  `admin_name` varchar(30) DEFAULT NULL,
  `population` int(11) DEFAULT NULL,
  `id` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3 COLLATE=utf8mb3_unicode_ci;