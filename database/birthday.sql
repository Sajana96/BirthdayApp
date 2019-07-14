-- phpMyAdmin SQL Dump
-- version 4.8.3
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1:3306
-- Generation Time: Jul 14, 2019 at 09:12 PM
-- Server version: 5.7.23
-- PHP Version: 7.2.10

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `birthday`
--

-- --------------------------------------------------------

--
-- Table structure for table `accessusers`
--

DROP TABLE IF EXISTS `accessusers`;
CREATE TABLE IF NOT EXISTS `accessusers` (
  `accessID` int(11) NOT NULL AUTO_INCREMENT,
  `user_id` int(11) NOT NULL,
  `userName` varchar(50) NOT NULL,
  `password` varchar(50) NOT NULL,
  `userType` varchar(50) NOT NULL,
  PRIMARY KEY (`accessID`),
  KEY `user_id` (`user_id`)
) ENGINE=InnoDB AUTO_INCREMENT=1002 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `accessusers`
--

INSERT INTO `accessusers` (`accessID`, `user_id`, `userName`, `password`, `userType`) VALUES
(1000, 2, 'sajana96', '123456', 'Admin'),
(1001, 5, 'hiluxgshock', '789', 'Organizer');

-- --------------------------------------------------------

--
-- Table structure for table `treats`
--

DROP TABLE IF EXISTS `treats`;
CREATE TABLE IF NOT EXISTS `treats` (
  `treat_id` int(11) NOT NULL AUTO_INCREMENT,
  `user_id` int(11) NOT NULL,
  `sheduleDate` date NOT NULL,
  `sheduleTime` time NOT NULL,
  `venue` varchar(50) NOT NULL,
  `state` varchar(50) NOT NULL,
  `treatNotes` varchar(50) NOT NULL,
  PRIMARY KEY (`treat_id`),
  KEY `user_id` (`user_id`)
) ENGINE=InnoDB AUTO_INCREMENT=8 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `treats`
--

INSERT INTO `treats` (`treat_id`, `user_id`, `sheduleDate`, `sheduleTime`, `venue`, `state`, `treatNotes`) VALUES
(1, 2, '2019-07-24', '11:00:00', 'Burger King', 'confirmed', 'Come All'),
(3, 8, '2019-07-30', '21:30:00', 'Barracuda', 'celebrated', 'Come All'),
(4, 3, '2019-08-20', '00:20:00', 'Lounge 171', 'confirmed', 'Will you Come'),
(6, 6, '2019-07-15', '13:00:00', 'University', 'pending', 'Come!!!!'),
(7, 5, '2019-09-25', '14:00:00', 'Galadari', 'confirmed', 'Come!!!!');

-- --------------------------------------------------------

--
-- Table structure for table `userdetails`
--

DROP TABLE IF EXISTS `userdetails`;
CREATE TABLE IF NOT EXISTS `userdetails` (
  `user_id` int(50) NOT NULL AUTO_INCREMENT,
  `fname` varchar(50) NOT NULL,
  `lname` varchar(50) NOT NULL,
  `pname` varchar(50) NOT NULL,
  `DOB` date NOT NULL,
  `oemail` varchar(50) DEFAULT NULL,
  `pemail` varchar(50) NOT NULL,
  `mobile` int(10) NOT NULL,
  `facebook` varchar(50) DEFAULT NULL,
  `designation` varchar(50) DEFAULT NULL,
  `category` varchar(50) NOT NULL,
  `NIC` varchar(50) NOT NULL,
  `indexNO` varchar(50) DEFAULT NULL,
  `food` varchar(50) NOT NULL,
  `note` varchar(250) DEFAULT NULL,
  PRIMARY KEY (`user_id`)
) ENGINE=InnoDB AUTO_INCREMENT=9 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `userdetails`
--

INSERT INTO `userdetails` (`user_id`, `fname`, `lname`, `pname`, `DOB`, `oemail`, `pemail`, `mobile`, `facebook`, `designation`, `category`, `NIC`, `indexNO`, `food`, `note`) VALUES
(2, 'Sajana', 'Weerakoon', 'Sajana', '1996-07-20', 'weerakoo_im16092@stu.kln.ac.lk', 'weerakoonsajana@yahoo.com', 776711444, 'https://www.facebook.com/sajana.weerakoon', 'Student', 'Student', '962021042V', 'IM/2016/092', 'Non-Veg', 'Hello I am Sajana.'),
(3, 'Malmi', 'Natasha', 'Malmi', '1996-03-04', '', 'malminatasha@gmail.com', 774151278, '', 'Student', 'Student', '960412859V', 'IM/2016/008', 'Veg', 'I am Malmi'),
(4, 'Thareendra', 'Keerthi', 'Keerthi', '1975-09-08', '', 'keerthi@gmail.com', 777762393, '', 'Senior Lecturer', 'Temp-Academic', '758078945V', '', 'Non-Veg', 'Hello I am Keerthi'),
(5, 'Nimal', 'Perera', 'Nimal', '1965-02-11', 'nimal@yahoo.com', 'nimal@yahoo.com', 776974849, '', 'Demonstrator', 'Academic', '658945678V', '', 'Veg', 'I am Nimal'),
(6, 'Hiran', 'Ransara', 'Hiran', '1992-04-10', '', 'hiran@japura.com', 776154249, '', 'Student', 'Student', '922021053V', 'IM/2015/012', 'Non-Veg', 'Hello I am hiran'),
(7, 'Sankha', 'Gunawardena', 'Sankha', '1995-08-05', '', 'sankhag@gmail.com', 774567282, '', 'Demonstrator', 'Admin', '954587955V', '', 'Non-Veg', 'I am sankha'),
(8, 'Adeepa', 'Akalanka', 'Adeepa', '1989-07-13', '', 'addz@yahoo.com', 776987513, '', 'Demonstrator', 'Temp-Academic', '894596123V', '', 'Non-Veg', 'I am adeepa');

--
-- Constraints for dumped tables
--

--
-- Constraints for table `accessusers`
--
ALTER TABLE `accessusers`
  ADD CONSTRAINT `accessusers_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `userdetails` (`user_id`);

--
-- Constraints for table `treats`
--
ALTER TABLE `treats`
  ADD CONSTRAINT `treats_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `userdetails` (`user_id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
