<?php


use Core\View;

use \App\Controllers\CategoryController;
use \App\Controllers\PageController;
use \App\Controllers\UserController;

// Paramètres Base de données
define( 'DB_HOST', 'localhost' );
define( 'DB_NAME', 'welchome' );
define( 'DB_USER', 'root' );
define( 'DB_PASS', '' );

// Paramètres PDO
define( 'PDO_ENGINE', 'mysql' );
define( 'PDO_OPTIONS', [
	PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC
]);

// Chemins de fichiers
define( 'DS', DIRECTORY_SEPARATOR );
define( 'ROOT_PATH', dirname(__FILE__) . DS );

spl_autoload_register();

// Autoload des modules de "composer"
require_once 'vendor' . DS . 'autoload.php';


// Initialisation de phprouter
$router = new \MiladRahimi\PhpRouter\Router();

// le paramètre "controller" contient "\App\Controllers\PageController@index"
$router
	->get( '/', PageController::class . '@index' )
	->get( '/categories', CategoryController::class . '@index' )
	->get( '/users', UserController::class . '@index' )
	->get( '/users/{user_id}', UserController::class . '@show')
	->get( '/contact', PageController::class . '@contactFormDisplay')
	->post( '/contact', PageController::class . '@contactFormProcess');

// Démarrage du routeur
try {
	// Essai de lancement
	$router->dispatch();
}
// Si erreur 404
catch( \MiladRahimi\PhpRouter\Exceptions\RouteNotFoundException $exception )
{
	$view = new View( 'error-404' );
	$view->get404();
}
// Si erreur sur l'appel du controller
catch( \MiladRahimi\PhpRouter\Exceptions\InvalidControllerException $exception ) {
	echo 'InvalidControllerException';
}
