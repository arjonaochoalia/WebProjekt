-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Nov 28, 2025 at 01:09 PM
-- Server version: 10.4.32-MariaDB
-- PHP Version: 8.2.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `beautylab`
--

-- --------------------------------------------------------

--
-- Table structure for table `events`
--

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

--
-- Dumping data for table `events`
--

INSERT INTO `events` (`event_id`, `admin_id`, `title`, `description`, `location`, `event_date`, `event_time`, `image_path`, `created_at`) VALUES
(1, 3, 'Winterzauber am Rathausplatz', 'Erleben Sie den magischen Winterzauber am Wiener Rathausplatz! Besucherinnen und Besucher erwartet ein gemütlicher Adventmarkt mit handgefertigten Geschenken, kulinarischen Spezialitäten, warmem Punsch und festlicher Musik. Für Kinder gibt es ein eigenes Bastelzelt sowie ein kleines Karussell. Ein perfekter Ort, um in weihnachtliche Stimmung zu kommen und gemeinsam Zeit zu verbringen.', 'Rathausplatz, 1010 Wien', '2025-12-12', '17:00:00', 'Bilder/winterzauber.jpg', '2025-11-14 14:17:42'),
(3, 3, 'Kunst-Workshop für Erwachsene', 'Entdecken Sie Ihre kreative Seite bei unserem Kunst-Workshop für Erwachsene. Unter Anleitung erfahrener Künstler können Sie Maltechniken ausprobieren und Ihr eigenes Kunstwerk gestalten. Alle Materialien werden gestellt.', 'Kunsthalle Wien, 1010 Wien', '2025-05-10', '14:00:00', 'Bilder/kunstworkshop.jpg', '2025-11-14 14:50:50'),
(4, 3, 'Lauftreff im Prater', 'Treffen Sie Gleichgesinnte und genießen Sie gemeinsam eine Lauf-Runde durch den Wiener Prater. Anfänger und Fortgeschrittene sind willkommen. Treffpunkt ist der Haupteingang. Bitte Sportschuhe und Wasser mitbringen.', 'Wiener Prater, 1020 Wien', '2025-06-22', '08:00:00', 'Bilder/lauftreff.jpg', '2025-11-14 14:51:02');

-- --------------------------------------------------------

--
-- Table structure for table `reviews`
--

CREATE TABLE `reviews` (
  `review_id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `content` text NOT NULL,
  `created_at` datetime DEFAULT current_timestamp(),
  `rating` int(1) NOT NULL DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `reviews`
--

INSERT INTO `reviews` (`review_id`, `user_id`, `content`, `created_at`, `rating`) VALUES
(5, 20, 'The skincare workshop was incredibly informative.\nI finally understand how to layer products properly.\nThe hands-on demos made everything easy to follow.', '2025-11-26 12:10:49', 5),
(6, 21, 'The wellness event had such a calming atmosphere.\nI loved the aromatherapy session.\nThe instructor was kind, patient, and very knowledgeable.\nHighly recommended.', '2025-11-26 12:10:49', 5),
(7, 22, 'I attended the makeup masterclass last week.\nThe tips were practical and easy to apply.\nMy confidence in doing my own makeup has improved so much.', '2025-11-26 12:10:49', 4),
(8, 23, 'The beauty workshop covered everything from skincare to natural remedies.\nI appreciated the open Q&A segment.\nGreat value and a fantastic experience overall.', '2025-11-26 12:10:49', 5),
(9, 24, 'This wellness retreat introduced me to new relaxation techniques.\nThe meditation session was deeply rejuvenating.\nI walked away feeling refreshed and more centered.', '2025-11-26 12:10:49', 5),
(10, 25, 'The haircare event gave me so many useful insights.\nI never knew proper brushing techniques mattered so much.\nFriendly hosts and very practical demonstrations.', '2025-11-26 12:10:49', 4),
(11, 26, 'I joined the natural beauty product workshop.\nLearning to create my own scrubs and oils was amazing.\nI enjoyed the creativity and the supportive environment.\nCan’t wait for the next event.', '2025-11-26 12:10:49', 5),
(12, 27, 'The spa-themed wellness event was relaxing from start to finish.\nBreathing exercises, massage tips, and self-care routines were all well-explained.\nA perfect way to spend the day.', '2025-11-26 12:10:49', 5);

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

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

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`user_id`, `username`, `first_name`, `last_name`, `email`, `user_password`, `user_role`, `created_at`, `image_path`) VALUES
(3, 'supjan', 'supjan', 'jakumov', 'supjan@pm.me', '$2y$10$TGdfQhzKnPhLCf5KPQbDNu4/Ke4CP/gzJrOxzRdk0Bm5d.RQb1M7O', 'admin', '2025-11-11 12:11:06', 'profile_pictures/3_profile_picture_PBoost.jpg'),
(19, 'river', 'River', 'Stone', 'river@example.com', '$2y$10$cBFdaAM2nEWvixGGf5gCXO.SWp8lU4nVNZ3itHfoTnBvN4jHZ14hC', 'user', '2025-11-26 10:54:53', 'profile_pictures/placeholder.jpg'),
(20, 'nova', 'Nova', 'Lane', 'nova@example.com', '$2y$10$cBFdaAM2nEWvixGGf5gCXO.SWp8lU4nVNZ3itHfoTnBvN4jHZ14hC', 'user', '2025-11-26 10:54:53', 'profile_pictures/placeholder.jpg'),
(21, 'ember', 'Ember', 'Gray', 'ember@example.com', '$2y$10$cBFdaAM2nEWvixGGf5gCXO.SWp8lU4nVNZ3itHfoTnBvN4jHZ14hC', 'user', '2025-11-26 10:54:53', 'profile_pictures/placeholder.jpg'),
(22, 'flint', 'Flint', 'Cole', 'flint@example.com', '$2y$10$cBFdaAM2nEWvixGGf5gCXO.SWp8lU4nVNZ3itHfoTnBvN4jHZ14hC', 'user', '2025-11-26 10:54:53', 'profile_pictures/placeholder.jpg'),
(23, 'sage', 'Sage', 'Reed', 'sage@example.com', '$2y$10$cBFdaAM2nEWvixGGf5gCXO.SWp8lU4nVNZ3itHfoTnBvN4jHZ14hC', 'user', '2025-11-26 10:54:53', 'profile_pictures/placeholder.jpg'),
(24, 'onyx', 'Onyx', 'Black', 'onyx@example.com', '$2y$10$cBFdaAM2nEWvixGGf5gCXO.SWp8lU4nVNZ3itHfoTnBvN4jHZ14hC', 'user', '2025-11-26 10:54:54', 'profile_pictures/placeholder.jpg'),
(25, 'sol', 'Sol', 'Bright', 'sol@example.com', '$2y$10$cBFdaAM2nEWvixGGf5gCXO.SWp8lU4nVNZ3itHfoTnBvN4jHZ14hC', 'user', '2025-11-26 10:54:54', 'profile_pictures/placeholder.jpg'),
(26, 'zen', 'Zen', 'Hill', 'zen@example.com', '$2y$10$cBFdaAM2nEWvixGGf5gCXO.SWp8lU4nVNZ3itHfoTnBvN4jHZ14hC', 'user', '2025-11-26 10:54:54', 'profile_pictures/placeholder.jpg'),
(27, 'koda', 'Koda', 'West', 'koda@example.com', '$2y$10$cBFdaAM2nEWvixGGf5gCXO.SWp8lU4nVNZ3itHfoTnBvN4jHZ14hC', 'user', '2025-11-26 10:54:54', 'profile_pictures/placeholder.jpg'),
(28, 'luna', 'Luna', 'Frost', 'luna@example.com', '$2y$10$cBFdaAM2nEWvixGGf5gCXO.SWp8lU4nVNZ3itHfoTnBvN4jHZ14hC', 'user', '2025-11-26 10:54:54', 'profile_pictures/placeholder.jpg');

-- --------------------------------------------------------

--
-- Table structure for table `user_events`
--

CREATE TABLE `user_events` (
  `id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `event_id` int(11) NOT NULL,
  `is_favorite` tinyint(1) DEFAULT 0,
  `is_participating` tinyint(1) DEFAULT 0,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `user_events`
--

INSERT INTO `user_events` (`id`, `user_id`, `event_id`, `is_favorite`, `is_participating`, `created_at`) VALUES
(1, 3, 4, 0, 1, '2025-11-26 16:52:43'),
(2, 3, 1, 1, 1, '2025-11-26 17:02:34'),
(3, 3, 3, 1, 0, '2025-11-26 17:31:40'),
(5, 19, 1, 0, 1, '2025-11-26 18:37:38'),
(6, 19, 4, 1, 0, '2025-11-26 18:37:39'),
(7, 19, 3, 1, 0, '2025-11-26 18:37:40');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `events`
--
ALTER TABLE `events`
  ADD PRIMARY KEY (`event_id`),
  ADD KEY `admin_id` (`admin_id`);

--
-- Indexes for table `reviews`
--
ALTER TABLE `reviews`
  ADD PRIMARY KEY (`review_id`),
  ADD KEY `user_id` (`user_id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`user_id`),
  ADD UNIQUE KEY `username` (`username`),
  ADD UNIQUE KEY `email` (`email`);

--
-- Indexes for table `user_events`
--
ALTER TABLE `user_events`
  ADD PRIMARY KEY (`id`),
  ADD KEY `user_id` (`user_id`),
  ADD KEY `event_id` (`event_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `events`
--
ALTER TABLE `events`
  MODIFY `event_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `reviews`
--
ALTER TABLE `reviews`
  MODIFY `review_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `user_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=29;

--
-- AUTO_INCREMENT for table `user_events`
--
ALTER TABLE `user_events`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `events`
--
ALTER TABLE `events`
  ADD CONSTRAINT `events_ibfk_1` FOREIGN KEY (`admin_id`) REFERENCES `users` (`user_id`) ON DELETE CASCADE;

--
-- Constraints for table `reviews`
--
ALTER TABLE `reviews`
  ADD CONSTRAINT `reviews_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `users` (`user_id`);

--
-- Constraints for table `user_events`
--
ALTER TABLE `user_events`
  ADD CONSTRAINT `user_events_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `users` (`user_id`) ON DELETE CASCADE,
  ADD CONSTRAINT `user_events_ibfk_2` FOREIGN KEY (`event_id`) REFERENCES `events` (`event_id`) ON DELETE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
