<?php

return [
	'permissions' => [
		'admin' => 'Gérer le plugin LibertyBans',
		'view' => 'Voir la page LibertyBans',
	],

	'settings' => [
		'title' => 'Paramètres de la page LibertyBans',

		'driver' => 'Pilote',
		'host' => 'Hôte',
		'database' => 'Base de données',
		'username' => 'Nom d\'utilisateur',
		'password' => 'Mot de passe',
		'perPage' => 'Enregistrements par page',
		'path' => 'Chemin',
		'pathHelp' => 'Ceci est le chemin depuis lequel la page contenant la liste des sanctions LibertyBans sera accessible, après l\'URL de base de votre site web. Par exemple, si vous définissez ceci à <code>libertybans</code>, la page sera accessible à <code>:baseURL/libertybans</code>.',
	],
];