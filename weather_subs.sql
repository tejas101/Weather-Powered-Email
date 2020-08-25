-- phpMyAdmin SQL Dump
-- version 4.8.4
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jan 21, 2019 at 10:42 PM
-- Server version: 10.1.37-MariaDB
-- PHP Version: 7.3.0

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `weather_subs`
--

-- --------------------------------------------------------

--
-- Table structure for table `subs_list`
--

CREATE TABLE `subs_list` (
  `email` varchar(100) NOT NULL,
  `city` text NOT NULL,
  `email_status` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `subs_list`
--

INSERT INTO `subs_list` (`email`, `city`, `email_status`) VALUES
('weatherapp+anc@klaviyo.com', 'Anchorage', 'Sent'),
('weatherapp+aus@klaviyo.com', 'Austin', 'Sent'),
('weatherapp+bos@klaviyo.com', 'Boston', 'Sent'),
('weatherapp+sea@klaviyo.com', 'Seattle', 'Sent'),
('weatherapp+wdc@klaviyo.com', 'Washington', 'Sent');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `subs_list`
--
ALTER TABLE `subs_list`
  ADD UNIQUE KEY `Email` (`email`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
