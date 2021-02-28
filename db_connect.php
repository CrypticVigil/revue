<?php

$host = 'localhost';
$user = 'chad';
$pw = 'orionrigel';
$db = 'revue';

// create the connection
$conn = mysqli_connect($host, $user, $pw, $db);

// check the connection
if (!$conn) {
	die('Connection failed: ' . mysqli_connect_error());
}