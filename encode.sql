-- phpMyAdmin SQL Dump
-- version 4.8.3
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Nov 13, 2018 at 01:03 AM
-- Server version: 10.1.36-MariaDB
-- PHP Version: 7.2.10

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `encode`
--

-- --------------------------------------------------------

--
-- Table structure for table `encode`
--

CREATE TABLE `encode` (
  `id` int(11) NOT NULL,
  `message` varchar(255) DEFAULT NULL,
  `encodedFile` varchar(255) DEFAULT NULL,
  `decodedFile` varchar(255) DEFAULT NULL,
  `senderId` int(11) DEFAULT NULL,
  `receiverId` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `encode`
--

INSERT INTO `encode` (`id`, `message`, `encodedFile`, `decodedFile`, `senderId`, `receiverId`) VALUES
(1, NULL, 'Conference-template-A4.doc', '45353062_592964461147212_6192686101677735936_n.jpg', 1, 3),
(3, NULL, 'Assigned Task for week 1.xlsx', 'uiu-ccl.jpg', 3, 1);

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `name` varchar(25) DEFAULT NULL,
  `email` varchar(255) DEFAULT NULL,
  `password` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `name`, `email`, `password`) VALUES
(1, 'Jobaer Surid', 'surid@jobaer.com', '123456'),
(2, 'Admin', 'admin@porao.com', 'admin'),
(3, 'Josna', 'j@j.com', '1234'),
(4, 'Mohona', 'm@m.com', '1234');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `encode`
--
ALTER TABLE `encode`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `encodedFile` (`encodedFile`,`decodedFile`),
  ADD KEY `senderId` (`senderId`),
  ADD KEY `receiverId` (`receiverId`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `encode`
--
ALTER TABLE `encode`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `encode`
--
ALTER TABLE `encode`
  ADD CONSTRAINT `encode_ibfk_1` FOREIGN KEY (`senderId`) REFERENCES `users` (`id`),
  ADD CONSTRAINT `encode_ibfk_2` FOREIGN KEY (`receiverId`) REFERENCES `users` (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
