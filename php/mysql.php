<?php

class Database {

	private static $connection;

	public static function connect($ip, $database, $username, $password) {

		try {
		    self::$connection = new PDO("mysql:host=$ip;dbname=$database;charset=utf8", $username, $password);
		}
		catch(PDOException $e)
		{
		    die("Failed to connect to database: " . $e->getMessage());
		}

	}

	public static function getConnection() { return self::$connection; }

}

//Nežinau, ar bandysite prisijungti prie duombazės, tačiau jeigu bandysit čia pateiksiu bšk info:
//(Duombazė priima tik lokalius prisijungimus, todėl naudokite /phpmyadmin)
//O .htaccess auth: username: l5rp password: isdabestserver.
Database::connect("localhost", "nfq", "nfq", "randomPassword");