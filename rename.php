<?php
session_start();
$username = $_SESSION['username'];
$filename = $_POST['file'];
$oldname=sprintf("/srv/fileshare_module/uploads/%s/%s", $username, $filename);
$newname = sprintf("/srv/fileshare_module/uploads/%s/%s", $username, $_POST['newName']);

if( !preg_match('/^[\w_\.\-]+$/', $filename) ){
	echo "Invalid filename";
	exit;
}

if( !preg_match('/^[\w_\-]+$/', $username) ){
	echo "Invalid username";
	exit;
}

if(rename($oldname, $newname)){
    echo "yay";
}
else{
    echo "nay";
};
?>