-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Dec 06, 2023 at 08:38 PM
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
(1, 'Admin', 'mathewsuarez20@gmail.com', 'admin123123', 'admin', 428297, '2023-12-06 13:38:00', 1),
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
  `section` varchar(50) NOT NULL,
  `strand_class` varchar(50) NOT NULL,
  `user_type` varchar(50) NOT NULL,
  `otp` int(11) NOT NULL,
  `otp_expiration` datetime NOT NULL,
  `created_at` datetime NOT NULL DEFAULT current_timestamp(),
  `is_email_activated` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `teachers_data`
--

CREATE TABLE `teachers_data` (
  `id` int(11) NOT NULL,
  `unique_id` int(11) NOT NULL,
  `name` text NOT NULL,
  `email` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  `department` varchar(50) NOT NULL,
  `user_type` text NOT NULL,
  `otp` int(11) NOT NULL,
  `otp_expiration` datetime NOT NULL,
  `created_at` datetime NOT NULL DEFAULT current_timestamp(),
  `is_email_activated` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `teachers_data`
--

INSERT INTO `teachers_data` (`id`, `unique_id`, `name`, `email`, `password`, `department`, `user_type`, `otp`, `otp_expiration`, `created_at`, `is_email_activated`) VALUES
(3, 4056405, 'teacher', 'teacher@tracecollege.edu.ph', 'teacher123123', '', 'teacher', 567670, '2023-12-06 14:02:00', '2023-12-01 14:25:04', 1),
(4, 1234514, 'teacher 2', 'teacher2@tracecollege.edu.ph', 'teacher123123', '', 'teacher', 0, '2023-11-29 19:05:20', '2023-12-01 14:25:04', 1);

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
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=119;

--
-- AUTO_INCREMENT for table `teachers_data`
--
ALTER TABLE `teachers_data`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
