
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

(1, 1, 'agent_involved', 'Any vehicle or associated equipment / machinery', 1),
(2, 1, 'agent_involved', 'Building services – not electrical', 1),
(3, 1, 'agent_involved', 'Building, structure or excavation / underground working', 1),
(4, 1, 'agent_involved', 'Carcinogen', 1),
(5, 1, 'agent_involved', 'Construction, shuttering or false work', 1),
(6, 1, 'agent_involved', 'Entertainment, sporting facilities or equipment', 1),
(7, 1, 'agent_involved', 'Floor, ground, stairs or any work surface', 1),
(8, 1, 'agent_involved', 'Gas, vapour, dust, fume or oxygen deficient atmosphere', 1),
(9, 1, 'agent_involved', 'Inclement weather conditions', 1),
(10, 1, 'agent_involved', 'Ladder, stepladder or scaffolding', 1),
(11, 1, 'agent_involved', 'Live animal', 1),
(12, 1, 'agent_involved', 'Machinery / Equipment for lifting and conveying', 1),
(13, 1, 'agent_involved', 'Material, substance or product being handled, used or stored', 1),
(14, 1, 'agent_involved', 'Other machinery', 1),
(15, 1, 'agent_involved', 'Pathogen or infected material', 1),
(16, 1, 'agent_involved', 'Portable power / hand too', 1),
(17, 1, 'agent_involved', 'Process plant, pipework or bulk storage', 1),
(18, 1, 'employment_status', 'Employee', 1),
(19, 1, 'employment_status', 'Member of the public', 1),
(20, 1, 'employment_status', 'Self-Employed', 1),
(21, 1, 'employment_status', 'Subcontractor', 1),
(22, 1, 'kind_of_occurrence', 'Contact with electricity or an electrical discharge', 1),
(23, 1, 'kind_of_occurrence', 'Contact with moving machinery or materials being machined.', 1),
(24, 1, 'kind_of_occurrence', 'Drowning or asphyxiation', 1),
(25, 1, 'kind_of_occurrence', 'Exposure to an explosion', 1),
(26, 1, 'kind_of_occurrence', 'Exposure to fire', 1),
(27, 1, 'kind_of_occurrence', 'Exposure to, or contact with a harmful substance', 1),
(28, 1, 'kind_of_occurrence', 'Fall from height', 1),
(29, 1, 'kind_of_occurrence', 'Injured whilst handling, lifting or carrying', 1),
(30, 1, 'kind_of_occurrence', 'Physically assaulted by a person', 1),
(31, 1, 'kind_of_occurrence', 'Physically assaulted by a person', 1),
(32, 1, 'kind_of_occurrence', 'Slip, trip or fall on same level.', 1),
(33, 1, 'kind_of_occurrence', 'Struck against something fixed or stationery', 1),
(34, 1, 'kind_of_occurrence', 'Struck by moving object (inc. flying or falling)', 1),
(35, 1, 'kind_of_occurrence', 'Struck by moving vehicle', 1),
(36, 1, 'kind_of_occurrence', 'Trapped by something collapsing or overturning', 1),
(37, 1, 'operative_at_now', 'Home', 1),
(38, 1, 'operative_at_now', 'Hospital', 1),
(39, 1, 'operative_at_now', 'Lodging', 1),
(40, 1, 'operative_at_now', 'Work', 1);

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


INSERT INTO `mdl_new_standing_table` (`id`, `report_id`, `dropdown_name`, `field_value`, `field_status`) VALUES (NULL, '1', 'incident_type', 'Report Only', '1');
INSERT INTO `mdl_new_standing_table` (`id`, `report_id`, `dropdown_name`, `field_value`, `field_status`) VALUES (NULL, '1', 'incident_type', 'Accident / Injury', '1');
INSERT INTO `mdl_new_standing_table` (`id`, `report_id`, `dropdown_name`, `field_value`, `field_status`) VALUES (NULL, '1', 'incident_type', 'Serious Injury', '1');
INSERT INTO `mdl_new_standing_table` (`id`, `report_id`, `dropdown_name`, `field_value`, `field_status`) VALUES (NULL, '1', 'incident_type', 'Other', '1');

INSERT INTO `mdl_new_standing_table` (`id`, `report_id`, `dropdown_name`, `field_value`, `field_status`) VALUES (NULL, '1', 'affecting', 'Employees', '1');
INSERT INTO `mdl_new_standing_table` (`id`, `report_id`, `dropdown_name`, `field_value`, `field_status`) VALUES (NULL, '1', 'affecting', 'Sub-Contractor(s)', '1');
INSERT INTO `mdl_new_standing_table` (`id`, `report_id`, `dropdown_name`, `field_value`, `field_status`) VALUES (NULL, '1', 'affecting', 'Client Employee(s', '1');
INSERT INTO `mdl_new_standing_table` (`id`, `report_id`, `dropdown_name`, `field_value`, `field_status`) VALUES (NULL, '1', 'affecting', 'Member(s) of the public', '1');
INSERT INTO `mdl_new_standing_table` (`id`, `report_id`, `dropdown_name`, `field_value`, `field_status`) VALUES (NULL, '1', 'affecting', 'Children', '1');
INSERT INTO `mdl_new_standing_table` (`id`, `report_id`, `dropdown_name`, `field_value`, `field_status`) VALUES (NULL, '1', 'affecting', 'Animals / Environmental', '1');

INSERT INTO `mdl_new_standing_table` (`id`, `report_id`, `dropdown_name`, `field_value`, `field_status`) VALUES (NULL, '1', 'compensation', 'Yes', '1');
INSERT INTO `mdl_new_standing_table` (`id`, `report_id`, `dropdown_name`, `field_value`, `field_status`) VALUES (NULL, '1', 'compensation', 'No', '1');

INSERT INTO `mdl_new_standing_table` (`id`, `report_id`, `dropdown_name`, `field_value`, `field_status`) VALUES (NULL, '1', 'contributors_incident', 'Improper Personal Protective Equipment', '1');
INSERT INTO `mdl_new_standing_table` (`id`, `report_id`, `dropdown_name`, `field_value`, `field_status`) VALUES (NULL, '1', 'contributors_incident', 'Faulty or Defective Equipment', '1');
INSERT INTO `mdl_new_standing_table` (`id`, `report_id`, `dropdown_name`, `field_value`, `field_status`) VALUES (NULL, '1', 'contributors_incident', 'Poor Housekeeping (trip/fall hazard)', '1');
INSERT INTO `mdl_new_standing_table` (`id`, `report_id`, `dropdown_name`, `field_value`, `field_status`) VALUES (NULL, '1', 'contributors_incident', 'Improper Machine Guarding', '1');
INSERT INTO `mdl_new_standing_table` (`id`, `report_id`, `dropdown_name`, `field_value`, `field_status`) VALUES (NULL, '1', 'contributors_incident', 'Hazardous Weather Conditions', '1');
INSERT INTO `mdl_new_standing_table` (`id`, `report_id`, `dropdown_name`, `field_value`, `field_status`) VALUES (NULL, '1', 'contributors_incident', 'Employee inexperience', '1');
INSERT INTO `mdl_new_standing_table` (`id`, `report_id`, `dropdown_name`, `field_value`, `field_status`) VALUES (NULL, '1', 'contributors_incident', 'Insufficient Safety Training', '1');
INSERT INTO `mdl_new_standing_table` (`id`, `report_id`, `dropdown_name`, `field_value`, `field_status`) VALUES (NULL, '1', 'contributors_incident', 'Not following procedure', '1');
INSERT INTO `mdl_new_standing_table` (`id`, `report_id`, `dropdown_name`, `field_value`, `field_status`) VALUES (NULL, '1', 'contributors_incident', 'Not performing routine task', '1');
INSERT INTO `mdl_new_standing_table` (`id`, `report_id`, `dropdown_name`, `field_value`, `field_status`) VALUES (NULL, '1', 'contributors_incident', 'Other', '1');

INSERT INTO `mdl_new_standing_table` (`id`, `report_id`, `dropdown_name`, `field_value`, `field_status`) VALUES (NULL, '1', 'recommended_actions', 'Safety Training', '1');
INSERT INTO `mdl_new_standing_table` (`id`, `report_id`, `dropdown_name`, `field_value`, `field_status`) VALUES (NULL, '1', 'recommended_actions', 'Service or Replace Faulty Equipment', '1');
INSERT INTO `mdl_new_standing_table` (`id`, `report_id`, `dropdown_name`, `field_value`, `field_status`) VALUES (NULL, '1', 'recommended_actions', 'Revise Safety Procedure for task', '1');
INSERT INTO `mdl_new_standing_table` (`id`, `report_id`, `dropdown_name`, `field_value`, `field_status`) VALUES (NULL, '1', 'recommended_actions', 'Provide additional PPE', '1');
INSERT INTO `mdl_new_standing_table` (`id`, `report_id`, `dropdown_name`, `field_value`, `field_status`) VALUES (NULL, '1', 'recommended_actions', 'Complete full job safety analysis', '1');
INSERT INTO `mdl_new_standing_table` (`id`, `report_id`, `dropdown_name`, `field_value`, `field_status`) VALUES (NULL, '1', 'recommended_actions', 'Employee compliance review', '1');
INSERT INTO `mdl_new_standing_table` (`id`, `report_id`, `dropdown_name`, `field_value`, `field_status`) VALUES (NULL, '1', 'recommended_actions', 'Other', '1');
