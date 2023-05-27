<?php

return [
	'permissions' => [
		'admin' => 'Manage LibertyBans plugin',
		'view' => 'View LibertyBans page',
	],

	'settings' => [
		'title' => 'LibertyBans page settings',

		'driver' => 'Driver',
		'host' => 'Host',
		'database' => 'Database',
		'username' => 'Username',
		'password' => 'Password',
		'perPage' => 'Records per page',
		'path' => 'Path',
		'pathHelp' => 'This is the path from where the LibertyBans punishments list page will be accessible, after your website base URL. For example, if you set this to <code>libertybans</code>, the page will be accessible at <code>:baseURL/libertybans</code>.',
	],
];