CREATE TABLE `Employees` (
  `EmployeeID` int PRIMARY KEY AUTO_INCREMENT,
  `File_number` varchar(255),
  `BossID` int,
  `FirstName` varchar(255),
  `LastName` varchar(255),
  `Workdep` varchar(100),
  `Workname` varchar(100),
  `email` varchar(100),
  `Password` varchar(255),
  `created_at` timestamp DEFAULT (CURRENT_TIMESTAMP),
  `updated_at` timestamp DEFAULT (CURRENT_TIMESTAMP)
);

CREATE TABLE `Bosses` (
  `BossID` int PRIMARY KEY AUTO_INCREMENT,
  `Full_name` varchar(255),
  `Responsibility` text,
  `Email` varchar(255) UNIQUE,
  `Password` varchar(255),
  `created_at` timestamp DEFAULT (CURRENT_TIMESTAMP),
  `updated_at` timestamp DEFAULT (CURRENT_TIMESTAMP)
);

CREATE TABLE `Stakeholders` (
  `StakeholderID` int PRIMARY KEY AUTO_INCREMENT,
  `Workdep` text,
  `FullName` varchar(255),
  `created_at` timestamp DEFAULT (CURRENT_TIMESTAMP),
  `updated_at` timestamp DEFAULT (CURRENT_TIMESTAMP)
);

CREATE TABLE `Locations` (
  `LocationID` int PRIMARY KEY AUTO_INCREMENT,
  `LocationName` varchar(255),
  `created_at` timestamp DEFAULT (CURRENT_TIMESTAMP),
  `updated_at` timestamp DEFAULT (CURRENT_TIMESTAMP)
);

CREATE TABLE `ClearanceForms` (
  `ClearanceFormID` int PRIMARY KEY AUTO_INCREMENT,
  `EmployeeID` int,
  `BossID` int,
  `Leaving_case` varchar(255),
  `RequestDate` date,
  `Status` varchar(50),
  `created_at` timestamp DEFAULT (CURRENT_TIMESTAMP),
  `updated_at` timestamp DEFAULT (CURRENT_TIMESTAMP)
);

CREATE TABLE `ClearanceFormApprovals` (
  `ApprovalID` int PRIMARY KEY AUTO_INCREMENT,
  `ClearanceFormID` int,
  `StakeholderLocationID` int,
  `ApprovalDate` date,
  `ApprovalStatus` varchar(50),
  `Comments` text,
  `created_at` timestamp DEFAULT (CURRENT_TIMESTAMP),
  `updated_at` timestamp DEFAULT (CURRENT_TIMESTAMP)
);

CREATE TABLE `EmployeeLocations` (
  `EmployeeLocationID` int PRIMARY KEY AUTO_INCREMENT,
  `EmployeeID` int,
  `LocationID` int,
  `created_at` timestamp DEFAULT (CURRENT_TIMESTAMP),
  `updated_at` timestamp DEFAULT (CURRENT_TIMESTAMP)
);

CREATE TABLE `StakeholderLocations` (
  `StakeholderLocationID` int PRIMARY KEY AUTO_INCREMENT,
  `StakeholderID` int,
  `LocationID` int,
  `Email` varchar(255) UNIQUE,
  `Password` varchar(255),
  `created_at` timestamp DEFAULT (CURRENT_TIMESTAMP),
  `updated_at` timestamp DEFAULT (CURRENT_TIMESTAMP)
);

CREATE TABLE `Admins` (
  `id` int PRIMARY KEY AUTO_INCREMENT,
  `full_name` varchar(255),
  `email` varchar(255) UNIQUE,
  `password` varchar(255),
  `created_at` timestamp DEFAULT (CURRENT_TIMESTAMP),
  `updated_at` timestamp DEFAULT (CURRENT_TIMESTAMP)
);

ALTER TABLE `Employees` ADD FOREIGN KEY (`BossID`) REFERENCES `Bosses` (`BossID`) ON DELETE CASCADE;

ALTER TABLE `ClearanceForms` ADD FOREIGN KEY (`EmployeeID`) REFERENCES `Employees` (`EmployeeID`) ON DELETE CASCADE;

ALTER TABLE `ClearanceForms` ADD FOREIGN KEY (`BossID`) REFERENCES `Bosses` (`BossID`) ON DELETE CASCADE;

ALTER TABLE `ClearanceFormApprovals` ADD FOREIGN KEY (`ClearanceFormID`) REFERENCES `ClearanceForms` (`ClearanceFormID`) ON DELETE CASCADE;

ALTER TABLE `ClearanceFormApprovals` ADD FOREIGN KEY (`StakeholderLocationID`) REFERENCES `StakeholderLocations` (`StakeholderLocationID`) ON DELETE CASCADE;

ALTER TABLE `EmployeeLocations` ADD FOREIGN KEY (`EmployeeID`) REFERENCES `Employees` (`EmployeeID`) ON DELETE CASCADE;

ALTER TABLE `EmployeeLocations` ADD FOREIGN KEY (`LocationID`) REFERENCES `Locations` (`LocationID`) ON DELETE CASCADE;

ALTER TABLE `StakeholderLocations` ADD FOREIGN KEY (`StakeholderID`) REFERENCES `Stakeholders` (`StakeholderID`) ON DELETE CASCADE;

ALTER TABLE `StakeholderLocations` ADD FOREIGN KEY (`LocationID`) REFERENCES `Locations` (`LocationID`) ON DELETE CASCADE;
