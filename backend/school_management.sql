-- phpMyAdmin SQL Dump
-- version 5.1.3
-- https://www.phpmyadmin.net/
--
-- Host: localhost:3306
-- Generation Time: Mar 27, 2022 at 12:45 PM
-- Server version: 5.7.33
-- PHP Version: 7.4.19

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `school_management`
--

-- --------------------------------------------------------

--
-- Table structure for table `assignments`
--

CREATE TABLE `assignments` (
  `id` int(11) UNSIGNED NOT NULL,
  `student_code` varchar(20) COLLATE utf8_unicode_ci DEFAULT NULL,
  `class_code` varchar(20) COLLATE utf8_unicode_ci DEFAULT NULL,
  `teacher_code` varchar(20) COLLATE utf8_unicode_ci DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `assignments`
--

INSERT INTO `assignments` (`id`, `student_code`, `class_code`, `teacher_code`) VALUES
(65, 'STUDENT_2', 'CLASS_3', 'TEACHER_2'),
(66, 'STUDENT_3', 'CLASS_3', 'TEACHER_1'),
(63, 'STUDENT_3', 'CLASS_3', 'TEACHER_2');

-- --------------------------------------------------------

--
-- Table structure for table `classes`
--

CREATE TABLE `classes` (
  `id` int(11) UNSIGNED NOT NULL,
  `code` varchar(20) COLLATE utf8_unicode_ci NOT NULL,
  `name` varchar(50) COLLATE utf8_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `classes`
--

INSERT INTO `classes` (`id`, `code`, `name`, `created_at`, `updated_at`) VALUES
(4, 'CLASS_1', 'Class 1', '2022-03-27 10:17:08', '2022-03-27 10:17:08'),
(2, 'CLASS_2', 'Class 2', '2022-03-25 10:39:49', '2022-03-25 10:39:49'),
(3, 'CLASS_3', 'Class 3', '2022-03-25 10:39:55', '2022-03-25 10:39:55');

-- --------------------------------------------------------

--
-- Table structure for table `students`
--

CREATE TABLE `students` (
  `id` int(11) UNSIGNED NOT NULL,
  `code` varchar(20) COLLATE utf8_unicode_ci NOT NULL,
  `name` varchar(50) COLLATE utf8_unicode_ci DEFAULT NULL,
  `birthday` date DEFAULT NULL,
  `gender` tinyint(1) DEFAULT NULL,
  `address` varchar(50) COLLATE utf8_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `students`
--

INSERT INTO `students` (`id`, `code`, `name`, `birthday`, `gender`, `address`, `created_at`, `updated_at`) VALUES
(1, 'STUDENT_1', 'Student 1', '1999-02-22', 0, 'hue', '2022-03-25 10:42:02', '2022-03-25 10:42:02'),
(2, 'STUDENT_2', 'Student 2', '1992-02-02', 2, 'dn', '2022-03-25 10:42:33', '2022-03-25 10:42:33'),
(3, 'STUDENT_3', 'Student 3', '2002-02-21', 1, 'da nang', '2022-03-27 06:42:56', '2022-03-27 06:42:56');

-- --------------------------------------------------------

--
-- Table structure for table `teachers`
--

CREATE TABLE `teachers` (
  `id` int(11) UNSIGNED NOT NULL,
  `code` varchar(20) COLLATE utf8_unicode_ci NOT NULL,
  `name` varchar(50) COLLATE utf8_unicode_ci DEFAULT NULL,
  `birthday` date DEFAULT NULL,
  `gender` tinyint(1) DEFAULT NULL,
  `address` varchar(50) COLLATE utf8_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `teachers`
--

INSERT INTO `teachers` (`id`, `code`, `name`, `birthday`, `gender`, `address`, `created_at`, `updated_at`) VALUES
(1, 'TEACHER_1', 'Teacher 1', '1999-12-09', 0, 'hue', '2022-03-25 10:40:17', '2022-03-25 10:40:17'),
(2, 'TEACHER_2', 'Teacher 2', '1995-02-02', 1, 'hue', '2022-03-25 10:40:36', '2022-03-25 10:40:36'),
(3, 'TEACHER_3', 'Teacher 3', '1994-11-11', 0, 'da nang', '2022-03-25 10:41:40', '2022-03-25 10:41:40'),
(4, 'TEACHER_4', 'Teacher 4', '1991-11-11', 0, 'hue', '2022-03-27 06:39:37', '2022-03-27 06:39:37');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `assignments`
--
ALTER TABLE `assignments`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `assignments_check_unique` (`student_code`,`class_code`,`teacher_code`),
  ADD KEY `teacher_assign` (`teacher_code`),
  ADD KEY `student_assign` (`student_code`),
  ADD KEY `class_assign` (`class_code`);

--
-- Indexes for table `classes`
--
ALTER TABLE `classes`
  ADD PRIMARY KEY (`code`),
  ADD UNIQUE KEY `id` (`id`),
  ADD UNIQUE KEY `name` (`name`);

--
-- Indexes for table `students`
--
ALTER TABLE `students`
  ADD PRIMARY KEY (`code`),
  ADD UNIQUE KEY `id` (`id`),
  ADD UNIQUE KEY `code` (`code`);

--
-- Indexes for table `teachers`
--
ALTER TABLE `teachers`
  ADD PRIMARY KEY (`code`),
  ADD UNIQUE KEY `id` (`id`),
  ADD UNIQUE KEY `code` (`code`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `assignments`
--
ALTER TABLE `assignments`
  MODIFY `id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=67;

--
-- AUTO_INCREMENT for table `classes`
--
ALTER TABLE `classes`
  MODIFY `id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `students`
--
ALTER TABLE `students`
  MODIFY `id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `teachers`
--
ALTER TABLE `teachers`
  MODIFY `id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `assignments`
--
ALTER TABLE `assignments`
  ADD CONSTRAINT `assignments_ibfk_1` FOREIGN KEY (`student_code`) REFERENCES `students` (`code`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `assignments_ibfk_2` FOREIGN KEY (`class_code`) REFERENCES `classes` (`code`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `assignments_ibfk_3` FOREIGN KEY (`teacher_code`) REFERENCES `teachers` (`code`) ON DELETE CASCADE ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
