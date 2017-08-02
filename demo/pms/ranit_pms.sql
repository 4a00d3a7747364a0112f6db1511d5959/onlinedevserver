-- phpMyAdmin SQL Dump
-- version 4.0.4.1
-- http://www.phpmyadmin.net
--
-- Host: 127.0.0.1
-- Generation Time: Jul 13, 2017 at 07:58 AM
-- Server version: 5.6.11
-- PHP Version: 5.5.3

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Database: `ranit_pms`
--
CREATE DATABASE IF NOT EXISTS `ranit_pms` DEFAULT CHARACTER SET latin1 COLLATE latin1_swedish_ci;
USE `ranit_pms`;

-- --------------------------------------------------------

--
-- Table structure for table `content`
--

CREATE TABLE IF NOT EXISTS `content` (
  `content_id` int(200) NOT NULL AUTO_INCREMENT,
  `emp_id` int(200) NOT NULL,
  `proj_name` varchar(200) NOT NULL,
  `time_to` varchar(200) NOT NULL,
  `time_from` varchar(200) NOT NULL,
  `content_details` varchar(300) NOT NULL,
  `created_date` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`content_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=3 ;

--
-- Dumping data for table `content`
--

INSERT INTO `content` (`content_id`, `emp_id`, `proj_name`, `time_to`, `time_from`, `content_details`, `created_date`) VALUES
(1, 1, 'Therexportal', '11.10am', '1142pm', 'working on the prining page', '2017-07-12 11:38:10'),
(2, 1, 'now porj', 'sdf', 'sdf', 'sdfsf', '2017-07-12 11:50:31');

-- --------------------------------------------------------

--
-- Table structure for table `employes`
--

CREATE TABLE IF NOT EXISTS `employes` (
  `u_id` int(200) NOT NULL AUTO_INCREMENT,
  `u_email` varchar(200) NOT NULL,
  `u_password` varchar(200) NOT NULL,
  PRIMARY KEY (`u_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=2 ;

--
-- Dumping data for table `employes`
--

INSERT INTO `employes` (`u_id`, `u_email`, `u_password`) VALUES
(1, 'ranit@uniterrene.com', 'ranit!@#');

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;