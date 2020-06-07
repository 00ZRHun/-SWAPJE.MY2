-- phpMyAdmin SQL Dump
-- version 4.9.3
-- https://www.phpmyadmin.net/
--
-- Host: localhost:8889
-- Generation Time: May 25, 2020 at 06:56 PM
-- Server version: 5.7.26
-- PHP Version: 7.4.2

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";

--
-- Database: `carrental`
--

-- --------------------------------------------------------

--
-- Table structure for table `tblpostitem`
--

CREATE TABLE `tblpostitem` (
  `id` int(11) NOT NULL,
  `productName` varchar(100) DEFAULT NULL,
  `usedYear` int(4) DEFAULT NULL,
  `overview` longtext,
  `pricePerDay` int(12) DEFAULT NULL,
  `totalPrice` int(12) DEFAULT NULL,
  `payPalBusinessAccount` varchar(100) DEFAULT NULL,
  `contactNo` int(15) DEFAULT NULL,
  `Vimage1` varchar(120) DEFAULT NULL,
  `Vimage2` varchar(120) DEFAULT NULL,
  `Vimage3` varchar(120) DEFAULT NULL,
  `Vimage4` varchar(120) DEFAULT NULL,
  `Vimage5` varchar(120) DEFAULT NULL,
  `sell` int(11) DEFAULT NULL,
  `rent` int(11) DEFAULT NULL,
  `swap` int(11) DEFAULT NULL,
  `updationDate` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `delmode` varchar(100) DEFAULT '1',
  `value` int(12) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tblpostitem`
--

INSERT INTO `tblpostitem` (`id`, `productName`, `usedYear`, `overview`, `pricePerDay`, `totalPrice`, `payPalBusinessAccount`, `contactNo`, `Vimage1`, `Vimage2`, `Vimage3`, `Vimage4`, `Vimage5`, `sell`, `rent`, `swap`, `updationDate`, `delmode`, `value`) VALUES
(2, 'a', 1, 'a', 1, 1, 'jobbusiness@gmail.com', 1, 'Screenshot 2020-05-23 at 3.27.44 PM.png', '', '', '', '', 1, 1, 1, '2020-05-25 11:26:37', '1', 100),
(3, 'a', 1, 'a', 1, 1, 'a@gmail.com', 1, 'Screenshot 2020-05-23 at 3.27.44 PM.png', '', '', '', '', 1, 1, 1, '2020-05-25 11:28:09', '1', 100),
(4, 'a', 1, 'a', 1, 1, 'a@gmail.com', 1, 'Screenshot 2020-05-23 at 3.27.44 PM.png', '', '', '', '', 1, 1, 1, '2020-05-25 11:28:18', '1', 300),
(5, 'z', 0, 'zzzzzzzzzzzzzzzzzzzzzzzzzzzzzzzzzzzzzzzzzz', 0, 0, 'z@gmail.com', 0, 'Screenshot 2020-05-23 at 3.29.27 PM.png', '', '', '', '', 1, NULL, NULL, '2020-05-25 13:09:55', '1', 200),
(6, ':productName', 1, ':overview', 1, 1, 'hun@gmail.com', 1, ':vimage1', ':vimage2', ':vimage3', ':vimage4', ':vimage5', 1, 1, 1, '2020-05-25 13:30:54', '1', 1),
(7, 'Book', 1, 'It is a long established fact that a reader will be distracted by the readable content of a page when looking at its layout. The point of using Lorem Ipsum is that it has a more-or-less normal distribution of letters, as opposed to using \'Content here, content here\', making it look like readable English. Many desktop publishing packages and web page editors now use Lorem Ipsum as their default model text, and a search for \'lorem ipsum\' will uncover many web sites still in their infancy. Various versions have evolved over the years, sometimes by accident, sometimes on purpose (injected humour and the like).', 1, 5, 'businesspersonal@gmail.com', 1, 'Screenshot 2020-05-23 at 2.53.06 PM.png', '', '', '', '', 1, 1, 1, '2020-05-25 13:31:06', '1', 10),
(8, 'x', 1, 'x', 1, 1, 'x@gmail.com', 1110604061, 'Screenshot 2020-05-23 at 3.20.44 PM.png', '', '', '', '', NULL, 1, NULL, '2020-05-25 13:32:12', '1', 1);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `tblpostitem`
--
ALTER TABLE `tblpostitem`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `tblpostitem`
--
ALTER TABLE `tblpostitem`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;
