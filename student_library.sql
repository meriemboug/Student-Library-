-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Dec 02, 2024 at 07:11 PM
-- Server version: 10.4.32-MariaDB
-- PHP Version: 8.2.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `student_library`
--

-- --------------------------------------------------------

--
-- Table structure for table `adminactivities`
--

CREATE TABLE `adminactivities` (
  `ActivityID` int(11) NOT NULL,
  `AdminID` int(11) DEFAULT NULL,
  `ActionType` enum('Edit','Delete','Add','View') NOT NULL,
  `AffectedResourceID` int(11) DEFAULT NULL,
  `ActivityTime` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `feedback`
--

CREATE TABLE `feedback` (
  `FeedbackID` int(11) NOT NULL,
  `UserID` int(11) DEFAULT NULL,
  `ResourceID` int(11) DEFAULT NULL,
  `ReportID` int(11) DEFAULT NULL,
  `FeedbackText` text DEFAULT NULL,
  `SubmittedAt` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `fileuploads`
--

CREATE TABLE `fileuploads` (
  `FileID` int(11) NOT NULL,
  `UserID` int(11) DEFAULT NULL,
  `FileName` varchar(100) NOT NULL,
  `FilePath` varchar(255) NOT NULL,
  `FileType` enum('pdf','docx','pptx','zip') NOT NULL,
  `FileSize` int(11) DEFAULT NULL,
  `UploadTime` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `reports`
--

CREATE TABLE `reports` (
  `ReportID` int(11) NOT NULL,
  `Title` varchar(100) NOT NULL,
  `ModuleName` varchar(100) DEFAULT NULL,
  `Year` enum('L1','L2','L3','M1','M2') DEFAULT NULL,
  `Type` enum('Cours','TD','TP','Exam') DEFAULT NULL,
  `Description` text DEFAULT NULL,
  `SubmittedAt` timestamp NOT NULL DEFAULT current_timestamp(),
  `SubmittedBy` int(11) DEFAULT NULL,
  `DeletedAt` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `resourcecategories`
--

CREATE TABLE `resourcecategories` (
  `CategoryID` int(11) NOT NULL,
  `CategoryName` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `resources`
--

CREATE TABLE `resources` (
  `ResourceID` int(11) NOT NULL,
  `ResourceName` varchar(100) NOT NULL,
  `Author` varchar(100) DEFAULT NULL,
  `CategoryID` int(11) DEFAULT NULL,
  `Description` text DEFAULT NULL,
  `FilePath` varchar(255) NOT NULL,
  `FileType` enum('pdf','docx','pptx','zip') NOT NULL,
  `FileSize` int(11) DEFAULT NULL,
  `UploadedAt` timestamp NOT NULL DEFAULT current_timestamp(),
  `UploadedBy` int(11) DEFAULT NULL,
  `DeletedAt` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `searchhistory`
--

CREATE TABLE `searchhistory` (
  `SearchID` int(11) NOT NULL,
  `UserID` int(11) DEFAULT NULL,
  `SearchQuery` varchar(255) DEFAULT NULL,
  `SearchTime` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `useractivitylog`
--

CREATE TABLE `useractivitylog` (
  `LogID` int(11) NOT NULL,
  `UserID` int(11) DEFAULT NULL,
  `ActivityType` enum('Login','Logout','Search','Upload') NOT NULL,
  `ActivityTime` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `userreports`
--

CREATE TABLE `userreports` (
  `UserReportID` int(11) NOT NULL,
  `UserID` int(11) DEFAULT NULL,
  `ReportID` int(11) DEFAULT NULL,
  `SubmittedAt` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `UserID` int(11) NOT NULL,
  `Username` varchar(50) NOT NULL,
  `PasswordHash` varchar(255) NOT NULL,
  `Email` varchar(100) NOT NULL,
  `Role` enum('Admin','User') NOT NULL,
  `FirstName` varchar(50) DEFAULT NULL,
  `LastName` varchar(50) DEFAULT NULL,
  `PhoneNumber` varchar(15) DEFAULT NULL,
  `ProfilePicturePath` varchar(255) DEFAULT NULL,
  `TotalUploads` int(11) DEFAULT 0,
  `TotalDownloads` int(11) DEFAULT 0,
  `CreatedAt` timestamp NOT NULL DEFAULT current_timestamp(),
  `UpdatedAt` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `DeletedAt` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Indexes for dumped tables
--

--
-- Indexes for table `adminactivities`
--
ALTER TABLE `adminactivities`
  ADD PRIMARY KEY (`ActivityID`),
  ADD KEY `AdminID` (`AdminID`),
  ADD KEY `AffectedResourceID` (`AffectedResourceID`);

--
-- Indexes for table `feedback`
--
ALTER TABLE `feedback`
  ADD PRIMARY KEY (`FeedbackID`),
  ADD KEY `UserID` (`UserID`),
  ADD KEY `ResourceID` (`ResourceID`),
  ADD KEY `ReportID` (`ReportID`);

--
-- Indexes for table `fileuploads`
--
ALTER TABLE `fileuploads`
  ADD PRIMARY KEY (`FileID`),
  ADD KEY `UserID` (`UserID`);

--
-- Indexes for table `reports`
--
ALTER TABLE `reports`
  ADD PRIMARY KEY (`ReportID`),
  ADD KEY `SubmittedBy` (`SubmittedBy`);

--
-- Indexes for table `resourcecategories`
--
ALTER TABLE `resourcecategories`
  ADD PRIMARY KEY (`CategoryID`),
  ADD UNIQUE KEY `CategoryName` (`CategoryName`);

--
-- Indexes for table `resources`
--
ALTER TABLE `resources`
  ADD PRIMARY KEY (`ResourceID`),
  ADD KEY `UploadedBy` (`UploadedBy`),
  ADD KEY `idx_resourcename` (`ResourceName`),
  ADD KEY `idx_category` (`CategoryID`);

--
-- Indexes for table `searchhistory`
--
ALTER TABLE `searchhistory`
  ADD PRIMARY KEY (`SearchID`),
  ADD KEY `UserID` (`UserID`);

--
-- Indexes for table `useractivitylog`
--
ALTER TABLE `useractivitylog`
  ADD PRIMARY KEY (`LogID`),
  ADD KEY `UserID` (`UserID`);

--
-- Indexes for table `userreports`
--
ALTER TABLE `userreports`
  ADD PRIMARY KEY (`UserReportID`),
  ADD KEY `UserID` (`UserID`),
  ADD KEY `ReportID` (`ReportID`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`UserID`),
  ADD UNIQUE KEY `Username` (`Username`),
  ADD UNIQUE KEY `Email` (`Email`),
  ADD KEY `idx_username` (`Username`),
  ADD KEY `idx_email` (`Email`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `adminactivities`
--
ALTER TABLE `adminactivities`
  MODIFY `ActivityID` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `feedback`
--
ALTER TABLE `feedback`
  MODIFY `FeedbackID` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `fileuploads`
--
ALTER TABLE `fileuploads`
  MODIFY `FileID` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `reports`
--
ALTER TABLE `reports`
  MODIFY `ReportID` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `resourcecategories`
--
ALTER TABLE `resourcecategories`
  MODIFY `CategoryID` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `resources`
--
ALTER TABLE `resources`
  MODIFY `ResourceID` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `searchhistory`
--
ALTER TABLE `searchhistory`
  MODIFY `SearchID` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `useractivitylog`
--
ALTER TABLE `useractivitylog`
  MODIFY `LogID` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `userreports`
--
ALTER TABLE `userreports`
  MODIFY `UserReportID` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `UserID` int(11) NOT NULL AUTO_INCREMENT;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `adminactivities`
--
ALTER TABLE `adminactivities`
  ADD CONSTRAINT `adminactivities_ibfk_1` FOREIGN KEY (`AdminID`) REFERENCES `users` (`UserID`),
  ADD CONSTRAINT `adminactivities_ibfk_2` FOREIGN KEY (`AffectedResourceID`) REFERENCES `resources` (`ResourceID`);

--
-- Constraints for table `feedback`
--
ALTER TABLE `feedback`
  ADD CONSTRAINT `feedback_ibfk_1` FOREIGN KEY (`UserID`) REFERENCES `users` (`UserID`),
  ADD CONSTRAINT `feedback_ibfk_2` FOREIGN KEY (`ResourceID`) REFERENCES `resources` (`ResourceID`),
  ADD CONSTRAINT `feedback_ibfk_3` FOREIGN KEY (`ReportID`) REFERENCES `reports` (`ReportID`);

--
-- Constraints for table `fileuploads`
--
ALTER TABLE `fileuploads`
  ADD CONSTRAINT `fileuploads_ibfk_1` FOREIGN KEY (`UserID`) REFERENCES `users` (`UserID`);

--
-- Constraints for table `reports`
--
ALTER TABLE `reports`
  ADD CONSTRAINT `reports_ibfk_1` FOREIGN KEY (`SubmittedBy`) REFERENCES `users` (`UserID`);

--
-- Constraints for table `resources`
--
ALTER TABLE `resources`
  ADD CONSTRAINT `resources_ibfk_1` FOREIGN KEY (`UploadedBy`) REFERENCES `users` (`UserID`),
  ADD CONSTRAINT `resources_ibfk_2` FOREIGN KEY (`CategoryID`) REFERENCES `resourcecategories` (`CategoryID`);

--
-- Constraints for table `searchhistory`
--
ALTER TABLE `searchhistory`
  ADD CONSTRAINT `searchhistory_ibfk_1` FOREIGN KEY (`UserID`) REFERENCES `users` (`UserID`);

--
-- Constraints for table `useractivitylog`
--
ALTER TABLE `useractivitylog`
  ADD CONSTRAINT `useractivitylog_ibfk_1` FOREIGN KEY (`UserID`) REFERENCES `users` (`UserID`);

--
-- Constraints for table `userreports`
--
ALTER TABLE `userreports`
  ADD CONSTRAINT `userreports_ibfk_1` FOREIGN KEY (`UserID`) REFERENCES `users` (`UserID`),
  ADD CONSTRAINT `userreports_ibfk_2` FOREIGN KEY (`ReportID`) REFERENCES `reports` (`ReportID`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
