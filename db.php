<?php
// configuration
$dbhost 	= "localhost";
$dbname		= "google_login";
$dbuser		= "root";
$dbpass		= "";

// database connection
$db = new PDO("mysql:host=$dbhost;dbname=$dbname",$dbuser,$dbpass);

function clean_post($data)
{
	$data = trim(strip_tags($data));
	return $data;
}
?>