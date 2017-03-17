-- phpMyAdmin SQL Dump
-- version 4.6.5.2
-- https://www.phpmyadmin.net/
--
-- Host: localhost
-- Generation Time: Mar 17, 2017 at 11:04 AM
-- Server version: 10.1.21-MariaDB
-- PHP Version: 5.6.30

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `Prescriptions-R-X`
--

-- --------------------------------------------------------

--
-- Table structure for table `Contract`
--

CREATE TABLE `Contract` (
  `PharmacyId` int(10) UNSIGNED NOT NULL,
  `PharmaceuticalCompanyId` int(10) UNSIGNED NOT NULL,
  `StartDate` date NOT NULL,
  `EndDate` date NOT NULL,
  `Supervisor` text CHARACTER SET greek NOT NULL,
  `Text` text CHARACTER SET greek NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `Contract`
--

INSERT INTO `Contract` (`PharmacyId`, `PharmaceuticalCompanyId`, `StartDate`, `EndDate`, `Supervisor`, `Text`) VALUES
(1, 2, '2014-05-06', '2017-02-28', 'Sagonas Konstantinos', 'Please send money.'),
(2, 1, '2017-02-06', '2017-02-28', 'Papaspyrou Nikolaos', 'Please send money.'),
(3, 4, '2018-11-19', '2025-10-18', 'Maragos Petros', 'Please send money.'),
(3, 7, '2016-06-16', '2017-08-09', 'Koziris Nektarios', 'Please send money.'),
(4, 7, '2016-09-05', '2018-06-15', 'Stamou Georgios', 'Please send money.'),
(10, 8, '2017-03-13', '2017-08-17', 'Sountris Dimitris', 'Please send money.');

-- --------------------------------------------------------

--
-- Table structure for table `delete_log`
--

CREATE TABLE `delete_log` (
  `first` text CHARACTER SET greek COLLATE greek_bin,
  `last` text CHARACTER SET greek COLLATE greek_bin,
  `doctorid` int(11) DEFAULT NULL,
  `deleted_on` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `delete_log`
--

INSERT INTO `delete_log` (`first`, `last`, `doctorid`, `deleted_on`) VALUES
('Doctor', 'Doctoropoulos', 11, '2017-03-07 17:19:07');

-- --------------------------------------------------------

--
-- Table structure for table `Doctor`
--

CREATE TABLE `Doctor` (
  `DoctorId` int(11) UNSIGNED NOT NULL,
  `ExperienceYears` int(11) UNSIGNED NOT NULL,
  `FirstName` text CHARACTER SET greek NOT NULL,
  `LastName` text CHARACTER SET greek NOT NULL,
  `Specialty` text CHARACTER SET greek NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `Doctor`
--

INSERT INTO `Doctor` (`DoctorId`, `ExperienceYears`, `FirstName`, `LastName`, `Specialty`) VALUES
(1, 5, 'Christos', 'Frisiras', 'Gynecologist'),
(2, 6, 'Emmanouil', 'Theodosis', 'Heart Surgeon'),
(3, 3, 'Achilles', 'Benetopoulos', 'Orthopedic'),
(4, 11, 'Yannis', 'Sachinoglou', 'Urologist'),
(5, 15, 'Timos', 'Korres', 'Pediatrician'),
(6, 9, 'Dimitris', 'Housiadas', 'Gynecologist'),
(7, 5, 'Panayotis', 'Fitas', 'Opthalmologist'),
(8, 23, 'Foivos', 'Andriotis', 'Neurosurgeon'),
(12, 11, 'Maira', 'Ravani', 'Dermatologist'),
(13, 43, 'Zoe', 'Lagoudaki', 'Chiropractor');

--
-- Triggers `Doctor`
--
DELIMITER $$
CREATE TRIGGER `delete_logger` AFTER DELETE ON `Doctor` FOR EACH ROW INSERT INTO delete_log(first, last, doctorid)
VALUES (OLD.FirstName, OLD.LastName, OLD.`DoctorId`)
$$
DELIMITER ;

-- --------------------------------------------------------

--
-- Table structure for table `Drug`
--

CREATE TABLE `Drug` (
  `DrugId` int(10) UNSIGNED NOT NULL,
  `Formula` text NOT NULL,
  `Name` text NOT NULL,
  `PharmaceuticalCompanyId` int(10) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `Drug`
--

INSERT INTO `Drug` (`DrugId`, `Formula`, `Name`, `PharmaceuticalCompanyId`) VALUES
(1, 'Chlorine, Mercury, Nitric Acid', 'CHLOROX', 5),
(2, 'Valeriana, Heroine, Cocaine', 'VALIUM', 2),
(3, 'Cocaine, Sugar', 'HAPPYLEX', 1),
(4, 'Cocaine, Sulfur, Milk', 'ORVITOL', 3),
(5, 'Chloric Acid, Sulfuric Acid', 'RIFTILEN', 6),
(6, 'Coffe', 'LAXATINIUM', 4),
(7, 'Human Tears, Waster Dreams, Vanity', 'PLISEREX', 6),
(8, 'Human Tears, Dog Hair, Effort', 'LOCOBEN', 5),
(9, 'Hair, Paper, Love', 'LOVENEX', 2);

-- --------------------------------------------------------

--
-- Stand-in structure for view `drug_view`
-- (See below for the actual view)
--
CREATE TABLE `drug_view` (
`PatientName` text
,`DoctorName` text
,`DrugName` text
);

-- --------------------------------------------------------

--
-- Table structure for table `insert_log`
--

CREATE TABLE `insert_log` (
  `Drug` int(11) DEFAULT NULL,
  `Pharmacy` int(11) DEFAULT NULL,
  `Price` int(11) DEFAULT NULL,
  `Inserted_on` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `insert_log`
--

INSERT INTO `insert_log` (`Drug`, `Pharmacy`, `Price`, `Inserted_on`) VALUES
(7, 7, 567, '2017-03-07 16:12:46'),
(4, 9, 59, '2017-03-07 16:23:21'),
(9, 10, 7654, '2017-03-09 10:10:46');

-- --------------------------------------------------------

--
-- Table structure for table `Patient`
--

CREATE TABLE `Patient` (
  `Age` int(10) UNSIGNED NOT NULL,
  `DoctorId` int(11) UNSIGNED NOT NULL,
  `FirstName` text CHARACTER SET greek NOT NULL,
  `LastName` text CHARACTER SET greek NOT NULL,
  `PatientId` int(10) UNSIGNED NOT NULL,
  `PostalCode` int(10) UNSIGNED NOT NULL,
  `StreetName` text CHARACTER SET greek NOT NULL,
  `StreetNumber` int(10) UNSIGNED NOT NULL,
  `Town` text CHARACTER SET greek NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `Patient`
--

INSERT INTO `Patient` (`Age`, `DoctorId`, `FirstName`, `LastName`, `PatientId`, `PostalCode`, `StreetName`, `StreetNumber`, `Town`) VALUES
(14, 1, 'Foivos', 'Varthalitis', 1, 12345, 'Averof', 27, 'Athens'),
(16, 2, 'Elli', 'Galata', 2, 15032, 'Valtetsiou', 31, 'Athens'),
(11, 8, 'Vasilis', 'Papaefthymiou', 3, 15356, 'Olympias', 17, 'Athens'),
(21, 4, 'Nelly', 'Papalampidi', 4, 15128, 'Panayoti Zografou', 49, 'Leykada'),
(22, 6, 'Yannis', 'Spantidakis', 5, 15119, 'Vasileos Konstantinou', 53, 'Chania'),
(52, 5, 'Georgios', 'Valkanos', 6, 15132, 'Panayotara', 25, 'Euvoia'),
(45, 3, 'Stella', 'Tsikoura', 7, 15232, 'Mpimpaki', 33, 'Athens'),
(4, 13, 'Zizel', 'Theodosi', 8, 15232, 'Elpidos', 26, 'Athens'),
(23, 13, 'Katerina', 'Margatina', 9, 15532, 'Streit', 52, 'Athens');

-- --------------------------------------------------------

--
-- Stand-in structure for view `patient_view`
-- (See below for the actual view)
--
CREATE TABLE `patient_view` (
`PatientId` int(10) unsigned
,`PatientFirst` text
,`PatientLast` text
,`PatientTown` text
,`DoctorName` text
);

-- --------------------------------------------------------

--
-- Table structure for table `PharmaceuticalCompany`
--

CREATE TABLE `PharmaceuticalCompany` (
  `Name` text NOT NULL,
  `PharmaceuticalCompanyId` int(10) UNSIGNED NOT NULL,
  `PhoneNumber` int(10) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `PharmaceuticalCompany`
--

INSERT INTO `PharmaceuticalCompany` (`Name`, `PharmaceuticalCompanyId`, `PhoneNumber`) VALUES
('Mylan', 1, 2106678987),
('Bayern', 2, 2106678982),
('Rockafeller', 3, 2109898786),
('Bimbex', 4, 2104567876),
('Rimpentex', 5, 2106578935),
('Lokrox', 6, 2101298456),
('Aribarx', 7, 2107852901),
('Leonerefex', 8, 2107898223);

-- --------------------------------------------------------

--
-- Table structure for table `Pharmacy`
--

CREATE TABLE `Pharmacy` (
  `PharmacyId` int(10) UNSIGNED NOT NULL,
  `Name` text CHARACTER SET greek NOT NULL,
  `PostalCode` int(10) UNSIGNED NOT NULL,
  `StreetName` text CHARACTER SET greek NOT NULL,
  `StreetNumber` int(10) UNSIGNED NOT NULL,
  `Town` text CHARACTER SET greek NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `Pharmacy`
--

INSERT INTO `Pharmacy` (`PharmacyId`, `Name`, `PostalCode`, `StreetName`, `StreetNumber`, `Town`) VALUES
(1, 'Mpamis', 15232, 'Esperidon', 135, 'Athens'),
(2, 'Yiota', 11232, 'Tsimiski', 99, 'Thessaloniki'),
(3, 'Haralampos', 11471, 'Aristotelous', 37, 'Thessaloniki'),
(4, 'Eulampia', 19802, 'Riga Feraiou', 2, 'Patra'),
(5, 'Vrasidas', 15233, 'Sarantaporou', 33, 'Athens'),
(6, 'Hristoforos', 11475, 'Perikleous', 121, 'Thessalonii'),
(7, 'Soula', 15232, 'Elpidos', 26, 'Athens'),
(9, 'Lukourgos', 19872, 'Lykourgou', 52, 'Oropos'),
(10, 'Eufrosini', 15683, 'Alexandras', 187, 'Patra');

-- --------------------------------------------------------

--
-- Table structure for table `Prescription`
--

CREATE TABLE `Prescription` (
  `Date` date NOT NULL,
  `Quantity` int(10) UNSIGNED NOT NULL,
  `DoctorId` int(10) UNSIGNED NOT NULL,
  `PatientId` int(10) UNSIGNED NOT NULL,
  `DrugId` int(10) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `Prescription`
--

INSERT INTO `Prescription` (`Date`, `Quantity`, `DoctorId`, `PatientId`, `DrugId`) VALUES
('2017-08-22', 6, 2, 1, 7),
('2017-02-26', 3, 2, 3, 4),
('2017-02-15', 6, 3, 5, 4),
('2017-02-22', 3, 6, 3, 5),
('2017-02-01', 2, 6, 4, 4),
('2017-02-13', 6, 7, 1, 2),
('2017-02-28', 11, 8, 7, 1),
('2017-02-24', 2, 8, 7, 6),
('2017-05-26', 7, 13, 9, 9);

-- --------------------------------------------------------

--
-- Table structure for table `Sell`
--

CREATE TABLE `Sell` (
  `DrugId` int(10) UNSIGNED NOT NULL,
  `PharmacyId` int(10) UNSIGNED NOT NULL,
  `Price` int(10) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `Sell`
--

INSERT INTO `Sell` (`DrugId`, `PharmacyId`, `Price`) VALUES
(1, 1, 82),
(1, 4, 82),
(1, 7, 92),
(2, 2, 15),
(3, 2, 27),
(4, 6, 88),
(4, 9, 59),
(5, 5, 55),
(6, 2, 23),
(7, 7, 56),
(9, 10, 7654);

--
-- Triggers `Sell`
--
DELIMITER $$
CREATE TRIGGER `before_log` BEFORE INSERT ON `Sell` FOR EACH ROW INSERT INTO insert_log(Drug, Pharmacy, Price)
VALUES (NEW.`DrugId`, NEW.`PharmacyId`, NEW.`Price`)
$$
DELIMITER ;

-- --------------------------------------------------------

--
-- Structure for view `drug_view`
--
DROP TABLE IF EXISTS `drug_view`;

CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `prescriptions-r-x`.`drug_view`  AS  (select `prescriptions-r-x`.`patient`.`LastName` AS `PatientName`,`prescriptions-r-x`.`doctor`.`LastName` AS `DoctorName`,`prescriptions-r-x`.`drug`.`Name` AS `DrugName` from (((`prescriptions-r-x`.`patient` join `prescriptions-r-x`.`doctor`) join `prescriptions-r-x`.`drug`) join `prescriptions-r-x`.`prescription`) where ((`prescriptions-r-x`.`prescription`.`DoctorId` = `prescriptions-r-x`.`doctor`.`DoctorId`) and (`prescriptions-r-x`.`prescription`.`PatientId` = `prescriptions-r-x`.`patient`.`PatientId`) and (`prescriptions-r-x`.`prescription`.`DrugId` = `prescriptions-r-x`.`drug`.`DrugId`)) order by `prescriptions-r-x`.`patient`.`LastName`) ;

-- --------------------------------------------------------

--
-- Structure for view `patient_view`
--
DROP TABLE IF EXISTS `patient_view`;

CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `prescriptions-r-x`.`patient_view`  AS  (select `prescriptions-r-x`.`patient`.`PatientId` AS `PatientId`,`prescriptions-r-x`.`patient`.`FirstName` AS `PatientFirst`,`prescriptions-r-x`.`patient`.`LastName` AS `PatientLast`,`prescriptions-r-x`.`patient`.`Town` AS `PatientTown`,`prescriptions-r-x`.`doctor`.`LastName` AS `DoctorName` from (`prescriptions-r-x`.`patient` join `prescriptions-r-x`.`doctor`) where (`prescriptions-r-x`.`patient`.`DoctorId` = `prescriptions-r-x`.`doctor`.`DoctorId`)) ;

--
-- Indexes for dumped tables
--

--
-- Indexes for table `Contract`
--
ALTER TABLE `Contract`
  ADD PRIMARY KEY (`PharmacyId`,`PharmaceuticalCompanyId`),
  ADD KEY `fk_contract` (`PharmacyId`,`PharmaceuticalCompanyId`),
  ADD KEY `fk_pharmaceuticalId_contract` (`PharmaceuticalCompanyId`);

--
-- Indexes for table `Doctor`
--
ALTER TABLE `Doctor`
  ADD PRIMARY KEY (`DoctorId`);

--
-- Indexes for table `Drug`
--
ALTER TABLE `Drug`
  ADD PRIMARY KEY (`DrugId`),
  ADD KEY `fk_pharmaId_drug` (`PharmaceuticalCompanyId`);

--
-- Indexes for table `Patient`
--
ALTER TABLE `Patient`
  ADD PRIMARY KEY (`PatientId`),
  ADD KEY `fk_doctorId_patient` (`DoctorId`);

--
-- Indexes for table `PharmaceuticalCompany`
--
ALTER TABLE `PharmaceuticalCompany`
  ADD PRIMARY KEY (`PharmaceuticalCompanyId`);

--
-- Indexes for table `Pharmacy`
--
ALTER TABLE `Pharmacy`
  ADD PRIMARY KEY (`PharmacyId`);

--
-- Indexes for table `Prescription`
--
ALTER TABLE `Prescription`
  ADD PRIMARY KEY (`DoctorId`,`PatientId`,`DrugId`),
  ADD KEY `fk_presc` (`DoctorId`,`PatientId`,`DrugId`),
  ADD KEY `fk_patientId_presc` (`PatientId`),
  ADD KEY `fk_drugId_presc` (`DrugId`);

--
-- Indexes for table `Sell`
--
ALTER TABLE `Sell`
  ADD PRIMARY KEY (`DrugId`,`PharmacyId`),
  ADD KEY `fk_pharmacy` (`DrugId`,`PharmacyId`),
  ADD KEY `fk_pharmacyId_sell` (`PharmacyId`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `Doctor`
--
ALTER TABLE `Doctor`
  MODIFY `DoctorId` int(11) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;
--
-- AUTO_INCREMENT for table `Drug`
--
ALTER TABLE `Drug`
  MODIFY `DrugId` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;
--
-- AUTO_INCREMENT for table `Patient`
--
ALTER TABLE `Patient`
  MODIFY `PatientId` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;
--
-- AUTO_INCREMENT for table `PharmaceuticalCompany`
--
ALTER TABLE `PharmaceuticalCompany`
  MODIFY `PharmaceuticalCompanyId` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;
--
-- AUTO_INCREMENT for table `Pharmacy`
--
ALTER TABLE `Pharmacy`
  MODIFY `PharmacyId` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;
--
-- Constraints for dumped tables
--

--
-- Constraints for table `Contract`
--
ALTER TABLE `Contract`
  ADD CONSTRAINT `fk_pharmaceuticalId_contract` FOREIGN KEY (`PharmaceuticalCompanyId`) REFERENCES `PharmaceuticalCompany` (`PharmaceuticalCompanyId`) ON UPDATE CASCADE,
  ADD CONSTRAINT `fk_pharmacyId_contract` FOREIGN KEY (`PharmacyId`) REFERENCES `Pharmacy` (`PharmacyId`) ON UPDATE CASCADE;

--
-- Constraints for table `Drug`
--
ALTER TABLE `Drug`
  ADD CONSTRAINT `fk_pharmaId_drug` FOREIGN KEY (`PharmaceuticalCompanyId`) REFERENCES `PharmaceuticalCompany` (`PharmaceuticalCompanyId`) ON UPDATE CASCADE;

--
-- Constraints for table `Patient`
--
ALTER TABLE `Patient`
  ADD CONSTRAINT `fk_doctorId_patient` FOREIGN KEY (`DoctorId`) REFERENCES `Doctor` (`DoctorId`) ON UPDATE CASCADE;

--
-- Constraints for table `Prescription`
--
ALTER TABLE `Prescription`
  ADD CONSTRAINT `fk_doctorId_presc` FOREIGN KEY (`DoctorId`) REFERENCES `Doctor` (`DoctorId`) ON UPDATE CASCADE,
  ADD CONSTRAINT `fk_drugId_presc` FOREIGN KEY (`DrugId`) REFERENCES `Drug` (`DrugId`) ON UPDATE CASCADE,
  ADD CONSTRAINT `fk_patientId_presc` FOREIGN KEY (`PatientId`) REFERENCES `Patient` (`PatientId`) ON UPDATE CASCADE;

--
-- Constraints for table `Sell`
--
ALTER TABLE `Sell`
  ADD CONSTRAINT `fk_drugId_sell` FOREIGN KEY (`DrugId`) REFERENCES `Drug` (`DrugId`) ON UPDATE CASCADE,
  ADD CONSTRAINT `fk_pharmacyId_sell` FOREIGN KEY (`PharmacyId`) REFERENCES `Pharmacy` (`PharmacyId`) ON UPDATE CASCADE;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
