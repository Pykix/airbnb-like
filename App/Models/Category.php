<?php

namespace App\Models;

use Core\IModel;
use Core\Model;

class Category extends Model implements IModel
{
	public string $label;
}