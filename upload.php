<?php

session_start();

$filename = basename($_FILES['uploadedfile']['name']);

//filters file name
if( !preg_match('/^[\w_\.\-]+$/', $filename) ){
	header("Location:failure.html");
	exit;
}

//filters user name
$username = $_SESSION['username'];
if( !preg_match('/^[\w_\-]+$/', $username) ){
	echo htmlentities("Invalid username");
	exit;
}

$full_path = sprintf("/srv/fileshare_module/uploads/%s/%s", $username, $filename);

if( move_uploaded_file($_FILES['uploadedfile']['tmp_name'], $full_path) ){
	header("Location:success.html");
    exit;
}else{ 
	echo "Something went wrong. Go back and try again";
	exit; 
}

?>