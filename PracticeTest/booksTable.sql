-- phpMyAdmin SQL Dump
-- version 5.1.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jul 22, 2021 at 02:04 PM
-- Server version: 10.4.19-MariaDB
-- PHP Version: 8.0.7

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `fpt_aptech`
--

-- --------------------------------------------------------

--
-- Table structure for table `books`
--
DROP DATABASE IF EXISTS `fpt-aptech`;
CREATE DATABASE `fpt-aptech`;

DROP TABLE IF EXISTS `books`;
CREATE TABLE `books` (
  `bookid` int(11) NOT NULL,
  `authorid` int(11) NOT NULL DEFAULT 0,
  `title` varchar(55) NOT NULL,
  `ISBN` varchar(25) NOT NULL,
  `pub_year` smallint(6) NOT NULL DEFAULT 0,
  `available` tinyint(4) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `books`
--

INSERT INTO `books` (`bookid`, `authorid`, `title`, `ISBN`, `pub_year`, `available`) VALUES
(1, 1, 'Cross-Platform Development with Qt 6 and Modern C++', '9781800204584', 2021, 1),
(2, 2, 'Expert Python Programming - Fourth Edition', '9781801071109', 2021, 1),
(3, 3, '40 Algorithms Every Programmer Should Know', '9781789801217', 2020, 1),
(4, 2, 'Node.js Design Patterns - Third Edition', '9781839214110', 2020, 1),
(5, 1, 'Python Object-Oriented Programming - Fourth Edition', '9781801077262', 2021, 1),
(6, 4, 'Software Architecture with C++', '9781838554590', 2021, 0),
(7, 5, 'Linux System Programming Techniques', '9781789951288', 2021, 1),
(8, 2, 'Polished Ruby Programming', '9781801072724', 2021, 0),
(9, 1, 'Mastering TypeScript - Fourth Edition', '9781800564732', 2021, 1),
(10, 5, 'Clean Code in Python - Second Edition', '9781800560215', 2021, 1),
(11, 3, 'Microsoft Power Apps Cookbook', '9781800569553', 2021, 1),
(12, 2, 'PHP 7 Data Structures and Algorithms', '9781786463890', 2017, 0),
(13, 4, 'Object Oriented PHP and MVC', '9781789533149', 2018, 1),
(14, 3, 'Beginning PHP', '9781789535686', 2018, 1);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `books`
--
ALTER TABLE `books`
  ADD PRIMARY KEY (`bookid`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `books`
--
ALTER TABLE `books`
  MODIFY `bookid` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
