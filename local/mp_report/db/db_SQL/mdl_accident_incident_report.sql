-- phpMyAdmin SQL Dump
-- version 5.1.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Dec 13, 2021 at 08:10 PM
-- Server version: 10.4.21-MariaDB
-- PHP Version: 7.3.31

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `mp-moodle`
--

-- --------------------------------------------------------

--
-- Table structure for table `mdl_accident_incident_report`
--

CREATE TABLE `mdl_accident_incident_report` (
  `id` int(11) NOT NULL,
  `injured_surname` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
  `injured_forename` varchar(200) COLLATE utf8mb4_unicode_ci NOT NULL,
  `home_address` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `telephone` varchar(50) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `sex` enum('Male','Female') COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `age` int(11) DEFAULT NULL,
  `operative_now_at` int(11) DEFAULT NULL,
  `time_lost_hours` int(11) DEFAULT NULL,
  `time_lost_minutes` int(11) DEFAULT NULL,
  `time_lost_none` int(11) DEFAULT NULL,
  `temporary_address` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `employment_status` int(11) DEFAULT NULL,
  `occupation` varchar(256) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `nature_of_injury` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `part_of_body_affected` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `occurrence_date` bigint(20) DEFAULT NULL,
  `name_address_of_site` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `exect_location_on_site` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `work_type_of_occurrence` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `reported_datetime` bigint(20) DEFAULT NULL,
  `injured_person_believe` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `witness_name_address` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `kind_of_accident_id` int(11) DEFAULT NULL,
  `agents_indicated` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `firstaid_administered` enum('Yes','No') COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `account_occurrance` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `action_taken` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `submitter_to_manager` enum('Yes','No') COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'No',
  `created_by` int(11) NOT NULL,
  `created_date` datetime NOT NULL,
  `updated_date` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;


--
-- Indexes for table `mdl_accident_incident_report`
--
ALTER TABLE `mdl_accident_incident_report`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `mdl_accident_incident_report`
--
ALTER TABLE `mdl_accident_incident_report`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
