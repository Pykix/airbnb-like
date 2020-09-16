<?php

namespace App\Repositories;

use App\Models\Post;
use Core\Repository;

class PostRepository extends Repository
{
	public function getTable(): string
	{
		return 'posts';
	}
	// CRUD
	// Read: Toute la liste
	public function findAll(): array
	{
		return $this->readAll( Post::class );
	}

	// Read: Un Post par son ID
	public function findById( int $id ): ?Post
	{
		return $this->readById( $id, Post::class );
	}
}