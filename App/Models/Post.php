<?php

namespace App\Models;

use Core\IModel;
use Core\Model;

class Post extends Model implements IModel
{
	public string $title;
	public string $author_name;
}