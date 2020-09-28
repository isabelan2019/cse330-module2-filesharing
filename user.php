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

//$userarray = file("/srv/users.txt");
// users: username, user.name, test.user

//print_r($userarray);
//file_get_contents("/srv/users.txt","r");

//for ($i=0; $i<count($userarray); $i++) {
    
//    if ( $userarray[$i] === $username ) {
//        echo $userarray[$i];
//        echo "yay";
//    } else {
//        echo "boo";
//    }
//}

// if ( in_array($username, $userarray) ) {
//     header( "Location:main.html"); //should be specific to user, i.e. main.html/ .. 
// } else {
//     echo "you are not in the system. please return and try again.";
// }

?>