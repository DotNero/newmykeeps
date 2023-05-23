<?php

return [
    'admin' => [
        'type' => 1,
        'children' => [
            'user_au',
            'studentSignup',
        ],
    ],
    'user_au' => [
        'type' => 1,
    ],
    'student' => [
        'type' => 1,
    ],
    'company' => [
        'type' => 1,
    ],
    'help' => [
        'type' => 1,
    ],
    'studentSignup' => [
        'type' => 2,
        'description' => 'Регистрация студента',
    ],
    'companySignup' => [
        'type' => 2,
        'description' => 'Создание компании',
    ],
];
