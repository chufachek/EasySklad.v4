<?php
$plans = [
    'Free' => [
        'companies' => 1,
        'warehouses' => 1,
        'products' => 50,
        'users' => 1,
        'turnover' => 300000,
        'price' => 0,
    ],
    'Trial' => [
        'companies' => 1,
        'warehouses' => 3,
        'products' => 300,
        'users' => 3,
        'turnover' => 3000000,
        'price' => 0,
        'trial_days' => 14,
    ],
    'Pro' => [
        'companies' => 1,
        'warehouses' => -1,
        'products' => 5000,
        'users' => 5,
        'turnover' => 30000000,
        'price' => 9900,
    ],
    'Max' => [
        'companies' => -1,
        'warehouses' => -1,
        'products' => -1,
        'users' => -1,
        'turnover' => -1,
        'price' => 19900,
    ],
];
