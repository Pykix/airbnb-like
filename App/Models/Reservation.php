<?php

namespace App\Models;


use Core\Model;

class Reservation extends Model
{
	public int $user_id;
	public int $offer_id;
	public $start_date;
	public $end_date;
}