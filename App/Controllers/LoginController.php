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
            $_SESSION['role'] = $resulat->role;

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


        $user = new User($results);
        $new_user = RepositoryManager::getRm()->getUserRepo()->create($user);
        if(isset($new_user->id)) {
            $_SESSION['username'] = $new_user->username;
            $_SESSION['role'] = $new_user->role;
            $_SESSION['id'] = $new_user->id;

            header('Location: /');
        }


    }

    public function logoutProcess():void
    {
        session_destroy();
        header('Location: /');
    }
}