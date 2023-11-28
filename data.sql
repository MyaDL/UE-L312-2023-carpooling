INSERT INTO `users` (`firstname`, `lastname`, `email`, `birthday`) VALUES
('Vincent', 'Godé', 'hello@vincentgo.fr', '1990-11-08'),
('Albert', 'Dupond', 'sonemail@gmail.com', '1985-11-08'),
('Thomas', 'Dumoulin', 'sonemail2@gmail.com', '1985-10-08');

INSERT INTO `cars` (`brand`, `model`, `color`, `nbrSlots`) VALUES
('Skoda', 'Fabia', 'Noire', 5),
('Huandai', 'Getz', 'Rouge', 5),
('Mercedes', 'Classe C', 'Noire', 4),
('Renaut', 'Zoé', 'Bleu', 2);

INSERT INTO `posts` (`price`, `start_address`, `arrival_address`, `start_date_time`, `message`) VALUES
('12', 'Tours', 'Châteaudun', '2023-12-24 15:40:00.000000', 'Bonne humeur avant les fêtes !'),
('16', 'Paris', 'Bordeaux', '2023-12-12 10:00:00.000000', 'Musique tout le trajet'),
('30', 'Caen', 'Marseille', '2023-01-05 06:45:00.000000', 'Calme please');

INSERT INTO `bookings` (`payment_method`) VALUES
('Carte'),
('PayPal');

INSERT INTO `users_cars` (`user_id`, `car_id`) VALUES
(1, 1),
(1, 2),
(2, 3),
(3, 4);

INSERT INTO `users_posts` (`user_id`, `post_id`) VALUES
(1, 1),
(1, 2),
(2, 3),
(3, 3);

INSERT INTO `users_bookings` (`user_id`, `booking_id`) VALUES
(1, 1),
(1, 2),
(2, 2),
(3, 1);

INSERT INTO `posts_cars` (`post_id`, `car_id`) VALUES
(1, 1),
(1, 2),
(2, 2),
(3, 4);

INSERT INTO `posts_bookings` (`post_id`, `booking_id`) VALUES
(1, 1),
(3, 2),
(2, 2),
(3, 2);