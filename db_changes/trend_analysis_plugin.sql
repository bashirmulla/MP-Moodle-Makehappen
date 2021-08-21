-- phpMyAdmin SQL Dump
-- version 5.0.2
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Aug 20, 2021 at 03:20 PM
-- Server version: 10.4.14-MariaDB
-- PHP Version: 7.2.33

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `moodle_final`
--

-- --------------------------------------------------------

--
-- Table structure for table `mdl_accident_riddor_files`
--

DROP TABLE IF EXISTS `mdl_accident_riddor_files`;
CREATE TABLE `mdl_accident_riddor_files` (
  `id` int(11) NOT NULL,
  `accident_id` int(11) NOT NULL,
  `file_name` varchar(200) DEFAULT NULL,
  `file_location` text NOT NULL,
  `uploaded_by` int(11) NOT NULL COMMENT 'user_id of file uploader'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `mdl_email_notification_on_high_h_s_report_volumes`
--

DROP TABLE IF EXISTS `mdl_email_notification_on_high_h_s_report_volumes`;
CREATE TABLE `mdl_email_notification_on_high_h_s_report_volumes` (
  `id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `act_of_physical_violence_status` tinyint(4) NOT NULL DEFAULT 0,
  `act_of_physical_violence` int(11) NOT NULL DEFAULT 0,
  `cuts_and_lacerations_status` tinyint(4) NOT NULL DEFAULT 0,
  `cuts_and_lacerations` int(11) NOT NULL DEFAULT 0,
  `falls_from_height_status` tinyint(4) NOT NULL DEFAULT 0,
  `falls_from_height` int(11) NOT NULL DEFAULT 0,
  `manual_handling_status` tinyint(4) NOT NULL DEFAULT 0,
  `manual_handling` int(11) NOT NULL DEFAULT 0,
  `needlestick_injuries_status` tinyint(4) NOT NULL DEFAULT 0,
  `needlestick_injuries` int(11) NOT NULL DEFAULT 0,
  `slips_trips_and_falls_on_same_level_status` tinyint(4) NOT NULL DEFAULT 0,
  `slips_trips_and_falls_on_same_level` int(11) NOT NULL DEFAULT 0,
  `struck_by_an_object_status` tinyint(4) NOT NULL DEFAULT 0,
  `struck_by_an_object` int(11) NOT NULL DEFAULT 0,
  `animals_status` tinyint(4) NOT NULL DEFAULT 0,
  `animals` int(11) NOT NULL DEFAULT 0,
  `equipment_issues_status` tinyint(4) NOT NULL DEFAULT 0,
  `equipment_issues` int(11) NOT NULL DEFAULT 0,
  `gas_detection_status` tinyint(4) NOT NULL DEFAULT 0,
  `gas_detection` int(11) NOT NULL DEFAULT 0,
  `needle_glass_status` tinyint(4) NOT NULL DEFAULT 0,
  `needle_glass` int(11) NOT NULL DEFAULT 0,
  `slips_trips_and_falls_status` tinyint(4) NOT NULL DEFAULT 0,
  `slips_trips_and_falls` int(11) NOT NULL DEFAULT 0,
  `traffic_vehicle_status` tinyint(4) NOT NULL DEFAULT 0,
  `traffic_vehicle` int(11) NOT NULL DEFAULT 0,
  `vegetation_status` tinyint(4) NOT NULL DEFAULT 0,
  `vegetation` int(11) NOT NULL DEFAULT 0,
  `vehicle_collision_status` tinyint(4) NOT NULL DEFAULT 0,
  `vehicle_collision` int(11) NOT NULL DEFAULT 0,
  `vehicle_near_miss_status` tinyint(4) NOT NULL DEFAULT 0,
  `vehicle_near_miss` int(11) NOT NULL DEFAULT 0,
  `vehicle_theft_status` tinyint(4) NOT NULL DEFAULT 0,
  `vehicle_theft` int(11) NOT NULL DEFAULT 0,
  `vehicle_vandalism_status` tinyint(4) NOT NULL DEFAULT 0,
  `vehicle_vandalism` int(11) NOT NULL DEFAULT 0,
  `vehicle_general_damage_status` tinyint(4) NOT NULL DEFAULT 0,
  `vehicle_general_damage` int(11) NOT NULL DEFAULT 0,
  `equipment_loss_status` tinyint(4) NOT NULL DEFAULT 0,
  `equipment_loss` int(11) NOT NULL DEFAULT 0,
  `equipment_theft_status` tinyint(4) NOT NULL DEFAULT 0,
  `equipment_theft` int(11) NOT NULL DEFAULT 0,
  `equipment_wear_and_tear_status` tinyint(4) NOT NULL DEFAULT 0,
  `equipment_wear_and_tear` int(11) NOT NULL DEFAULT 0,
  `environmental_flooding_internal_status` tinyint(4) NOT NULL DEFAULT 0,
  `environmental_flooding_internal` int(11) NOT NULL DEFAULT 0,
  `environmental_flooding_external_status` tinyint(4) NOT NULL DEFAULT 0,
  `environmental_flooding_external` int(11) NOT NULL DEFAULT 0,
  `environmental_contamination_status` tinyint(4) NOT NULL DEFAULT 0,
  `environmental_contamination` int(11) NOT NULL DEFAULT 0,
  `environmental_fly_tipping_status` tinyint(4) NOT NULL DEFAULT 0,
  `environmental_fly_tipping` int(11) NOT NULL DEFAULT 0,
  `attack_abusive_verbal_status` tinyint(4) NOT NULL DEFAULT 0,
  `attack_abusive_verbal` int(11) NOT NULL DEFAULT 0,
  `attack_animal_attack_status` tinyint(4) NOT NULL DEFAULT 0,
  `attack_animal_attack` int(11) NOT NULL DEFAULT 0,
  `created_at` int(11) NOT NULL DEFAULT 0,
  `updated_at` int(11) NOT NULL DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `mdl_report_actual`
--

DROP TABLE IF EXISTS `mdl_report_actual`;
CREATE TABLE `mdl_report_actual` (
  `id` bigint(10) NOT NULL,
  `user_id` bigint(10) NOT NULL,
  `year` smallint(6) NOT NULL,
  `month` smallint(6) NOT NULL,
  `data` longtext COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `timestamp` bigint(10) DEFAULT NULL,
  `created_at` bigint(10) DEFAULT NULL,
  `updated_at` bigint(10) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci COMMENT='Report Actual' ROW_FORMAT=COMPRESSED;

-- --------------------------------------------------------

--
-- Table structure for table `mdl_report_download_history`
--

DROP TABLE IF EXISTS `mdl_report_download_history`;
CREATE TABLE `mdl_report_download_history` (
  `id` int(11) NOT NULL,
  `report_id` int(11) DEFAULT NULL,
  `user_id` int(11) DEFAULT NULL,
  `download_at` bigint(20) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `mdl_report_table`
--

DROP TABLE IF EXISTS `mdl_report_table`;
CREATE TABLE `mdl_report_table` (
  `id` bigint(10) NOT NULL,
  `name` varchar(150) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT ''
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci COMMENT='Report Table' ROW_FORMAT=COMPRESSED;

-- --------------------------------------------------------

--
-- Table structure for table `mdl_report_table_emaildata`
--

DROP TABLE IF EXISTS `mdl_report_table_emaildata`;
CREATE TABLE `mdl_report_table_emaildata` (
  `id` bigint(10) NOT NULL,
  `firstname` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT '',
  `lastname` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT '',
  `email` varchar(150) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT '',
  `contact` bigint(11) NOT NULL DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci COMMENT='Report Email Data Table' ROW_FORMAT=COMPRESSED;

--
-- Dumping data for table `mdl_report_table_emaildata`
--

INSERT INTO `mdl_report_table_emaildata` (`id`, `firstname`, `lastname`, `email`, `contact`) VALUES
(1, 'Bashir', 'Mulla', 'N/A', 1),
(2, 'Bashir', 'Mulla', 'N/A', 2),
(3, 'UU', 'Waste Water (Non-Core)', 'N/A', 119),
(4, 'STW Waste Water', 'Pro-Active', 'N/A', 120),
(5, 'YWS', 'Waste Water', 'N/A', 121),
(6, 'MAG', '', 'N/A', 122),
(7, 'Carnells', '', 'N/A', 123),
(8, 'UU', 'Other', 'N/A', 124),
(9, 'Other', '', 'N/A', 125),
(10, 'UU', 'Waste Water (Non-Core)', 'N/A', 126),
(11, 'STW Waste Water', 'Pro-Active', 'N/A', 127),
(12, 'YWS', 'Waste Water', 'N/A', 128),
(13, 'MAG', '', 'N/A', 129),
(14, 'Carnells', '', 'N/A', 130),
(15, 'UU', 'Other', 'N/A', 131),
(16, 'Other', '', 'N/A', 132);
-- --------------------------------------------------------

--
-- Table structure for table `mdl_report_target`
--

DROP TABLE IF EXISTS `mdl_report_target`;
CREATE TABLE `mdl_report_target` (
  `id` bigint(10) NOT NULL,
  `user_id` bigint(10) NOT NULL,
  `year` smallint(6) NOT NULL,
  `data` longtext COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `timestamp` bigint(10) DEFAULT NULL,
  `created_at` bigint(10) DEFAULT NULL,
  `updated_at` bigint(10) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci COMMENT='Report Target' ROW_FORMAT=COMPRESSED;

--
-- Indexes for dumped tables
--

--
-- Indexes for table `mdl_accident_riddor_files`
--
ALTER TABLE `mdl_accident_riddor_files`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `mdl_email_notification_on_high_h_s_report_volumes`
--
ALTER TABLE `mdl_email_notification_on_high_h_s_report_volumes`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `mdl_report_actual`
--
ALTER TABLE `mdl_report_actual`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `mdl_report_download_history`
--
ALTER TABLE `mdl_report_download_history`
  ADD PRIMARY KEY (`id`),
  ADD KEY `report_id` (`report_id`,`user_id`,`download_at`);

--
-- Indexes for table `mdl_report_table`
--
ALTER TABLE `mdl_report_table`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `mdl_report_table_emaildata`
--
ALTER TABLE `mdl_report_table_emaildata`
  ADD PRIMARY KEY (`id`),
  ADD KEY `email` (`email`,`contact`);

--
-- Indexes for table `mdl_report_target`
--
ALTER TABLE `mdl_report_target`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `mdl_accident_riddor_files`
--
ALTER TABLE `mdl_accident_riddor_files`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `mdl_email_notification_on_high_h_s_report_volumes`
--
ALTER TABLE `mdl_email_notification_on_high_h_s_report_volumes`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `mdl_report_actual`
--
ALTER TABLE `mdl_report_actual`
  MODIFY `id` bigint(10) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `mdl_report_download_history`
--
ALTER TABLE `mdl_report_download_history`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `mdl_report_table`
--
ALTER TABLE `mdl_report_table`
  MODIFY `id` bigint(10) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `mdl_report_table_emaildata`
--
ALTER TABLE `mdl_report_table_emaildata`
  MODIFY `id` bigint(10) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `mdl_report_target`
--
ALTER TABLE `mdl_report_target`
  MODIFY `id` bigint(10) NOT NULL AUTO_INCREMENT;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
