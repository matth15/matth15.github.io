-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Dec 01, 2023 at 05:27 AM
-- Server version: 10.4.28-MariaDB
-- PHP Version: 8.2.4

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `early-alert-system`
--

-- --------------------------------------------------------

--
-- Table structure for table `admin`
--

CREATE TABLE `admin` (
  `id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  `user_type` varchar(50) NOT NULL DEFAULT 'admin',
  `otp` int(11) NOT NULL,
  `otp_expiration` datetime NOT NULL,
  `is_email_activated` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `admin`
--

INSERT INTO `admin` (`id`, `name`, `email`, `password`, `user_type`, `otp`, `otp_expiration`, `is_email_activated`) VALUES
(1, 'Admin', 'mathewsuarez20@gmail.com', 'admin123123', 'admin', 794415, '2023-11-30 14:37:00', 0),
(3, 'admin 2', 'mathewsuarez@gmail.com', 'admin123123', 'admin', 0, '2023-11-29 18:43:49', 0);

-- --------------------------------------------------------

--
-- Table structure for table `students_data`
--

CREATE TABLE `students_data` (
  `id` int(11) NOT NULL,
  `unique_id` int(11) NOT NULL,
  `name` varchar(50) NOT NULL,
  `email` varchar(50) NOT NULL,
  `password` varchar(255) NOT NULL,
  `grade_level` varchar(255) NOT NULL,
  `strand` varchar(255) NOT NULL,
  `user_type` varchar(50) NOT NULL,
  `otp` int(11) NOT NULL,
  `otp_expiration` datetime NOT NULL,
  `is_email_activated` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `students_data`
--

INSERT INTO `students_data` (`id`, `unique_id`, `name`, `email`, `password`, `grade_level`, `strand`, `user_type`, `otp`, `otp_expiration`, `is_email_activated`) VALUES
(1, 0, 'Matthew Suarez', 'msuarez.f2f@tracecollege.edu.ph', '$2y$10$uDjxqVtidz2xBxafgMagHOw3bGU4M4ZHvfhXBj3OUjmGqcnnyxu52', 'g12', 'ict', 'student', 0, '0000-00-00 00:00:00', 1),
(2, 0, 'Sedrick Pulutan', 'dpulutan@tracecollege.edu.ph', '$2y$10$f6ON6B4RzRtSWOUWiBvKL.ZM8kzm3tmuO8A/pfmUsdDxKS4rSa6X.', 'g12', 'ict', 'student', 0, '0000-00-00 00:00:00', 1),
(39, 0, 'miyuji pogi', 'msasayama.f2f@tracecollege.edu.ph', '$2y$10$pigToHdSL18YaQEBKOE8y.y87Ep9wvlNaWWE3vv94z4PJoqJAyQ96', 'g12', 'gas', 'student', 0, '0000-00-00 00:00:00', 0),
(40, 6048938, 'Jedrick Murillo', 'jmurillo.f2f@tracecollege.edu.ph', '$2y$10$bK/4rsn0zhJc1G.PeABKTe9k1Q8pARVttQUfdy6tzY4.3sgDzkt9y', 'g12', 'ict', 'student', 0, '0000-00-00 00:00:00', 1);

-- --------------------------------------------------------

--
-- Table structure for table `teachers_data`
--

CREATE TABLE `teachers_data` (
  `id` int(11) NOT NULL,
  `name` text NOT NULL,
  `email` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  `user_type` text NOT NULL,
  `otp` int(11) NOT NULL,
  `otp_expiration` datetime NOT NULL,
  `is_email_activated` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `teachers_data`
--

INSERT INTO `teachers_data` (`id`, `name`, `email`, `password`, `user_type`, `otp`, `otp_expiration`, `is_email_activated`) VALUES
(3, 'teacher', 'teacher@tracecollege.edu.ph', 'teacher123123', 'teacher', 897780, '2023-11-30 06:31:00', 1),
(4, 'teacher 2', 'teacher2@tracecollege.edu.ph', 'teacher123123', 'teacher', 0, '2023-11-29 19:05:20', 1);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `admin`
--
ALTER TABLE `admin`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `students_data`
--
ALTER TABLE `students_data`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `teachers_data`
--
ALTER TABLE `teachers_data`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `admin`
--
ALTER TABLE `admin`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `students_data`
--
ALTER TABLE `students_data`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=41;

--
-- AUTO_INCREMENT for table `teachers_data`
--
ALTER TABLE `teachers_data`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
