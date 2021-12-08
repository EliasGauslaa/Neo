<?php

include "inc/header.php";

echo "<h1>Last opp profilbilde</h1>";

$membersSelect = $conn->query("SELECT * FROM member");
    
/* Form submit? */
if (isset($_REQUEST['upload-send'])) {

    
    $_SERVER['SCRIPT_FILENAME'] . "<br>";
    $_FILES['upload-file']['name'] . "<br>";
    $_FILES['upload-file']['tmp_name'] . "<br>";
    $_FILES['upload-file']['type'] . "<br>";
    $_FILES['upload-file']['size'] . " bytes<br><br>";
    
    
    /* Define array for messages */
    $messages = array();
    
    /* File upload */
    if (is_uploaded_file($_FILES['upload-file']['tmp_name'])) {
        /* Collecting information about file */
        //print_r($_FILES);
        $filetype = $_FILES['upload-file']['type'];
        $filesize = $_FILES['upload-file']['size'];
        
        /* Configurations */
        $accepted_types = array("image/jpeg",
                               "image/png");
        $max_file_size = 2097152; // in bytes // = 2MB
        $directory = $_SERVER['DOCUMENT_ROOT'] . "/Neo/Neo/www/site/img/";

        /* No directory with that name */
        if(!file_exists($directory)) {
            if (!mkdir($directory, 0777, true)) {
                die("Cannot create directory..." . $directory);
            }
        }
        
        /* Constructing file name */
        $pos = strrpos($_FILES['upload-file']['type'], "/") +1;
        $suffix = substr($_FILES['upload-file']['type'], $pos);
        $filename = $_POST['member'] . '.' . $suffix; // the filename is based on what the user write in the input field followed by the filetype
        
        /* If the file already exists for some reason */
        
        while(file_exists($directory . $filename)){
            $filename = $_POST['name'] . '_(1).' . $suffix;
        }
        
        /* Errors? */
        if (!in_array($filetype, $accepted_types)) {
            $types = implode(", ", $accepted_types);
            $messages[] = "Feil filtype (bare " . $types . " aksepteres)";
        }
        if ($filesize > $max_file_size) {
            $messages[] = "Filen (" . round($filesize * pow(10, -6), 2) . " MB) er for stor (" . round($max_file_size * pow(10, -6), 2) . " MB)";
        }
        
        /* If everything is fine */
        if (count($messages) < 1) {
            /* Moving uploaded file to its new home */
            $filepath = $directory . $filename;
            $uploaded_file = move_uploaded_file($_FILES['upload-file']['tmp_name'], $filepath);
            
            if (!$uploaded_file) {
                $messages[] = "Dette bildet kan ikke lastes opp";
            } else {
                /* All is well */
                $messages[] = "Profilbildet ble lastet opp!";
            }
        }
    } else {
        $messages[] = "Ingen fil valgt";
    }

    /* Output messages to user */
    foreach($messages as $message) {
        echo $message . '<br>';
    }
}
?>
    <form method="POST" action="<?php echo $_SERVER['PHP_SELF']; ?>" enctype="multipart/form-data">
        <p>
            <label for="member">Velg medlem</label>
            <select name="member">
                <option></option>
                    <?php
                    while ($rows = $membersSelect->fetch_assoc()){
                        $member = $rows['firstName'] . " " . $rows['lastName'];
                        $ID = $rows['memberID'];
                        echo "<option value='$ID'>$member</option>";
                    }
                ?>  
            </select><br><br>
            <label for="upload-file">Velg fil</label>
            <input name="upload-file" type="file"><br>
        </p>
        <p>
            <button type="submit" name="upload-send">Last opp</button>
        </p>
    </form>

