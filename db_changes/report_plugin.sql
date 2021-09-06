DROP TABLE IF EXISTS mdl_accident_report;
DROP TABLE IF EXISTS mdl_incident_report;
DROP TABLE IF EXISTS mdl_report_table;
DROP TABLE IF EXISTS mdl_standing_table;
DROP TABLE IF EXISTS mdl_report_table_emaildata;
DROP TABLE IF EXISTS mdl_report_download_history;
DROP TABLE IF EXISTS mdl_email_notification_on_high_h_s_report_volumes;
DROP TABLE IF EXISTS mdl_high_hs_report_send_notification;

-- phpMyAdmin SQL Dump
-- version 5.1.0
-- https://www.phpmyadmin.net/
--
-- Host: 172.24.16.20
-- Generation Time: Aug 11, 2021 at 10:31 AM
-- Server version: 5.7.19
-- PHP Version: 7.4.16

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `PRE_CALM_MOODLE`
--

-- --------------------------------------------------------

--
-- Table structure for table `mdl_accident_report`
--

CREATE TABLE `mdl_accident_report` (
  `id` bigint(10) NOT NULL,
  `user_id` bigint(10) NOT NULL,
  `user_address` longtext COLLATE utf8mb4_unicode_ci,
  `user_postcode` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `user_occupation` varchar(250) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `user_contract` bigint(10) DEFAULT NULL,
  `user_manager` varchar(256) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `user_date` bigint(10) DEFAULT NULL,
  `victim_name` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `victim_address` longtext COLLATE utf8mb4_unicode_ci,
  `victim_postcode` varchar(20) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `victim_occupation` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `accident_report_number` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `accident_date` bigint(10) DEFAULT NULL,
  `accident_time` varchar(20) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `accident_place` longtext COLLATE utf8mb4_unicode_ci,
  `accident_reason` longtext COLLATE utf8mb4_unicode_ci,
  `accident_detail` longtext COLLATE utf8mb4_unicode_ci,
  `accident_witnesses` varchar(20) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `witnesses_name` text COLLATE utf8mb4_unicode_ci,
  `witnesses_address` longtext COLLATE utf8mb4_unicode_ci,
  `witnesses_phone_number` text COLLATE utf8mb4_unicode_ci,
  `witnesses_report_date` bigint(10) DEFAULT NULL,
  `witnesses_report_details` longtext COLLATE utf8mb4_unicode_ci,
  `witnesses_report_diagram` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `photo_1` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `photo_2` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `photo_3` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `photo_4` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `photo_5` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `photo_6` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `mgt_review_report_date` bigint(10) DEFAULT NULL,
  `mgt_review_status` bigint(10) DEFAULT NULL,
  `mgt_review_comments` longtext COLLATE utf8mb4_unicode_ci,
  `s_mgt_rpt_name` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `s_mgt_rpt_report_date` bigint(10) DEFAULT NULL,
  `s_mgt_rpt_comments` longtext COLLATE utf8mb4_unicode_ci,
  `s_mgt_rpt_f_action` bigint(10) DEFAULT NULL,
  `s_mgt_rpt_f_a_comment` longtext COLLATE utf8mb4_unicode_ci,
  `s_mgt_rpt_a_b_completed` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `s_mgt_rpt_a_b_cpt_date` bigint(10) DEFAULT NULL,
  `s_mgt_rpt_2508_completed` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `s_mgt_rpt_2508_cpt_date` bigint(10) DEFAULT NULL,
  `s_mgt_rpt_riddor_event_clf` bigint(10) DEFAULT NULL,
  `s_mgt_rpt_reported_en_a` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `s_mgt_rpt_reported_en_a_date` bigint(10) DEFAULT NULL,
  `s_mgt_rpt_sr_mgr_notified` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `s_mgt_rpt_sr_mgr_notified_date` bigint(10) DEFAULT NULL,
  `s_mgt_rpt_in_br_informed` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `s_mgt_rpt_in_br_informed_date` bigint(10) DEFAULT NULL,
  `s_mgt_rpt_ant_closed_off` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `s_mgt_rpt_ant_closed_off_date` bigint(10) DEFAULT NULL,
  `submitter_to_manager` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT 'No',
  `manager_id` bigint(10) DEFAULT NULL,
  `accident_category` bigint(10) DEFAULT NULL,
  `accident_treatment` longtext COLLATE utf8mb4_unicode_ci,
  `minor_injuries` longtext COLLATE utf8mb4_unicode_ci,
  `accident_additional_details` varchar(20) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `additional_details` longtext COLLATE utf8mb4_unicode_ci,
  `root_cause` longtext COLLATE utf8mb4_unicode_ci,
  `immediate_action` longtext COLLATE utf8mb4_unicode_ci,
  `further_action_required` longtext COLLATE utf8mb4_unicode_ci,
  `lost_time` longtext COLLATE utf8mb4_unicode_ci,
  `lost_time_days` longtext COLLATE utf8mb4_unicode_ci,
  `riddor_subcategory` bigint(10) DEFAULT NULL,
  `senior_manager_id` bigint(10) DEFAULT NULL,
  `read_only` tinyint(4) NOT NULL DEFAULT '0' COMMENT '1=read only to make read only view for manager part',
  `submitted_from` varchar(50) COLLATE utf8mb4_unicode_ci DEFAULT 'web',
  `created_at` bigint(10) DEFAULT NULL,
  `updated_at` bigint(10) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci COMMENT='Accident Report Table' ROW_FORMAT=COMPRESSED;


-- --------------------------------------------------------

--
-- Table structure for table `mdl_email_notification_on_high_h_s_report_volumes`
--

CREATE TABLE `mdl_email_notification_on_high_h_s_report_volumes` (
  `id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `act_of_physical_violence_status` tinyint(4) NOT NULL DEFAULT '0',
  `act_of_physical_violence` int(11) NOT NULL DEFAULT '0',
  `cuts_and_lacerations_status` tinyint(4) NOT NULL DEFAULT '0',
  `cuts_and_lacerations` int(11) NOT NULL DEFAULT '0',
  `falls_from_height_status` tinyint(4) NOT NULL DEFAULT '0',
  `falls_from_height` int(11) NOT NULL DEFAULT '0',
  `manual_handling_status` tinyint(4) NOT NULL DEFAULT '0',
  `manual_handling` int(11) NOT NULL DEFAULT '0',
  `needlestick_injuries_status` tinyint(4) NOT NULL DEFAULT '0',
  `needlestick_injuries` int(11) NOT NULL DEFAULT '0',
  `slips_trips_and_falls_on_same_level_status` tinyint(4) NOT NULL DEFAULT '0',
  `slips_trips_and_falls_on_same_level` int(11) NOT NULL DEFAULT '0',
  `struck_by_an_object_status` tinyint(4) NOT NULL DEFAULT '0',
  `struck_by_an_object` int(11) NOT NULL DEFAULT '0',
  `animals_status` tinyint(4) NOT NULL DEFAULT '0',
  `animals` int(11) NOT NULL DEFAULT '0',
  `equipment_issues_status` tinyint(4) NOT NULL DEFAULT '0',
  `equipment_issues` int(11) NOT NULL DEFAULT '0',
  `gas_detection_status` tinyint(4) NOT NULL DEFAULT '0',
  `gas_detection` int(11) NOT NULL DEFAULT '0',
  `needle_glass_status` tinyint(4) NOT NULL DEFAULT '0',
  `needle_glass` int(11) NOT NULL DEFAULT '0',
  `slips_trips_and_falls_status` tinyint(4) NOT NULL DEFAULT '0',
  `slips_trips_and_falls` int(11) NOT NULL DEFAULT '0',
  `traffic_vehicle_status` tinyint(4) NOT NULL DEFAULT '0',
  `traffic_vehicle` int(11) NOT NULL DEFAULT '0',
  `vegetation_status` tinyint(4) NOT NULL DEFAULT '0',
  `vegetation` int(11) NOT NULL DEFAULT '0',
  `vehicle_collision_status` tinyint(4) NOT NULL DEFAULT '0',
  `vehicle_collision` int(11) NOT NULL DEFAULT '0',
  `vehicle_near_miss_status` tinyint(4) NOT NULL DEFAULT '0',
  `vehicle_near_miss` int(11) NOT NULL DEFAULT '0',
  `vehicle_theft_status` tinyint(4) NOT NULL DEFAULT '0',
  `vehicle_theft` int(11) NOT NULL DEFAULT '0',
  `vehicle_vandalism_status` tinyint(4) NOT NULL DEFAULT '0',
  `vehicle_vandalism` int(11) NOT NULL DEFAULT '0',
  `vehicle_general_damage_status` tinyint(4) NOT NULL DEFAULT '0',
  `vehicle_general_damage` int(11) NOT NULL DEFAULT '0',
  `equipment_loss_status` tinyint(4) NOT NULL DEFAULT '0',
  `equipment_loss` int(11) NOT NULL DEFAULT '0',
  `equipment_theft_status` tinyint(4) NOT NULL DEFAULT '0',
  `equipment_theft` int(11) NOT NULL DEFAULT '0',
  `equipment_wear_and_tear_status` tinyint(4) NOT NULL DEFAULT '0',
  `equipment_wear_and_tear` int(11) NOT NULL DEFAULT '0',
  `environmental_flooding_internal_status` tinyint(4) NOT NULL DEFAULT '0',
  `environmental_flooding_internal` int(11) NOT NULL DEFAULT '0',
  `environmental_flooding_external_status` tinyint(4) NOT NULL DEFAULT '0',
  `environmental_flooding_external` int(11) NOT NULL DEFAULT '0',
  `environmental_contamination_status` tinyint(4) NOT NULL DEFAULT '0',
  `environmental_contamination` int(11) NOT NULL DEFAULT '0',
  `environmental_fly_tipping_status` tinyint(4) NOT NULL DEFAULT '0',
  `environmental_fly_tipping` int(11) NOT NULL DEFAULT '0',
  `attack_abusive_verbal_status` tinyint(4) NOT NULL DEFAULT '0',
  `attack_abusive_verbal` int(11) NOT NULL DEFAULT '0',
  `attack_animal_attack_status` tinyint(4) NOT NULL DEFAULT '0',
  `attack_animal_attack` int(11) NOT NULL DEFAULT '0',
  `created_at` int(11) NOT NULL DEFAULT '0',
  `updated_at` int(11) NOT NULL DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;


-- --------------------------------------------------------

--
-- Table structure for table `mdl_high_hs_report_send_notification`
--

CREATE TABLE `mdl_high_hs_report_send_notification` (
  `id` int(11) NOT NULL,
  `volume_name` varchar(512) COLLATE utf8mb4_unicode_ci NOT NULL,
  `volume_id` int(11) NOT NULL,
  `month` int(11) NOT NULL,
  `year` int(11) NOT NULL,
  `send_notification` enum('Yes','No') COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'No'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `mdl_h_s_manager_standing_table`
--

CREATE TABLE `mdl_h_s_manager_standing_table` (
  `id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `mdl_incident_report`
--

CREATE TABLE `mdl_incident_report` (
  `id` bigint(10) NOT NULL,
  `user_id` bigint(10) NOT NULL,
  `report_number` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT '',
  `name` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT '',
  `i_date` bigint(10) DEFAULT NULL,
  `contact` bigint(10) DEFAULT NULL,
  `manager` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `i_time` varchar(10) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `day_night` varchar(10) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `location` longtext COLLATE utf8mb4_unicode_ci,
  `lone_worker` varchar(10) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `what_observe` longtext COLLATE utf8mb4_unicode_ci,
  `photo_1` longtext COLLATE utf8mb4_unicode_ci,
  `photo_2` longtext COLLATE utf8mb4_unicode_ci,
  `photo_3` longtext COLLATE utf8mb4_unicode_ci,
  `photo_4` longtext COLLATE utf8mb4_unicode_ci,
  `photo_5` longtext COLLATE utf8mb4_unicode_ci,
  `photo_6` longtext COLLATE utf8mb4_unicode_ci,
  `action_taken` longtext COLLATE utf8mb4_unicode_ci,
  `what_could_happened` longtext COLLATE utf8mb4_unicode_ci,
  `report_category` bigint(10) DEFAULT NULL,
  `classification` bigint(10) DEFAULT NULL,
  `categorisation` bigint(10) DEFAULT NULL,
  `vehicles` bigint(10) DEFAULT NULL,
  `equipment` bigint(10) DEFAULT NULL,
  `environmental` bigint(10) DEFAULT NULL,
  `attack` bigint(10) DEFAULT NULL,
  `further_action` longtext COLLATE utf8mb4_unicode_ci,
  `report_to_client` varchar(20) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `report_priority` bigint(10) DEFAULT NULL,
  `contact_details` text COLLATE utf8mb4_unicode_ci,
  `meeting_date` bigint(10) DEFAULT NULL,
  `added_to_rvt_calm_system` bigint(10) DEFAULT NULL,
  `submitter_to_manager` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT 'No',
  `manager_id` bigint(10) DEFAULT NULL,
  `change_required` varchar(40) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `details_change_required` longtext COLLATE utf8mb4_unicode_ci,
  `is_correct_report_category` varchar(20) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `correct_report_category` bigint(10) DEFAULT NULL,
  `report_closed` varchar(20) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `lost_time` longtext COLLATE utf8mb4_unicode_ci,
  `lost_time_days` longtext COLLATE utf8mb4_unicode_ci,
  `compliance_id` bigint(10) DEFAULT NULL,
  `read_only` tinyint(4) NOT NULL DEFAULT '0' COMMENT '1=read only to make read only view for manager part',
  `submitted_from` varchar(50) COLLATE utf8mb4_unicode_ci DEFAULT 'web',
  `created_at` bigint(10) DEFAULT NULL,
  `updated_at` bigint(10) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci COMMENT='Incident Report Table' ROW_FORMAT=COMPRESSED;

-- --------------------------------------------------------

--
-- Table structure for table `mdl_report_download_history`
--

CREATE TABLE `mdl_report_download_history` (
  `id` int(11) NOT NULL,
  `report_id` int(11) DEFAULT NULL,
  `user_id` int(11) DEFAULT NULL,
  `download_at` bigint(20) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `mdl_report_table`
--

CREATE TABLE `mdl_report_table` (
  `id` bigint(10) NOT NULL,
  `name` varchar(150) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT ''
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci COMMENT='Report Table' ROW_FORMAT=COMPRESSED;

--
-- Dumping data for table `mdl_report_table`
--

INSERT INTO `mdl_report_table` (`id`, `name`) VALUES
(1, 'Accident Analysis'),
(2, 'Incident Analysis');

-- --------------------------------------------------------

--
-- Table structure for table `mdl_report_table_emaildata`
--

CREATE TABLE `mdl_report_table_emaildata` (
  `id` bigint(10) NOT NULL,
  `firstname` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT '',
  `lastname` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT '',
  `email` varchar(150) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT '',
  `contact` bigint(11) NOT NULL DEFAULT '0'
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
-- Table structure for table `mdl_standing_table`
--

CREATE TABLE `mdl_standing_table` (
  `id` bigint(10) NOT NULL,
  `report_id` bigint(10) NOT NULL,
  `dropdown_name` varchar(150) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT '',
  `field_value` varchar(250) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `field_status` bigint(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci COMMENT='Standing Table' ROW_FORMAT=COMPRESSED;

--
-- Dumping data for table `mdl_standing_table`
--

INSERT INTO `mdl_standing_table` (`id`, `report_id`, `dropdown_name`, `field_value`, `field_status`) VALUES
(74, 1, 'category', 'Act of Physical Violence', 1),
(75, 1, 'category', 'Cuts and Lacerations', 1),
(76, 1, 'category', 'Falls from a Height', 1),
(77, 1, 'category', 'Manual Handling', 1),
(78, 1, 'category', 'Needlestick Injuries', 1),
(79, 1, 'category', 'Slips, Trips and Falls on same level', 1),
(80, 1, 'category', 'Struck by an Object', 1),
(123, 1, 'contract', 'Carnells', 1),
(92, 1, 'contract', 'MAG', 0),
(122, 1, 'contract', 'MAG', 1),
(135, 1, 'contract', 'N/A', 1),
(125, 1, 'contract', 'Other', 1),
(91, 1, 'contract', 'STW - PWP', 0),
(120, 1, 'contract', 'STW Waste Water – Pro-Active', 1),
(88, 1, 'contract', 'UU - Cyclical', 0),
(87, 1, 'contract', 'UU - NPA', 0),
(124, 1, 'contract', 'UU - Other', 1),
(119, 1, 'contract', 'UU Waste Water (Non-Core)', 1),
(89, 1, 'contract', 'YWS - CSO', 0),
(90, 1, 'contract', 'YWS - DG5', 0),
(121, 1, 'contract', 'YWS – Waste Water', 1),
(14, 1, 'further_action', 'Amended COSHH Terms', 1),
(12, 1, 'further_action', 'Amended procedure', 1),
(13, 1, 'further_action', 'Amended Risk Assessments', 1),
(15, 1, 'further_action', 'Other', 1),
(9, 1, 'further_action', 'Toolbox Talk', 1),
(11, 1, 'further_action', 'Training - Formal', 1),
(10, 1, 'further_action', 'Training - Internal', 1),
(5, 1, 'mgt_review_status', 'Contractor', 1),
(4, 1, 'mgt_review_status', 'Employee', 1),
(8, 1, 'mgt_review_status', 'Member of the Public', 1),
(6, 1, 'mgt_review_status', 'Sub-Contractor', 1),
(7, 1, 'mgt_review_status', 'Visitor', 1),
(21, 1, 'riddor_classification', 'Dangerous Occurrence', 1),
(16, 1, 'riddor_classification', 'Fatalities', 1),
(22, 1, 'riddor_classification', 'Gas Incidents', 1),
(19, 1, 'riddor_classification', 'Non Fatal Accidents to non workers', 1),
(20, 1, 'riddor_classification', 'Occupational Disease', 1),
(18, 1, 'riddor_classification', 'Over 7 Day Incapacity', 1),
(17, 1, 'riddor_classification', 'Specific Injuries', 1),
(95, 1, 'RIDDOR_subcategory', 'Amputation of an arm, hand. finger, thumb, leg, foot or toe', 1),
(98, 1, 'RIDDOR_subcategory', 'Any burn injury (including scalding)', 1),
(97, 1, 'RIDDOR_subcategory', 'Any crush injury to the head or torso, causing damage to the brain or internal organs', 1),
(99, 1, 'RIDDOR_subcategory', 'Any degree of scalping requiring hospital treatment', 1),
(96, 1, 'RIDDOR_subcategory', 'Any injury likely to lead to permanent loss of sight or reduction in sight in one or both eyes', 1),
(100, 1, 'RIDDOR_subcategory', 'Any loss of consciousness caused by head injury or asphyxia', 1),
(101, 1, 'RIDDOR_subcategory', 'Any other injury arising from working in an enclosed space', 1),
(107, 1, 'RIDDOR_subcategory', 'Any workplace - Biological agents', 1),
(109, 1, 'RIDDOR_subcategory', 'Any workplace - Breathing Apparatus', 1),
(111, 1, 'RIDDOR_subcategory', 'Any workplace - Collapse of scaffolding', 1),
(110, 1, 'RIDDOR_subcategory', 'Any workplace - Diving Operations', 1),
(105, 1, 'RIDDOR_subcategory', 'Any workplace - Electrical incidents causing explosion or fire', 1),
(106, 1, 'RIDDOR_subcategory', 'Any workplace - Explosives', 1),
(102, 1, 'RIDDOR_subcategory', 'Any workplace - Lifting Equipment', 1),
(104, 1, 'RIDDOR_subcategory', 'Any workplace - Overhead electric lines', 1),
(114, 1, 'RIDDOR_subcategory', 'Any workplace - Pipelines or pipeline works', 1),
(103, 1, 'RIDDOR_subcategory', 'Any workplace - Pressure Systems', 1),
(108, 1, 'RIDDOR_subcategory', 'Any workplace - Radiation generation or radiography', 1),
(112, 1, 'RIDDOR_subcategory', 'Any workplace - Train Collisions', 1),
(113, 1, 'RIDDOR_subcategory', 'Any workplace - Wells', 1),
(81, 1, 'RIDDOR_subcategory', 'Carpal Tunnel Syndrome', 1),
(82, 1, 'RIDDOR_subcategory', 'Cramp of the hand or forearm', 1),
(94, 1, 'RIDDOR_subcategory', 'Fractures, other than to fingers, thumbs and toes', 1),
(84, 1, 'RIDDOR_subcategory', 'Hand Arm Vibration Syndrome', 1),
(85, 1, 'RIDDOR_subcategory', 'Occupational asthma', 1),
(83, 1, 'RIDDOR_subcategory', 'Occupational dermatitis', 1),
(116, 1, 'RIDDOR_subcategory', 'Other locations - Explosion or fire', 1),
(118, 1, 'RIDDOR_subcategory', 'Other locations - Hazardous escapes of substances', 1),
(117, 1, 'RIDDOR_subcategory', 'Other locations - Release of flammable liquids or gases', 1),
(115, 1, 'RIDDOR_subcategory', 'Other locations - Structural Collapse', 1),
(86, 1, 'RIDDOR_subcategory', 'Tendonitis or tenosynovitis', 1),
(3, 1, 'yes_no', 'N/A', 1),
(2, 1, 'yes_no', 'No', 1),
(1, 1, 'yes_no', 'Yes', 1),
(72, 2, 'attack', 'Abusive/Verbal', 1),
(73, 2, 'attack', 'Animal Attack', 1),
(51, 2, 'calm_systems', 'AIMS - Additional Results', 1),
(54, 2, 'calm_systems', 'MAG', 1),
(133, 2, 'calm_systems', 'N/A', 1),
(53, 2, 'calm_systems', 'Sewer Viewer STW', 1),
(52, 2, 'calm_systems', 'Sewer Viewer UU', 1),
(55, 2, 'calm_systems', 'YSW', 1),
(46, 2, 'categorisation', 'Attack', 1),
(93, 2, 'categorisation', 'Customer Complaint', 1),
(134, 2, 'categorisation', 'Customer Complaint', 1),
(45, 2, 'categorisation', 'Environmental', 1),
(44, 2, 'categorisation', 'Equipment', 1),
(47, 2, 'categorisation', 'Other', 1),
(43, 2, 'categorisation', 'Vehicle', 1),
(32, 2, 'classification', 'Access Restriction', 1),
(33, 2, 'classification', 'Animals', 1),
(34, 2, 'classification', 'Asset Issues', 1),
(35, 2, 'classification', 'Equipment Issues', 1),
(36, 2, 'classification', 'Gas Detection', 1),
(37, 2, 'classification', 'Manhole Covers/Frame Issue', 1),
(38, 2, 'classification', 'Needles/Glass', 1),
(39, 2, 'classification', 'Other', 1),
(40, 2, 'classification', 'Slips, Trips and Falls', 1),
(41, 2, 'classification', 'Traffic/Vehicle', 1),
(42, 2, 'classification', 'Vegetation', 1),
(130, 2, 'contract', 'Carnells', 1),
(28, 2, 'contract', 'MAG', 0),
(129, 2, 'contract', 'MAG', 1),
(136, 2, 'contract', 'N/A', 1),
(132, 2, 'contract', 'Other', 1),
(27, 2, 'contract', 'STW - PWP', 0),
(127, 2, 'contract', 'STW Waste Water – Pro-Active', 1),
(24, 2, 'contract', 'UU - Cyclical', 0),
(23, 2, 'contract', 'UU - NPA', 0),
(131, 2, 'contract', 'UU - Other', 1),
(126, 2, 'contract', 'UU Waste Water (Non-Core)', 1),
(25, 2, 'contract', 'YWS - CSO', 0),
(26, 2, 'contract', 'YWS - DG5', 0),
(128, 2, 'contract', 'YWS – Waste Water', 1),
(67, 2, 'environment', 'Adverse Weather', 1),
(70, 2, 'environment', 'Contamination  ', 1),
(69, 2, 'environment', 'Flooding - External', 1),
(68, 2, 'environment', 'Flooding - Internal', 1),
(71, 2, 'environment', 'Fly Tipping', 1),
(64, 2, 'equipment', 'Loss', 1),
(65, 2, 'equipment', 'Theft', 1),
(66, 2, 'equipment', 'Wear and Tear', 1),
(30, 2, 'report_category', 'Hazard identification', 1),
(31, 2, 'report_category', 'Incident', 1),
(29, 2, 'report_category', 'Near Miss', 1),
(48, 2, 'report_priority', 'Immediately', 1),
(49, 2, 'report_priority', 'Monthly Review', 1),
(50, 2, 'report_priority', 'Quarterly', 1),
(59, 2, 'vehicle', 'Collision', 1),
(63, 2, 'vehicle', 'General Damage', 1),
(60, 2, 'vehicle', 'Near Miss', 1),
(61, 2, 'vehicle', 'Theft', 1),
(62, 2, 'vehicle', 'Vandalism', 1),
(58, 2, 'yes_no', 'N/A', 1),
(57, 2, 'yes_no', 'No', 1),
(56, 2, 'yes_no', 'Yes', 1);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `mdl_accident_report`
--
ALTER TABLE `mdl_accident_report`
  ADD PRIMARY KEY (`id`),
  ADD KEY `user_id` (`user_id`,`user_contract`,`user_date`,`accident_date`,`accident_witnesses`,`witnesses_report_date`,`mgt_review_report_date`,`mgt_review_status`,`s_mgt_rpt_report_date`,`s_mgt_rpt_f_action`),
  ADD KEY `s_mgt_rpt_a_b_completed` (`s_mgt_rpt_a_b_completed`,`s_mgt_rpt_a_b_cpt_date`,`s_mgt_rpt_2508_completed`,`s_mgt_rpt_2508_cpt_date`,`s_mgt_rpt_riddor_event_clf`,`s_mgt_rpt_reported_en_a`,`s_mgt_rpt_reported_en_a_date`,`s_mgt_rpt_in_br_informed`,`s_mgt_rpt_in_br_informed_date`),
  ADD KEY `s_mgt_rpt_ant_closed_off_date` (`s_mgt_rpt_ant_closed_off_date`,`submitter_to_manager`,`manager_id`,`accident_category`,`riddor_subcategory`,`senior_manager_id`,`read_only`,`created_at`),
  ADD KEY `submitted_from` (`submitted_from`);

--
-- Indexes for table `mdl_email_notification_on_high_h_s_report_volumes`
--
ALTER TABLE `mdl_email_notification_on_high_h_s_report_volumes`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `mdl_high_hs_report_send_notification`
--
ALTER TABLE `mdl_high_hs_report_send_notification`
  ADD PRIMARY KEY (`id`),
  ADD KEY `month` (`month`,`send_notification`),
  ADD KEY `volume_id` (`volume_id`);

--
-- Indexes for table `mdl_h_s_manager_standing_table`
--
ALTER TABLE `mdl_h_s_manager_standing_table`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `mdl_incident_report`
--
ALTER TABLE `mdl_incident_report`
  ADD PRIMARY KEY (`id`),
  ADD KEY `user_id` (`user_id`,`report_number`,`i_date`,`contact`,`manager`,`day_night`,`report_category`,`classification`,`categorisation`,`vehicles`),
  ADD KEY `equipment` (`equipment`,`environmental`,`attack`,`report_to_client`,`meeting_date`,`added_to_rvt_calm_system`,`submitter_to_manager`,`manager_id`,`is_correct_report_category`,`correct_report_category`),
  ADD KEY `report_closed` (`report_closed`,`compliance_id`,`read_only`,`created_at`,`updated_at`),
  ADD KEY `submitted_from` (`submitted_from`);

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
-- Indexes for table `mdl_standing_table`
--
ALTER TABLE `mdl_standing_table`
  ADD PRIMARY KEY (`id`),
  ADD KEY `report_id` (`report_id`,`dropdown_name`,`field_value`,`field_status`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `mdl_accident_report`
--
ALTER TABLE `mdl_accident_report`
  MODIFY `id` bigint(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=18;

--
-- AUTO_INCREMENT for table `mdl_email_notification_on_high_h_s_report_volumes`
--
ALTER TABLE `mdl_email_notification_on_high_h_s_report_volumes`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `mdl_high_hs_report_send_notification`
--
ALTER TABLE `mdl_high_hs_report_send_notification`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `mdl_h_s_manager_standing_table`
--
ALTER TABLE `mdl_h_s_manager_standing_table`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=22;

--
-- AUTO_INCREMENT for table `mdl_incident_report`
--
ALTER TABLE `mdl_incident_report`
  MODIFY `id` bigint(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=32;

--
-- AUTO_INCREMENT for table `mdl_report_download_history`
--
ALTER TABLE `mdl_report_download_history`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=30;

--
-- AUTO_INCREMENT for table `mdl_report_table`
--
ALTER TABLE `mdl_report_table`
  MODIFY `id` bigint(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `mdl_report_table_emaildata`
--
ALTER TABLE `mdl_report_table_emaildata`
  MODIFY `id` bigint(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=17;

--
-- AUTO_INCREMENT for table `mdl_standing_table`
--
ALTER TABLE `mdl_standing_table`
  MODIFY `id` bigint(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=137;
COMMIT;

--
-- Add extra columns to course table
--
ALTER TABLE `mdl_course` ADD `coursetype` INT NULL AFTER `cacherev`, ADD `client` VARCHAR(256) NULL AFTER `coursetype`, ADD `duedate` BIGINT NULL AFTER `client`;

--
-- Add column manager_id to user table
--
ALTER TABLE `mdl_user` ADD `manager_id` INT NULL DEFAULT NULL COMMENT 'manager Id of user' AFTER `alternatename`;



/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;


ALTER TABLE `mdl_course` ADD `send_notification` ENUM('Yes','No') NOT NULL DEFAULT 'No' AFTER `duedate`;
ALTER TABLE `mdl_course` ADD `cron_executed` ENUM('Yes','No') NOT NULL DEFAULT 'No' AFTER `send_notification`;


-- This is the Trigger

CREATE TRIGGER `course_table_update` BEFORE UPDATE ON `mdl_course`
 FOR EACH ROW BEGIN
           IF NEW.startdate > OLD.startdate THEN
               SET NEW.cron_executed = 'No';
           END IF;
           IF NEW.send_notification='No' THEN
               SET NEW.cron_executed = 'No';
           END IF;
END
