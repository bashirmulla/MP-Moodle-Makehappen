
DROP TABLE IF EXISTS `mdl_new_accident_report`;
CREATE TABLE `mdl_new_accident_report` (
  `id` bigint(11) NOT NULL,
  `user_id` bigint(11) NOT NULL,
  `a_surname` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `a_forename` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `a_home_address` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `a_postcode` varchar(50) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `a_tel_no` int(11) DEFAULT NULL,
  `a_sex` varchar(10) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `a_age` int(11) DEFAULT NULL,
  `a_following_accident` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `a_resumed_work` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `a_hours` int(11) DEFAULT NULL,
  `a_mins` int(11) DEFAULT NULL,
  `a_temp_address` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `a_status` varchar(10) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `a_job_title` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `a_injury_condition` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `a_body_affected` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `a_employers_name` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `b_date` bigint(20) DEFAULT NULL,
  `b_name_address_site` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `b_exact_location_site` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `b_dangerous` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `b2_date` bigint(20) DEFAULT NULL,
  `b_injured` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `b_witness` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `b_witness_name` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `b_witness_address` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `b_tel_witness` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `c_kind_of_accident` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `c_metres` int(10) DEFAULT NULL,
  `d_agents` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `d2_agents` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `d_first_aid` varchar(5) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `e_accident_state` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `f_action_taken` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `declaration_name_of_person` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `declaration_date` bigint(20) DEFAULT NULL,
  `submitter_to_manager` varchar(10) COLLATE utf8mb4_unicode_ci DEFAULT 'No',
  `created_at` bigint(20) DEFAULT NULL,
  `updated_at` bigint(20) DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `mdl_new_accident_report`
--

INSERT INTO `mdl_new_accident_report` (`id`, `user_id`, `a_surname`, `a_forename`, `a_home_address`, `a_postcode`, `a_tel_no`, `a_sex`, `a_age`, `a_following_accident`, `a_resumed_work`, `a_hours`, `a_mins`, `a_temp_address`, `a_status`, `a_job_title`, `a_injury_condition`, `a_body_affected`, `a_employers_name`, `b_date`, `b_name_address_site`, `b_exact_location_site`, `b_dangerous`, `b2_date`, `b_injured`, `b_witness`, `b_witness_name`, `b_witness_address`, `b_tel_witness`, `c_kind_of_accident`, `c_metres`, `d_agents`, `d2_agents`, `d_first_aid`, `e_accident_state`, `f_action_taken`, `declaration_name_of_person`, `declaration_date`, `submitter_to_manager`, `created_at`, `updated_at`) VALUES
(1, 3, 'Happen1', 'Make', 'Gwgwg', 'Gwgwg', 21, 'Male', 12, '51', 'Yes', 11, 11, 'Gagwg', '55', 'Gagwg', 'Gwgw', 'Gwgw', 'Gwgw', 1640038080, 'Fwgw', 'Gwgw', 'Gwg2', 1640038080, 'Gwgw', 'Yes', 'Gwgwgs', 'Gwgwg', '64', 'Fall from height', 11, '22,27', 'Hwhw', 'Yes', 'Gwg', 'Gwg', 'Make Happen1', 1639958400, 'Yes', 1640039207, NULL),
(2, 3, 'Happen1', 'Make', 'Gwgwg', 'Gwgwg', 21, 'Male', 12, '51', 'Yes', 11, 11, 'Gagwg', '55', 'Gagwg', 'Gwgw', 'Gwgw', 'Gwgw', 1640038080, 'Fwgw', 'Gwgw', 'Gwg2', 1640038080, 'Gwgw', 'Yes', 'Gwgwgs', 'Gwgwg', '64', 'Struck against something fixed or stationery', 0, '22,27', 'Hwhw', 'Yes', 'Gwg', 'Gwg', 'Make Happen1', 1639958400, 'Yes', 1640039256, NULL),
(3, 3, 'Happen1', 'Make', 'Gwgwg', 'Gwgwg', 21, 'Male', 12, '51', 'Yes', 11, 11, 'Gagwg', '55', 'Gagwg', 'Gwgw', 'Gwgw', 'Gwgw', 1640038080, 'Fwgw', 'Gwgw', 'Gwg2', 1640038080, 'Gwgw', 'Yes', 'Gwgwgs', 'Gwgwg', '64', 'Fall from height', 12, '22,27', 'Hwhw', 'Yes', 'Gwg', 'Gwg', 'Make Happen1', 1639958400, 'Yes', 1640039291, NULL),
(4, 2, 'Admin', 'User', 'This is a Dest', 'sadf', 1714116624, 'Male', 222, '51', 'Yes', 33, 33, 'CDDL Humaira Palace, House: 310, Flat: 3B, Road: 03, Baitul Aman Housing, Adabor', '55', 'dfg', 'dsfg', 'dsfg', 'dfg', 1640248680, 'CDDL Humaira Palace, House: 310, Flat: 3B, Road: 03, Baitul Aman Housing, Adabor', 'sdfg', 'dsfg', 1640248680, 'dsfg', 'Yes', 'sdfg', 'dsfg', 'dsfg', '8,1,7', NULL, '24,23,22', NULL, 'Yes', 'sdfgsdf', 'dsfg', 'Admin User', 1640248680, 'Yes', NULL, NULL);


ALTER TABLE `mdl_new_accident_report`
  ADD PRIMARY KEY (`id`);

ALTER TABLE `mdl_new_accident_report`
  MODIFY `id` bigint(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;
COMMIT;
