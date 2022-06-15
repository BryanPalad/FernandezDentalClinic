-- phpMyAdmin SQL Dump
-- version 4.7.9
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1:3306
-- Generation Time: Nov 22, 2018 at 02:05 AM
-- Server version: 5.7.21
-- PHP Version: 5.6.35

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `fernandezdental`
--

-- --------------------------------------------------------

--
-- Table structure for table `aboutus`
--

DROP TABLE IF EXISTS `aboutus`;
CREATE TABLE IF NOT EXISTS `aboutus` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `image` longblob NOT NULL,
  `descriptions` text NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=4 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `aboutus`
--

INSERT INTO `aboutus` (`id`, `image`, `descriptions`) VALUES
(1, 0x726f647269676f2e706e67, 'Hello I am Doctor Rodrigo Fernandez, \r\nMy specialties are Prosthodontics, Oral Surgery and Cosmetic Dentistry.'),
(2, 0x6d696b65652e6a7067, 'Hello I am Doctor Mikee Fernandez, \r\nI am a preventive pediatric and a peridontist.'),
(3, 0x737573616e2e706e67, 'Hello I am Doctor Susan Fernandez, \r\nI am a TMJ specialist and a Orthodontist.');

-- --------------------------------------------------------

--
-- Table structure for table `appointment`
--

DROP TABLE IF EXISTS `appointment`;
CREATE TABLE IF NOT EXISTS `appointment` (
  `appId` int(3) NOT NULL AUTO_INCREMENT,
  `patientIc` bigint(12) NOT NULL,
  `scheduleId` int(10) NOT NULL,
  `appSymptom` varchar(200) NOT NULL,
  `appComment` varchar(100) NOT NULL,
  `status` varchar(10) NOT NULL DEFAULT 'process',
  `doctorFirstName` varchar(50) NOT NULL,
  `doctorLastName` varchar(50) NOT NULL,
  `doctorId` int(11) NOT NULL,
  PRIMARY KEY (`appId`),
  UNIQUE KEY `scheduleId_2` (`scheduleId`),
  KEY `patientIc` (`patientIc`),
  KEY `scheduleId` (`scheduleId`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `appointments`
--

DROP TABLE IF EXISTS `appointments`;
CREATE TABLE IF NOT EXISTS `appointments` (
  `appId` int(3) NOT NULL AUTO_INCREMENT,
  `patientusername` varchar(50) NOT NULL,
  `scheduleId` int(10) NOT NULL,
  `appSymptom` varchar(200) NOT NULL,
  `appComment` varchar(200) NOT NULL,
  `status` varchar(10) NOT NULL DEFAULT 'pending',
  `doctorFirstName` varchar(50) NOT NULL,
  `doctorLastName` varchar(50) NOT NULL,
  `doctorId` int(11) NOT NULL,
  `service_time` varchar(100) NOT NULL,
  `remarks` varchar(200) NOT NULL,
  PRIMARY KEY (`appId`)
) ENGINE=MyISAM AUTO_INCREMENT=8 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `appointments`
--

INSERT INTO `appointments` (`appId`, `patientusername`, `scheduleId`, `appSymptom`, `appComment`, `status`, `doctorFirstName`, `doctorLastName`, `doctorId`, `service_time`, `remarks`) VALUES
(7, 'bryan', 185, 'Discoloured Teeth    ', 'asdsadsadsad', 'pending', 'Rodrigo\n', 'Fernandez', 1, '10:00 - 10:30', 'NULL'),
(5, 'jm', 175, 'Implants  Dentures  Crowns', 'tae', 'done', 'Rodrigo\n', 'Fernandez', 1, '2:30 - 3:00', '');

-- --------------------------------------------------------

--
-- Table structure for table `background`
--

DROP TABLE IF EXISTS `background`;
CREATE TABLE IF NOT EXISTS `background` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `background` longblob NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=4 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `background`
--

INSERT INTO `background` (`id`, `background`) VALUES
(1, 0x62672e6a7067),
(2, 0x62672e6a7067),
(3, 0x62672e6a7067);

-- --------------------------------------------------------

--
-- Table structure for table `cancelled_reports`
--

DROP TABLE IF EXISTS `cancelled_reports`;
CREATE TABLE IF NOT EXISTS `cancelled_reports` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `patientLastName` varchar(50) NOT NULL,
  `patientFirstName` varchar(50) NOT NULL,
  `Contact` varchar(11) NOT NULL,
  `Day` varchar(20) NOT NULL,
  `Date` varchar(50) NOT NULL,
  `doctorFirstName` varchar(50) NOT NULL,
  `doctorLastName` varchar(50) NOT NULL,
  `Service_time` varchar(50) NOT NULL,
  `Service` varchar(100) NOT NULL,
  `Status` varchar(10) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `contactaddress`
--

DROP TABLE IF EXISTS `contactaddress`;
CREATE TABLE IF NOT EXISTS `contactaddress` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `address` text NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=2 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `contactaddress`
--

INSERT INTO `contactaddress` (`id`, `address`) VALUES
(1, '543 Rizal Boulevard Poblacion Barangay Kanluran Rodsan Building Santa Rosa Laguna');

-- --------------------------------------------------------

--
-- Table structure for table `contactuscontent`
--

DROP TABLE IF EXISTS `contactuscontent`;
CREATE TABLE IF NOT EXISTS `contactuscontent` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `title` text NOT NULL,
  `background` longblob NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=2 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `contactuscontent`
--

INSERT INTO `contactuscontent` (`id`, `title`, `background`) VALUES
(1, 'Do you have any questions? Please do not hesitate to email or contact us directly. We will come back to you within matters to help you.', 0x636f6e746163742e6a7067);

-- --------------------------------------------------------

--
-- Table structure for table `contactusemail`
--

DROP TABLE IF EXISTS `contactusemail`;
CREATE TABLE IF NOT EXISTS `contactusemail` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `email` varchar(50) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=2 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `contactusemail`
--

INSERT INTO `contactusemail` (`id`, `email`) VALUES
(1, 'fernandezdentalfdc@gmail.com');

-- --------------------------------------------------------

--
-- Table structure for table `contactusnumber`
--

DROP TABLE IF EXISTS `contactusnumber`;
CREATE TABLE IF NOT EXISTS `contactusnumber` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `phone` varchar(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=4 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `contactusnumber`
--

INSERT INTO `contactusnumber` (`id`, `phone`) VALUES
(1, '09055081683'),
(2, '09282849121'),
(3, '09455602846');

-- --------------------------------------------------------

--
-- Table structure for table `doctor`
--

DROP TABLE IF EXISTS `doctor`;
CREATE TABLE IF NOT EXISTS `doctor` (
  `doctorid` bigint(12) NOT NULL AUTO_INCREMENT,
  `password` varchar(20) NOT NULL,
  `doctorFirstName` varchar(50) NOT NULL,
  `doctorLastName` varchar(50) NOT NULL,
  `doctorAddress` varchar(150) DEFAULT NULL,
  `doctorPhone` varchar(11) DEFAULT NULL,
  `doctorEmail` varchar(50) DEFAULT NULL,
  `doctorDOB` date NOT NULL,
  `doctorGender` varchar(10) NOT NULL,
  `stats` varchar(20) NOT NULL,
  `image` longblob NOT NULL,
  PRIMARY KEY (`doctorid`)
) ENGINE=InnoDB AUTO_INCREMENT=9 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `doctor`
--

INSERT INTO `doctor` (`doctorid`, `password`, `doctorFirstName`, `doctorLastName`, `doctorAddress`, `doctorPhone`, `doctorEmail`, `doctorDOB`, `doctorGender`, `stats`, `image`) VALUES
(1, 'docrodrigo', 'Rodrigo', 'Fernandez', 'Sta.rosaLaguna', '09455602846', 'rodrigofernandez@gmail.com', '1981-01-01', 'Male', 'Active', 0x726f647269676f2e706e67),
(2, 'docsusan', 'Susan', 'Fernandez', 'Sta.rosaLaguna', '09363151340', 'susanfernandez@gmail.com', '1981-01-01', 'Female', 'Active', 0x737573616e2e706e67),
(3, 'docmikee', 'Mikee', 'Fernandez', 'Sta.rosaLaguna', '09363151340', 'mikeefernandez@gmail.com', '1981-01-01', 'Female', 'Active', 0x6d696b65652e6a7067),
(4, 'allenpass', 'Allen', 'League', 'Pulo Cabuyao Laguna', '09363151340', 'allenleague@gmail.com', '1981-01-01', 'Male', 'Active', 0x6e6f742d617661696c61626c652e706e67),
(5, 'rheapass', 'Rhea', 'Recuenco', 'Bunggo Calamba Laguna', '09363151340', 'rhearecuenco@gmail.com', '1999-08-16', 'Female', 'Active', 0x6e6f742d617661696c61626c652e706e67),
(6, 'rod12345', 'Rod', 'Magpantay', 'Real Calamba Laguna', '09363151340', 'rodmagpantay@gmail.com', '1998-09-30', 'Male', 'Active', 0x6e6f742d617661696c61626c652e706e67),
(7, 'docbryan', 'Bryan', 'Palad', 'Blk 4c Lot 30 Granseville Banlic Cabuyao Laguna', '09363151340', 'bryanjustin50@yahoo.com', '1999-01-15', 'Male', 'Active', 0x6e6f742d617661696c61626c652e706e67),
(8, 'adminpass', 'Admin', 'Admin', 'Blk 4c Lot 30 Granseville Banlic Cabuyao Laguna', '09363151340', 'admin@gmail.com', '1981-01-01', 'Male', 'Active', 0x6e6f742d617661696c61626c652e706e67);

-- --------------------------------------------------------

--
-- Table structure for table `doctorschedule`
--

DROP TABLE IF EXISTS `doctorschedule`;
CREATE TABLE IF NOT EXISTS `doctorschedule` (
  `scheduleId` int(11) NOT NULL AUTO_INCREMENT,
  `scheduleDate` date NOT NULL,
  `startTime` time DEFAULT NULL,
  `endTime` time DEFAULT NULL,
  `bookAvail` varchar(10) NOT NULL,
  `doctorId` int(11) DEFAULT NULL,
  `doctorFirstName` varchar(50) NOT NULL,
  `doctorLastName` varchar(50) NOT NULL,
  PRIMARY KEY (`scheduleId`)
) ENGINE=InnoDB AUTO_INCREMENT=217 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `doctorschedule`
--

INSERT INTO `doctorschedule` (`scheduleId`, `scheduleDate`, `startTime`, `endTime`, `bookAvail`, `doctorId`, `doctorFirstName`, `doctorLastName`) VALUES
(209, '2018-10-28', '08:30:00', '17:30:00', 'available', 3, 'Mikee', ' Fernandez'),
(210, '2018-10-29', '08:30:00', '17:30:00', 'available', 1, 'Rodrigo', ' Fernandez(DDS)'),
(211, '2018-10-30', '08:30:00', '17:30:00', 'available', 1, 'Rodrigo', ' Fernandez(DDS)'),
(212, '2018-10-31', '08:30:00', '17:30:00', 'available', 1, 'Rodrigo', ' Fernandez(DDS)'),
(213, '2018-10-30', '08:30:00', '17:30:00', 'available', 2, 'Susan', ' Fernandez'),
(214, '2018-10-31', '08:30:00', '17:30:00', 'available', 2, 'Susan', ' Fernandez'),
(215, '2018-10-30', '08:30:00', '17:30:00', 'available', 3, 'Mikee', ' Fernandez'),
(216, '2018-10-31', '08:30:00', '17:30:00', 'available', 3, 'Mikee', ' Fernandez');

-- --------------------------------------------------------

--
-- Table structure for table `faq`
--

DROP TABLE IF EXISTS `faq`;
CREATE TABLE IF NOT EXISTS `faq` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `question` varchar(1000) NOT NULL,
  `answer` varchar(1000) NOT NULL,
  `status` varchar(20) NOT NULL DEFAULT 'pending',
  `faqdate` date DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=14 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `faq`
--

INSERT INTO `faq` (`id`, `question`, `answer`, `status`, `faqdate`) VALUES
(1, 'Magbubukas po ba kayo this coming holidays po? What time po mag oopen yung clinic kung sakali?', 'Yes po, We are open from 8:30 am up to 5:30 pm..                        ', 'approved', '2018-10-27'),
(2, 'Kung mag papabrace po ba ko? Kaninong doctor po ako mag papaappoint?', 'Doctor Susan Fernandez, But before that you need to walk-in for the check up of your teeth.                           ', 'approved', '2018-10-27'),
(3, 'Need na po ba agad ng payment pag nag pa-appointment?', 'We apply the service/s first before we get your payment/s..                           ', 'approved', '2018-10-27'),
(4, 'Ano pong exact address ng clinic niyo?', '543 Rizal Boulevard Poblacion Barangay Kanluran Rodsan Building Santa Rosa Laguna, Please check our Contact Us content for more details..                            ', 'approved', '2018-10-27'),
(5, 'Magkano po ba pag papabunot ng wisdom tooth? Please reply ASAP..', 'It depends on your teeth. We need to check your teeth first before we do the surgery.. Thanks                         ', 'approved', '2018-10-27'),
(6, 'Ano pong symptoms kung bakit nasakit panga ko?', 'Doctor Susan Fernandez is a TMJ specialist. She can help you lessen your pain. Just go to our clinic. Thankyou                            ', 'approved', '2018-10-27'),
(7, 'Pwede na po ba bunutan ng ngipin yung 7 years old ko pong kapatid?', 'Kindly contact Doctor Mikee Fernandez, She is a preventive pediatric. She can help you with that..                           ', 'approved', '2018-10-27'),
(9, 'Every day po ba nagbubukas yung clinic niyo? and what time po nag coclose open?', 'Our clinic is open Monday to Saturday from 8:30 am up to 5:30 pm, We are half day every Sunday..                             ', 'approved', '2018-10-27'),
(10, 'Nag pupustiso po ba kayo?', 'Yes po, Please check our services at the SERVICES OFFERED content for more info.                            ', 'approved', '2018-10-27'),
(11, 'Sinong doctor po applicable for Dental Implants?', 'Doctor Rodrigo Fernandez                            ', 'approved', '2018-10-27');

-- --------------------------------------------------------

--
-- Table structure for table `footer`
--

DROP TABLE IF EXISTS `footer`;
CREATE TABLE IF NOT EXISTS `footer` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `title` varchar(300) NOT NULL,
  `footer_color` varchar(50) NOT NULL,
  `color` varchar(50) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=2 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `footer`
--

INSERT INTO `footer` (`id`, `title`, `footer_color`, `color`) VALUES
(1, 'Copyright @ 2018 | Dental Clinic Appointment System | B.P,M.L,R.R,R.M | All Rights reserved', 'White', 'DarkSlateGray');

-- --------------------------------------------------------

--
-- Table structure for table `header`
--

DROP TABLE IF EXISTS `header`;
CREATE TABLE IF NOT EXISTS `header` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `header_title` varchar(100) NOT NULL,
  `header_color` varchar(100) NOT NULL,
  `color` varchar(20) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=2 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `header`
--

INSERT INTO `header` (`id`, `header_title`, `header_color`, `color`) VALUES
(1, 'Fernandez Dental Clinic', 'Teal', 'WhiteSmoke');

-- --------------------------------------------------------

--
-- Table structure for table `location`
--

DROP TABLE IF EXISTS `location`;
CREATE TABLE IF NOT EXISTS `location` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `map` varchar(1000) NOT NULL,
  `location` varchar(1000) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=3 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `location`
--

INSERT INTO `location` (`id`, `map`, `location`) VALUES
(1, '<iframe src=\"https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d389.5092020699736!2d121.11185392426317!3d14.31161454527606!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x3397d9b06fab3fe1%3A0xfe61f67e0649325f!2sRod-San+Building!5e0!3m2!1sen!2sph!4v1534040006835\" width=\"100%\" height=\"450\" frameborder=\"0\" style=\"border:0\" allowfullscreen></iframe>', '<iframe src=\"https://www.google.com/maps/embed?pb=!4v1534040421585!6m8!1m7!1sBJOlsS05Eoy8sDGULh9MPw!2m2!1d14.31176731446258!2d121.1119117821278!3f276.99487116628666!4f1.4067362940633217!5f0.7820865974627469\" width=\"100%\" height=\"450\" frameborder=\"0\" style=\"border:0\" allowfullscreen></iframe>'),
(2, '', '');

-- --------------------------------------------------------

--
-- Table structure for table `missionvision`
--

DROP TABLE IF EXISTS `missionvision`;
CREATE TABLE IF NOT EXISTS `missionvision` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `mission` text NOT NULL,
  `vision` text NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=2 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `missionvision`
--

INSERT INTO `missionvision` (`id`, `mission`, `vision`) VALUES
(1, 'It is our mission to exceed expectations by providing exceptional dental care to our patients and at the same time, building relationships of trust with them. We are passionate about what we do and we want our patients to feel confident that they will receive the best care dentistry has to offer.', 'Our vision is to provide our patients with a dental experience that will promote a lifelong relationship built on trust, confidence, quality of work, and exceptional patient care. It is our vision to strive to remove barriers that seem to get in the way when it comes to a patient?s ability to maintain a healthy smile.');

-- --------------------------------------------------------

--
-- Table structure for table `patient`
--

DROP TABLE IF EXISTS `patient`;
CREATE TABLE IF NOT EXISTS `patient` (
  `icPatient` bigint(12) NOT NULL,
  `password` varchar(20) NOT NULL,
  `patientFirstName` varchar(20) NOT NULL,
  `patientLastName` varchar(20) NOT NULL,
  `patientMaritialStatus` varchar(10) NOT NULL,
  `patientDOB` date NOT NULL,
  `patientGender` varchar(10) NOT NULL,
  `patientAddress` varchar(100) NOT NULL,
  `patientPhone` varchar(12) NOT NULL,
  `patientEmail` varchar(100) NOT NULL,
  `patient` varchar(10) NOT NULL,
  `status` varchar(50) NOT NULL,
  PRIMARY KEY (`icPatient`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `patient`
--

INSERT INTO `patient` (`icPatient`, `password`, `patientFirstName`, `patientLastName`, `patientMaritialStatus`, `patientDOB`, `patientGender`, `patientAddress`, `patientPhone`, `patientEmail`, `patient`, `status`) VALUES
(1234, '12345678', 'Bryan', 'Palad', 'Single', '1999-01-15', 'Male', 'Blk4c Lot 30 Granseville Banlic Cabuyao Laguna', '09363151340', 'bryanjustin50@yahoo.com', 'New', 'Active');

-- --------------------------------------------------------

--
-- Table structure for table `patientinfo`
--

DROP TABLE IF EXISTS `patientinfo`;
CREATE TABLE IF NOT EXISTS `patientinfo` (
  `icPatient` int(11) NOT NULL AUTO_INCREMENT,
  `username` varchar(100) NOT NULL,
  `password` varchar(100) NOT NULL,
  `patientFirstName` varchar(20) NOT NULL,
  `patientLastName` varchar(20) NOT NULL,
  `patientMaritialStatus` varchar(10) NOT NULL,
  `patientDOB` date DEFAULT NULL,
  `patientGender` varchar(10) NOT NULL,
  `patientAddress` varchar(200) NOT NULL,
  `patientPhone` varchar(11) DEFAULT NULL,
  `patientEmail` varchar(100) NOT NULL,
  `verified` int(1) NOT NULL DEFAULT '0',
  `patient` varchar(10) NOT NULL,
  `status` varchar(20) NOT NULL,
  `image` longblob,
  `patientOccupation` varchar(50) NOT NULL,
  PRIMARY KEY (`icPatient`)
) ENGINE=MyISAM AUTO_INCREMENT=3 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `patientinfo`
--

INSERT INTO `patientinfo` (`icPatient`, `username`, `password`, `patientFirstName`, `patientLastName`, `patientMaritialStatus`, `patientDOB`, `patientGender`, `patientAddress`, `patientPhone`, `patientEmail`, `verified`, `patient`, `status`, `image`, `patientOccupation`) VALUES
(1, 'bryan', 'bryanpass', 'Bryan', 'Palad', 'Single', '1999-01-15', 'Male', 'Bunggo', '09363151340', 'paladbryanj@gmail.com', 1, 'New', 'Active', 0x6e6f742d617661696c61626c652e706e67, 'Student'),
(2, 'admin', 'adminpass', 'Palad', 'Bryan', 'Single', '1999-01-15', 'Male', 'Blk 4c Lot 30 Granseville Banlic Cabuyao Laguna', '09363151340', 'fernandezdentalfdc@gmail.com', 1, 'New', 'Active', 0x6e6f742d617661696c61626c652e706e67, 'Student');

-- --------------------------------------------------------

--
-- Table structure for table `schedule`
--

DROP TABLE IF EXISTS `schedule`;
CREATE TABLE IF NOT EXISTS `schedule` (
  `icPatient` int(11) NOT NULL,
  `username` varchar(50) NOT NULL,
  `scheduleid` int(11) DEFAULT NULL,
  `doctorid` int(11) DEFAULT NULL,
  `scheduleDate` date NOT NULL,
  `service_id` int(11) DEFAULT NULL,
  `servicename` varchar(50) NOT NULL,
  `status` varchar(50) NOT NULL DEFAULT 'pending',
  `startTime` time DEFAULT NULL,
  `endTime` time DEFAULT NULL,
  `complain` varchar(250) NOT NULL,
  `medication` varchar(250) DEFAULT NULL,
  `diagnosis` varchar(250) DEFAULT NULL,
  `prognosis` varchar(250) DEFAULT NULL,
  `reminded` tinyint(1) NOT NULL DEFAULT '0',
  `appointmentid` int(11) NOT NULL AUTO_INCREMENT,
  `remarks` varchar(250) DEFAULT NULL,
  PRIMARY KEY (`appointmentid`),
  KEY `icPatient` (`icPatient`),
  KEY `scheduleid` (`scheduleid`),
  KEY `doctorid` (`doctorid`),
  KEY `service_id` (`service_id`)
) ENGINE=MyISAM AUTO_INCREMENT=33 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `schedule`
--

INSERT INTO `schedule` (`icPatient`, `username`, `scheduleid`, `doctorid`, `scheduleDate`, `service_id`, `servicename`, `status`, `startTime`, `endTime`, `complain`, `medication`, `diagnosis`, `prognosis`, `reminded`, `appointmentid`, `remarks`) VALUES
(6, 'none', NULL, 1, '2018-10-29', NULL, 'Check up ', 'done', '09:30:00', NULL, 'none', 'tangina', 'tangina', 'tangina', 1, 3, 'null'),
(3, 'none', NULL, 1, '2018-10-29', NULL, 'Impacted teeth removal ', 'pending', '16:30:00', NULL, 'Walk-in', NULL, NULL, NULL, 0, 29, 'null'),
(1, 'bryan', 211, 1, '2018-10-30', 1, 'Check up  ', 'pending', '09:30:00', NULL, 'none', NULL, NULL, NULL, 1, 28, NULL),
(1, 'test', 210, 1, '2018-10-29', 1, 'Check up  ', 'done', '08:30:00', NULL, 'none', 'Antibiotics', 'Impacted Tooth on the upper left tooth ', 'Need to Follow up', 1, 7, NULL),
(3, 'none', NULL, 1, '2018-10-30', NULL, 'Dental implants ', 'pending', '11:30:00', NULL, 'Walk-in', NULL, NULL, NULL, 0, 30, 'null'),
(1, 'admin', 211, 1, '2018-10-30', 1, 'Check up  ', 'pending', '08:30:00', NULL, 'none', NULL, NULL, NULL, 1, 27, NULL),
(1, 'bryan', 212, 1, '2018-10-31', 1, 'Check up  ', 'pending', '08:30:00', NULL, 'none', NULL, NULL, NULL, 1, 31, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `service`
--

DROP TABLE IF EXISTS `service`;
CREATE TABLE IF NOT EXISTS `service` (
  `service_id` int(11) NOT NULL AUTO_INCREMENT,
  `service_type` varchar(50) NOT NULL,
  `service_name` varchar(50) NOT NULL,
  `doctorId` int(11) DEFAULT NULL,
  `doctorFirstName` varchar(50) NOT NULL,
  `doctorLastName` varchar(50) NOT NULL,
  `service_time` varchar(50) NOT NULL,
  PRIMARY KEY (`service_id`)
) ENGINE=MyISAM AUTO_INCREMENT=84 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `service`
--

INSERT INTO `service` (`service_id`, `service_type`, `service_name`, `doctorId`, `doctorFirstName`, `doctorLastName`, `service_time`) VALUES
(1, 'Checkup', 'Check up', 1, 'Rodrigo', 'Fernandez\r\n        ', '15'),
(2, 'Prosthodontics', 'Discoloured Teeth', 1, 'Rodrigo', 'Fernandez\r\n        ', '20'),
(3, 'Prosthodontics', 'Crown case', 1, 'Rodrigo', 'Fernandez\r\n        ', '30'),
(4, 'Prosthodontics', 'Single Missing Tooth ', 1, 'Rodrigo', 'Fernandez\r\n        ', '60'),
(5, 'Oral Surgery', 'Impacted teeth removal', 1, 'Rodrigo', 'Fernandez\r\n        ', '15'),
(6, 'Oral Surgery', 'Wisdom tooth removal', 1, 'Rodrigo', 'Fernandez\r\n        ', '30'),
(7, 'Oral Surgery', 'Improve fit of dentures', 1, 'Rodrigo', 'Fernandez\r\n        ', '30'),
(8, 'Oral Surgery', 'Dental implants', 1, 'Rodrigo', 'Fernandez\r\n        ', '60'),
(9, 'Oral Surgery', 'Unequal jaw growth', 1, 'Rodrigo', 'Fernandez\r\n        ', '30'),
(10, 'Oral Surgery', 'Cleft lip and cleft palate repair', 1, 'Rodrigo', 'Fernandez\r\n        ', '30'),
(11, 'Cosmetic Dentistry', 'Teeth Whitening', 1, 'Rodrigo', 'Fernandez\r\n        ', '15'),
(12, 'Cosmetic Dentistry', 'Veneers', 1, 'Rodrigo', 'Fernandez\r\n        ', '30'),
(13, 'Cosmetic Dentistry', 'Crowns', 1, 'Rodrigo', 'Fernandez\r\n        ', '15'),
(14, 'Cosmetic Dentistry', 'Enamel Shaping', 1, 'Rodrigo', 'Fernandez\r\n        ', '20'),
(15, 'Cosmetic Dentistry', 'Dental Blonding', 1, 'Rodrigo', 'Fernandez\r\n        ', '20'),
(16, 'Cosmetic Dentistry', 'Composite Fillings', 1, 'Rodrigo', 'Fernandez\r\n        ', '30'),
(17, 'Cosmetic Dentistry', 'Gum Reshaping', 1, 'Rodrigo', 'Fernandez\r\n        ', '30'),
(18, 'Cosmetic Dentistry', 'Implants', 1, 'Rodrigo', 'Fernandez\r\n        ', '30'),
(19, 'Cosmetic Dentistry', 'Dentures', 1, 'Rodrigo', 'Fernandez\r\n        ', '30'),
(20, 'Cosmetic Dentistry', 'Bridges(fixed partial dentures)', 1, 'Rodrigo', 'Fernandez\r\n        ', '30'),
(21, 'Cosmetic Dentistry', 'Gum grafts', 1, 'Rodrigo', 'Fernandez\r\n        ', '30'),
(22, 'Cosmetic Dentistry', 'Smile Makeovers', 1, 'Rodrigo', 'Fernandez\r\n        ', '30'),
(78, 'Orthodontics', 'Braces', 2, 'Susan', 'Fernandez\r\n        ', '60'),
(24, 'Orthodontics', 'Special fixed appliances', 2, 'Susan', 'Fernandez\r\n        ', '15'),
(25, 'Orthodontics', 'Fixed space maintainers', 2, 'Susan', 'Fernandez\r\n        ', '20'),
(26, 'Orthodontics', 'Aligners', 2, 'Susan', 'Fernandez\r\n        ', '30'),
(27, 'Orthodontics', 'Removable space maintainers', 2, 'Susan', 'Fernandez\r\n        ', '30'),
(28, 'Orthodontics', 'Jaw repositioning appliances', 2, 'Susan', 'Fernandez\r\n        ', '60'),
(29, 'Orthodontics', 'Lip and cheek bumpers', 2, 'Susan', 'Fernandez\r\n        ', '20'),
(30, 'Orthodontics', 'Palatal expander', 2, 'Susan', 'Fernandez\r\n        ', '30'),
(31, 'Orthodontics', 'Removal retainers', 2, 'Susan', 'Fernandez\r\n        ', '20'),
(32, 'Orthodontics', 'Headgear', 2, 'Susan', 'Fernandez\r\n        ', '30'),
(33, 'Orthodontics', 'Overbite', 2, 'Susan', 'Fernandez\r\n        ', '30'),
(34, 'Orthodontics', 'Underbite', 2, 'Susan', 'Fernandez\r\n        ', '20'),
(35, 'Orthodontics', 'Crossbite', 2, 'Susan', 'Fernandez\r\n        ', '20'),
(36, 'Orthodontics', 'Open bite', 2, 'Susan', 'Fernandez\r\n        ', '20'),
(37, 'Orthodontics', 'Misplaced midline', 2, 'Susan', 'Fernandez\r\n        ', '30'),
(38, 'Orthodontics', 'Spacing', 2, 'Susan', 'Fernandez\r\n        ', '30'),
(39, 'Orthodontics', 'Crowding', 2, 'Susan', 'Fernandez\r\n        ', '20'),
(40, 'TMJ specialist', 'Pain relievers and anti-inflammatories', 2, 'Susan', 'Fernandez\r\n        ', '30'),
(41, 'TMJ specialist', 'Tricyclic antidepressants', 2, 'Susan', 'Fernandez\r\n        ', '20'),
(42, 'TMJ specialist', 'Muscle relaxants', 2, 'Susan', 'Fernandez\r\n        ', '20'),
(43, 'TMJ specialist', 'Oral splints or mouth guards', 2, 'Susan', 'Fernandez\r\n        ', '30'),
(44, 'TMJ specialist', 'Physical therapy', 2, 'Susan', 'Fernandez\r\n        ', '20'),
(45, 'TMJ specialist', 'Counseling', 2, 'Susan', 'Fernandez\r\n        ', '30'),
(46, 'Preventive Pediatric', 'Stainless Steel Crowns', 3, 'Mikee', 'Fernandez\r\n        ', '30'),
(47, 'Preventive Pediatric', 'Tooth Colored Fillings', 3, 'Mikee', 'Fernandez\r\n        ', '30'),
(49, 'Preventive Pediatric', 'Dental Cleaning', 3, 'Mikee', 'Fernandez\r\n        ', '15'),
(50, 'Preventive Pediatric', 'Fluoride', 3, 'Mikee', 'Fernandez\r\n        ', '15'),
(51, 'Preventive Pediatric', 'Cavities', 3, 'Mikee', 'Fernandez\r\n        ', '20'),
(52, 'Preventive Pediatric', 'Early(Interceptive) Orthodontic Care', 3, 'Mikee', 'Fernandez\r\n        ', '30'),
(53, 'Preventive Pediatric', 'Extractions', 3, 'Mikee', 'Fernandez\r\n        ', '20'),
(54, 'Preventive Pediatric', 'Pulp Treatment', 3, 'Mikee', 'Fernandez\r\n        ', '20'),
(55, 'Preventive Pediatric', 'Sealants', 3, 'Mikee', 'Fernandez\r\n        ', '20'),
(56, 'Preventive Pediatric', 'Space Maintainers', 3, 'Mikee', 'Fernandez\r\n        ', '30'),
(57, 'Periodontics', 'Non-Surgical Treatments', 3, 'Mikee', 'Fernandez\r\n        ', '30'),
(58, 'Periodontics', 'Gum Graft Surgery', 3, 'Mikee', 'Fernandez\r\n        ', '60'),
(59, 'Periodontics', 'Laser Treatment', 3, 'Mikee', 'Fernandez\r\n        ', '60'),
(60, 'Periodontics', 'Regenerative Procedures', 3, 'Mikee', 'Fernandez\r\n        ', '30'),
(61, 'Periodontics', 'Dental Crown Lengthening', 3, 'Mikee', 'Fernandez\r\n        ', '30'),
(62, 'Periodontics', 'Pocket Reduction Procedures', 3, 'Mikee', 'Fernandez\r\n        ', '30'),
(63, 'Periodontics', 'Plastic Surgery Procedures', 3, 'Mikee', 'Fernandez\r\n        ', '60'),
(82, 'Check up', 'Check up', 2, 'Susan', 'Fernandez', '30'),
(83, 'Check up', 'Check up', 3, 'Mikee', 'Fernandez', '30');

-- --------------------------------------------------------

--
-- Table structure for table `servicebackground`
--

DROP TABLE IF EXISTS `servicebackground`;
CREATE TABLE IF NOT EXISTS `servicebackground` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `background` longblob NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=2 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `servicebackground`
--

INSERT INTO `servicebackground` (`id`, `background`) VALUES
(1, 0x73657276696365732e6a7067);

-- --------------------------------------------------------

--
-- Table structure for table `servicecontent`
--

DROP TABLE IF EXISTS `servicecontent`;
CREATE TABLE IF NOT EXISTS `servicecontent` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `service` varchar(50) NOT NULL,
  `image` longblob NOT NULL,
  `offered_by` varchar(50) NOT NULL,
  `descriptions` text NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=8 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `servicecontent`
--

INSERT INTO `servicecontent` (`id`, `service`, `image`, `offered_by`, `descriptions`) VALUES
(1, 'Prosthodontics', 0x70726f73746f2e6a7067, 'Dr. Rodrigo Fernandez', 'Concerned with the design, manufacture, and fitting of artificial replacements for teeth and other parts of the mouth..'),
(2, 'Cosmetic Dentistry', 0x6165737468657469632e6a7067, 'Dr. Rodrigo Fernandez', 'Cosmetic dentistry is generally used to refer to any dental work that improves the appearance of teeth, gums and/or bite.'),
(3, 'Oral Surgery', 0x737572676572792e6a7067, 'Dr. Rodrigo Fernandez', 'Medical procedures that involve artificially modifying dentition; in other words, surgery of the teeth and jaw bones.'),
(4, 'Orthodontics', 0x6f7274686f646f6e746963732e6a7067, 'Dr. Susan Fernandez', 'The dental specialty that is concerned with the diagnosis and treatment of dental deformities as well as irregularity in the relationship of the lower to the upper jaw.'),
(5, 'TMJ specialist', 0x544d4a2e6a7067, 'Dr. Susan Fernandez', 'Concerns with the Temporomandibular joint syndrome(TMJ) a pain in the jaw joint that can be caused by a variety of medical problems.'),
(6, 'Preventive Pediatric', 0x7065646961747269632e6a7067, 'Dr. Mikee Fernandez', 'Refers to prevention of disease and promotion of physical, mental and social well-being of children with the aim of attaining a positive health.'),
(7, 'Periodontics', 0x706572696f646f6e746963732e6a7067, 'Dr. Mikee Fernandez', 'Work closely with dental hygienists, generalists and other dental specialists, play key roles in formulating treatments for maintaining a healthy mouth. ');

-- --------------------------------------------------------

--
-- Table structure for table `service_type`
--

DROP TABLE IF EXISTS `service_type`;
CREATE TABLE IF NOT EXISTS `service_type` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `service_type` varchar(250) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=15 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `service_type`
--

INSERT INTO `service_type` (`id`, `service_type`) VALUES
(1, 'Cosmetic/Aesthetic'),
(2, 'Prosthodontics'),
(3, 'Dental Surgery'),
(4, 'Orthodontics'),
(5, 'TMJ specialist'),
(6, 'Preventive Pediatric'),
(7, 'Periodontics'),
(14, 'Checkup');

-- --------------------------------------------------------

--
-- Table structure for table `slider`
--

DROP TABLE IF EXISTS `slider`;
CREATE TABLE IF NOT EXISTS `slider` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `slider` longblob NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=4 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `slider`
--

INSERT INTO `slider` (`id`, `slider`) VALUES
(1, 0x62616e6e65722e706e67),
(2, 0x736c6964652e4a5047),
(3, 0x62312e6a7067);

-- --------------------------------------------------------

--
-- Table structure for table `terms`
--

DROP TABLE IF EXISTS `terms`;
CREATE TABLE IF NOT EXISTS `terms` (
  `terms_id` int(11) NOT NULL,
  `terms` text NOT NULL,
  `late` text NOT NULL,
  `guarantee` text NOT NULL,
  `personal_details` text NOT NULL,
  `abuse_policy` text NOT NULL,
  `data_protection` text NOT NULL,
  `privacy` text NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data for table `terms`
--

INSERT INTO `terms` (`terms_id`, `terms`, `late`, `guarantee`, `personal_details`, `abuse_policy`, `data_protection`, `privacy`) VALUES
(1, 'Please be aware that any information provided through any part of our website (examples: forum, blog, news, main site, live chat, phone, email) is for fun & entertainment purposes only and does not constitute professional advice. No professional advice can be given without a clinical consultation with a dentist. For professional dental advice we strongly recommend that you see a dentist for consultation ', 'We understand that some patients travel long distances to get to the clinic, and in some cases being late for appointments can be unavoidable. If you are more than 10 minutes, please be aware that you may be asked to reschedule your appointment.', 'The patient has followed all post treatment maintenance recommendations made by our dentists.\r\nThe patient has attended and routine examination every 6 months.\r\nSome treatments may have a guarantee of less than 1 year, and in this case you will be informed by your Dentist either verbally or in writing, or both', 'It is very important that you give a full medical history and details of any medication you take. Should these change in any way, it is very important for you to tell your Dentist. It is the patients responsibility to inform the clinic of any changes in either personal details and/or their medical history.', 'At Fernandez Dental Clinic we operate a zero tolerance policy to abuse to our Dentists and staff, loud/disorderly/drunken behavior, persistent missing and late cancellation of appointments (after multiple warnings). In these situations, Dream Smile Dental Clinic reserves the right to refuse treatment and admission.', 'We store all patient personal details on a secure computer system in accordance with the Data Protection Act. All clinical notes, digital radio-graphs, digital photographs etc remain the property of Fernandez Dental Clinic. Copies of notes, radiographs and photographs can be made available on request, and Fernandez Dental Clinic reserves the right to charge an administration fee for these.', 'Your privacy is important to us. Our Clinics Privacy Policy explains how personal information is collected, used and disclosed in connection with this website.  It does not apply to personal information collected offline, such as when you visit or contact one of our dental offices. For more information about our offline practices, contact your local office and ask for a copy of our Privacy and Anti-Spam Code.  By visiting our website, you consent to the collection, use and disclosure of your personal information as described in this policy. ');

-- --------------------------------------------------------

--
-- Table structure for table `testimonials`
--

DROP TABLE IF EXISTS `testimonials`;
CREATE TABLE IF NOT EXISTS `testimonials` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `fullname` varchar(100) NOT NULL,
  `image` longblob,
  `descriptions` varchar(250) NOT NULL,
  `status` varchar(20) NOT NULL DEFAULT 'pending',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=3 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `testimonials`
--

INSERT INTO `testimonials` (`id`, `fullname`, `image`, `descriptions`, `status`) VALUES
(1, 'Bryan Palad', 0x6e6f742d617661696c61626c652e706e67, 'testing testimonials', 'approved'),
(2, 'test test', 0x6e6f742d617661696c61626c652e706e67, 'Galing niyo po magbunot ng ngipin :)', 'approved');

-- --------------------------------------------------------

--
-- Table structure for table `verify`
--

DROP TABLE IF EXISTS `verify`;
CREATE TABLE IF NOT EXISTS `verify` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `email` varchar(50) NOT NULL,
  `code` varchar(50) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=3 DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `welcome`
--

DROP TABLE IF EXISTS `welcome`;
CREATE TABLE IF NOT EXISTS `welcome` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `title` varchar(100) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=2 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `welcome`
--

INSERT INTO `welcome` (`id`, `title`) VALUES
(1, 'Make an appointment Today!');

--
-- Constraints for dumped tables
--

--
-- Constraints for table `appointment`
--
ALTER TABLE `appointment`
  ADD CONSTRAINT `appointment_ibfk_4` FOREIGN KEY (`patientIc`) REFERENCES `patient` (`icPatient`),
  ADD CONSTRAINT `appointment_ibfk_5` FOREIGN KEY (`scheduleId`) REFERENCES `doctorschedule` (`scheduleId`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
