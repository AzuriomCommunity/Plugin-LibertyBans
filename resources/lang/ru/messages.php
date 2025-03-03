<?php

return [
	'permissions' => [
		'admin' => 'Управление плагином LibertyBans',
		'view' => 'Просмотр страницы LibertyBans',
	],

	'settings' => [
		'title' => 'Настройки страницы LibertyBans',

		'driver' => 'Драйвер',
		'host' => 'Хост',
		'database' => 'База данных',
		'username' => 'Имя пользователя',
		'password' => 'Пароль',
		'perPage' => 'Записей на страницу',
		'path' => 'Путь',
		'pathHelp' => 'Это путь, по которому будет доступна страница списка наказаний LibertyBans после базового URL вашего сайта. Например, если вы установите значение <code>libertybans</code>, страница будет доступна по адресу <code>:baseURL/libertybans</code>.',
	],
];
