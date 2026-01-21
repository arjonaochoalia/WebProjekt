SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";

/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

-- Datenbank: `beautylab`

-- --------------------------------------------------------
-- Tabellenstruktur für Tabelle `users`
-- --------------------------------------------------------

CREATE TABLE `users` (
  `user_id` int(11) NOT NULL,
  `username` varchar(50) NOT NULL,
  `first_name` varchar(50) NOT NULL,
  `last_name` varchar(50) NOT NULL,
  `email` varchar(100) NOT NULL,
  `user_password` varchar(255) NOT NULL,
  `user_role` varchar(50) DEFAULT 'user',
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `image_path` varchar(255) DEFAULT 'profile_pictures/placeholder.jpg'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- 13 Users (3 Admins, 10 Regular Users)
INSERT INTO `users` (`user_id`, `username`, `first_name`, `last_name`, `email`, `user_password`, `user_role`, `created_at`, `image_path`) VALUES
(1, 'liaa05', 'Lia', 'Arjona', 'arjona.lia05@gmail.com', '$2y$10$8kO8GlW2NT8Kjet/aygpCuEYI/nEYU4PyXGQb5kJVmw5RoZUiDonW', 'admin', '2026-01-07 10:12:15', 'profile_pictures/lia.jpg'),
(3, 'supjan', 'Jan', 'Jakumov', 'supjan@pm.me', '$2y$10$TGdfQhzKnPhLCf5KPQbDNu4/Ke4CP/gzJrOxzRdk0Bm5d.RQb1M7O', 'admin', '2025-11-11 12:11:06', 'profile_pictures/jan.jpg'),
(4, 'admin_clara', 'Clara', 'Müller', 'clara@beautylab.at', '$2y$10$8kO8GlW2NT8Kjet/aygpCuEYI/nEYU4PyXGQb5kJVmw5RoZUiDonW', 'admin', '2025-12-01 09:00:00', 'profile_pictures/clara.jpg'),
(21, 'ember', 'Ember', 'Gray', 'ember@example.com', '$2y$10$cBFdaAM2nEWvixGGf5gCXO.SWp8lU4nVNZ3itHfoTnBvN4jHZ14hC', 'user', '2025-11-26 10:54:53', 'profile_pictures/placeholder.jpg'),
(22, 'flint', 'Flint', 'Cole', 'flint@example.com', '$2y$10$cBFdaAM2nEWvixGGf5gCXO.SWp8lU4nVNZ3itHfoTnBvN4jHZ14hC', 'user', '2025-11-26 10:54:53', 'profile_pictures/placeholder.jpg'),
(23, 'glam_sara', 'Sara', 'Jenkins', 'sara@example.com', '$2y$10$cBFdaAM2nEWvixGGf5gCXO.SWp8lU4nVNZ3itHfoTnBvN4jHZ14hC', 'user', '2025-11-26 10:55:00', 'profile_pictures/placeholder.jpg'),
(24, 'onyx', 'Onyx', 'Black', 'onyx@example.com', '$2y$10$cBFdaAM2nEWvixGGf5gCXO.SWp8lU4nVNZ3itHfoTnBvN4jHZ14hC', 'user', '2025-11-26 10:54:54', 'profile_pictures/placeholder.jpg'),
(25, 'ruby_red', 'Ruby', 'Rose', 'ruby@example.com', '$2y$10$cBFdaAM2nEWvixGGf5gCXO.SWp8lU4nVNZ3itHfoTnBvN4jHZ14hC', 'user', '2025-11-27 11:00:00', 'profile_pictures/placeholder.jpg'),
(26, 'zen_master', 'Zen', 'Hill', 'zen@example.com', '$2y$10$cBFdaAM2nEWvixGGf5gCXO.SWp8lU4nVNZ3itHfoTnBvN4jHZ14hC', 'user', '2025-11-26 10:54:54', 'profile_pictures/placeholder.jpg'),
(27, 'sophie_mua', 'Sophie', 'Bauer', 'sophie@example.at', '$2y$10$cBFdaAM2nEWvixGGf5gCXO.SWp8lU4nVNZ3itHfoTnBvN4jHZ14hC', 'user', '2025-12-05 14:20:00', 'profile_pictures/placeholder.jpg'),
(28, 'max_style', 'Max', 'Mustermann', 'max@example.com', '$2y$10$cBFdaAM2nEWvixGGf5gCXO.SWp8lU4nVNZ3itHfoTnBvN4jHZ14hC', 'user', '2025-12-10 08:45:00', 'profile_pictures/placeholder.jpg'),
(29, 'lara_lashes', 'Lara', 'Croft', 'lara@tomb.com', '$2y$10$cBFdaAM2nEWvixGGf5gCXO.SWp8lU4nVNZ3itHfoTnBvN4jHZ14hC', 'user', '2025-12-15 12:00:00', 'profile_pictures/placeholder.jpg'),
(30, 'simon_skin', 'Simon', 'Digital', 'simon@tech.com', '$2y$10$cBFdaAM2nEWvixGGf5gCXO.SWp8lU4nVNZ3itHfoTnBvN4jHZ14hC', 'user', '2025-12-20 16:30:00', 'profile_pictures/placeholder.jpg');

-- --------------------------------------------------------
-- Tabellenstruktur für Tabelle `events`
-- --------------------------------------------------------

CREATE TABLE `events` (
  `event_id` int(11) NOT NULL,
  `admin_id` int(11) NOT NULL,
  `title` varchar(150) NOT NULL,
  `description` text DEFAULT NULL,
  `location` varchar(255) DEFAULT NULL,
  `event_date` date DEFAULT NULL,
  `event_time` time DEFAULT NULL,
  `image_path` varchar(255) DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- 6 Beauty & Wellness Events
INSERT INTO `events` (`event_id`, `admin_id`, `title`, `description`, `location`, `event_date`, `event_time`, `image_path`, `created_at`) VALUES
(1, 4, 'Skincare 101: Glow Up Secrets', 'Lernen Sie die Grundlagen der Hautpflege, von der Reinigung bis zum Sonnenschutz. Unsere Experten analysieren Ihren Hauttyp und erstellen eine individuelle Routine für den perfekten Glow.', 'BeautyLab Studio 1, 1070 Wien', '2025-12-12', '17:00:00', 'Bilder/skincare101.jpg', '2025-11-14 14:17:42'),
(2, 4, 'Morning Flow Yoga & Face Yoga', 'Starten Sie den Tag mit einer entspannenden Yoga-Session, kombiniert mit Face-Yoga-Übungen, um die Gesichtsmuskulatur zu straffen und Verspannungen zu lösen.', 'Stadtpark (Pavillon), 1030 Wien', '2026-04-15', '09:00:00', 'Bilder/yoga_face.jpg', '2025-12-01 10:00:00'),
(3, 3, 'DIY Organic Face Masks Workshop', 'Mischen Sie Ihre eigenen Gesichtsmasken aus 100% natürlichen Zutaten wie Honig, Aloe Vera und Tonerde. Nehmen Sie Ihre Kreationen in schönen Gläsern mit nach Hause.', 'Workshop Space B, 1010 Wien', '2026-02-10', '14:00:00', 'Bilder/diy_mask.jpg', '2025-11-14 14:50:50'),
(4, 1, 'Bridal Makeup Masterclass', 'Ein intensiver Kurs für angehende Visagisten oder Bräute, die ihr Hochzeits-Make-up selbst machen möchten. Fokus auf Haltbarkeit und Fotogenität.', 'Hotel Sacher Seminarraum, 1010 Wien', '2026-03-22', '10:00:00', 'Bilder/bridal_makeup.jpg', '2025-11-14 14:51:02'),
(5, 4, 'Aromatherapy & Stress Relief', 'Tauchen Sie ein in die Welt der ätherischen Öle. Lernen Sie, welche Düfte Stress abbauen, Energie spenden oder den Schlaf fördern.', 'Wellness Center, 1090 Wien', '2026-01-20', '18:30:00', 'Bilder/aromatherapy.jpg', '2025-12-05 11:00:00'),
(6, 1, 'Hair Styling Basics: Braids & Waves', 'Lernen Sie einfache, aber effektvolle Frisuren für den Alltag. Wir üben verschiedene Flechttechniken und das Styling mit dem Lockenstab.', 'Friseursalon Shine, 1060 Wien', '2026-05-05', '16:00:00', 'Bilder/hair_styling.jpg', '2025-12-10 09:00:00');

-- --------------------------------------------------------
-- Tabellenstruktur für Tabelle `reviews`
-- --------------------------------------------------------

CREATE TABLE `reviews` (
  `review_id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `content` text NOT NULL,
  `created_at` datetime DEFAULT current_timestamp(),
  `rating` int(1) NOT NULL DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- Reviews focused on Beauty/Wellness
INSERT INTO `reviews` (`review_id`, `user_id`, `content`, `created_at`, `rating`) VALUES
(6, 21, 'The Skincare 101 event changed my life! Finally found a routine that works for my sensitive skin.', '2025-12-13 12:10:49', 5),
(7, 22, 'I attended the Bridal Makeup class. The teacher was lovely, but I wished we had more time for eyeliner practice.', '2025-11-26 12:10:49', 4),
(12, 25, 'Face Yoga was surprisingly effective! My jaw feels so much more relaxed.', '2025-07-16 10:00:00', 5),
(13, 27, 'The DIY Mask workshop was fun, but a bit messy. The honey mask smells great though!', '2025-05-11 09:30:00', 4),
(14, 28, 'Aromatherapy session was pure bliss. I slept like a baby afterwards.', '2025-06-23 11:00:00', 5),
(15, 30, 'Great hair tips! Finally learned how to do a french braid properly.', '2025-08-21 14:00:00', 5),
(16, 23, 'Loved the organic ingredients used in the DIY workshop. Very eco-friendly!', '2026-02-11 09:15:00', 5),
(17, 29, 'The skincare analysis was very detailed. Highly recommend.', '2025-12-14 18:20:00', 5);

-- --------------------------------------------------------
-- Tabellenstruktur für Tabelle `user_events`
-- --------------------------------------------------------

CREATE TABLE `user_events` (
  `id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `event_id` int(11) NOT NULL,
  `is_favorite` tinyint(1) DEFAULT 0,
  `is_participating` tinyint(1) DEFAULT 0,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

INSERT INTO `user_events` (`id`, `user_id`, `event_id`, `is_favorite`, `is_participating`, `created_at`) VALUES
(1, 23, 3, 1, 1, '2025-11-26 16:52:43'),
(2, 25, 2, 1, 1, '2025-11-26 17:02:34'),
(3, 21, 1, 1, 1, '2025-12-01 12:00:00'),
(4, 22, 4, 1, 1, '2025-12-05 15:00:00'),
(5, 25, 5, 0, 1, '2025-12-10 10:00:00'),
(6, 27, 3, 1, 0, '2025-12-12 09:00:00'),
(7, 28, 5, 1, 1, '2025-12-15 11:30:00'),
(8, 29, 6, 0, 1, '2025-12-20 14:00:00'),
(9, 30, 6, 1, 1, '2025-12-21 09:00:00'),
(10, 4, 2, 0, 1, '2025-12-02 08:00:00');

-- --------------------------------------------------------
-- Indizes & Constraints
-- --------------------------------------------------------

ALTER TABLE `events` ADD PRIMARY KEY (`event_id`), ADD KEY `admin_id` (`admin_id`);
ALTER TABLE `reviews` ADD PRIMARY KEY (`review_id`), ADD KEY `user_id` (`user_id`);
ALTER TABLE `users` ADD PRIMARY KEY (`user_id`), ADD UNIQUE KEY `username` (`username`), ADD UNIQUE KEY `email` (`email`);
ALTER TABLE `user_events` ADD PRIMARY KEY (`id`), ADD KEY `user_id` (`user_id`), ADD KEY `event_id` (`event_id`);

ALTER TABLE `events` MODIFY `event_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;
ALTER TABLE `reviews` MODIFY `review_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=18;
ALTER TABLE `users` MODIFY `user_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=31;
ALTER TABLE `user_events` MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

ALTER TABLE `events` ADD CONSTRAINT `events_ibfk_1` FOREIGN KEY (`admin_id`) REFERENCES `users` (`user_id`) ON DELETE CASCADE;
ALTER TABLE `reviews` ADD CONSTRAINT `fk_reviews_user` FOREIGN KEY (`user_id`) REFERENCES `users` (`user_id`) ON DELETE CASCADE;
ALTER TABLE `user_events` ADD CONSTRAINT `user_events_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `users` (`user_id`) ON DELETE CASCADE, ADD CONSTRAINT `user_events_ibfk_2` FOREIGN KEY (`event_id`) REFERENCES `events` (`event_id`) ON DELETE CASCADE;

COMMIT;