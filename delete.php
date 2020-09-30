<?php 

session_start();

$filename = $_POST['file'];
$username = $_SESSION['username'];

if( !preg_match('/^[\w_\.\-]+$/', $filename) ){
	echo "Invalid filename";
	exit;
}

$username = $_SESSION['username'];
if( !preg_match('/^[\w_\-]+$/', $username) ){
	echo "Invalid username";
	exit;
}

$full_path = sprintf("/srv/fileshare_module/uploads/%s/%s", $username, $filename);

if (unlink($full_path)) {
    header("Location:main.php");
    exit;
} else {
	echo "Something went wrong. Go back and try again";
	exit;
}

?> 