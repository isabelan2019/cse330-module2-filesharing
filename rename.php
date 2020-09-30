<?php
session_start();
$username = $_SESSION['username'];
$filename = $_POST['file'];
$oldname=sprintf("/srv/fileshare_module/uploads/%s/%s", $username, $filename);
$newname = sprintf("/srv/fileshare_module/uploads/%s/%s", $username, $_POST['newName']);

//check if the old filename is valid (which it should be if it's in the list)
if( !preg_match('/^[\w_\.\-]+$/', $filename) ){
	echo htmlentities("Invalid old filename");
	exit;
}

//check if the new filename is valid
if( !preg_match('/^[\w_\.\-]+$/', $_POST['newName']) ){
	header("Location: failure.html");
	exit;
}

//check if the username is valid
if( !preg_match('/^[\w_\-]+$/', $username) ){
	echo htmlentities("Invalid username");
	exit;
}

//rename file
if(rename($oldname, $newname)){
	header("Location:success.html");
	exit;
}
else{
	header("Location:failure.html");
	exit;
};
?>