<?php

namespace App\Models;


use Core\Model;

class Offer extends Model
{
	public string $title;
	public string $author_id;
	public string $chapo;
	public int $price;
	public string $date_creation;
	public string $equipment_id;
	public string $cp;
}