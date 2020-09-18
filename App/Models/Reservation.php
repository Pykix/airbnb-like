<?php

namespace App\Models;


use Core\Model;

class Reservation extends Model
{
	public string $user_id;
	public string $offer_id;
	public string $start_date;
	public string $end_date;
}