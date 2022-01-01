DROP TABLE IF EXISTS `mdl_new_accident_report`;
CREATE TABLE `mdl_new_accident_report` (
  `id` bigint(11) NOT NULL,
  `user_id` bigint(11) NOT NULL,
  `a_surname` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `a_forename` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `a_home_address` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `a_postcode` varchar(50) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `a_tel_no` varchar(25) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `a_sex` varchar(10) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `a_age` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
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
  `c_metres` varchar(50) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `d_agents` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `d2_agents` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `d_first_aid` varchar(5) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `e_accident_state` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `f_action_taken` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `declaration_name_of_person` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `declaration_date` bigint(20) DEFAULT NULL,
  `submitter_to_manager` varchar(10) COLLATE utf8mb4_unicode_ci DEFAULT 'No',
  `confirmed_person_name` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `confirmed_date` bigint(20) DEFAULT NULL,
  `how_reported` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `approve_date` bigint(20) NOT NULL,
  `status` enum('Pending','Confirmed','Approved') COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'Pending',
  `created_at` bigint(20) DEFAULT NULL,
  `updated_at` bigint(20) DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

ALTER TABLE `mdl_new_accident_report`
  ADD PRIMARY KEY (`id`);

ALTER TABLE `mdl_new_accident_report`
  MODIFY `id` bigint(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=1;
COMMIT;
