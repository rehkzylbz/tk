<?php

use Transports\Company;

function class_loader($classname) {
    $path = str_replace('\\', DIRECTORY_SEPARATOR, $classname);
    include_once $path . '.php';
}

spl_autoload_register('class_loader');

$answer = [
    'error' => '',
    'data' => [
    ]
];
$data_filters = [
    'from_point' => FILTER_SANITIZE_SPECIAL_CHARS,
    'to_point' => FILTER_SANITIZE_SPECIAL_CHARS,
    'client' => FILTER_SANITIZE_SPECIAL_CHARS,
    'weight' => [
        'filter' => FILTER_SANITIZE_NUMBER_FLOAT,
        'flags' => FILTER_FLAG_ALLOW_FRACTION
    ],
    'volume' => [
        'filter' => FILTER_SANITIZE_NUMBER_FLOAT,
        'flags' => FILTER_FLAG_ALLOW_FRACTION
    ],
    'company_name' => FILTER_SANITIZE_SPECIAL_CHARS
];
$data = filter_input_array(INPUT_POST, $data_filters);
$company_name = $data['company_name'];
$companies_config = parse_ini_file('config/companies.ini', true, INI_SCANNER_RAW);
if (!is_array($data)) {
    $answer['error'] = 'Отправленные данные пусты';
} elseif (!in_array($company_name, array_keys($companies_config))) {
    $answer['error'] = 'Выбрана неизвестная компания';
}
if ($answer['error'] !== '') {
    echo json_encode($answer);
    die();
}
$company = Company::build($company_name, $companies_config[$company_name]);
$answer['data'] = $company->get_price($data);
echo json_encode($answer);
