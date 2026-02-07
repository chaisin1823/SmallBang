-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Feb 07, 2026 at 09:38 AM
-- Server version: 10.4.32-MariaDB
-- PHP Version: 8.0.30

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `smallbang_user_details`
--

-- --------------------------------------------------------

--
-- Table structure for table `appointment_details`
--

CREATE TABLE `appointment_details` (
  `id` int(11) NOT NULL,
  `fullName` varchar(50) NOT NULL,
  `appDate` date NOT NULL,
  `appTime` time NOT NULL,
  `category` varchar(50) NOT NULL,
  `serviceName` varchar(50) NOT NULL,
  `status` varchar(20) NOT NULL DEFAULT 'Pending'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `appointment_details`
--

INSERT INTO `appointment_details` (`id`, `fullName`, `appDate`, `appTime`, `category`, `serviceName`, `status`) VALUES
(2, 'Lee Wen XI', '2026-02-07', '02:00:00', 'Specialist Services', 'Dental Implant Consultation', 'Approved'),
(3, 'Teo Kok Chuan', '2026-02-19', '10:00:00', 'Cosmetic & Aesthetic', 'Porcelain Veneers Consultation', 'Cancelled'),
(4, 'Ho Yin Ying', '2026-02-22', '11:00:00', 'General Dentistry', 'Scale & Polish - Deep Cleaning', 'Approved'),
(5, 'Lee Min Xi', '2026-02-28', '02:00:00', 'General Dentistry', 'Scale & Polish - Deep Cleaning', 'Approved');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `appointment_details`
--
ALTER TABLE `appointment_details`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `appointment_details`
--
ALTER TABLE `appointment_details`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
