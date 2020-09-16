<?php

namespace App\Models;

use Core\IModel;
use Core\Model;

class User extends Model implements IModel
{
	public string $username;
}