-- phpMyAdmin SQL Dump
-- version 6.0.0-dev+20260728.a0d1231b75
-- https://www.phpmyadmin.net/
--
-- Host: localhost:3306
-- Generation Time: Aug 09, 2026 at 02:23 PM
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
(11, '2026', 'Today: A Global Platform', 'Gallery Mockers stands as a premier platform for satirical contemporary art with 25+ global partners.', '2026-08-09 14:15:39');

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
(12, 'Birth of Venus Online Shopping (Canvas)', 160.00, 'assets/friedrich_shmam_0109_02-56a03a2a3df78cafdaa092dc.jpg', 'Botticelli masterpiece reimagined with shopping delivery boxes floating on water.');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `history`
--
ALTER TABLE `history`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `products`
--
ALTER TABLE `products`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `history`
--
ALTER TABLE `history`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT for table `products`
--
ALTER TABLE `products`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
