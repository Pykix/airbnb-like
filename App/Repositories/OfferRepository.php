<?php

namespace App\Repositories;

use App\Models\Offer;
use Core\Repository;

class OfferRepository extends Repository
{
	public function getTable(): string
	{
		return 'offers';
	}
	// CRUD
	// Read: Toute la liste
	public function findAll(): array
	{
		return $this->readAll( Offer::class );
	}

	// Read: Un Post par son ID
	public function findById( int $id ): ?Offer
	{
		return $this->readById( $id, Offer::class );
	}
}