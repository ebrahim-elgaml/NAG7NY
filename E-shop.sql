-- phpMyAdmin SQL Dump
-- version 4.0.10deb1
-- http://www.phpmyadmin.net
--
-- Host: localhost
-- Generation Time: Oct 08, 2015 at 06:27 PM
-- Server version: 5.5.44-0ubuntu0.14.04.1
-- PHP Version: 5.5.9-1ubuntu4.11

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Database: `E-Shop`
--
CREATE DATABASE IF NOT EXISTS `E-Shop` DEFAULT CHARACTER SET latin1 COLLATE latin1_swedish_ci;
USE `E-Shop`;

-- --------------------------------------------------------

--
-- Table structure for table `cart`
--

DROP TABLE IF EXISTS `cart`;
CREATE TABLE IF NOT EXISTS `cart` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `user_id` int(11) NOT NULL,
  `project_id` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=13 ;

--
-- Dumping data for table `cart`
--

INSERT INTO `cart` (`id`, `user_id`, `project_id`) VALUES
(12, 12, 2);

-- --------------------------------------------------------

--
-- Table structure for table `course`
--

DROP TABLE IF EXISTS `course`;
CREATE TABLE IF NOT EXISTS `course` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(50) NOT NULL,
  `university_id` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=7 ;

--
-- Dumping data for table `course`
--

INSERT INTO `course` (`id`, `name`, `university_id`) VALUES
(1, 'CSEN101', 1),
(2, 'CSEN202', 1),
(3, 'CHEM101', 4),
(4, 'CHEM202', 4),
(5, 'Physyics101', 5),
(6, 'Physyics202', 5);

-- --------------------------------------------------------

--
-- Table structure for table `project`
--

DROP TABLE IF EXISTS `project`;
CREATE TABLE IF NOT EXISTS `project` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `price` int(11) NOT NULL,
  `name` varchar(50) NOT NULL,
  `course_id` int(11) DEFAULT NULL,
  `description` varchar(255) NOT NULL,
  `image_link` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=7 ;

--
-- Dumping data for table `project`
--

INSERT INTO `project` (`id`, `price`, `name`, `course_id`, `description`, `image_link`) VALUES
(1, 20, 'CS1 Assignment', 1, 'You are asked to find if a string is palindrome or not ,i.e palindrome strings can be read as the same from the start and end (rar, noon)', 'http://s3.postimg.org/pr4ruer83/spiral_2_books.png'),
(2, 25, 'cs1 Assignment2', 1, 'In this assignment you are required to implement a small application to calculate the how many prime numbers in a certain range of numbers', NULL),
(3, 25, 'Chem1 Assignment 1', 3, 'draw priodic table with all its elements and show the number of protons, electrons and neutrons for each element', 'http://s21.postimg.org/q0mnjlv7b/English21_320x150.jpg'),
(4, 30, 'chems2 Assignment2', 4, 'you are required to give the steps to differentiate between chlorine and florine', NULL),
(5, 25, 'Phys1 Assignment 1', 5, 'do research to know how to calculate the centerfugal force', 'http://s30.postimg.org/j7bep7g29/6a01156f183410970c0148c84547ab970c_320wi.jpg'),
(6, 30, 'phys2 Assignment2', 6, 'calculate the viscosity of the follwing liqueds : water and oil with all steps', 'http://s29.postimg.org/trji1s97r/image.jpg');

-- --------------------------------------------------------

--
-- Table structure for table `project_links`
--

DROP TABLE IF EXISTS `project_links`;
CREATE TABLE IF NOT EXISTS `project_links` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `link` varchar(255) NOT NULL,
  `project_id` int(11) NOT NULL,
  `sold` tinyint(1) NOT NULL DEFAULT '0',
  `user_id` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=14 ;

--
-- Dumping data for table `project_links`
--

INSERT INTO `project_links` (`id`, `link`, `project_id`, `sold`, `user_id`) VALUES
(1, 'https://docs.google.com/document/d/1-HMuR7-93tzG6nozKNk3BdPSUQR3ebhpYx_UHqnpOWw/edit?usp=sharing', 1, 1, 15),
(2, 'https://docs.google.com/document/d/1-HMuR7-93tzG6nozKNk3BdPSUQR3ebhpYx_UHqnpOWw/edit?usp=sharing', 1, 1, 15),
(3, 'https://docs.google.com/document/d/1-HMuR7-93tzG6nozKNk3BdPSUQR3ebhpYx_UHqnpOWw/edit?usp=sharing', 1, 1, 15),
(4, 'https://docs.google.com/document/d/1-HMuR7-93tzG6nozKNk3BdPSUQR3ebhpYx_UHqnpOWw/edit?usp=sharing', 1, 1, 15),
(5, 'https://docs.google.com/document/d/1-HMuR7-93tzG6nozKNk3BdPSUQR3ebhpYx_UHqnpOWw/edit?usp=sharing', 2, 1, 15),
(6, 'https://docs.google.com/document/d/1-HMuR7-93tzG6nozKNk3BdPSUQR3ebhpYx_UHqnpOWw/edit?usp=sharing', 1, 1, 15),
(7, 'https://docs.google.com/document/d/1-HMuR7-93tzG6nozKNk3BdPSUQR3ebhpYx_UHqnpOWw/edit?usp=sharing', 3, 0, 0),
(8, 'https://docs.google.com/document/d/1-HMuR7-93tzG6nozKNk3BdPSUQR3ebhpYx_UHqnpOWw/edit?usp=sharing', 3, 0, 0),
(9, 'https://docs.google.com/document/d/1-HMuR7-93tzG6nozKNk3BdPSUQR3ebhpYx_UHqnpOWw/edit?usp=sharing', 3, 0, 0),
(10, 'https://docs.google.com/document/d/1-HMuR7-93tzG6nozKNk3BdPSUQR3ebhpYx_UHqnpOWw/edit?usp=sharing', 4, 0, 0),
(11, 'https://docs.google.com/document/d/1-HMuR7-93tzG6nozKNk3BdPSUQR3ebhpYx_UHqnpOWw/edit?usp=sharing', 4, 0, 0),
(12, 'https://docs.google.com/document/d/1-HMuR7-93tzG6nozKNk3BdPSUQR3ebhpYx_UHqnpOWw/edit?usp=sharing', 5, 0, 0),
(13, 'https://docs.google.com/document/d/1-HMuR7-93tzG6nozKNk3BdPSUQR3ebhpYx_UHqnpOWw/edit?usp=sharing', 6, 0, 0);

-- --------------------------------------------------------

--
-- Table structure for table `university`
--

DROP TABLE IF EXISTS `university`;
CREATE TABLE IF NOT EXISTS `university` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(50) NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `name` (`name`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=6 ;

--
-- Dumping data for table `university`
--

INSERT INTO `university` (`id`, `name`) VALUES
(4, 'AUC'),
(5, 'Cairo University'),
(1, 'GUC');

-- --------------------------------------------------------

--
-- Table structure for table `user`
--

DROP TABLE IF EXISTS `user`;
CREATE TABLE IF NOT EXISTS `user` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `email` varchar(50) NOT NULL,
  `password` varchar(255) NOT NULL,
  `avatar` varchar(255) NOT NULL,
  `first_name` varchar(50) NOT NULL,
  `last_name` varchar(50) NOT NULL,
  `credit_card` int(11) NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `email` (`email`),
  UNIQUE KEY `credit_card` (`credit_card`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=16 ;

--
-- Dumping data for table `user`
--

INSERT INTO `user` (`id`, `email`, `password`, `avatar`, `first_name`, `last_name`, `credit_card`) VALUES
(12, 'ebrahim.el.gaml@gmail.com', '0396d07fbe0cc3bfc6228c83a879d252008efac8', '', 'Ebrahim', 'ELgaml', 465465465),
(13, 'khkj@khk.com', '0396d07fbe0cc3bfc6228c83a879d252008efac8', '', 'dsaasd', 'jhjkhlk', 14564654),
(14, 'ebrahim.el.gaml2@gmail.com', '0396d07fbe0cc3bfc6228c83a879d252008efac8', '', 'Ebrahim', 'ELgaml', 123456),
(15, 'asdjghj@asdsad.com', '0396d07fbe0cc3bfc6228c83a879d252008efac8', '', 'asdsa', 'asdasd', 54654654);

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
