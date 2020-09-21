<?php

namespace App\Models;


use Core\Model;

class Offer extends Model
{
	public string $title;
	public int $author_id;
	public string $chapo;
	public int $price;
	public string $date_creation;
	public int $standard_id;
	public string $cp;
	public string $picture;
	public string $type;
}