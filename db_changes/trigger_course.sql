CREATE TRIGGER `course_table_update` BEFORE UPDATE ON `mdl_course`
FOR EACH ROW BEGIN
IF NEW.startdate > OLD.startdate THEN
SET NEW.cron_executed = 'No';
END IF;
IF NEW.send_notification='No' THEN
SET NEW.cron_executed = 'No';
END IF;
END