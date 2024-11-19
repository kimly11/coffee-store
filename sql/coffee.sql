-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Nov 19, 2024 at 09:14 AM
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
-- Database: `coffee`
--

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `username` varchar(100) NOT NULL,
  `email` varchar(100) NOT NULL,
  `password` varchar(100) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `username`, `email`, `password`, `created_at`) VALUES
(1, 'kimlyjr1188', 'kimlyjr11@gmail.com', '$2y$10$ahbx63Wqt8bcjKos6v18TunbfAIYRi1IbcEZwdwSncFv1BDqHwbqC', '2024-11-15 06:38:04'),
(2, 'kimlyjr111888', 'nanuchiha1@gmail.com', '$2y$10$208DF8nPmT8hkF3BgbJUwulRuSUf9QyvjpA5V/hAInEb8B6YHRJQm', '2024-11-15 06:40:27'),
(3, 'Kimly KHON', 'kimlyjr88@gmail.com', '$2y$10$zyFHBgKkXOEX2j/hrmT9euK/v0vFxuTkFqDYp8yFfFWfvG4o47L7a', '2024-11-18 06:43:22'),
(4, 'kim', 'kim@gmail.com', '$2y$10$fYgYVmmT7bMzSjJasrx./u5e3msII95b6R55H6Iyr1cthmE/fmiIC', '2024-11-18 06:23:14'),
(5, '123', '123@gmail.com', '$2y$10$x8zeQShZpndG2Gy7y2IWyOvyRNusFqDdyDTJtMbK0C7sfPDYw8zSy', '2024-11-19 07:19:48');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
