<?php
	include_once 'db.php';
	$name = $_COOKIE["toz"];
	$tbl = "tbl";
	$tbl .= $name;
	$table = "tbl_titles";
	$title = $_POST["key1"]; // Google ID
	$authors = $_POST["key2"]; // Google ID
	$img = $_POST["key3"]; // Google ID
	$isbn = $_POST["key4"]; // Google ID

	//check if Google ID already exits
	$stmt = $db->prepare("SELECT * FROM ".$tbl." WHERE titles=:titles");
	$stmt->execute(array(':titles' => $title));

		$insert_user_query = $db->prepare("INSERT INTO ".$tbl."(titles, authors, img, isbn) VALUES(:titles, :authors, :img, :isbn)");
		$insert_user_query->execute(array(':titles' => $title, ':authors' => $authors, ':img' => $img, ':isbn' => $isbn));

		echo json_encode($_POST);
?>