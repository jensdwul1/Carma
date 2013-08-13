-- phpMyAdmin SQL Dump
-- version 4.0.4
-- http://www.phpmyadmin.net
--
-- Host: 127.0.0.1
-- Generation Time: Aug 13, 2013 at 08:27 PM
-- Server version: 5.5.32
-- PHP Version: 5.4.16

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Database: `carma`
--
CREATE DATABASE IF NOT EXISTS `carma` DEFAULT CHARACTER SET utf8 COLLATE utf8_general_ci;
USE `carma`;

-- --------------------------------------------------------

--
-- Table structure for table `campuses`
--

CREATE TABLE IF NOT EXISTS `campuses` (
  `camp_id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `camp_name` varchar(255) NOT NULL,
  `camp_address` varchar(255) NOT NULL,
  `camp_city` varchar(255) NOT NULL,
  `camp_postal` int(11) NOT NULL,
  `camp_telephone` varchar(20) NOT NULL,
  `camp_lat` float NOT NULL,
  `camp_lng` float NOT NULL,
  `camp_pic` varchar(255) NOT NULL DEFAULT 'http://placehold.it/300&text=pic',
  PRIMARY KEY (`camp_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=10 ;

--
-- Dumping data for table `campuses`
--

INSERT INTO `campuses` (`camp_id`, `camp_name`, `camp_address`, `camp_city`, `camp_postal`, `camp_telephone`, `camp_lat`, `camp_lng`, `camp_pic`) VALUES
(1, 'Campus Kantienberg', 'Voetweg 66', 'Gent', 9000, '09 234 70 00', 51.0406, 3.72707, 'http://www.arteveldehs.be/myImages/07/025/001/kantienberg_450.png'),
(2, 'Campus Kattenberg', 'Kattenberg 9', 'Gent', 9000, '09 234 80 00', 51.0418, 3.72404, 'http://www.arteveldehs.be/myImages/07/025/001/kattenberg_450.png'),
(3, 'Campus Mariakerke', 'Industrieweg 232', 'Gent-Mariakerke', 9030, '09 234 86 00', 51.0872, 3.669, 'http://www.arteveldehs.be/myImages/07/025/001/mariakerke_450.png'),
(4, 'Campus Sint-Amandsberg', 'J. Gerardstraat 18', 'Gent-Sint-Amandsberg', 9040, '09 234 88 00', 51.0616, 3.74714, 'http://www.arteveldehs.be/myImages/07/023/002/sintamandsberg_web.jpg'),
(5, 'Campus Sint-Annaplein', 'Sint-Annaplein 31', 'Gent', 9000, '09 234 94 00', 51.0497, 3.73516, 'http://www.arteveldehs.be/myImages/07/023/002/campus_sintanna.jpg'),
(6, 'Campus Brusselsepoortstraat', 'Brusselsepoortstraat 93', 'Gent', 9000, '09 234 81 00', 51.0428, 3.73782, 'http://placehold.it/300&text=pic'),
(7, 'Campus Goudstraat', 'Goudstraat 37', 'Gent', 9000, '000000000', 51.0599, 3.72805, 'http://www.arteveldehs.be/myImages/07/025/001/goudstraat_450.png'),
(8, 'Campus Heymans', 'De Pintelaan 185', 'Gent', 9000, '09 332 26 32', 51.025, 3.72518, 'http://www.arteveldehs.be/myImages/07/025/001/heymans_450.png'),
(9, 'Campus Hoogpoort', 'Hoogpoort 15', 'Gent', 9000, '09 234 90 00', 51.0556, 3.72298, 'http://www.arteveldehs.be/myImages/07/025/001/hoogpoort_450.png');

-- --------------------------------------------------------

--
-- Table structure for table `carpools`
--

CREATE TABLE IF NOT EXISTS `carpools` (
  `carp_id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `carp_title` varchar(255) NOT NULL,
  `carp_description` text NOT NULL,
  `carp_departure` varchar(200) NOT NULL,
  `carp_lat` float NOT NULL,
  `carp_long` float NOT NULL,
  `carp_seats` int(11) NOT NULL,
  `camp_id` int(10) unsigned NOT NULL,
  `usr_id` int(10) unsigned NOT NULL,
  PRIMARY KEY (`carp_id`,`camp_id`,`usr_id`),
  KEY `fk_carpool_campus1_idx` (`camp_id`),
  KEY `fk_carpool_user1_idx` (`usr_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=2 ;

--
-- Dumping data for table `carpools`
--

INSERT INTO `carpools` (`carp_id`, `carp_title`, `carp_description`, `carp_departure`, `carp_lat`, `carp_long`, `carp_seats`, `camp_id`, `usr_id`) VALUES
(1, 'Carpool De Wulf', 'Carpool naar Campus Mariakerke', 'Stationsstraat 75. 9800 Deinze', 50.9784, 3.5345, 4, 1, 1);

-- --------------------------------------------------------

--
-- Table structure for table `passengers`
--

CREATE TABLE IF NOT EXISTS `passengers` (
  `pass_id` int(10) NOT NULL AUTO_INCREMENT,
  `carp_id` int(10) unsigned NOT NULL,
  `usr_id` int(10) unsigned NOT NULL,
  PRIMARY KEY (`pass_id`,`carp_id`,`usr_id`),
  KEY `fk_carpoolHasUsers_carpools1_idx` (`carp_id`),
  KEY `fk_carpoolHasUsers_users1_idx` (`usr_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE IF NOT EXISTS `users` (
  `usr_id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `usr_givenname` varchar(255) NOT NULL,
  `usr_familyname` varchar(255) NOT NULL,
  `usr_email` varchar(255) NOT NULL,
  `usr_pic` varchar(255) NOT NULL DEFAULT 'http://placehold.it/100&text=pic',
  `usr_password` char(128) NOT NULL,
  `usr_salt` char(64) NOT NULL,
  `usr_created` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`usr_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=3 ;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`usr_id`, `usr_givenname`, `usr_familyname`, `usr_email`, `usr_pic`, `usr_password`, `usr_salt`, `usr_created`) VALUES
(1, 'Jens', 'De Wulf', 'jdw.jensdewulf@gmail.com', 'http://i.imgur.com/AIWsOYJ.jpg', '.EPxYT9MJL.1e9aodwMszekfhiG3moGe', '3wgpiqzFkRmTTUHfYowVrA', '2013-08-07 14:44:51'),
(2, 'Bob', 'Mcbobson', 'bob@gmail.com', 'http://i.imgur.com/VQLGJOL.gif', '.YrjhLz6CG8BbRUxQe7TFmSOUnjvGznu', 'PPn9L71vgymEEhjqE.bYQJ', '2013-08-12 12:36:35');

--
-- Constraints for dumped tables
--

--
-- Constraints for table `carpools`
--
ALTER TABLE `carpools`
  ADD CONSTRAINT `fk_carpool_campus1` FOREIGN KEY (`camp_id`) REFERENCES `campuses` (`camp_id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `fk_carpool_user1` FOREIGN KEY (`usr_id`) REFERENCES `users` (`usr_id`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Constraints for table `passengers`
--
ALTER TABLE `passengers`
  ADD CONSTRAINT `fk_carpoolHasUsers_carpools1` FOREIGN KEY (`carp_id`) REFERENCES `carpools` (`carp_id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `fk_carpoolHasUsers_users1` FOREIGN KEY (`usr_id`) REFERENCES `users` (`usr_id`) ON DELETE NO ACTION ON UPDATE NO ACTION;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
