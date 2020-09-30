<?php
session_start();

$_SESSION['newUser'] = (string) $_GET["newUser"];

//check if the new username is valid
if( !preg_match('/^[\w_\-]+$/', $_SESSION['newUser']) ){
	header("Location:userfailure.html");
	exit;

} else {
	// adds user to users.txt 
	$h = "/srv/fileshare_module/users.txt";
	$newUser = $_SESSION['newUser']; 
	file_put_contents($h, $newUser, FILE_APPEND | LOCK_EX);
	$newline = "\n";
	file_put_contents($h, $newline, FILE_APPEND | LOCK_EX);

	//adds user folder
	$uploadFolder = sprintf("/srv/fileshare_module/uploads/%s", $newUser);
	mkdir($uploadFolder, 0777, true);
	header("Location:usersuccess.html");
}

?>