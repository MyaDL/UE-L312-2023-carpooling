--
-- Structure de la table `users`
--

CREATE TABLE IF NOT EXISTS `users` (
    `user_id` int AUTO_INCREMENT NOT NULL,
    `firstname` varchar(255) NOT NULL,
    `lastname` varchar(255) NOT NULL,
    `email` varchar(255) NOT NULL,
    `birthday` datetime NOT NULL,
    PRIMARY KEY (`user_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Structure de la table `cars`
--

CREATE TABLE IF NOT EXISTS `cars` (
    `car_id` int AUTO_INCREMENT NOT NULL,
    `brand` varchar(255) NOT NULL,
    `model` varchar(255) NOT NULL,
    `color` varchar(255) NOT NULL,
    `nbrSlots` int(11) NOT NULL,
    PRIMARY KEY (`car_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Structure de la table `posts`
--

CREATE TABLE IF NOT EXISTS `posts` (
    `post_id` int AUTO_INCREMENT NOT NULL,
    `price` int(11) NOT NULL,
    `start_address` varchar(255) NOT NULL,
    `arrival_address` varchar(255) NOT NULL,
    `start_date_time` datetime NOT NULL,
    `message` varchar(255) NOT NULL,
    PRIMARY KEY (`post_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Structure de la table `bookings`
--

CREATE TABLE IF NOT EXISTS `bookings` (
    `booking_id` int AUTO_INCREMENT NOT NULL,
    `payment_method` varchar(255) NOT NULL,
    PRIMARY KEY (`booking_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Structure de la table `users_cars` table de liaison entre users et cars
--

CREATE TABLE IF NOT EXISTS users_cars (
    `user_car_id` INT AUTO_INCREMENT NOT NULL,
    `user_id` INT NOT NULL,
    `car_id` INT NOT NULL,
    PRIMARY KEY(`user_car_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Structure de la table `users_posts` table de liaison entre users et posts
--

CREATE TABLE IF NOT EXISTS users_posts (
    `user_post_id` INT AUTO_INCREMENT NOT NULL,
    `user_id` INT NOT NULL,
    `post_id` INT NOT NULL,
    PRIMARY KEY(`user_post_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Structure de la table `users_bookings` table de liaison entre users et bookings
--

CREATE TABLE IF NOT EXISTS users_bookings (
    `user_booking_id` INT AUTO_INCREMENT NOT NULL,
    `user_id` INT NOT NULL,
    `booking_id` INT NOT NULL,
    PRIMARY KEY(`user_booking_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Structure de la table `posts_cars` table de liaison entre posts et cars
--

CREATE TABLE IF NOT EXISTS posts_cars (
    `post_car_id` INT AUTO_INCREMENT NOT NULL,
    `post_id` INT NOT NULL,
    `car_id` INT NOT NULL,
    PRIMARY KEY(`post_car_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Structure de la table `posts_bookings` table de liaison entre posts et bookings
--

CREATE TABLE IF NOT EXISTS posts_bookings (
    `post_booking_id` INT AUTO_INCREMENT NOT NULL,
    `post_id` INT NOT NULL,
    `booking_id` INT NOT NULL,
    PRIMARY KEY(`post_booking_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;