<?php
include_once "config.php";

$first = $_POST["fnavn"];
$last = $_POST["enavn"];
$adress = $_POST["adresse"];
$postal = $_POST["pnummer"];
$gender = $_POST["kjønn"];
$email = $_POST["epost"];
$phone = $_POST["tlf"];
$birthDate = $_POST["fdato"];
$memberDate = $_POST["mdato"];
$interests = $_POST["interesser"];
$activities = $_POST["kaktiviteter"];
$status = $_POST["betalt"];

$sql = "INSERT INTO member (firstName, lastName, adress, 
postNumber, gender, email, phone, born, memberSince,
interests, courseActivities, contingentStatus) 
VALUES ('$first', '$last', '$adress', '$postal',
'$gender', '$email', '$phone', '$birthDate', '$memberDate',
'$interests', '$activities', '$status');";

mysqli_query($conn, $sql);
?>