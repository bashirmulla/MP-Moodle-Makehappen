-- phpMyAdmin SQL Dump
-- version 5.1.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Dec 18, 2021 at 08:14 PM
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
-- Table structure for table `mdl_new_accident_report`
--

CREATE TABLE `mdl_new_accident_report` (
  `id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `a_surname` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `a_forename` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `a_home_address` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `a_postcode` varchar(50) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `a_tel_no` varchar(25) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `a_sex` enum('Male','Female') COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `a_age` int(11) DEFAULT NULL,
  `a_following_accident` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `a_resumed_work` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `a_hours` int(11) DEFAULT NULL,
  `a_mins` int(11) DEFAULT NULL,
  `a_temp_address` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `a_status` int(11) DEFAULT NULL,
  `a_job_title` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `a_injury_condition` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `a_body_affected` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `a_employers_name` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `b_date` bigint(20) DEFAULT NULL,
  `b_time` bigint(20) DEFAULT NULL,
  `b_name_address_site` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `b_exact_location_site` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `b_dangerous` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `b2_date` bigint(20) DEFAULT NULL,
  `b2_time` bigint(20) DEFAULT NULL,
  `b_injured` int(11) DEFAULT NULL,
  `b_witness` varchar(50) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `b_witness_name` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `b_witness_address` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `b_tel_witness` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `c_kind_of_accident` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
  `c_metres` int(100) DEFAULT NULL,
  `d_agents` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
  `d_first_aid` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
  `e_accident_state` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `f_action_taken` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `declaration_name_of_person` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
  `declaration_date` bigint(20) NOT NULL,
  `submitter_to_manager` varchar(10) COLLATE utf8mb4_unicode_ci DEFAULT 'No',
  `created_date` datetime NOT NULL,
  `updated_date` datetime NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `mdl_new_accident_report`
--

INSERT INTO `mdl_new_accident_report` (`id`, `user_id`, `a_surname`, `a_forename`, `a_home_address`, `a_postcode`, `a_tel_no`, `a_sex`, `a_age`, `a_following_accident`, `a_resumed_work`, `a_hours`, `a_mins`, `a_temp_address`, `a_status`, `a_job_title`, `a_injury_condition`, `a_body_affected`, `a_employers_name`, `b_date`, `b_time`, `b_name_address_site`, `b_exact_location_site`, `b_dangerous`, `b2_date`, `b2_time`, `b_injured`, `b_witness`, `b_witness_name`, `b_witness_address`, `b_tel_witness`, `c_kind_of_accident`, `c_metres`, `d_agents`, `d_first_aid`, `e_accident_state`, `f_action_taken`, `declaration_name_of_person`, `declaration_date`, `submitter_to_manager`, `created_date`, `updated_date`) VALUES
(1, 2, 'Admin', 'User', 'sadfasd', 'asdf', '01714116624', 'Male', 33, '51', 'No', 0, 0, 'CDDL Humaira Palace, House: 310, Flat: 3B, Road: 03, Baitul Aman Housing, Adabor', 55, 'sdf', 'sadf', 'sadf', 'sadfsad', 1639836420, NULL, 'CDDL Humaira Palace, House: 310, Flat: 3B, Road: 03, Baitul Aman Housing, Adabor', '23', '234', 1639836420, NULL, 234, 'Yes', '234', 'CDDL Humaira Palace, House: 310, Flat: 3B, Road: 03, Baitul Aman Housing, Adabor', '01714116624', '8,1,7,4,14,11', NULL, '31,26,29', 'Yes', 'sdfdfg', 'dsfgsdf', 'Admin User', 1639836420, 'Yes', '2021-12-18 00:00:00', '2021-12-18 00:00:00');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `mdl_new_accident_report`
--
ALTER TABLE `mdl_new_accident_report`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `mdl_new_accident_report`
--
ALTER TABLE `mdl_new_accident_report`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
