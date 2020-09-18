<?php

namespace App\Controllers;

use Core\Controller;
use Core\View;

class DetailController extends Controller
{
	public function detail(): void
	{
		$view = new View( 'detail' );

		$view_data = [
			'reservation' => $this->rm->getReservationRepo()->findById()
		];

		$view->render( $view_data );
	}

	public function lol(): void
	{
		echo 'LOL';
	}
}