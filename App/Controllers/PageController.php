<?php

namespace App\Controllers;

use Core\Controller;
use Core\View;

use Zend\Diactoros\ServerRequest;

class PageController extends Controller
{
	public function index(): void
	{
		$view = new View( 'home' );

		$view_data = [
			'html_title'	=> 'Mon Super site - accueil',
			'html_h1'		=> 'Bienvenue !',
			'latest_posts'	=> $this->rm->getPostRepo()->findAll()
		];

		$view->render( $view_data );
	}

	public function contactFormDisplay(): void
	{
		$view = new View( 'contact' );
		$view->render();
	}

	public function contactFormProcess(ServerRequest $request): void
	{
		echo 'Formulaire envoyé';
		var_dump($request->getParsedBody());
	}
}