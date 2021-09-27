<?php
if(isset($_POST['HU']) && !empty($_POST['HU']) && !empty($_POST['St']))
{

	include_once 'db.php';

	$id = clean_post($_POST['HU']); // Google ID
	$email = clean_post($_POST['St']); // Email ID
	$name = clean_post($_POST['Re']); // Name
	$profile_pic = clean_post($_POST['kK']); //Profile Pic URL

	//check if Google ID already exits
	$stmt = $db->prepare("SELECT * FROM tbl_users WHERE fld_user_email=:email");
	$stmt->execute(array(':email' => $email));
	$check_user = $stmt->fetchAll(PDO::FETCH_ASSOC);

	if(!$check_user)
	{
		//new user - we need to insert a record
		$time = time();
		$insert_user_query = $db->prepare("INSERT INTO tbl_users(fld_user_name,fld_user_email,fld_google_id,fld_user_img,fld_user_doj) VALUES(:name,:email,:google_id,:url,:doj)");
		$insert_user_query->execute(array(':name' => $name, ':email' => $email, ':google_id' => $id, ':url' => $profile_pic, ':doj' => $time));

		echo json_encode($_POST);
	} else{
		//update the user details
		$update_user_query = $db->prepare("UPDATE tbl_users SET fld_user_name=?, fld_user_email=? WHERE fld_user_email=?");
		$update_user_query->execute(array($name, $email, $email));

		echo json_encode($_POST);
	}
} else {
	$arr = array('error' => 1);
	echo json_encode($arr);
}
?>