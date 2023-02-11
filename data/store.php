<?php

return [
    'app.name' => [
        'label' => 'Название сайта',
        'group' => 'app',
        'value' => 'Тюменская Генераторная Компания',
        'default' => null,
        'rules' => [
            [
                0 => 'value',
                1 => 'string',
                'min' => 2,
                'max' => 60,
            ],
            [
                'value',
                'required',
            ],
        ],
        'type' => 'string',
        'placeholder' => 'Сайт компании ООО "Рога и Копыта"',
        'hint' => 'Строка от 2 до 60 символов',
        'data' => [],
    ],
    'app.slogan' => [
        'label' => 'Слоган компании',
        'group' => 'app',
        'value' => '',
        'default' => null,
        'rules' => [
            [
                0 => 'value',
                1 => 'string',
                'min' => 4,
            ],
        ],
        'type' => 'text',
        'placeholder' => 'Быстрее, выше, сильнее!',
        'hint' => null,
        'data' => [],
    ],
    'app.robotEmail' => [
        'label' => 'Email робота рассыльного',
        'group' => 'app',
        'value' => 'corp@astgk.com',
        'default' => null,
        'rules' => [
            [
                'value',
                'required',
            ],
            [
                'value',
                'email',
            ],
        ],
        'type' => 'email',
        'placeholder' => 'robot@domian.com',
        'hint' => null,
        'data' => [],
    ],
    'app.supportEmail' => [
        'label' => 'Email техподдержки сайта',
        'group' => 'app',
        'value' => 'corp@astgk.com',
        'default' => null,
        'rules' => [
            [
                'value',
                'required',
            ],
            [
                'value',
                'email',
            ],
        ],
        'type' => 'email',
        'placeholder' => 'support@domian.com',
        'hint' => null,
        'data' => [],
    ],
    'app.adminEmail' => [
        'label' => 'Email администратора сайта',
        'group' => 'app',
        'value' => 'corp@astgk.com',
        'default' => null,
        'rules' => [
            [
                'value',
                'required',
            ],
            [
                'value',
                'email',
            ],
        ],
        'type' => 'email',
        'placeholder' => 'admin@domian.com',
        'hint' => null,
        'data' => [],
    ],
    'user.profile.fee' => [
        'label' => 'Базовая наценка на запчасти',
        'group' => 'user',
        'value' => '200',
        'default' => '50',
        'rules' => [
            [
                'value',
                'required',
            ],
            [
                0 => 'value',
                1 => 'integer',
                'min' => 0,
                'max' => 1000,
            ],
        ],
        'type' => 'numeric',
        'placeholder' => null,
        'hint' => 'Указжите % от 0 до 1000',
        'data' => [],
    ],
];
