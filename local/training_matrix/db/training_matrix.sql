
DROP TABLE IF EXISTS `mdl_certificate_types`;
CREATE TABLE `mdl_certificate_types` (
  `id` int(11) NOT NULL,
  `user_id` bigint(10) NOT NULL,
  `certificate_name` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT '',
  `certificate_expire` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT '',
  `number_of_months` int(10) NOT NULL DEFAULT 0,
  `sortorder` int(11) NOT NULL,
  `status` tinyint(4) NOT NULL DEFAULT 1,
  `created_at` int(10) DEFAULT NULL,
  `updated_at` int(10) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `mdl_certificate_types`
--

INSERT INTO `mdl_certificate_types` (`id`, `user_id`, `certificate_name`, `certificate_expire`, `number_of_months`, `sortorder`, `status`, `created_at`, `updated_at`) VALUES
(1, 2, 'Expired_2', 'Yes', 2, 1, 1, 1581080547, 1584504184),
(2, 2, 'No Expired', 'No', 0, 3, 1, 1581080570, 1594025608),
(3, 2, 'Expired_3', 'Yes', 3, 2, 1, 1584504234, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `mdl_managecertificates`
--

DROP TABLE IF EXISTS `mdl_managecertificates`;
CREATE TABLE `mdl_managecertificates` (
  `id` int(11) NOT NULL,
  `certificate_user_id` int(10) NOT NULL,
  `certificate_types_id` int(10) NOT NULL,
  `copy_of_certificate` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT '',
  `expiry_date` bigint(20) DEFAULT NULL,
  `attended_date` bigint(20) DEFAULT NULL,
  `update_status` tinyint(4) DEFAULT 0,
  `certificate_status` int(11) DEFAULT NULL,
  `user_id` int(10) DEFAULT NULL COMMENT 'user_id is for created by',
  `active` tinyint(4) NOT NULL DEFAULT 1,
  `created_at` int(10) DEFAULT NULL,
  `updated_at` int(10) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Table structure for table `mdl_managecertificates_status`
--

DROP TABLE IF EXISTS `mdl_managecertificates_status`;
CREATE TABLE `mdl_managecertificates_status` (
  `id` bigint(10) NOT NULL,
  `status_name` varchar(150) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT '',
  `flag` tinyint(4) NOT NULL DEFAULT 1 COMMENT '0,1 = all, 1 = certificate form'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `mdl_managecertificates_status`
--

INSERT INTO `mdl_managecertificates_status` (`id`, `status_name`, `flag`) VALUES
(1, 'Expiring', 0),
(2, 'Expired/Not Held', 0),
(3, 'Booked', 1),
(4, 'Awaiting Certificate', 1),
(5, 'No Action required', 0),
(6, 'N/A', 0),
(7, 'System Status', 1),
(8, 'Refresher Training not Required', 1),
(9, 'Refresher Training not Required', 1);

-- --------------------------------------------------------

--
-- Table structure for table `mdl_training_groups`
--

DROP TABLE IF EXISTS `mdl_training_groups`;
CREATE TABLE `mdl_training_groups` (
  `id` int(11) NOT NULL,
  `user_id` bigint(10) NOT NULL,
  `training_role_name` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT '',
  `required_certificates` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT '' COMMENT 'ids keep with concate',
  `status` tinyint(4) NOT NULL DEFAULT 1,
  `created_at` int(10) DEFAULT NULL,
  `updated_at` int(10) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `mdl_training_groups`
--

INSERT INTO `mdl_training_groups` (`id`, `user_id`, `training_role_name`, `required_certificates`, `status`, `created_at`, `updated_at`) VALUES
(1, 2, 'Test', '1,2', 1, 1579502044, 1615360201),
(2, 2, 'Test2', '3', 1, 1579503874, 1614833526);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `mdl_certificate_types`
--
ALTER TABLE `mdl_certificate_types`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `mdl_managecertificates`
--
ALTER TABLE `mdl_managecertificates`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `mdl_managecertificates_status`
--
ALTER TABLE `mdl_managecertificates_status`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `mdl_training_groups`
--
ALTER TABLE `mdl_training_groups`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `mdl_certificate_types`
--
ALTER TABLE `mdl_certificate_types`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `mdl_managecertificates`
--
ALTER TABLE `mdl_managecertificates`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=1162;

--
-- AUTO_INCREMENT for table `mdl_managecertificates_status`
--
ALTER TABLE `mdl_managecertificates_status`
  MODIFY `id` bigint(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT for table `mdl_training_groups`
--
ALTER TABLE `mdl_training_groups`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;
COMMIT;
