<?php

namespace App\Controllers;

use App\Models\User;
use App\Repositories\RepositoryManager;
use Core\Controller;
use Core\View;

use Zend\Diactoros\ServerRequest;

class LoginController extends Controller
{
    /**
     * Gestion de la connexion
     *
     * @param ServerRequest $request
     */
	public function loginProcess(ServerRequest $request): void
	{
		$results = $request->getParsedBody();

		$username = $results['username'];
		$password = $results['password'];

        $resulat = $this->rm->getUserRepo()->loginConnexion($password, $username);
        if($resulat) {
            $_SESSION['username'] = $resulat->username;
            $_SESSION['role'] = $resulat->role;
            $_SESSION['id'] = $resulat->id;

            header('Location: /');
        }

	}

    /**
     * Gestion de l'enregistrement d'user
     *
     * @param ServerRequest $request
     */
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


    /**
     * Gestion de la deconnection
     */
    public function logoutProcess():void
    {
        session_destroy();
        header('Location: /');
    }
}