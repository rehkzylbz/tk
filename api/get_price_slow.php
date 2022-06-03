<?php

$answers = [
    [
        'coefficient' => 10.5,
        'date' => '2022-06-05',
        'error' => '',
    ],
    [
        'coefficient' => 15.7,
        'date' => '2022-06-11',
        'error' => '',
    ],
    [
        'coefficient' => 0,
        'date' => '',
        'error' => 'Неверный ключ api',
    ],
];
echo json_encode($answers[rand(0, 2)]);
