CREATE TABLE IF NOT EXISTS `posts` (
    `id` int(11) NOT NULL,
    `creator_id` int(11) NOT NULL,
    `start_address` varchar(255) NOT NULL,
    `arrival_address` varchar(255) NOT NULL,
    `start_date_time` datetime NOT NULL,
    `message` varchar(255) NOT NULL,
    PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

INSERT INTO `posts` (`id`, `creator_id`, `start_address`, `arrival_address`, `start_date_time`, `message`) VALUES
(1, 1, 'Tours', 'Poitiers', '2023-12-25 21:40:00.000000', 'Bonne humeur après les fesses'),
(2, 2, 'Limoges', 'Paris', '2023-12-13 18:15:00.000000', 'Vous êtes les bienvenues');

