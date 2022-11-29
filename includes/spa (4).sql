-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Nov 29, 2022 at 06:29 AM
-- Server version: 10.4.25-MariaDB
-- PHP Version: 8.0.23

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `spa`
--

-- --------------------------------------------------------

--
-- Table structure for table `appointments`
--

CREATE TABLE `appointments` (
  `Id` int(100) NOT NULL,
  `fullname` varchar(255) NOT NULL,
  `user_id` int(10) NOT NULL,
  `agent` int(100) NOT NULL,
  `service_id` int(100) NOT NULL,
  `branches_id` int(100) NOT NULL,
  `appointment_date` varchar(30) NOT NULL,
  `speciality` varchar(255) NOT NULL,
  `status` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `appointments`
--

INSERT INTO `appointments` (`Id`, `fullname`, `user_id`, `agent`, `service_id`, `branches_id`, `appointment_date`, `speciality`, `status`) VALUES
(1, 'updatetest', 0, 0, 0, 0, '', '', ''),
(2, 'updatetest', 0, 0, 0, 0, '', '', ''),
(3, 'updatetest', 0, 0, 0, 0, '', '', ''),
(4, 'updatetest', 0, 0, 0, 0, '', '', ''),
(5, 'updatetest', 0, 0, 0, 0, '', '', ''),
(6, 'updatetest', 0, 0, 0, 0, '', '', ''),
(7, 'updatetest', 0, 0, 0, 0, '', '', ''),
(8, 'updatetest', 0, 0, 0, 0, '', '', ''),
(9, 'updatetest', 0, 0, 0, 0, '', '', ''),
(10, 'updatetest', 0, 0, 0, 0, '', '', ''),
(11, 'updatetest', 0, 0, 0, 0, '', '', ''),
(12, 'updatetest', 0, 0, 0, 0, '', '', ''),
(13, 'updatetest', 0, 0, 0, 0, '', '', ''),
(14, 'updatetest', 0, 0, 0, 0, '', '', ''),
(15, 'updatetest', 0, 0, 0, 0, '', '', ''),
(16, 'updatetest', 0, 0, 0, 0, '', '', ''),
(17, 'updatetest', 0, 0, 0, 0, '', '', ''),
(18, 'updatetest', 0, 0, 0, 0, '', '', ''),
(19, 'updatetest', 0, 0, 0, 0, '', '', ''),
(20, 'updatetest', 0, 0, 0, 0, '', '', ''),
(21, 'updatetest', 0, 0, 0, 0, '', '', ''),
(22, 'updatetest', 0, 0, 0, 0, '', '', ''),
(23, '', 2, 9, 1, 3, '11/26/2022 11:48 ', 'Test update', 'cancel appointment'),
(24, '', 2, 9, 6, 3, '11/28/2022 17:02  ', 'Test', 'confirm'),
(25, '', 2, 6, 7, 3, '11/29/2022 10:00', 'Can I get a discount.', 'pending');

-- --------------------------------------------------------

--
-- Table structure for table `branches`
--

CREATE TABLE `branches` (
  `id` int(11) NOT NULL,
  `bname` varchar(50) NOT NULL,
  `location` varchar(50) NOT NULL,
  `bmanager` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `branches`
--

INSERT INTO `branches` (`id`, `bname`, `location`, `bmanager`) VALUES
(1, 'Ora Nail Spot (Nairobi)', 'Nairobi', '1'),
(3, 'Ora Nail Spot 2', 'Kitengela', '6'),
(6, 'Ora Nail Spot', 'Ruiru', '5');

-- --------------------------------------------------------

--
-- Table structure for table `designations`
--

CREATE TABLE `designations` (
  `id` int(50) NOT NULL,
  `designation_name` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `designations`
--

INSERT INTO `designations` (`id`, `designation_name`) VALUES
(1, 'Manager'),
(6, 'Receptionist');

-- --------------------------------------------------------

--
-- Table structure for table `employees`
--

CREATE TABLE `employees` (
  `id` int(11) NOT NULL,
  `fname` varchar(50) NOT NULL,
  `lname` varchar(50) NOT NULL,
  `email` varchar(100) NOT NULL,
  `uname` varchar(50) NOT NULL,
  `designation` varchar(100) NOT NULL,
  `phone_no` varchar(14) NOT NULL,
  `password` varchar(100) NOT NULL,
  `branch` varchar(50) NOT NULL,
  `gender` enum('Male','Female') NOT NULL,
  `utype` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `employees`
--

INSERT INTO `employees` (`id`, `fname`, `lname`, `email`, `uname`, `designation`, `phone_no`, `password`, `branch`, `gender`, `utype`) VALUES
(1, 'Alice', 'Nyagah', 'a.nyagah@gmail.com', 'A.Nyagah', '5', '+254 722 00001', '827ccb0eea8a706c4c34a16891f84e7b', '1', 'Female', 'manager'),
(5, 'Stephen', 'Mutiso', 'stephen@gmail.com', 'S.Mutiso', '5', '+254 720 00003', '827ccb0eea8a706c4c34a16891f84e7b', '1', 'Male', 'staff'),
(6, 'Dennis', 'Waweru', 'denniswaweru71@gmail.com', 'D.Waweru', '1', '+254 720 00002', '827ccb0eea8a706c4c34a16891f84e7b', '3', 'Male', 'bmanager'),
(7, 'Patrick', 'Maina', 'pato@gmail.com', 'P.Maina', '1', '+254 720 00000', '827ccb0eea8a706c4c34a16891f84e7b', '6', 'Male', 'bmanager'),
(8, 'Victor', 'Onyango', 'victor@gmail.com', 'V.Onyango', '5', '+254 720 00000', '827ccb0eea8a706c4c34a16891f84e7b', '6', 'Male', 'staff'),
(9, 'George', 'Wanyonyi', 'george@gmail.com', 'G.Wanyonyi', '6', '+254 720 00000', '827ccb0eea8a706c4c34a16891f84e7b', '3', 'Male', 'staff'),
(10, 'Derrick', 'Waithatka', 'dede@gmail.com', 'D.Waithatka', '5', '+254 720 00000', '827ccb0eea8a706c4c34a16891f84e7b', '3', 'Male', 'staff');

-- --------------------------------------------------------

--
-- Table structure for table `services`
--

CREATE TABLE `services` (
  `id` int(100) NOT NULL,
  `serve_name` varchar(255) NOT NULL,
  `price` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `services`
--

INSERT INTO `services` (`id`, `serve_name`, `price`) VALUES
(6, 'Manicure', 0),
(7, 'Waxing', 0),
(8, 'Micro Blading', 0),
(9, 'Pedicure', 500),
(10, 'Hair Cut', 400),
(11, 'Full body massage', 4500);

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `first_name` varchar(100) NOT NULL,
  `last_name` varchar(100) NOT NULL,
  `email` varchar(255) NOT NULL,
  `uname` varchar(100) NOT NULL,
  `utype` varchar(100) NOT NULL,
  `phone_no` varchar(14) NOT NULL,
  `password` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `first_name`, `last_name`, `email`, `uname`, `utype`, `phone_no`, `password`) VALUES
(1, 'Admin', 'Strator', 'admin@admin.com', 'A.Strator', 'user', '+254 722 00000', '827ccb0eea8a706c4c34a16891f84e7b'),
(2, 'Dennis', 'Waweru', 'denniswaweru71@gmail.com', 'D.Waweru', 'user', '+254 720 00000', '827ccb0eea8a706c4c34a16891f84e7b');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `appointments`
--
ALTER TABLE `appointments`
  ADD PRIMARY KEY (`Id`);

--
-- Indexes for table `branches`
--
ALTER TABLE `branches`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `designations`
--
ALTER TABLE `designations`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `employees`
--
ALTER TABLE `employees`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `services`
--
ALTER TABLE `services`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `appointments`
--
ALTER TABLE `appointments`
  MODIFY `Id` int(100) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=26;

--
-- AUTO_INCREMENT for table `branches`
--
ALTER TABLE `branches`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `designations`
--
ALTER TABLE `designations`
  MODIFY `id` int(50) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `employees`
--
ALTER TABLE `employees`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT for table `services`
--
ALTER TABLE `services`
  MODIFY `id` int(100) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
