<?php

namespace Core;

use \PDO;

class Database
{
	private static ?PDO $instance = null;

	private const DSN = PDO_ENGINE . ':dbname=' . DB_NAME . ';host=' . DB_HOST;

	public static function get(): PDO
	{
		if( is_null( self::$instance ) ) {
			self::$instance = new PDO( self::DSN, DB_USER, DB_PASS, PDO_OPTIONS );
		}

		return self::$instance;
	}

	private function __construct() { }
	private function __clone() { }
	private function __wakeup() { }
}