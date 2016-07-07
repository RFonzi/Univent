-- phpMyAdmin SQL Dump
-- version 4.1.14
-- http://www.phpmyadmin.net
--
-- Host: 127.0.0.1
-- Generation Time: Jul 07, 2016 at 11:06 PM
-- Server version: 5.6.17
-- PHP Version: 5.5.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Database: `mydb`
--

-- --------------------------------------------------------

--
-- Table structure for table `admin`
--

CREATE TABLE IF NOT EXISTS `admin` (
  `sid` char(11) NOT NULL DEFAULT '',
  `name` char(30) DEFAULT NULL,
  `password` char(20) DEFAULT NULL,
  `email` char(30) DEFAULT NULL,
  PRIMARY KEY (`sid`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `admin_creates_event`
--

CREATE TABLE IF NOT EXISTS `admin_creates_event` (
  `sid` char(11) NOT NULL DEFAULT '',
  `time` time DEFAULT NULL,
  `name` char(30) DEFAULT NULL,
  PRIMARY KEY (`sid`),
  KEY `time` (`time`),
  KEY `name` (`name`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `comments`
--

CREATE TABLE IF NOT EXISTS `comments` (
  `sid` char(11) NOT NULL DEFAULT '',
  `time` time NOT NULL DEFAULT '00:00:00',
  `name` char(30) NOT NULL DEFAULT '',
  `text` char(100) DEFAULT NULL,
  `timestamp` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`sid`,`time`,`name`),
  KEY `time` (`time`),
  KEY `name` (`name`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `create_profile`
--

CREATE TABLE IF NOT EXISTS `create_profile` (
  `name` char(30) NOT NULL DEFAULT '',
  `sid` char(11) DEFAULT NULL,
  PRIMARY KEY (`name`),
  KEY `sid` (`sid`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `event`
--

CREATE TABLE IF NOT EXISTS `event` (
  `time` time NOT NULL DEFAULT '00:00:00',
  `date` date DEFAULT NULL,
  `name` char(30) DEFAULT NULL,
  `category` char(20) DEFAULT NULL,
  `description` char(100) DEFAULT NULL,
  `contact_phone` char(12) DEFAULT NULL,
  `contact_email` char(30) DEFAULT NULL,
  `type` char(15) DEFAULT NULL,
  `rating` char(10) DEFAULT NULL,
  `super_approval` int(1) DEFAULT NULL,
  `admin_approval` int(1) DEFAULT NULL,
  `up` int(1) DEFAULT NULL,
  `down` int(1) DEFAULT NULL,
  PRIMARY KEY (`time`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `have_location`
--

CREATE TABLE IF NOT EXISTS `have_location` (
  `time` time NOT NULL DEFAULT '00:00:00',
  `name` char(30) NOT NULL DEFAULT '',
  PRIMARY KEY (`time`,`name`),
  KEY `time` (`time`),
  KEY `name` (`name`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `joins`
--

CREATE TABLE IF NOT EXISTS `joins` (
  `sid` char(11) NOT NULL DEFAULT '',
  `rid` char(11) NOT NULL DEFAULT '',
  PRIMARY KEY (`sid`,`rid`),
  KEY `rid` (`rid`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `location`
--

CREATE TABLE IF NOT EXISTS `location` (
  `name` char(30) NOT NULL DEFAULT '',
  `latitude` double DEFAULT NULL,
  `longitude` double DEFAULT NULL,
  PRIMARY KEY (`name`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `owns`
--

CREATE TABLE IF NOT EXISTS `owns` (
  `sid` char(11) DEFAULT NULL,
  `rid` char(11) NOT NULL DEFAULT '',
  PRIMARY KEY (`rid`),
  KEY `sid` (`sid`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `rso`
--

CREATE TABLE IF NOT EXISTS `rso` (
  `rid` char(11) NOT NULL DEFAULT '',
  `name` char(30) DEFAULT NULL,
  `university` char(30) DEFAULT NULL,
  `description` char(100) DEFAULT NULL,
  PRIMARY KEY (`rid`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `rso_affil`
--

CREATE TABLE IF NOT EXISTS `rso_affil` (
  `sid` char(11) NOT NULL DEFAULT '',
  `rid` char(11) NOT NULL DEFAULT '',
  PRIMARY KEY (`sid`,`rid`),
  KEY `rid` (`rid`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `student`
--

CREATE TABLE IF NOT EXISTS `student` (
  `sid` char(11) NOT NULL DEFAULT '',
  `name` char(30) DEFAULT NULL,
  `password` char(20) DEFAULT NULL,
  `email` varchar(30) NOT NULL,
  PRIMARY KEY (`sid`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `student_creates_event`
--

CREATE TABLE IF NOT EXISTS `student_creates_event` (
  `sid` char(11) NOT NULL DEFAULT '',
  `time` time NOT NULL DEFAULT '00:00:00',
  `name` char(30) NOT NULL DEFAULT '',
  PRIMARY KEY (`sid`,`time`,`name`),
  KEY `time` (`time`),
  KEY `name` (`name`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `student_creates_rso`
--

CREATE TABLE IF NOT EXISTS `student_creates_rso` (
  `sid` char(11) NOT NULL DEFAULT '',
  `rid` char(11) NOT NULL DEFAULT '',
  PRIMARY KEY (`sid`,`rid`),
  KEY `rid` (`rid`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `super_admin`
--

CREATE TABLE IF NOT EXISTS `super_admin` (
  `sid` char(11) NOT NULL DEFAULT '',
  `name` char(30) DEFAULT NULL,
  `password` char(20) DEFAULT NULL,
  `email` char(30) DEFAULT NULL,
  PRIMARY KEY (`sid`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `university`
--

CREATE TABLE IF NOT EXISTS `university` (
  `name` char(30) NOT NULL,
  `location` char(30) DEFAULT NULL,
  `description` char(100) DEFAULT NULL,
  `students` int(11) DEFAULT NULL,
  `pictures` char(30) DEFAULT NULL,
  PRIMARY KEY (`name`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `university_affil`
--

CREATE TABLE IF NOT EXISTS `university_affil` (
  `sid` char(11) NOT NULL DEFAULT '',
  `name` char(30) NOT NULL,
  PRIMARY KEY (`name`),
  KEY `sid` (`sid`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `user`
--

CREATE TABLE IF NOT EXISTS `user` (
  `sid` char(11) NOT NULL,
  `name` char(30) DEFAULT NULL,
  `password` char(20) DEFAULT NULL,
  `email` char(20) DEFAULT NULL,
  PRIMARY KEY (`sid`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `admin_creates_event`
--
ALTER TABLE `admin_creates_event`
  ADD CONSTRAINT `admin_creates_event_ibfk_1` FOREIGN KEY (`time`) REFERENCES `event` (`time`),
  ADD CONSTRAINT `admin_creates_event_ibfk_2` FOREIGN KEY (`name`) REFERENCES `location` (`name`);

--
-- Constraints for table `comments`
--
ALTER TABLE `comments`
  ADD CONSTRAINT `comments_ibfk_1` FOREIGN KEY (`sid`) REFERENCES `student` (`sid`),
  ADD CONSTRAINT `comments_ibfk_2` FOREIGN KEY (`time`) REFERENCES `event` (`time`),
  ADD CONSTRAINT `comments_ibfk_3` FOREIGN KEY (`name`) REFERENCES `location` (`name`);

--
-- Constraints for table `create_profile`
--
ALTER TABLE `create_profile`
  ADD CONSTRAINT `create_profile_ibfk_1` FOREIGN KEY (`sid`) REFERENCES `super_admin` (`sid`);

--
-- Constraints for table `joins`
--
ALTER TABLE `joins`
  ADD CONSTRAINT `joins_ibfk_1` FOREIGN KEY (`sid`) REFERENCES `student` (`sid`),
  ADD CONSTRAINT `joins_ibfk_2` FOREIGN KEY (`rid`) REFERENCES `rso` (`rid`);

--
-- Constraints for table `owns`
--
ALTER TABLE `owns`
  ADD CONSTRAINT `owns_ibfk_1` FOREIGN KEY (`sid`) REFERENCES `admin` (`sid`);

--
-- Constraints for table `rso_affil`
--
ALTER TABLE `rso_affil`
  ADD CONSTRAINT `rso_affil_ibfk_1` FOREIGN KEY (`sid`) REFERENCES `admin` (`sid`),
  ADD CONSTRAINT `rso_affil_ibfk_2` FOREIGN KEY (`rid`) REFERENCES `rso` (`rid`);

--
-- Constraints for table `student_creates_event`
--
ALTER TABLE `student_creates_event`
  ADD CONSTRAINT `student_creates_event_ibfk_1` FOREIGN KEY (`sid`) REFERENCES `student` (`sid`),
  ADD CONSTRAINT `student_creates_event_ibfk_2` FOREIGN KEY (`time`) REFERENCES `event` (`time`),
  ADD CONSTRAINT `student_creates_event_ibfk_3` FOREIGN KEY (`name`) REFERENCES `location` (`name`);

--
-- Constraints for table `student_creates_rso`
--
ALTER TABLE `student_creates_rso`
  ADD CONSTRAINT `student_creates_rso_ibfk_1` FOREIGN KEY (`sid`) REFERENCES `student` (`sid`),
  ADD CONSTRAINT `student_creates_rso_ibfk_2` FOREIGN KEY (`rid`) REFERENCES `rso` (`rid`);

--
-- Constraints for table `super_admin`
--
ALTER TABLE `super_admin`
  ADD CONSTRAINT `super_admin_ibfk_1` FOREIGN KEY (`sid`) REFERENCES `university` (`name`);
--
-- Database: `test`
--

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
