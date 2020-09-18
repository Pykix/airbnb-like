<?php

namespace App\Models;


use Core\Model;

class User extends Model
{
	public string $username;
	public string $password;
	public string $email;
	public string $role;
}