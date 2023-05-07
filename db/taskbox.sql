-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: db:3306
-- Generation Time: May 07, 2023 at 12:32 PM
-- Server version: 8.0.33
-- PHP Version: 8.1.17

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `taskbox`
--

-- --------------------------------------------------------

--
-- Table structure for table `CATEGORY`
--

CREATE TABLE `CATEGORY` (
  `id` int NOT NULL,
  `name` varchar(50) NOT NULL,
  `date_created` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3;

--
-- Dumping data for table `CATEGORY`
--

INSERT INTO `CATEGORY` (`id`, `name`, `date_created`) VALUES
(1, 'Gia đình', '2020-06-12 00:00:00'),
(5, 'Đại học', '2023-05-07 09:57:38'),
(6, 'Công ty', '2023-05-07 12:10:27');

-- --------------------------------------------------------

--
-- Table structure for table `TASK`
--

CREATE TABLE `TASK` (
  `id` int NOT NULL,
  `name` varchar(100) NOT NULL,
  `description` varchar(400) NOT NULL,
  `start_date` datetime NOT NULL,
  `due_date` datetime NOT NULL,
  `finished_date` datetime DEFAULT NULL,
  `category_id` int NOT NULL,
  `status` enum('TODO','IN_PROGRESS','FINISHED') NOT NULL DEFAULT 'TODO'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3;

--
-- Dumping data for table `TASK`
--

INSERT INTO `TASK` (`id`, `name`, `description`, `start_date`, `due_date`, `finished_date`, `category_id`, `status`) VALUES
(5, 'Tìm hiểu đề tài Seminar 4', 'Tìm hiểu đề tài Seminar Lý thuyết', '2020-06-19 00:00:00', '2023-06-20 00:00:00', NULL, 1, 'IN_PROGRESS'),
(13, 'Nộp bài tập Ứng dụng phân tán #1', 'Xây dựng trang web [Deadline 7/5/2023]. Xem chi tiết tại: https://courses.fit.hcmus.edu.vn/mod/assign/view.php?id=101067', '2023-04-24 16:40:00', '2023-05-07 23:55:00', NULL, 5, 'IN_PROGRESS'),
(14, '[Meeting] Vẫn show danh sách Private Meeting dù không thuộc', '[Meeting] Vẫn show danh sách Private Meeting dù không thuộc', '2023-05-07 18:08:00', '2023-05-08 18:08:00', NULL, 6, 'TODO'),
(15, '[Setting - Team] Cho phép thay đổi trạng thái Leadership Team', '[Setting - Team] Cho phép thay đổi trạng thái Leadership Team', '2023-05-05 19:14:00', '2023-05-10 19:14:00', NULL, 6, 'TODO'),
(16, 'Mua Camera Xiaomi cho ông Ngoại', 'Mua Camera Xiaomi cho ông Ngoại', '2023-06-01 19:15:00', '2023-06-05 19:15:00', NULL, 1, 'TODO');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `CATEGORY`
--
ALTER TABLE `CATEGORY`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `TASK`
--
ALTER TABLE `TASK`
  ADD PRIMARY KEY (`id`),
  ADD KEY `FK_TASK_CATEGORY` (`category_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `CATEGORY`
--
ALTER TABLE `CATEGORY`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `TASK`
--
ALTER TABLE `TASK`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=17;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `TASK`
--
ALTER TABLE `TASK`
  ADD CONSTRAINT `FK_TASK_CATEGORY` FOREIGN KEY (`category_id`) REFERENCES `CATEGORY` (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
