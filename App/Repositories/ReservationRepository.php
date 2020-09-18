<?php

namespace App\Repositories;

use App\Models\Reservation;
use Core\Repository;

class ReservationRepository extends Repository
{
	public function getTable(): string
	{
		return 'reservation';
	}
	// CRUD
	// Read: Toute la liste
	public function findAll(): array
	{
		return $this->readAll( Reservation::class );
	}

	// Read: Une catégorie par son ID
	public function findById( int $id ): ?Reservation
	{
		return $this->readById( $id, Reservation::class );
	}
}