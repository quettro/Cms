<?php

return [
    /**
     * Какие `Доступные разделы` можно выдать пользователю.
     */
    'SECTIONS' => [
        [
            'name' => 'Сайты', 'key' => 'SECTIONS.WEBSITES'
        ],
        [
            'name' => 'Блоки', 'key' => 'SECTIONS.BLOCKS'
        ],
        [
            'name' => 'Медиа', 'key' => 'SECTIONS.MEDIA'
        ],
        [
            'name' => 'Пользователи', 'key' => 'SECTIONS.USERS'
        ],
        [
            'name' => 'Данные', 'key' => 'SECTIONS.WEBDATA'
        ],
        [
            'name' => 'Формы', 'key' => 'SECTIONS.FORMS'
        ],
        [
            'name' => 'Языки', 'key' => 'SECTIONS.LANGUAGES'
        ],
        [
            'name' => 'Модули', 'key' => 'SECTIONS.MODULES'
        ],
    ],

    /**
     * Какие `Перечень возможностей` можно выдать пользователю.
     */
    'ACTIONS' => [
        [
            'name' => 'Просмотр', 'key' => 'ACTIONS.READ'
        ],
        [
            'name' => 'Создание', 'key' => 'ACTIONS.CREATE'
        ],
        [
            'name' => 'Редактирование', 'key' => 'ACTIONS.UPDATE'
        ],
        [
            'name' => 'Удаление', 'key' => 'ACTIONS.DELETE'
        ],
    ]
];
