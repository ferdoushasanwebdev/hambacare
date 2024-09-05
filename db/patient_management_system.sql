-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Sep 05, 2024 at 05:49 PM
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
-- Database: `patient_management_system`
--

-- --------------------------------------------------------

--
-- Table structure for table `familymember`
--

CREATE TABLE `familymember` (
  `id` int(11) NOT NULL,
  `patient_id` int(11) NOT NULL,
  `member_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `familymember`
--

INSERT INTO `familymember` (`id`, `patient_id`, `member_id`) VALUES
(1, 10, 11),
(8, 10, 12);

-- --------------------------------------------------------

--
-- Table structure for table `report`
--

CREATE TABLE `report` (
  `patient_id` int(11) NOT NULL,
  `heart_rate` varchar(3) NOT NULL,
  `blood_pressure` varchar(3) NOT NULL,
  `respiratory_rate` varchar(10) NOT NULL,
  `oxygen_saturation` varchar(10) NOT NULL,
  `body_temperature` varchar(10) NOT NULL,
  `glucose_level` varchar(10) NOT NULL,
  `bmi` varchar(10) NOT NULL,
  `cholesterol_level` varchar(10) NOT NULL,
  `hemoglobin_level` varchar(10) NOT NULL,
  `pain_scale` varchar(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `report`
--

INSERT INTO `report` (`patient_id`, `heart_rate`, `blood_pressure`, `respiratory_rate`, `oxygen_saturation`, `body_temperature`, `glucose_level`, `bmi`, `cholesterol_level`, `hemoglobin_level`, `pain_scale`) VALUES
(10, '72', '120', '16', '98', '98.6', '90', '22.5', '180', '15', '2'),
(14, '80', '120', '23', '32', '433', '343', '43', 'avb', '43', '2');

-- --------------------------------------------------------

--
-- Table structure for table `user`
--

CREATE TABLE `user` (
  `user_id` int(11) NOT NULL,
  `user_name` varchar(30) NOT NULL,
  `user_phone` varchar(20) NOT NULL,
  `user_password` varchar(200) NOT NULL,
  `user_role` varchar(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `user`
--

INSERT INTO `user` (`user_id`, `user_name`, `user_phone`, `user_password`, `user_role`) VALUES
(9, 'Ferdous Hasan', '0167877494', '$2y$10$YGvsDfc9cIqfqELHH57/j.OyxcQsZcUjBfNsxs6QE3Cs9ofmHdDQy', 'admin'),
(10, 'Mybop', '12318562709', '$2y$10$Q0kuEcwwA2Ut/4YzO.pkS.YLbI.Ybg0VXvK2t8Bq9T3QbPIVszKAK', 'patient'),
(11, 'Jixyzydoqo', '11192483884', '$2y$10$iiN1bPqgPPiXnJOQ4O9tQOd8i7Cs3uUKOukJmWuednMFrOsPOYyWm', 'familymember'),
(12, 'Hahigas', '12189354179', '$2y$10$cO68a3zROXGcNlQMWnDoleQEjrEhfZ6W431nJ4y6rvYNJU3ag2FsG', 'familymember'),
(13, 'Tosybisah', '17869576982', '$2y$10$bPqzuwhI/XDU.XZ/Ud05mObN7AXZvhKuhtXQv59AIZWidqBxU8YwG', 'staff'),
(14, 'Zovexofa', '15623998664', '$2y$10$dkBnKY51BuCdDQltDn1x2.RmKcxzcr3zvYvC2a4vNkCooKz34BJgS', 'patient');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `familymember`
--
ALTER TABLE `familymember`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `report`
--
ALTER TABLE `report`
  ADD PRIMARY KEY (`patient_id`);

--
-- Indexes for table `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`user_id`),
  ADD UNIQUE KEY `user_phone` (`user_phone`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `familymember`
--
ALTER TABLE `familymember`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `user`
--
ALTER TABLE `user`
  MODIFY `user_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
