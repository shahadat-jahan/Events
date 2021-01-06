-- phpMyAdmin SQL Dump
-- version 4.5.1
-- http://www.phpmyadmin.net
--
-- Host: 127.0.0.1
-- Generation Time: Jan 04, 2018 at 09:13 AM
-- Server version: 10.1.9-MariaDB
-- PHP Version: 5.6.15

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `events`
--

-- --------------------------------------------------------

--
-- Table structure for table `areas`
--

CREATE TABLE `areas` (
  `id` int(11) NOT NULL,
  `area` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `areas`
--

INSERT INTO `areas` (`id`, `area`) VALUES
(1, 'North'),
(2, 'South'),
(3, 'East'),
(4, 'West');

-- --------------------------------------------------------

--
-- Table structure for table `clubs`
--

CREATE TABLE `clubs` (
  `id` int(11) NOT NULL,
  `name` varchar(50) NOT NULL,
  `type` int(11) NOT NULL,
  `area` int(11) NOT NULL,
  `email` varchar(50) NOT NULL,
  `description` text NOT NULL,
  `login` varchar(8) NOT NULL,
  `password` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `clubs`
--

INSERT INTO `clubs` (`id`, `name`, `type`, `area`, `email`, `description`, `login`, `password`) VALUES
(1, '', 0, 0, '', '', 'jahan', 'e10adc39'),
(2, '', 0, 0, '', '', 'jahandsf', 'e10adc39'),
(3, '', 0, 0, '', '', 'jaki', 'e10adc3949ba59abbe56e057f20f883e'),
(4, '', 0, 0, '', '', 'jaa', 'e10adc3949ba59abbe56e057f20f883e'),
(5, 'Test1sdfsd', 2, 4, 'club@email.com', 'Club description testing																																	', 'jahan123', 'e10adc3949ba59abbe56e057f20f883e'),
(7, 'Model', 1, 1, 'mail@mail.com', 'test', 'mist', 'e10adc3949ba59abbe56e057f20f883e');

-- --------------------------------------------------------

--
-- Table structure for table `events`
--

CREATE TABLE `events` (
  `id` int(11) NOT NULL,
  `type` char(3) NOT NULL,
  `area` char(3) NOT NULL,
  `edate` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `ename` varchar(100) NOT NULL,
  `evanue` varchar(100) NOT NULL,
  `eaddress` varchar(255) NOT NULL,
  `ezip` varchar(20) NOT NULL,
  `edescription` blob NOT NULL,
  `eclub` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `types`
--

CREATE TABLE `types` (
  `id` int(11) NOT NULL,
  `type` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `types`
--

INSERT INTO `types` (`id`, `type`) VALUES
(1, 'Music'),
(2, 'Family'),
(3, 'Community'),
(4, 'Social');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `areas`
--
ALTER TABLE `areas`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `clubs`
--
ALTER TABLE `clubs`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `events`
--
ALTER TABLE `events`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `types`
--
ALTER TABLE `types`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `areas`
--
ALTER TABLE `areas`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;
--
-- AUTO_INCREMENT for table `clubs`
--
ALTER TABLE `clubs`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;
--
-- AUTO_INCREMENT for table `events`
--
ALTER TABLE `events`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `types`
--
ALTER TABLE `types`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
