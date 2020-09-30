<?php
    session_start();
    $username= (string) $_SESSION['username'];
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="file.css" type="text/css" rel="stylesheet" />
    <title>File Share</title>
</head>
<body>
    <h1> Welcome, <?php echo htmlentities("$username");?> ! </h1>
    <!--LOG OUT button to log out and destroy session-->
    <div id="logout"> 
        <form action="logout.php" method="GET">
         Not you? <input id="logout" type="submit" value="Log Out">
        </form>
    </div>
    <p id="welcome"> Click on the buttons to view or delete your file. Rename your files by entering in a valid file name. 
        Valid file names cannot include spaces or special characters. 
        You can also enter in another valid username in the system to send files to them.
        Usernames are case sensitive. 
    <h2> Your files </h2>
    <div>
    <?php
   

    //LIST files in a user's directory
    $filepath=sprintf("/srv/fileshare_module/uploads/%s/", $username);
    $fileArray= scandir($filepath);
    
    echo "<ul>\n";

    //loops through array output of files in directory
    for ($x=2; $x<count($fileArray); $x++){
        printf("\t\t<li>%s",
        htmlentities($fileArray[$x])
        );

    //VIEW button appended that opens or downloads file in browser
        echo "\n\t\t\t<form action='view.php' method='POST'>
        \t\t<input type='hidden' name='file' value=$fileArray[$x]>
        \t\t<input type='submit' value='View File'>
        \t</form>";

    //DELETE button appended that removes the file
        echo "\n\t\t\t<form action='delete.php' method='POST'>
        \t\t<input type='hidden' name='file' value=$fileArray[$x]>
        \t\t<input type='submit' value='Delete'>
        \t</form>";

    //RENAME input allowing users to rename files
        echo "\n\t\t\t<form action='rename.php' method='POST'>
        \t\t<input type='hidden' name='file' value=$fileArray[$x]>
        \t\t<input type='text' name='newName'>
        \t\t<input type='submit' value='Rename'>
        \t</form>";

    //SHARE button and input to share file with other users 
        echo "\n\t\t\t<form action='share.php' method='POST'>
        \t\t<input type='hidden' name='file' value=$fileArray[$x]>
        \t\t<input type='text' name='usershare'>
        \t\t<input type='submit' value='Share'>
        \t</form>
        ";
        print("</li>\n");
    }
    echo "\t</ul>\n";
    ?>
    </div>

    <div>
    <!--UPLOAD button to upload files-->
    <h2>Upload Files</h2>
    <p>Your file name cannot contain any spaces or special characters. </p>
    <form enctype="multipart/form-data" action="upload.php" method="POST">
        <p>
            <input type="hidden" name="MAX_FILE_SIZE" value="20000000" />
            <label for="uploadfile_input">Choose file:</label>
            <input name="uploadedfile" type="file" id="uploadfile_input"/>
        </p>
        <p>
            <input id="uploadbutton" type="submit" value="Upload File" />
        </p>
    </form>
    </div>


    


</body>
</html>