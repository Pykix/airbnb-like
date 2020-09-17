<?php

namespace App\Controllers;

use App\Models\User;
use App\Repositories\RepositoryManager;
use Core\Controller;
use Core\View;

use Zend\Diactoros\ServerRequest;

class LoginController extends Controller
{
	public function login(): void
	{
		$view = new View( 'login' );

		$view_data = [
			'html_title'	=> 'Welc-Home - Login',
			'html_h1'		=> 'connexion',

		];

		$view->render( $view_data );
	}


	public function loginProcess(ServerRequest $request): void
	{

		$results = $request->getParsedBody();
		$username = $results['username'];
		$password = $results['password'];
        $resulat = $this->rm->getUserRepo()->loginConnexion($password, $username);
        if($resulat) {
            $_SESSION['username'] = $resulat->username;
            var_dump($_SESSION['username']);
            header('Location: /');
        }

	}

	public function register():void
    {
        $view = new View('register');

        $view_data = [
            'html_title'	=> 'Welc-Home - Register',
            'html_h1'		=> 'Inscription',

        ];
        $view->render($view_data);
    }

    public function registerProcess(ServerRequest $request): void
    {

        $results = $request->getParsedBody();
        $username = $results['username'];
        $password = $results['password'];
        $email = $results['email'];

        $user = new User($results);
        $new_user = RepositoryManager::getRm()->getUserRepo()->create($user);
        var_dump($new_user);


    }

    public function logoutProcess():void
    {
        session_destroy();
        header('Location: /');
    }
}