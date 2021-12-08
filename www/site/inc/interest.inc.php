<?php

include_once "config.php";


if(isset($_POST['registrer'])){

    $query = "INSERT INTO interests (memberID)
    VALUES (LAST_INSERT_ID())";

    if(mysqli_query($conn, $query)){
            echo "suksess </h3>"; 
        } else{
            echo "feil ";
    }

}

?>