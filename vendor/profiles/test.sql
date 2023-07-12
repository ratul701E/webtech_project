-- phpMyAdmin SQL Dump
-- version 5.1.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jul 03, 2023 at 06:55 PM
-- Server version: 10.4.20-MariaDB
-- PHP Version: 8.0.8

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `test`
--

-- --------------------------------------------------------

--
-- Table structure for table `comment`
--

CREATE TABLE `comment` (
  `msg` varchar(500) NOT NULL,
  `username` varchar(32) NOT NULL,
  `post_id` varchar(32) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `comment`
--

INSERT INTO `comment` (`msg`, `username`, `post_id`) VALUES
('here is the first comment.', 'ratul', '1'),
('here is the second comment.', 'priya', '1'),
('here is the third comment', 'rabby', '1'),
('it is very dangerous', 'rabby', '2'),
('Its a threat for your data.', 'ratul', '2'),
('#CHECK', 'ratul', '3'),
('hello im new here', 'rafi', '3'),
('', 'rabby', '3'),
('kire rafi kmn asos\r\n', 'ratul', '4'),
('valo', 'rafi', '4'),
('hello', 'priya', '4'),
('asdfsadfs', 'priya', '5'),
('hi\r\n', 'ratul', '5'),
('hi ratul\r\n', 'priya', '5');

-- --------------------------------------------------------

--
-- Table structure for table `dp`
--

CREATE TABLE `dp` (
  `username` varchar(32) NOT NULL,
  `_location` varchar(500) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `dp`
--

INSERT INTO `dp` (`username`, `_location`) VALUES
('priya', 'WIN_20220320_09_05_33_Pro.jpg'),
('rabby', '1c93580d1bac5bb0cea5c92539bd3ba2.jpg'),
('rafi', 'WIN_20220613_20_00_11_Pro.jpg'),
('ratul', '21-44588-1.jpg');

-- --------------------------------------------------------

--
-- Table structure for table `info`
--

CREATE TABLE `info` (
  `username` varchar(32) NOT NULL,
  `full_name` varchar(32) NOT NULL,
  `mobile` varchar(15) NOT NULL,
  `_password` varchar(32) NOT NULL,
  `role` varchar(5) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `info`
--

INSERT INTO `info` (`username`, `full_name`, `mobile`, `_password`, `role`) VALUES
('priya', 'Asiya Akter', '01730461152', 'priya', 'user'),
('rabby', 'jahid hasan rabby', '01905053225', 'jahid', 'user'),
('rafi', 'Al Muktadir Rafi', '01715482287', 'rafi', 'user'),
('ratul', 'MD Asraful Alam', '+8801920221554', 'ratul', 'admin'),
('tester', 'Tester 1', '0192022554', 'tester1', 'user');

-- --------------------------------------------------------

--
-- Table structure for table `post`
--

CREATE TABLE `post` (
  `post_id` varchar(32) NOT NULL,
  `username` varchar(32) NOT NULL,
  `domain` varchar(50) NOT NULL,
  `title` varchar(150) NOT NULL,
  `body` varchar(1000) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `post`
--

INSERT INTO `post` (`post_id`, `username`, `domain`, `title`, `body`) VALUES
('1', 'ratul', 'AI', 'Testing first post', 'Here is the body'),
('2', 'rabby', 'Cyber Security', 'what is trozan', 'In publishing and graphic design, Lorem ipsum is a placeholder text commonly used to demonstrate the visual form of a document or a typeface without relying on meaningful content. Lorem ipsum may be used as a placeholder before final copy is available. It is also used to temporarily replace text in a process called greeking, which allows designers to consider the form '),
('3', 'ratul', 'on', 'First post ', 'Checking our posting system.  #IGNORE'),
('4', 'rafi', 'on', 'Hi guys ', 'Im back'),
('5', 'priya', 'AI', 'test', 'test test');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `dp`
--
ALTER TABLE `dp`
  ADD PRIMARY KEY (`username`);

--
-- Indexes for table `info`
--
ALTER TABLE `info`
  ADD PRIMARY KEY (`username`);

--
-- Indexes for table `post`
--
ALTER TABLE `post`
  ADD PRIMARY KEY (`post_id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
