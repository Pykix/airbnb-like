<?php

namespace App\Repositories;

use Core\Repository;
use App\Models\User;

class UserRepository extends Repository
{
	public function getTable(): string
	{
		return 'users';
	}

	// CRUD
	// Read: Toute la liste
	public function findAll(): array
	{
		return $this->readAll( User::class );
	}

	// Read: Un User par son ID
	public function findById( int $id ): ?User
	{
		return $this->readById( $id, User::class );
	}
}