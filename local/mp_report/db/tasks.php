<?php
$tasks = array(
    array(
        'classname' => 'local_mp_report\task\calmsendemail',
        'blocking' => 0,
        'minute' => '1',
        'hour' => '*',
        'day' => '*',
        'month' => '*',
        'dayofweek' => '*',
        'disabled' => 0
    ),
    array(
        'classname' => 'local_mp_report\task\physical_toolbox_talk_notification',
        'blocking' => 0,
        'minute' => '1',
        'hour' => '*',
        'day' => '*/1',
        'month' => '*',
        'dayofweek' => '*',
        'disabled' => 0
    ),
    array(
        'classname' => 'local_mp_report\task\assigntoapi',
        'blocking' => 0,
        'minute' => '1',
        'hour' => '*',
        'day' => '*',
        'month' => '*',
        'dayofweek' => '*',
        'disabled' => 0
    ),
    array(
        'classname' => 'local_mp_report\task\high_h_and_s_notification',
        'blocking' => 0,
        'minute' => '1',
        'hour' => '*',
        'day' => '*/1',
        'month' => '*',
        'dayofweek' => '*',
        'disabled' => 0
    ),
    array(
        'classname' => 'local_mp_report\task\physical_toolbox_talk_regular_notification',
        'blocking' => 0,
        'minute' => '1',
        'hour' => '*',
        'day' => '*/1',
        'month' => '*',
        'dayofweek' => '*',
        'disabled' => 0
    ),
);
?>