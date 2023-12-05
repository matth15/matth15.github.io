-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Dec 05, 2023 at 09:07 PM
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
(1, 'Admin', 'mathewsuarez20@gmail.com', 'admin123123', 'admin', 149848, '2023-12-03 17:48:00', 1),
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

--
-- Dumping data for table `students_data`
--

INSERT INTO `students_data` (`id`, `unique_id`, `name`, `email`, `password`, `grade_level`, `strand`, `section`, `strand_class`, `user_type`, `otp`, `otp_expiration`, `created_at`, `is_email_activated`) VALUES
(1, 4525690, 'Matthew Suarez', 'msuarez.f2f@tracecollege.edu.ph', '$2y$10$uDjxqVtidz2xBxafgMagHOw3bGU4M4ZHvfhXBj3OUjmGqcnnyxu52', 'g12', 'stem', 'Enthusiasm', 'A', 'student', 872760, '2023-12-05 21:09:00', '2023-12-01 14:24:01', 1),
(71, 2512314, 'Matthew Suarez', 'mt.f2f@tracecollege.edu.ph', '$2y$10$Jhe9rt2z94lQl/59/K9U.us/71NHrwmsrJicOdQUqG8Yz0/yMoGay', 'Select Grade Level', 'Select Strand', '', '0', 'student', 0, '0000-00-00 00:00:00', '2023-12-02 14:02:20', 1),
(72, 1449068, 'asdasd asdf', 'msuarezs.f2f@tracecollege.edu.ph', '$2y$10$83TZ1TOBQBLa38Q2z6ToEO9ccSQKTRZc/63E1OdMfYlpbJmHFMOdW', 'Select Grade Level', 'Select Strand', '', '0', 'student', 0, '0000-00-00 00:00:00', '2023-12-02 14:03:04', 1),
(73, 5948586, 'sadasd asdasd', 'msuarez.sdsf2f@tracecollege.edu.ph', '$2y$10$A42fkQKIXeaeqY8wJ3mCtu6FmOnik88SZ7F3OZtXU3Hcet3.bRR6O', 'Select Grade Level', 'Select Strand', '', '0', 'student', 0, '0000-00-00 00:00:00', '2023-12-02 14:08:15', 1),
(74, 9189297, ' ', 'asdfsad.f2f@tracecollege.edu.ph', '$2y$10$MFtPXATFEVu2nuwN5d30QuiKnE8b6wg4LzSm56clu39Q7zMRtAW7i', 'Select Grade Level', 'Select Strand', '', '0', 'student', 0, '0000-00-00 00:00:00', '2023-12-02 14:18:36', 1),
(75, 590519, 'asdasd asdasdas', 'dpuludtan@tracecollege.edu.ph', '$2y$10$klqoXJispZSxTYTx61g3xeqtZrVSLAjqXZSSPz9BSkTJqb5mUEQaa', 'Select Grade Level', 'Select Strand', '', '0', 'student', 0, '0000-00-00 00:00:00', '2023-12-02 14:19:07', 1),
(76, 2809485, 'asdasd Suarez', 'ddfdmathewsuarez20@gmail.com', '$2y$10$W25RUwuoD0msMBBHxTPYdOgDmAIip7PHQoyqsDwsum/VvgQFcOmZ6', 'Select Grade Level', 'Select Strand', '', '0', 'student', 0, '0000-00-00 00:00:00', '2023-12-02 20:56:08', 1),
(77, 8335205, 'asdasd asdf', 'mathewsuffarez20@gmail.com', '$2y$10$tohKbIeWD5udslIpPbDdqeXiJGyBvFSK0LFJdf1CSJXvCy1xXA.S2', 'Select Grade Level', 'Select Strand', '', '0', 'student', 0, '0000-00-00 00:00:00', '2023-12-02 20:57:44', 1),
(78, 6457378, 'sdfasdf fff', 'mathewsffffuarez20@gmail.com', '$2y$10$Vbvb2UkA..cuMl0E.wA7EOgdWeObmjHya40Ur2Vr8aILiqivDKXVK', 'Select Grade Level', 'Select Strand', '', '0', 'student', 0, '0000-00-00 00:00:00', '2023-12-02 20:57:49', 1),
(79, 5366890, 'asdasd Alcayde', 'msuarezd.f2f@tracecollege.edu.ph', '$2y$10$nPut3eToQ5cBIKRUhIZ1m..I20EsS3TKUlw74x8jJFKN4pVISrL82', 'Select Grade Level', 'Select Strand', '', '0', 'student', 0, '0000-00-00 00:00:00', '2023-12-02 21:14:33', 1),
(115, 5544893, 'asdfsadf fdfdfd', 'msuarez12.f2f@tracecollege.edu.ph', '$2y$10$AWwBPzvmCuJUzR6NoOYAYONhjqST0MlLB6yZytvbhSpvVNRkwz2NC', 'g11', 'ict', '', '', 'student', 0, '0000-00-00 00:00:00', '2023-12-04 18:38:17', 1);

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
(3, 4056405, 'teacher', 'teacher@tracecollege.edu.ph', 'teacher123123', '', 'teacher', 416108, '2023-12-05 19:55:00', '2023-12-01 14:25:04', 1),
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
