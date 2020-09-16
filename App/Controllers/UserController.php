<?php

namespace App\Controllers;

use Core\Controller;
use Core\View;

class UserController extends Controller
{
	public function index(): void
	{
		$view = new View( 'user-list' );

		$view_data = [
			'html_title' => 'Liste des utilisateurs',
			'html_h1' => 'Les utilisateurs',
			'users' => $this->rm->getUserRepo()->findAll()
		];

		$view->render( $view_data );
	}

	public function show(int $user_id ): void
	{
		// On cherche en BDD
		$user = $this->rm->getUserRepo()->findById( $user_id );

		// Si non trouvé => 404
		if( is_null( $user ) ) {
			$view = new View( 'error-404' );
			$view->get404();
			return;
		}

		// L'user existe:
		$view = new View( 'user-details' );

		$view_data = [
			'user' => $this->rm->getUserRepo()->findById( $user_id )
		];

		$view->render( $view_data );
	}
}