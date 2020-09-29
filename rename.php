<?php
session_start();
$username = $_SESSION['username'];
$filename = $_POST['file'];
$oldname=sprintf("/srv/fileshare_module/uploads/%s/%s", $username, $filename);
$newname = sprintf("/srv/fileshare_module/uploads/%s/%s", $username, $_POST['newName']);

if( !preg_match('/^[\w_\.\-]+$/', $filename) ){
	echo htmlentities("Invalid filename");
	exit;
}

if( !preg_match('/^[\w_\-]+$/', $username) ){
	echo htmlentities("Invalid username");
	exit;
}

if(rename($oldname, $newname)){
    echo htmlentities("yay");
}
else{
    echo htmlentities("nay");
};
?>