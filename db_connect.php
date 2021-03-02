<?php

// variables for the connect function
$host = 'localhost';
$user = 'chad';
$pw = 'orionrigel';
$db = 'revue';

// open a new connection to the MySQL server
$conn = new mysqli($host, $user, $pw, $db);

// check the connection for errors
if ($conn -> connect_errno) {
	echo "Failed to connect to MySQL: " . $conn -> connect_error;
	exit();
}