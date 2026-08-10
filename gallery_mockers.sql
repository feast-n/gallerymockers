-- phpMyAdmin SQL Dump
-- version 5.2.2
-- https://www.phpmyadmin.net/
--
-- Host: localhost:3306
-- Generation Time: Aug 10, 2026 at 03:19 AM
-- Server version: 8.4.3
-- PHP Version: 8.5.9

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `gallery_mockers`
--

-- --------------------------------------------------------

--
-- Table structure for table `history`
--

CREATE TABLE `history` (
  `id` int NOT NULL,
  `year` varchar(10) NOT NULL,
  `title` varchar(255) NOT NULL,
  `description` text NOT NULL,
  `created_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `history`
--

INSERT INTO `history` (`id`, `year`, `title`, `description`, `created_at`) VALUES
(1, '2020', '2020: The Spark', 'Gallery Mockers began as a small digital collective. Artists started subtly photoshopping modern elements into Renaissance paintings for fun.', '2026-08-09 14:15:39'),
(2, '2021', 'Jan 2021: The Viral Outbreak', 'Our \"Mona Lisa scrolling TikTok\" piece unexpectedly went viral, reaching 5 million views overnight.', '2026-08-09 14:15:39'),
(3, '2021', 'Jul 2021: The 10K Milestone', 'Hit 10,000 active community members on Discord, transforming our project into a collaborative movement.', '2026-08-09 14:15:39'),
(4, '2022', '2022: The First Exhibition', 'Hosted our very first physical pop-up gallery titled \"Classics Reimagined\" featuring physical prints of digital satires.', '2026-08-09 14:15:39'),
(5, '2022', 'Dec 2022: Website V2 Launch', 'Overhauled our entire web presence, introducing smooth interactive gallery features and responsive UI.', '2026-08-09 14:15:39'),
(6, '2023', 'Jul 2023: Launching AR Mockers', 'Introduced an Augmented Reality app allowing users to point phones at classic museum paintings to reveal satirical overlays.', '2026-08-09 14:15:39'),
(7, '2024', 'Feb 2024: Jakarta Permanent Studio', 'Opened our first permanent studio and creative hub in Jakarta, serving as regional headquarters.', '2026-08-09 14:15:39'),
(8, '2024', 'Dec 2024: Best Digital Collective Award', 'Won the prestigious \"Innovators in Contemporary Art\" award at the Asian Digital Art Expo.', '2026-08-09 14:15:39'),
(9, '2025', 'May 2025: London Calling Showcase', 'Successfully executed a two-week pop-up gallery in London Soho district to critical acclaim.', '2026-08-09 14:15:39'),
(10, '2026', 'Apr 2026: One Million Members', 'Hit the milestone of 1 million active followers and newsletter subscribers across all digital channels.', '2026-08-09 14:15:39'),
(11, '2026', 'Today: A Global Platform', 'Gallery Mockers stands as a premier platform for satirical contemporary art with 25+ global partners.', '2026-08-09 14:15:39'),
(12, '123', '123', '123', '2026-08-10 01:16:46');

-- --------------------------------------------------------

--
-- Table structure for table `messages`
--

CREATE TABLE `messages` (
  `id` int NOT NULL,
  `first_name` varchar(50) NOT NULL,
  `last_name` varchar(50) NOT NULL,
  `email` varchar(100) NOT NULL,
  `subject` varchar(255) NOT NULL,
  `message` text NOT NULL,
  `created_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `messages`
--

INSERT INTO `messages` (`id`, `first_name`, `last_name`, `email`, `subject`, `message`, `created_at`) VALUES
(1, '123', '123', '12334@gmail.com', '123123', '123', '2026-08-10 01:36:09');

-- --------------------------------------------------------

--
-- Table structure for table `products`
--

CREATE TABLE `products` (
  `id` int NOT NULL,
  `name` varchar(255) NOT NULL,
  `price` decimal(10,2) NOT NULL,
  `img` varchar(255) NOT NULL,
  `description` text
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `products`
--

INSERT INTO `products` (`id`, `name`, `price`, `img`, `description`) VALUES
(1, 'The Surprised Ducreux (Canvas)', 120.00, 'assets/2.jpg', 'Premium canvas print of the digital reinterpretation of Joseph Ducreux classic self-portrait.'),
(2, 'Napoleon\'s Pacifier (Framed Print)', 85.00, 'assets/napoleonsucking.jpg', 'A hilarious parody of classical portraiture featuring a nobleman with a baby pacifier.'),
(3, 'Distracted Looming (Poster)', 35.00, 'assets/Greenwell-JohnBrooks-Cloudbusting.webp', 'A modern figurative piece commenting on smartphone addiction. A2 size on 250gsm paper.'),
(4, 'Mona Lisa Scrolling TikTok (Canvas)', 145.00, 'assets/99.jpg', 'A viral digital satire depicting Da Vinci icon hopelessly hooked on short-form videos.'),
(5, 'Girl with a Pearl Earbud (Framed Print)', 95.00, 'assets/00.jpg', 'Vermeer masterpiece modernized with wireless audio tech. Premium wooden frame included.'),
(6, 'The Last Supper Delivery (Canvas)', 210.00, 'assets/dummy.jpg', 'A large-scale canvas exploring modern food delivery culture blended with Renaissance art.'),
(7, 'Van Gogh VR Isolation (Canvas)', 130.00, 'assets/vangogh.webp', 'Self-portrait reinterpretation exploring digital solitude through virtual reality headsets.'),
(8, 'Saturn Devouring His Fast Food (Poster)', 45.00, 'assets/xx.jpg', 'A dark comedic parody of Goya classic masterpiece commentary on modern junk food habits.'),
(9, 'The Scream in Zoom Call (Framed Print)', 110.00, 'assets/streams.jpg', 'Munch existential dread reinterpreted as modern remote meeting fatigue.'),
(10, 'Creation of Adam via Wi-Fi (Canvas)', 175.00, 'assets/fingers.webp', 'Michelangelo iconic touch replaced with a weak Wi-Fi signal icon.'),
(11, 'American Gothic Streetwear (Poster)', 40.00, 'assets/american.jpg', 'Classic American couple styled in modern oversized streetwear and limited sneakers.'),
(12, 'Birth of Venus Online Shopping (Canvas)', 160.00, 'assets/friedrich_shmam_0109_02-56a03a2a3df78cafdaa092dc.jpg', 'Botticelli masterpiece reimagined with shopping delivery boxes floating on water.'),
(13, '123', 123.00, 'assets/1786325169_dummy-image.jpg', '123'),
(14, 'asd', 213412.00, 'assets/1786325188_images (1).jpg', 'asd');

-- --------------------------------------------------------

--
-- Table structure for table `roles`
--

CREATE TABLE `roles` (
  `id` int NOT NULL,
  `role_name` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `roles`
--

INSERT INTO `roles` (`id`, `role_name`) VALUES
(1, 'Admin'),
(2, 'User');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int NOT NULL,
  `role_id` int NOT NULL DEFAULT '2',
  `username` varchar(50) NOT NULL,
  `email` varchar(100) NOT NULL,
  `password` varchar(255) NOT NULL,
  `created_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `role_id`, `username`, `email`, `password`, `created_at`) VALUES
(1, 1, 'admin', 'admin@example.com', '$2y$12$9ZLXnSX0E1igdcytVnnK8ucMNOD9VkIegySueh8fS6LlZVYueNab.', '2026-08-10 01:05:33'),
(2, 2, 'user1', 'user1@example.com', '$2y$12$GGJCI9vFzuD65aR1wziL/OgMsZOeOsMPjlFqWklcm7A9eGYhfKJTO', '2026-08-10 01:05:33'),
(3, 2, 'user2', 'user2@example.com', '$2y$12$GGJCI9vFzuD65aR1wziL/OgMsZOeOsMPjlFqWklcm7A9eGYhfKJTO', '2026-08-10 01:05:33'),
(5, 2, 'feastn', 'feastn@gmail.com', '$2y$12$XNNx/XUzRTYiFOqZhyNPhuY5joxd.oiY7oUBZ2Jnfj7MS5QQmzgve', '2026-08-10 02:20:31');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `history`
--
ALTER TABLE `history`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `messages`
--
ALTER TABLE `messages`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `products`
--
ALTER TABLE `products`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `roles`
--
ALTER TABLE `roles`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `role_name` (`role_name`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `username` (`username`),
  ADD UNIQUE KEY `email` (`email`),
  ADD KEY `role_id` (`role_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `history`
--
ALTER TABLE `history`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT for table `messages`
--
ALTER TABLE `messages`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `products`
--
ALTER TABLE `products`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;

--
-- AUTO_INCREMENT for table `roles`
--
ALTER TABLE `roles`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `users`
--
ALTER TABLE `users`
  ADD CONSTRAINT `fk_users_roles` FOREIGN KEY (`role_id`) REFERENCES `roles` (`id`) ON DELETE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
