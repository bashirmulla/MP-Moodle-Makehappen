<?php
$tasks = array(
    array(
        'classname' => 'local_training_matrix\task\certificate_notification',
        'blocking' => 0,
        'minute' => '1',
        'hour' => '*',
        'day' => '*',
        'month' => '*',
        'dayofweek' => '*',
        'disabled' => 0
    ),
    array(
        'classname' => 'local_training_matrix\task\certificate_status',
        'blocking' => 0,
        'minute' => '1',
        'hour' => '*',
        'day' => '*',
        'month' => '*',
        'dayofweek' => '*',
        'disabled' => 0
    ),
    array(
        'classname' => 'local_training_matrix\task\certificate_notification_weekly',
        'blocking' => 0,
        'minute' => '1',
        'hour' => '*',
        'day' => '*',
        'month' => '*',
        'dayofweek' => '7',
        'disabled' => 0
    )
);
?>