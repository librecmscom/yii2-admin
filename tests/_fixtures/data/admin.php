<?php

$time = time();

return [
    'admin' => [
        'username' => 'user',
        'email' => 'user@example.com',
        'mobile' => '13800138000',
        'password_hash' => '$2y$13$qY.ImaYBppt66qez6B31QO92jc5DYVRzo5NxM1ivItkW74WsSG6Ui',
        'auth_key' => '39HU0m5lpjWtqstFVGFjj6lFb7UZDeRq',
        'status' => 1,
        'last_login_at' => $time,
        'created_at' => $time,
        'updated_at' => $time,

    ],
    'blocked' => [
        'username' => 'steven',
        'email' => 'steven@example.com',
        'mobile' => '13800138001',
        'password_hash' => '$2y$13$qY.ImaYBppt66qez6B31QO92jc5DYVRzo5NxM1ivItkW74WsSG6Ui',
        'auth_key' => 'TnXTrtLdj-YJBlG2A6jFHJreKgbsLYCa',
        'status' => 0,
        'last_login_at' => $time,
        'created_at' => $time,
        'updated_at' => $time,
    ],
];
