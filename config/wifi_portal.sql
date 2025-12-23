-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: localhost:3306
-- Generation Time: Dec 23, 2025 at 08:35 AM
-- Server version: 8.0.30
-- PHP Version: 8.1.10

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `wifi_portal`
--

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int NOT NULL,
  `name` varchar(100) DEFAULT NULL,
  `email` varchar(100) DEFAULT NULL,
  `phone` varchar(20) DEFAULT NULL,
  `password` varchar(255) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `name`, `email`, `phone`, `password`, `created_at`) VALUES
(1, 'Almaas', 'almaasrozikin@gmail.com', '6281393684093', '$2y$10$s1SMRbhPaDaRDYtiLKDwaOnPXDQJP6KuUuvw8T4H6iuZkqSPLKz6u', '2025-12-22 07:18:20'),
(2, 'Budi', 'budi@gmail.com', '6281234567890', '$2y$10$cL/.BaWCTAiBCSG3G4qIJOp5nC3kvZYwQXldJaWVWnt84a4feYkku', '2025-12-22 07:54:29'),
(3, 'Naruto', 'naruto@gmail.com', '6281271827813', '$2y$10$S/YSe9hqij0i4YQckSsuOOc2mr.JZqCMlejy1pAFP3GJc2OVbLFEy', '2025-12-22 09:32:47'),
(20, 'Franco', 'wrutherford@example.com', '6287221362732', '$2y$10$wZTEyR7tAk20JZVMsvfSJ.AZ9tfa8H5SIBOPHWXG7xxBcx.Lj6B5S', '2025-12-23 02:43:44'),
(21, 'Franco Zoin', 'franco_zoin@gmail.com', '62853276423', '$2y$10$FZFb0TzXZVVtakcda8SiguO0Y5gxOi8YMlqKtmRKHfvnRPx9umQla', '2025-12-23 08:13:09');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `email` (`email`),
  ADD UNIQUE KEY `phone` (`phone`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=22;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
