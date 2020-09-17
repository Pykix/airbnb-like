<?php

namespace App\Controllers;

use Core\Controller;
use Core\View;

use Zend\Diactoros\ServerRequest;

class HomeController extends Controller
{
	public function index(): void
	{
		$view = new View( 'home' );

		$view_data = [
			'html_title'	=> 'Welc-Home - Annonces',
			'html_h1'		=> 'Les dernieres annnoces',
			'latest_offers'	=> $this->rm->getOfferRepo()->findAll()
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