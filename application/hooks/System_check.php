<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class System_check {

	function createCISessions() {
		$file_path = APPPATH . 'config/database.php';
		if (file_exists($file_path)) {
			include $file_path;
		}
		$database = $db['default'];

		$connect = new mysqli($database['hostname'], $database['username'], $database['password']);
		if ($connect->connect_error) {
			echo "Connection failed: " . $connect->connect_error;
			echo "<br>hostname : " . $database['hostname'] . "<br>username : " . $database['username'] . "<br>password : " . $database['password'];die;
		}
		$selectDB = "USE " . $database['database'];
		if ($connect->query($selectDB) === TRUE) {
			echo "";
			// echo "<br>Database select successfully";
		} else {
			echo "";
			// echo "<br>Error creating database: " . $connect->error;
		}

		$createTable = "CREATE TABLE IF NOT EXISTS `ci_sessions` (
            `id` varchar(128) NOT NULL,
            `ip_address` varchar(45) NOT NULL,
            `timestamp` int(10) unsigned DEFAULT 0 NOT NULL,
            `data` blob NOT NULL,
            KEY `ci_sessions_timestamp` (`timestamp`)
        )";
		if ($connect->query($createTable) === TRUE) {
			echo "";
			// echo "<br>Table ci_sessions created successfully";
		} else {
			echo "";
			// echo "<br>Error creating table: " . $connect->error;
		}
		$connect->close();
	}

}