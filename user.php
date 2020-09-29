<?php 
session_start();

$_SESSION['username'] = (string) $_GET["username"];
$validUser = FALSE;

//read file line by line 
$h = fopen("/srv/fileshare_module/users.txt", "r");
while( !feof($h) ){
    if (trim(fgets($h))==$_SESSION['username']){
        $validUser = TRUE;
        break;
    } 
}
fclose($h);

if($validUser){
    header("Location:main.php");
    exit;
}
else{
    header("Location:login.html");
    exit;
}

?>