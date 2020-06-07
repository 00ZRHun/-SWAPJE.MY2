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
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `user_id` int(11) NOT NULL,
  `productName` varchar(100) DEFAULT NULL,
  `usedYear` int(4) DEFAULT NULL,
  `overview` longtext,
  `sell` int(11) DEFAULT NULL,
  `rent` int(11) DEFAULT NULL,
  `swap` int(11) DEFAULT NULL,
  `totalPrice` int(12) DEFAULT NULL,
  `pricePerDay` int(12) DEFAULT NULL,
  `value` int(12) NOT NULL,
  `payPalBusinessAccount` varchar(100) DEFAULT NULL,
  `contactNo` varchar(15) DEFAULT NULL,
  `Vimage1` varchar(120) DEFAULT NULL,
  `Vimage2` varchar(120) DEFAULT NULL,
  `Vimage3` varchar(120) DEFAULT NULL,
  `Vimage4` varchar(120) DEFAULT NULL,
  `Vimage5` varchar(120) DEFAULT NULL,
  `updationDate` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `delmode` varchar(100) DEFAULT '0',
  PRIMARY KEY (id)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;
