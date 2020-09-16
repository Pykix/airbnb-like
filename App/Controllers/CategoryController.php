<?php

namespace App\Controllers;

use Core\Controller;
use Core\View;

class CategoryController extends Controller
{
	public function index(): void
	{
		$view = new View( 'category-list' );

		$view_data = [
			'categories' => $this->rm->getCategoryRepo()->findAll()
		];

		$view->render( $view_data );
	}

	public function lol(): void
	{
		echo 'LOL';
	}
}