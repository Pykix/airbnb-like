<?php

namespace App\Repositories;

use App\Models\Category;
use Core\Repository;

class CategoryRepository extends Repository
{
	public function getTable(): string
	{
		return 'categories';
	}
	// CRUD
	// Read: Toute la liste
	public function findAll(): array
	{
		return $this->readAll( Category::class );
	}

	// Read: Une catégorie par son ID
	public function findById( int $id ): ?Category
	{
		return $this->readById( $id, Category::class );
	}
}