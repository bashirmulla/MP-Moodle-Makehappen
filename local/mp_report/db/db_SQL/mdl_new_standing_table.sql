
CREATE TABLE `mdl_new_standing_table` (
  `id` bigint(10) NOT NULL,
  `report_id` bigint(10) NOT NULL,
  `dropdown_name` varchar(150) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT '',
  `field_value` varchar(250) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `field_status` bigint(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci COMMENT='Standing Table' ROW_FORMAT=COMPRESSED;

--
-- Dumping data for table `mdl_new_standing_table`
--

INSERT INTO `mdl_new_standing_table` (`id`, `report_id`, `dropdown_name`, `field_value`, `field_status`) VALUES
(67, 1, 'affecting', 'Animals / Environmental', 1),
(66, 1, 'affecting', 'Children', 1),
(64, 1, 'affecting', 'Client Employee(s)', 1),
(62, 1, 'affecting', 'Employees', 1),
(65, 1, 'affecting', 'Member(s) of the public', 1),
(63, 1, 'affecting', 'Sub-Contractor(s)', 1),
(24, 1, 'agent_involved', 'Any vehicle or associated equipment / machinery', 1),
(23, 1, 'agent_involved', 'Building services – not electrical', 1),
(22, 1, 'agent_involved', 'Building, structure or excavation / underground working', 1),
(27, 1, 'agent_involved', 'Carcinogen', 1),
(30, 1, 'agent_involved', 'Construction, shuttering or false work', 1),
(19, 1, 'agent_involved', 'Entertainment, sporting facilities or equipment', 1),
(18, 1, 'agent_involved', 'Floor, ground, stairs or any work surface', 1),
(21, 1, 'agent_involved', 'Gas, vapour, dust, fume or oxygen deficient atmosphere', 1),
(31, 1, 'agent_involved', 'Inclement weather conditions', 1),
(26, 1, 'agent_involved', 'Ladder, stepladder or scaffolding', 1),
(29, 1, 'agent_involved', 'Live animal', 1),
(16, 1, 'agent_involved', 'Machinery / Equipment for lifting and conveying', 1),
(17, 1, 'agent_involved', 'Material, substance or product being handled, used or stored', 1),
(28, 1, 'agent_involved', 'Other machinery', 1),
(25, 1, 'agent_involved', 'Pathogen or infected material', 1),
(20, 1, 'agent_involved', 'Portable power / hand too', 1),
(32, 1, 'agent_involved', 'Process plant, pipework or bulk storage', 1),
(69, 1, 'compensation', 'No', 1),
(68, 1, 'compensation', 'Yes', 1),
(55, 1, 'employment_status', 'Employee', 1),
(57, 1, 'employment_status', 'Member of the public', 1),
(56, 1, 'employment_status', 'Self-Employed', 1),
(58, 1, 'employment_status', 'Subcontractor', 1),
(59, 1, 'incident_type', 'Accident / Injury', 1),
(61, 1, 'incident_type', 'Other', 1),
(60, 1, 'incident_type', 'Serious Injury', 1),
(8, 1, 'kind_of_occurrence', 'Contact with electricity or an electrical discharge', 1),
(1, 1, 'kind_of_occurrence', 'Contact with moving machinery or materials being machined.', 1),
(7, 1, 'kind_of_occurrence', 'Drowning or asphyxiation', 1),
(4, 1, 'kind_of_occurrence', 'Exposure to an explosion', 1),
(14, 1, 'kind_of_occurrence', 'Exposure to fire', 1),
(11, 1, 'kind_of_occurrence', 'Exposure to, or contact with a harmful substance', 1),
(10, 1, 'kind_of_occurrence', 'Fall from height', 1),
(2, 1, 'kind_of_occurrence', 'Injured whilst handling, lifting or carrying', 1),
(12, 1, 'kind_of_occurrence', 'Physically assaulted by a person', 1),
(15, 1, 'kind_of_occurrence', 'Physically assaulted by a person', 1),
(6, 1, 'kind_of_occurrence', 'Slip, trip or fall on same level.', 1),
(13, 1, 'kind_of_occurrence', 'Struck against something fixed or stationery', 1),
(5, 1, 'kind_of_occurrence', 'Struck by moving object (inc. flying or falling)', 1),
(9, 1, 'kind_of_occurrence', 'Struck by moving vehicle', 1),
(3, 1, 'kind_of_occurrence', 'Trapped by something collapsing or overturning', 1),
(51, 1, 'operative_at_now', 'Home', 1),
(52, 1, 'operative_at_now', 'Hospital', 1),
(53, 1, 'operative_at_now', 'Lodging', 1),
(54, 1, 'operative_at_now', 'Work', 1);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `mdl_new_standing_table`
--
ALTER TABLE `mdl_new_standing_table`
  ADD PRIMARY KEY (`id`),
  ADD KEY `report_id` (`report_id`,`dropdown_name`,`field_value`,`field_status`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `mdl_new_standing_table`
--
ALTER TABLE `mdl_new_standing_table`
  MODIFY `id` bigint(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=70;
COMMIT;
