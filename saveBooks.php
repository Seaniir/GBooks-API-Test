<?php
	include_once 'db.php';

	$title = $_POST["key1"]; // Google ID
	$authors = $_POST["key2"]; // Google ID
	$img = $_POST["key3"]; // Google ID

	//check if Google ID already exits
	$stmt = $db->prepare("SELECT * FROM tbl_titles WHERE titles=:titles");
	$stmt->execute(array(':titles' => $title));

		$insert_user_query = $db->prepare("INSERT INTO tbl_titles(titles, authors, img) VALUES(:titles, :authors, :img)");
		$insert_user_query->execute(array(':titles' => $title, ':authors' => $authors, ':img' => $img));

		echo json_encode($_POST);
?>