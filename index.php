<?php


    use App\Controllers\OfferController;
    use Core\View;


    use \App\Controllers\HomeController;
    use \App\Controllers\UserController;
    use \App\Controllers\LoginController;

    // Paramètres Base de données
    define( 'DB_HOST', 'localhost' );
    define( 'DB_NAME', 'welchome' );
    define( 'DB_USER', 'root' );
    define( 'DB_PASS', '' );

    // Paramètres PDO
    define( 'PDO_ENGINE', 'mysql' );
    define( 'PDO_OPTIONS', [
        PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
        PDO::MYSQL_ATTR_INIT_COMMAND => 'SET NAMES utf8'
    ] );

    // Chemins de fichiers
    define( 'DS', DIRECTORY_SEPARATOR );
    define( 'ROOT_PATH', dirname( __FILE__ ) . DS );
    define('ASSET_PATH', 'http://local.welchome.net' . DS . 'App' . DS . 'assets' . DS);
    define('IMG_PATH', 'http://local.welchome.net' . DS . 'App' . DS . 'assets' . DS . 'img' . DS);

    spl_autoload_register();
    session_start();
    // Autoload des modules de "composer"
    require_once 'vendor' . DS . 'autoload.php';


    // Initialisation de phprouter
    $router = new \MiladRahimi\PhpRouter\Router();

    // le paramètre "controller" contient "\App\Controllers\PageController@index"
    $router
        ->get( '/', HomeController::class . '@index' )
        ->get( '/login', LoginController::class . '@login' )
        ->post( '/login', LoginController::class . '@loginProcess' )
        ->get( '/register', LoginController::class . '@register' )
        ->post( '/register', LoginController::class . '@registerProcess' )
        ->get( '/logout', LoginController::class . '@logoutProcess' )
        ->get( '/detail/{id}', OfferController::class . '@show' );


    // Démarrage du routeur
    try {
        // Essai de lancement
        $router->dispatch();
    } // Si erreur 404
    catch (\MiladRahimi\PhpRouter\Exceptions\RouteNotFoundException $exception) {
        $view = new View( 'error-404' );
        $view->get404();
    } // Si erreur sur l'appel du controller
    catch (\MiladRahimi\PhpRouter\Exceptions\InvalidControllerException $exception) {
        echo 'InvalidControllerException';
    }
