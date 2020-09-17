<?php

namespace App\Repositories;

use Core\Database;

class RepositoryManager
{
	private static ?self $instance = null;

	private UserRepository $user_repo;
	public function getUserRepo(): UserRepository
	{
		return $this->user_repo;
	}

	private CategoryRepository $category_repo;
	public function getCategoryRepo(): CategoryRepository
	{
		return $this->category_repo;
	}

	private OfferRepository $offer_repo;
	public function getOfferRepo(): OfferRepository
	{
		return $this->offer_repo;
	}

	public static function getRm(): self
	{
		if( is_null( self::$instance ) ) {
			self::$instance = new self();
		}

		return self::$instance;
	}

	private function __construct()
	{
		$pdo = Database::get();

		$this->user_repo = new UserRepository( $pdo );
		$this->category_repo = new CategoryRepository( $pdo );
		$this->offer_repo = new OfferRepository( $pdo );
	}

	private function __clone() { }
	private function __wakeup() { }
}