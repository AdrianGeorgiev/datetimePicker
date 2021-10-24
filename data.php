<?php
header('Content-type: application/json');
echo json_encode(
        array(
        'disabledDates' => array ('24.10.2021', '28.10.2021',  '29.10.2021'),
        'disableHours' => array(
            array(
                'date' => '30.10.2021',
                'hours' => ['9:00', '9:30'] 
            ),
            array(
                'date' => '1.11.2021',
                'hours' => ['10:30', '11:30', '12:00'] 
            ),
            array(
                'date' => '3.11.2021',
                'hours' => ['09:30','11:30', '12:30'] 
            ),
            array(
                'date' => '24.10.2021',
                'hours' => ['10:30', '11:30'] 
            )
        )
    )
);