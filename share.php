<?php
//users will enter the user they want to share a file with 
session_start();
$username = $_SESSION['username'];
$filename = $_POST['file'];
$shareuser = (string) $_POST['usershare'];
$validUser = FALSE;

//filters the sharing username
if( !preg_match('/^[\w_\-]+$/', $username) ){
	echo htmlentities("Invalid username");
	exit;
}

//filters the receiving username
if( !preg_match('/^[\w_\-]+$/', $shareuser) ){
	echo htmlentities("Invalid username");
	exit;
}

$file = sprintf("/srv/fileshare_module/uploads/%s/%s", $username, $filename);

//checks that the user receiving the shared file exists 
$h = fopen("/srv/fileshare_module/users.txt", "r");
while( !feof($h) ){
    if (trim(fgets($h))==$shareuser){
        $validUser = TRUE;
        break;
    } 
}
fclose($h);

if($validUser){
    //execute copy and move file
    $shareuserFolder = sprintf("/srv/fileshare_module/uploads/%s/%s", $shareuser, $filename);
    copy ($file, $shareuserFolder);
    //echo htmlentities("Your file has been shared.");
    header("Location:main.php");
    exit;
}
else{
    echo htmlentities("This user does not exist. Please try again with a valid username.");
    exit;
}

?>
