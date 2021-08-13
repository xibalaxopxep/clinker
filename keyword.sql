-- phpMyAdmin SQL Dump
-- version 4.7.4
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Oct 21, 2019 at 12:29 PM
-- Server version: 10.1.28-MariaDB
-- PHP Version: 7.1.10

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `alagreen`
--

-- --------------------------------------------------------

--
-- Table structure for table `keyword`
--

CREATE TABLE `keyword` (
  `id` int(11) NOT NULL,
  `keyword` varchar(255) NOT NULL,
  `created_at` datetime NOT NULL,
  `updated_at` datetime NOT NULL,
  `count` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `keyword`
--

INSERT INTO `keyword` (`id`, `keyword`, `created_at`, `updated_at`, `count`) VALUES
(1, 'bán', '2019-10-21 04:58:16', '2019-10-21 05:07:06', 7),
(2, 'bans', '2019-10-21 05:03:41', '2019-10-21 05:03:41', 1),
(3, 'trien lam', '2019-10-21 07:59:59', '2019-10-21 07:59:59', 1),
(4, 'ghe', '2019-10-21 08:00:14', '2019-10-21 08:00:14', 1),
(5, 'thiet bi bao ve', '2019-10-21 08:05:10', '2019-10-21 08:06:29', 3),
(6, 'Vòi chậu gật gù nóng lạnh TLG01301V', '2019-10-21 10:13:47', '2019-10-21 10:21:18', 2),
(7, 'Vòi chậu gật gù', '2019-10-21 10:19:28', '2019-10-21 10:21:05', 3),
(8, 'Vòi', '2019-10-21 10:19:35', '2019-10-21 10:19:35', 1),
(9, 'Vòi chậu', '2019-10-21 10:19:44', '2019-10-21 10:20:29', 2);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `keyword`
--
ALTER TABLE `keyword`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `keyword`
--
ALTER TABLE `keyword`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
