<?php

return [
    'permissions' => [
        'admin' => 'Керувати плагіном LibertyBans',
        'view' => 'Переглянути сторінку LibertyBans',
    ],

    'settings' => [
        'title' => 'Налаштування сторінки LibertyBans',

        'driver' => 'Провайдер',
        'host' => 'Адреса хоста',
        'database' => 'База даних',
        'username' => 'Користувач',
        'password' => 'Пароль',
        'perPage' => 'Записів на сторінці',
        'path' => 'Шлях',
        'pathHelp' => 'Це шлях, за яким буде доступна сторінка списку покарань LibertyBans, після базової URL-адреси вашого сайту. Наприклад, якщо ви встановите значення <code>libertybans</code>, сторінка буде доступна за адресою <code>:baseURL/libertybans</code>.',
    ],
];