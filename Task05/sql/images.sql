-- phpMyAdmin SQL Dump
-- version 5.1.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jul 15, 2021 at 04:19 PM
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
-- Database: `mygallery`
--

-- --------------------------------------------------------

--
-- Table structure for table `images`
--

CREATE TABLE `images` (
  `imageid` int(11) NOT NULL,
  `title` text DEFAULT NULL,
  `imgFullName` longtext DEFAULT NULL,
  `orderGallery` int(11) DEFAULT NULL,
  `likes` int(11) DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `images`
--

INSERT INTO `images` (`imageid`, `title`, `imgFullName`, `orderGallery`, `likes`) VALUES
(21, 'Flowers are blooming <3', 'blooming.60ec3cb1bcce48.02039480.jpg', 1, 0),
(22, 'Beautiful blue sky', 'bluesky.60ec3cc1695532.46735335.jpg', 2, 0),
(23, 'Peaceful countryside', 'coutryside.60ec3cea367de5.33848929.jpg', 3, 0),
(24, 'A leaf', 'leaf.60ec3cf48d11f4.61448105.jpg', 4, 0),
(25, 'Lovely face', 'face.60ec3d1e285ec0.55774483.jpg', 5, 0),
(26, 'Adventure to the forest', 'adventure.60ec3d282966e8.27361005.jpg', 6, 0),
(27, 'A bunch of flower', 'flower.60ec3d477cb0b8.39550322.jpg', 7, 0),
(28, 'Colorful flying umbrella', 'flyingumbrella.60ec3d54e1ebc3.53528741.jpg', 8, 1),
(29, 'Colorful forest in autumn', 'forest.60ec3d69cda9b6.51513923.jpg', 9, 0),
(30, 'Idiom about life', 'life.60ec3d81019138.90086214.jpg', 10, 0),
(31, 'Greatest mountain', 'mountain.60ec3d93beff06.84183005.jpg', 11, 1),
(32, 'Team work makes work easier', 'teamwork.60ec3dad278df4.48986313.jpg', 12, 1),
(33, 'Some lines of code', 'coding.60ec3dd6e0c798.01551520.png', 13, 0),
(34, 'My desktop 1', 'desktop1.60ec4132ca5f23.15319608.jpg', 14, 1),
(35, 'My desktop 2', 'desktop2.60ec41472d5ef3.40909179.jpg', 15, 1),
(36, 'Heart icon ', 'heart.60ef8fc0a8e8a7.07335085.png', 16, 2);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `images`
--
ALTER TABLE `images`
  ADD PRIMARY KEY (`imageid`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `images`
--
ALTER TABLE `images`
  MODIFY `imageid` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=37;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
