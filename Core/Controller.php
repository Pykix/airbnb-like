<?php

namespace Core;

use App\Repositories\RepositoryManager;

abstract class Controller
{
	protected RepositoryManager $rm;

	public function __construct()
	{
		$this->rm = RepositoryManager::getRm();
	}
}