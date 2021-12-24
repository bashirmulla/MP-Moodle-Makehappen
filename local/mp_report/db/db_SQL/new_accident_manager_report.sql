
DROP TABLE IF EXISTS `mdl_new_accident_manager_report`;
CREATE TABLE `mdl_new_accident_manager_report` (
  `id` int(11) NOT NULL,
  `new_accident_id` int(11) NOT NULL,
  `incident_type` int(11) DEFAULT NULL,
  `affecting` int(11) DEFAULT NULL,
  `compensation` int(11) DEFAULT NULL,
  `interviewee1_name` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `interviewee1_role` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `interviewee1_telephone` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `interviewee2_name` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `interviewee2_role` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `interviewee2_telephone` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `investigator_name` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `investigator_role` varchar(199) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `investigator_telephone` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `investigation_date` bigint(20) DEFAULT NULL,
  `incident_description` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `interviewee1_statement` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `interviewee2_statement` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `contributors_incident` int(11) DEFAULT NULL,
  `results_investigation` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `receive_medical_treatment` enum('Yes','No') COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `lost_time_report` enum('Yes','No') COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `recommended_actions` int(11) DEFAULT NULL,
  `specifice_corrective_actions` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `corrective_actions_completed` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `other_materials` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `user_id` int(11) DEFAULT NULL,
  `created_at` bigint(20) DEFAULT NULL,
  `updated_at` bigint(20) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

ALTER TABLE `mdl_new_accident_manager_report`
  ADD PRIMARY KEY (`id`);

ALTER TABLE `mdl_new_accident_manager_report`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
COMMIT;

