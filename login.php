

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login File Share</title>
</head>

<body>
    <h1> File Share</h1>
    <h2> Log in to manage your files</h2>
    <form name ="input" action="user.php" method="GET">
        <label> Username: </label>
        <input type="text" name="username">
        <input type="submit" value="Log In">
    </form>
</body>
</html>

<?php
// session_start();
// header("Location: user.php");
//$username = $_GET("username");
//echo "hello world ?";
?>
