<?php

if ($conn->connect_error) {
    echo "Connection failed: " . $conn->connect_error;
} else {

    if (isset($_POST["submit"])) {

    $activity = $_POST["activity"];
    $responsible = $_POST["responsible"];
    $date = $_POST["date"];
    $start = $_POST["start"];
    $end = $_POST["end"];

    $sql = "INSERT INTO activities (`activity`, `responsible`, `date`, `start`, `end`) 
    VALUES ('$activity','$responsible',' $date','$start','$end');";

    mysqli_query($conn, $sql);
    }
}        

?>