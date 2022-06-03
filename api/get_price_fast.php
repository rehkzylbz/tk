<?php

$answers = [
    [
        'price' => 4100,
        'period' => 7,
        'error' => '',
    ],
    [
        'price' => 2200,
        'period' => 2,
        'error' => '',
    ],
    [
        'price' => 0,
        'period' => 0,
        'error' => 'Не удалось найти перевозчика',
    ],
];
echo json_encode($answers[rand(0, 2)]);
