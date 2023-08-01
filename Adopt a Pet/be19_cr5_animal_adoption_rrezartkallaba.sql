-- phpMyAdmin SQL Dump
-- version 5.0.2
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1:3306
-- Generation Time: Aug 01, 2023 at 05:44 PM
-- Server version: 5.7.31
-- PHP Version: 7.3.21

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `be19_cr5_animal_adoption_rrezartkallaba`
--
CREATE DATABASE IF NOT EXISTS `be19_cr5_animal_adoption_rrezartkallaba` DEFAULT CHARACTER SET latin1 COLLATE latin1_swedish_ci;
USE `be19_cr5_animal_adoption_rrezartkallaba`;

-- --------------------------------------------------------

--
-- Table structure for table `animals`
--

DROP TABLE IF EXISTS `animals`;
CREATE TABLE IF NOT EXISTS `animals` (
  `animal_id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(50) NOT NULL,
  `image` varchar(100) NOT NULL,
  `gender` enum('Male','Female') NOT NULL,
  `location` varchar(100) NOT NULL,
  `description` text,
  `size` varchar(20) DEFAULT NULL,
  `age` int(11) DEFAULT NULL,
  `vaccinated` enum('Yes','No') NOT NULL,
  `breed` varchar(50) NOT NULL,
  `category` enum('Cat','Dog') NOT NULL,
  `status` varchar(20) NOT NULL DEFAULT 'Available',
  PRIMARY KEY (`animal_id`)
) ENGINE=MyISAM AUTO_INCREMENT=46 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `animals`
--

INSERT INTO `animals` (`animal_id`, `name`, `image`, `gender`, `location`, `description`, `size`, `age`, `vaccinated`, `breed`, `category`, `status`) VALUES
(19, 'Fluffy', 'fluffy.jpg', 'Female', 'Shelter A', 'A cute and friendly cat', 'Small', 8, 'No', 'Persian', 'Cat', 'Unavailable'),
(20, 'Buddy', 'buddy.jpg', 'Male', 'Shelter B', 'A loyal and playful dog', 'Medium', 2, 'Yes', 'Golden Retriever', 'Dog', 'Available'),
(21, 'Whiskers', 'whiskers.jpg', 'Male', 'Shelter C', 'A mischievous cat', 'Small', 6, 'Yes', 'Siamese', 'Cat', 'Available'),
(22, 'Max', 'max.jpg', 'Male', 'Shelter A', 'A big and gentle dog', 'Large', 5, 'Yes', 'German Shepherd', 'Dog', 'Unavailable'),
(23, 'Luna', 'luna.jpg', 'Female', 'Shelter B', 'A playful and energetic dog', 'Medium', 1, 'Yes', 'Labrador Retriever', 'Dog', 'Available'),
(24, 'Oliver', 'oliver.jpg', 'Male', 'Shelter C', 'A fluffy and affectionate cat', 'Small', 9, 'Yes', 'Maine Coon', 'Cat', 'Available'),
(25, 'Rocky', 'rocky.jpg', 'Male', 'Shelter A', 'A brave and protective dog', 'Large', 4, 'Yes', 'Rottweiler', 'Dog', 'Available'),
(26, 'Coco', 'coco.jpg', 'Male', 'Shelter B', 'A curious and friendly cat', 'Small', 2, 'Yes', 'Bengal', 'Cat', 'Available'),
(27, 'Duke', 'duke.jpg', 'Male', 'Shelter C', 'A smart and obedient dog', 'Medium', 10, 'No', 'Border Collie', 'Dog', 'Available'),
(28, 'Misty', 'misty.jpg', 'Male', 'Shelter A', 'A shy and sweet cat', 'Small', 12, 'Yes', 'British Shorthair', 'Cat', 'Available');

-- --------------------------------------------------------

--
-- Table structure for table `pet_adoption`
--

DROP TABLE IF EXISTS `pet_adoption`;
CREATE TABLE IF NOT EXISTS `pet_adoption` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `user_id` int(11) NOT NULL,
  `pet_id` int(11) NOT NULL,
  `adoption_date` date DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `user_id` (`user_id`),
  KEY `pet_id` (`pet_id`)
) ENGINE=MyISAM AUTO_INCREMENT=27 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `pet_adoption`
--

INSERT INTO `pet_adoption` (`id`, `user_id`, `pet_id`, `adoption_date`) VALUES
(26, 2, 22, '2023-08-01'),
(25, 2, 19, '2023-08-01');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

DROP TABLE IF EXISTS `users`;
CREATE TABLE IF NOT EXISTS `users` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `first_name` varchar(50) NOT NULL,
  `last_name` varchar(50) NOT NULL,
  `email` varchar(50) NOT NULL,
  `phone` varchar(20) NOT NULL,
  `address` varchar(40) NOT NULL,
  `image` varchar(100) DEFAULT NULL,
  `password` varchar(255) NOT NULL,
  `status` varchar(10) DEFAULT 'user',
  PRIMARY KEY (`id`),
  UNIQUE KEY `email` (`email`)
) ENGINE=MyISAM AUTO_INCREMENT=18 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `first_name`, `last_name`, `email`, `phone`, `address`, `image`, `password`, `status`) VALUES
(1, 'Rrezart', 'Kallaba', 'rrezartkallaba@gmail.com', '049123123', 'Suhareke', 'user.png', 'cfb4e4cff35327725d186b2ab037b2876bcdcbed97798ef30896f6b1a26c6888', 'admin'),
(2, 'User', 'Test', 'usertest@gmail.com', '049123123', 'Suhareke', '64c92e7e16a68.png', 'cfb4e4cff35327725d186b2ab037b2876bcdcbed97798ef30896f6b1a26c6888', 'user');
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
