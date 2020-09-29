<?php
session_start();

$_SESSION['newUser'] = (string) $_GET["newUser"];

$newUser = $_SESSION['newUser'];
if( !preg_match('/^[\w_\-]+$/', $_SESSION['newUser']) ){
	echo htmlentities("Invalid username. Try a username with no special characters.");
	exit;
} else {
$h = "/srv/fileshare_module/users.txt";
file_put_contents($h, $newUser, FILE_APPEND | LOCK_EX);
// fwrite($h, $newUser);
// fclose($h);
echo "done";
}a

?>