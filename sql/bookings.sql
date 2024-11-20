-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Nov 20, 2024 at 03:34 AM
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
-- Table structure for table `bookings`
--

CREATE TABLE `bookings` (
  `id` int(11) NOT NULL,
  `first_name` varchar(100) NOT NULL,
  `last_name` varchar(100) NOT NULL,
  `date` varchar(100) NOT NULL,
  `time` varchar(100) NOT NULL,
  `phone` varchar(100) NOT NULL,
  `message` text NOT NULL,
  `user_id` int(100) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `bookings`
--

INSERT INTO `bookings` (`id`, `first_name`, `last_name`, `date`, `time`, `phone`, `message`, `user_id`, `created_at`) VALUES
(3, 'Khon', 'Kimly', '11/20/2024', '7:00pm', '355675', 'im booking', 4, '2024-11-19 10:51:11'),
(4, 'ly', 'kim', '11/22/2024', '1:00am', '11111', 'hi', 4, '2024-11-19 10:57:47'),
(5, 'jelly', 'rufer', '11/23/2024', '1:00am', '2222', 'hi', 4, '2024-11-19 11:05:33'),
(6, 'dfjhg', 'gh', '11/6/2024', '1:00am', '1234', 'fd', 4, '2024-11-19 11:06:29'),
(7, 'kim', 'hy', '11/22/2024', '1:00am', '677', 'ji', 4, '2024-11-19 11:24:41'),
(8, 'helo', 'ki', '11/23/2024', '1:30am', '7666', 'hi', 4, '2024-11-19 11:26:03'),
(9, 'nan', 'uchiha', '11/23/2024', '12:30am', '366', 'kim', 4, '2024-11-19 11:34:22'),
(10, 'kiew', 'ty', '11/6/2024', '12:30am', '34', 'gt', 4, '2024-11-19 11:49:06'),
(11, '12', '23', '11/28/2024', '12:30am', '3443', 'fr', 4, '2024-11-19 11:50:07'),
(12, '44', '55', '11/20/2024', '1:30am', '36765', 'f', 4, '2024-11-19 11:51:52');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `bookings`
--
ALTER TABLE `bookings`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `bookings`
--
ALTER TABLE `bookings`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
