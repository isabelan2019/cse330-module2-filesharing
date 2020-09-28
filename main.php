<?php
session_start();
$username=$_SESSION['username'];
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>File Share</title>
</head>
<body>
    <h1> Welcome <?php echo "$username";?> ! </h1> <!--include username-->
    
    <h2> Your files </h2>
    <!--List files in user-file-->
    <?php
    $filepath=sprintf("/srv/fileshare_module/uploads/%s/", $username);
    $fileArray= scandir($filepath);
    $fixedFileArray = array_diff($fileArray, array('..', '.'));
    echo "<ul>\n";
    for ($x=0; $x<count($fixedFileArray); $x++){
        printf("\t<li>%s</li>\n",
        $fixedFileArray[$x+2]
        );
    //VIEW button appended that opens or downloads file in browser
        echo "<form action='view.php' method='GET'>
        <input type='submit' value='View File'>
        </form>";
    //DELETE button appended that removes the file
        echo "<form action='delete.php' method='GET'>
        <input type='submit' value='Delete'>
        </form>";
    }
    echo "</ul>\n";
    ?>

    <!--at the bottom in the center is upload button to upload a file-->
    <form enctype="multipart/form-data" action="upload.php" method="POST">
        <p>
            <input type="hidden" name="MAX_FILE_SIZE" value="20000000" />
            <label for="uploadfile_input">Choose a file to upload:</label> <input name="uploadedfile" type="file" id="uploadfile_input" />
        </p>
        <p>
            <input type="submit" value="Upload File" />
        </p>
    </form>
    <!--buttom destroy session and redirect to login page-->
    <form action="logout.php" method="GET">
        <input type="submit" value="Log Out">
    </form>
</body>
</html>