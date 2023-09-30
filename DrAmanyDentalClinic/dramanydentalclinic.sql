-- phpMyAdmin SQL Dump
-- version 4.9.2
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1:3306
-- Generation Time: Dec 17, 2019 at 03:09 PM
-- Server version: 10.4.10-MariaDB
-- PHP Version: 7.3.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `dramanydentalclinic`
--

-- --------------------------------------------------------

--
-- Table structure for table `address`
--

DROP TABLE IF EXISTS `address`;
CREATE TABLE IF NOT EXISTS `address` (
  `AddressID` int(10) NOT NULL AUTO_INCREMENT,
  `Address` varchar(200) NOT NULL,
  `ParentID` int(10) DEFAULT 0,
  PRIMARY KEY (`AddressID`)
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `address`
--

INSERT INTO `address` (`AddressID`, `Address`, `ParentID`) VALUES
(1, 'Egypt', 0),
(2, 'KSA', 0),
(3, 'Italy', 0),
(4, 'Giza', 1),
(5, '6 October', 4),
(6, 'Pavia', 3);

-- --------------------------------------------------------

--
-- Table structure for table `doctors`
--

DROP TABLE IF EXISTS `doctors`;
CREATE TABLE IF NOT EXISTS `doctors` (
  `DocID` int(10) NOT NULL AUTO_INCREMENT,
  `Docname` varchar(30) NOT NULL,
  `Docphone` varchar(15) NOT NULL,
  `DocaddressID` int(5) NOT NULL,
  `Docbirthdate` date NOT NULL,
  `Docshifttime` varchar(20) NOT NULL,
  `DocjobtypeID` int(10) NOT NULL,
  `Docsalary` int(10) NOT NULL,
  PRIMARY KEY (`DocID`),
  KEY `doctors_ibfk_2` (`DocaddressID`),
  KEY `doctors_ibfk_1` (`DocjobtypeID`)
) ENGINE=InnoDB AUTO_INCREMENT=10 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `doctors`
--

INSERT INTO `doctors` (`DocID`, `Docname`, `Docphone`, `DocaddressID`, `Docbirthdate`, `Docshifttime`, `DocjobtypeID`, `Docsalary`) VALUES
(1, 'Khaled Hossameldin', '01020700343', 5, '1999-06-14', 'Day', 1, 10000),
(9, 'Eslam', '01020700158', 4, '1999-12-01', 'Day', 1, 10000);

-- --------------------------------------------------------

--
-- Table structure for table `employees`
--

DROP TABLE IF EXISTS `employees`;
CREATE TABLE IF NOT EXISTS `employees` (
  `EmpID` int(11) NOT NULL AUTO_INCREMENT,
  `Empname` varchar(50) NOT NULL,
  `Empphone` varchar(15) NOT NULL,
  `EmpaddressID` int(11) NOT NULL,
  `Empbirthdate` date NOT NULL,
  `EmpjobtypeID` int(11) NOT NULL,
  `Empshifttime` varchar(50) NOT NULL,
  `Empsalary` int(11) NOT NULL,
  PRIMARY KEY (`EmpID`)
) ENGINE=MyISAM AUTO_INCREMENT=3 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `employees`
--

INSERT INTO `employees` (`EmpID`, `Empname`, `Empphone`, `EmpaddressID`, `Empbirthdate`, `EmpjobtypeID`, `Empshifttime`, `Empsalary`) VALUES
(1, 'Khaled Hossameldin', '01020700343', 5, '1999-06-14', 1, 'Day', 1000);

-- --------------------------------------------------------

--
-- Table structure for table `jobtype`
--

DROP TABLE IF EXISTS `jobtype`;
CREATE TABLE IF NOT EXISTS `jobtype` (
  `JobtypeID` int(10) NOT NULL AUTO_INCREMENT,
  `jobtypename` varchar(20) NOT NULL,
  PRIMARY KEY (`JobtypeID`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `jobtype`
--

INSERT INTO `jobtype` (`JobtypeID`, `jobtypename`) VALUES
(1, 'Surgery Dentist'),
(2, 'Helper'),
(3, 'Dentist'),
(4, 'Analyst');

-- --------------------------------------------------------

--
-- Table structure for table `manager`
--

DROP TABLE IF EXISTS `manager`;
CREATE TABLE IF NOT EXISTS `manager` (
  `ManagerID` int(10) NOT NULL AUTO_INCREMENT,
  `Managername` varchar(30) NOT NULL,
  `Managerphone` varchar(15) NOT NULL,
  `ManageraddressID` int(5) NOT NULL,
  `Managerbirthdate` date NOT NULL,
  `Managershiftime` varchar(10) NOT NULL,
  `ManagerjobtypeID` int(10) NOT NULL,
  `Managersalary` int(10) NOT NULL,
  PRIMARY KEY (`ManagerID`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `manager`
--

INSERT INTO `manager` (`ManagerID`, `Managername`, `Managerphone`, `ManageraddressID`, `Managerbirthdate`, `Managershiftime`, `ManagerjobtypeID`, `Managersalary`) VALUES
(2, 'Simone Moggi', '01553527885', 6, '1997-08-27', 'Day', 1, 10000);

-- --------------------------------------------------------

--
-- Table structure for table `medicalhistory`
--

DROP TABLE IF EXISTS `medicalhistory`;
CREATE TABLE IF NOT EXISTS `medicalhistory` (
  `MhistoryID` int(10) NOT NULL AUTO_INCREMENT,
  `DIagnosis` varchar(500) NOT NULL,
  `PatID` int(11) DEFAULT NULL,
  PRIMARY KEY (`MhistoryID`),
  KEY `medicalhistory_bfk_1` (`PatID`)
) ENGINE=InnoDB AUTO_INCREMENT=8 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `medicalhistory`
--

INSERT INTO `medicalhistory` (`MhistoryID`, `DIagnosis`, `PatID`) VALUES
(4, 'Tooth Decay', 1),
(5, 'Tooth Removal', 2),
(6, 'Endodontics', 1),
(7, 'Tooth Decay', 2);

-- --------------------------------------------------------

--
-- Table structure for table `patients`
--

DROP TABLE IF EXISTS `patients`;
CREATE TABLE IF NOT EXISTS `patients` (
  `PatID` int(10) NOT NULL AUTO_INCREMENT,
  `Patname` varchar(30) NOT NULL,
  `PatEmail` varchar(30) DEFAULT NULL,
  `Patphone` varchar(15) NOT NULL,
  `PataddressID` int(5) NOT NULL,
  `Patbirthdate` date NOT NULL,
  `Patbloodtype` varchar(3) NOT NULL,
  `PathealthcareID` int(20) DEFAULT NULL,
  `PatlocalID` int(10) NOT NULL,
  `PatmedicalhistoryID` int(10) DEFAULT NULL,
  PRIMARY KEY (`PatID`),
  KEY `patients_ibfk_2` (`PataddressID`)
) ENGINE=InnoDB AUTO_INCREMENT=8 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `patients`
--

INSERT INTO `patients` (`PatID`, `Patname`, `PatEmail`, `Patphone`, `PataddressID`, `Patbirthdate`, `Patbloodtype`, `PathealthcareID`, `PatlocalID`, `PatmedicalhistoryID`) VALUES
(1, 'Khaled Hossameldin', 'khaled-hossam@outlook.com', '01020700343', 5, '1999-06-14', 'A+', 654321, 123456, 1),
(2, 'Omar Hossameldin', 'omar-hossam@outlook.com', '01020700345', 5, '2002-08-13', 'A+', 654321, 123456, 2);

-- --------------------------------------------------------

--
-- Table structure for table `receptionists`
--

DROP TABLE IF EXISTS `receptionists`;
CREATE TABLE IF NOT EXISTS `receptionists` (
  `RecID` int(11) NOT NULL AUTO_INCREMENT,
  `Recname` varchar(50) NOT NULL,
  `Recphone` varchar(15) NOT NULL,
  `RecaddressID` int(11) NOT NULL,
  `Recbirthdate` date NOT NULL,
  `RecjobtypeID` int(11) NOT NULL,
  `Recshifttime` varchar(11) NOT NULL,
  `Recsalary` int(11) NOT NULL,
  PRIMARY KEY (`RecID`)
) ENGINE=MyISAM AUTO_INCREMENT=2 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `receptionists`
--

INSERT INTO `receptionists` (`RecID`, `Recname`, `Recphone`, `RecaddressID`, `Recbirthdate`, `RecjobtypeID`, `Recshifttime`, `Recsalary`) VALUES
(1, 'Khaled Hossameldin', '01020700343', 5, '1999-06-14', 3, 'Day', 1000);

-- --------------------------------------------------------

--
-- Table structure for table `reservations`
--

DROP TABLE IF EXISTS `reservations`;
CREATE TABLE IF NOT EXISTS `reservations` (
  `ResID` int(11) NOT NULL AUTO_INCREMENT,
  `PatientID` int(11) NOT NULL DEFAULT 0,
  `ResDate` datetime NOT NULL,
  `DoctorID` int(11) NOT NULL DEFAULT 0,
  PRIMARY KEY (`ResID`),
  KEY `reservation_bfk_1` (`DoctorID`),
  KEY `reservation_bfk_2` (`PatientID`)
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=latin1 ROW_FORMAT=DYNAMIC;

--
-- Dumping data for table `reservations`
--

INSERT INTO `reservations` (`ResID`, `PatientID`, `ResDate`, `DoctorID`) VALUES
(1, 1, '2019-12-15 15:00:00', 1),
(5, 1, '2020-03-13 14:00:00', 1);

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

DROP TABLE IF EXISTS `users`;
CREATE TABLE IF NOT EXISTS `users` (
  `UserID` int(10) NOT NULL AUTO_INCREMENT,
  `Username` varchar(20) NOT NULL,
  `Password` varchar(15) NOT NULL,
  `UsertypeID` int(5) NOT NULL,
  PRIMARY KEY (`UserID`)
) ENGINE=InnoDB AUTO_INCREMENT=13 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`UserID`, `Username`, `Password`, `UsertypeID`) VALUES
(12, 'simone', '185919', 2);

-- --------------------------------------------------------

--
-- Table structure for table `usertype`
--

DROP TABLE IF EXISTS `usertype`;
CREATE TABLE IF NOT EXISTS `usertype` (
  `UsertypeID` int(10) NOT NULL AUTO_INCREMENT,
  `Usertype` varchar(30) NOT NULL,
  PRIMARY KEY (`UsertypeID`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `usertype`
--

INSERT INTO `usertype` (`UsertypeID`, `Usertype`) VALUES
(1, 'Doctor'),
(2, 'Manager'),
(3, 'Employee'),
(4, 'Receptionist');

--
-- Constraints for dumped tables
--

--
-- Constraints for table `doctors`
--
ALTER TABLE `doctors`
  ADD CONSTRAINT `doctors_ibfk_1` FOREIGN KEY (`DocjobtypeID`) REFERENCES `jobtype` (`JobtypeID`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `doctors_ibfk_2` FOREIGN KEY (`DocaddressID`) REFERENCES `address` (`AddressID`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `manager`
--
ALTER TABLE `manager`
  ADD CONSTRAINT `manager_ibfk_1` FOREIGN KEY (`ManagerjobtypeID`) REFERENCES `jobtype` (`JobtypeID`),
  ADD CONSTRAINT `manager_ibfk_2` FOREIGN KEY (`ManageraddressID`) REFERENCES `address` (`AddressID`);

--
-- Constraints for table `medicalhistory`
--
ALTER TABLE `medicalhistory`
  ADD CONSTRAINT `medicalhistory_bfk_1` FOREIGN KEY (`PatID`) REFERENCES `patients` (`PatID`);

--
-- Constraints for table `patients`
--
ALTER TABLE `patients`
  ADD CONSTRAINT `patients_ibfk_2` FOREIGN KEY (`PataddressID`) REFERENCES `address` (`AddressID`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `reservations`
--
ALTER TABLE `reservations`
  ADD CONSTRAINT `reservation_bfk_1` FOREIGN KEY (`DoctorID`) REFERENCES `doctors` (`DocID`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `reservation_bfk_2` FOREIGN KEY (`PatientID`) REFERENCES `patients` (`PatID`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `users`
--
ALTER TABLE `users`
  ADD CONSTRAINT `users_ibfk_1` FOREIGN KEY (`UsertypeID`) REFERENCES `usertype` (`UsertypeID`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
