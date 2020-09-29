<?php
session_start();
$username= (string) $_SESSION['username'];
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="fileshare.css" type="text/css" rel="stylesheet" />
    <title>File Share</title>
</head>
<body>
    <h1> Welcome, <?php echo htmlentities("$username");?> ! </h1> <!--include username-->
    
    <h2> Your files </h2>

    <!--List files in user-file-->
    <?php
    $filepath=sprintf("/srv/fileshare_module/uploads/%s/", $username);
    $fileArray= scandir($filepath);
   // $fixedFileArray = array_diff($fileArray, array('.', '..'));
    
    echo "<ul>\n";
    for ($x=2; $x<count($fileArray); $x++){
        printf("\t<li>%s</li>\n",
        htmlentities($fileArray[$x])
        );

    //VIEW button appended that opens or downloads file in browser
        echo "<form action='view.php' method='POST'>
        <input type='hidden' name='file' value=$fileArray[$x]>
        <input type='submit' value='View File'>
        </form>";

    //DELETE button appended that removes the file
        echo "<form action='delete.php' method='POST'>
        <input type='hidden' name='file' value=$fileArray[$x]>
        <input type='submit' value='Delete'>
        </form>";

    //RENAME input allowing users to rename files
        echo "<form action='rename.php' method='POST'>
        <input type='hidden' name='file' value=$fileArray[$x]>
        <input type='text' name='newName'>
        <input type='submit' value='Rename'>
        </form>
        ";

    //SHARE button and input to share file with other users 
        echo "<form action='share.php' method='POST'>
        <input type='hidden' name='file' value=$fileArray[$x]>
        <input type='text' name='usershare'>
        <input type='submit' value='Share'>
        </form>
        ";
    }
    echo "</ul>\n";
    ?>

    <!--at the bottom in the center is upload button to upload a file-->
    <h2>Upload Files</h2>
    <p>Your files cannot contain any spaces, /, ^,$ </p>
    <form enctype="multipart/form-data" action="upload.php" method="POST">
        <p>
            <input type="hidden" name="MAX_FILE_SIZE" value="20000000" />
            <label for="uploadfile_input">Choose a file to upload:</label> 
            <input name="uploadedfile" type="file" id="uploadfile_input" />
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