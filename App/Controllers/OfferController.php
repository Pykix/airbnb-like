<?php

namespace App\Controllers;

use App\Models\User;
use App\Repositories\RepositoryManager;
use Core\Controller;
use Core\View;

use Zend\Diactoros\ServerRequest;

class OfferController extends Controller
{
	public function show($id): void
	{

		$view = new View( 'detail' );

		$view_data = [
			'html_title'	=> 'Welc-Home - detail',
            'details' => $this->rm->getOfferRepo()->details($id),
            'equipment' => $this->rm->getEquipmentOfferRepo()->equipmentDetails($id)
		];

		$view->render( $view_data );
	}



}