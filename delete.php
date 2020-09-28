<?php 

session_start();

$filename = $_POST['file'];
$full_path = sprintf("/srv/fileshare_module/uploads/%s/%s", $username, $filename);

?>