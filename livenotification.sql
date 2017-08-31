-- phpMyAdmin SQL Dump
-- version 4.6.5.2
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Aug 31, 2017 at 12:44 PM
-- Server version: 10.1.21-MariaDB
-- PHP Version: 5.6.30

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `livenotification`
--

-- --------------------------------------------------------

--
-- Table structure for table `comments`
--

CREATE TABLE `comments` (
  `comment_id` int(11) NOT NULL,
  `comment_subject` varchar(250) NOT NULL,
  `comment_text` text NOT NULL,
  `comment_status` int(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `comments`
--

INSERT INTO `comments` (`comment_id`, `comment_subject`, `comment_text`, `comment_status`) VALUES
(1, 'Test', 'Testing ', 1),
(2, 'Tsad ', 'asd a', 1),
(3, 'New', 'New 1', 1),
(4, 'Hello', 'Hello World', 1),
(5, 'Gode Bye', 'Good Bye 1', 1),
(6, 'Count 5', '5', 1),
(7, 'Testing the Count', 'Count Test', 1),
(8, 'Counter Test 2', '2 no Counter Testing', 1),
(9, 'Tab test', 'Tab Testing comment', 1),
(10, 'Test', 'tttt', 1),
(11, 'Testing for Both', 'This is the both notification', 1),
(12, 'Test', 'sada', 1),
(13, 'Test', 'Test Notification', 0),
(14, 'Test 2 ', 'Test 2 Notification', 0),
(15, 'Test 3 ', 'Test For Notification 3', 0);

-- --------------------------------------------------------

--
-- Table structure for table `tbl_users`
--

CREATE TABLE `tbl_users` (
  `user_id` int(11) NOT NULL,
  `username` varchar(60) NOT NULL,
  `email` varchar(60) NOT NULL,
  `password` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `tbl_users`
--

INSERT INTO `tbl_users` (`user_id`, `username`, `email`, `password`) VALUES
(1, 'admin@admin.com', 'admin@admin.com', '$2y$10$mmun0XUsf68ysOy/D5aMkOZlFMoTYoMTBR5QoMcwKuKqSC5LH3PZ2'),
(2, 'Shahriar63', 'srm@srm.com', '$2y$10$E4WbY8PkDYnJxjZ4kuEw4eceXmtSV9CLbR4teyLtCtPWHinQIwW7y'),
(3, 'tabarak', 'tab@tab.com', '$2y$10$abuR8uwDJXFMJd8lnIPy.Ox.UdUkNJ./ZDhaPs0eNrbXebP4ChNRC');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `comments`
--
ALTER TABLE `comments`
  ADD PRIMARY KEY (`comment_id`);

--
-- Indexes for table `tbl_users`
--
ALTER TABLE `tbl_users`
  ADD PRIMARY KEY (`user_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `comments`
--
ALTER TABLE `comments`
  MODIFY `comment_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=16;
--
-- AUTO_INCREMENT for table `tbl_users`
--
ALTER TABLE `tbl_users`
  MODIFY `user_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
